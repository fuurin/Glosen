<?php
require_once (dirname(__FILE__).'/MySmarty.class.php');
require_once (dirname(__FILE__).'/Auth.php');
require_once (dirname(__FILE__).'/MyPDO.php');
$params = include dirname(__FILE__).'/config.php';
$map_key = $params['map_key'];
$auth = new Auth();
if (!$auth->is_logged_in()) {
    header('Location: ./login.php');
    return;
}
if (count($_POST) != 0) {
    if (empty($_POST['title'])){
    	$error = "タイトルが入力されていません";
    }else if(empty($_POST['country'])) {
    	$error = "国名が入力されていません";
    }else if(empty($_POST['article'])) {
    	$error = "本文が入力されていません";
    }else{
        $pdo = new MyPDO();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = false;
        //画像が添付されているとき
        if (isset($_FILES['picture']) && isset($_FILES['picture']['error']) && $_FILES['picture']['error'] == 0) {
            $picture = $_FILES['picture'];
            if ($picture['size'] > 5 * 1024 * 1024) {
                $error = "サイズオーバーです(上限5MB)";
            } else {
                if (is_uploaded_file($_FILES["picture"]["tmp_name"])) {
                    $file1 = $_FILES["picture"]["tmp_name"]; // 元画像ファイル
                    $file2 = $_FILES["picture"]["tmp_name"] . "_"; // 画像保存先のパス
                    $in = ImageCreateFromJPEG($file1); // 元画像ファイル読み込み
                    $width = ImageSx($in); // 画像の幅を取得
                    $height = ImageSy($in); // 画像の高さを取得
                    $min_width = 800; // 幅の最低サイズ
                    $min_height = 600; // 高さの最低サイズ
                    $image_type = exif_imagetype($file1); // 画像タイプ判定用
                    if ($image_type == IMAGETYPE_JPEG) { // JPGかどうか判定
                        if ($width > $min_width || $height > $min_height) {
                            if ($width == $height) {
                                $new_width = $min_width;
                                $new_height = $min_height;
                            } else if ($width > $height) { //横長の場合
                                $new_width = $min_width;
                                $new_height = $height * ($min_width / $width);
                            } else if ($width < $height) { //縦長の場合
                                $new_width = $width * ($min_height / $height);
                                $new_height = $min_height;
                            }
                            //　画像生成
                            $out = ImageCreateTrueColor($new_width, $new_height);
                            ImageCopyResampled($out, $in, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                            ImageJPEG($out, $file2);

                            //位置情報をのせるとき
                            if (isset($_POST['location'])) {
                                $sql = "INSERT INTO kgp_article (id,title,country,university,article,lat,lng,zoom,picture) VALUE (?,?,?,?,?,?,?,?,?)";
                                $stmt = $pdo->prepare($sql);
                                $result = $stmt->execute(array($auth->get_id(), $_POST['title'], $_POST['country'], $_POST['university'], $_POST['article'], $_POST['lat'], $_POST['lng'], $_POST['zoom'], file_get_contents($_FILES['picture']['tmp_name'] . "_")));
                            } else {
                                $sql = "INSERT INTO kgp_article (id,title,country,university,article,picture) VALUE (?,?,?,?,?,?)";
                                $stmt = $pdo->prepare($sql);
                                $result = $stmt->execute(array($auth->get_id(), $_POST['title'], $_POST['country'], $_POST['university'], $_POST['article'], file_get_contents($_FILES['picture']['tmp_name'] . "_")));
                            }
                            
                        } else {
                            copy($file, $file2);
                        }
                    } else {
                        $error =  "JPG画像をご用意ください";
                    }
                }
            }
        } else {
            //位置情報をのせるとき
            if (isset($_POST['location'])) {
                $sql = "INSERT INTO kgp_article (id,title,country,university,article,lat,lng,zoom) VALUE (?,?,?,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute(array($auth->get_id(), $_POST['title'], $_POST['country'], $_POST['university'], $_POST['article'], $_POST['lat'], $_POST['lng'], $_POST['zoom']));
            } else {
                $sql = "INSERT INTO kgp_article (id,title,country,university,article) VALUE (?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute(array($auth->get_id(), $_POST['title'], $_POST['country'], $_POST['university'], $_POST['article']));
            }
        }
        if ($result) {
            //Success
            header('Location: ./list.php');
        } else {
            if(!isset($error)){
                $error = "投稿に失敗しました。";
            }                  
        }
    }
}
$smarty = new MySmarty();
$name = $auth->get_name();
if (!is_null($name)) {
    $smarty->assign('name', $name);
}
if (isset($error)) {
    $smarty->assign('error', $error);
}
$smarty->assign('params', $_POST);
$smarty->assign('load_map_js', true);
$smarty->assign('content_path', 'post.tpl');
$smarty->display('main.tpl');

?>