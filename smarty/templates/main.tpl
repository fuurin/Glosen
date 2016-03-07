{* Main Frame *}
{* require $content_path *}
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Glosen -Kosen Global Project-</title>
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/bootstrap.css">
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.js"></script>
{if isset($load_map_js) && $load_map_js}
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={$map_key}"></script>
{/if}
</head>
<body>
	<div id="container">
		<header>
			<a href="./" class="navbar-brand">
				<img src="./img/logo.png" class="img-rounded" alt="Glosen -logo-">
			</a>
			<ul id="user_menu" class="nav nav-pills">
					<li>
						<a href="./list.php">記事一覧</a>
					</li>
				{if isset($name)}
					<li>
						<a href="./post.php">記事を書く</a>
					</li>
					<li>
						<a href="./logout.php">ログアウト</a>
					</li>
					<li>
						<a href="#">マイページ</a>
					</li>
				{else}
					<li>
						<a href="./register.php">新規登録</a>
					</li>
					<li>
						<a href="./login.php">ログイン</a>
					</li>
				{/if}
			</ul>
			
			<ul id="header_menu" class="nav nav-justified">
				<li>
					<a href="./about.php">高専留学とは</a>
				</li>
				<li>
					<a href="#">留学のプロセス</a>
				</li>
				<li>
					<a href="#">ロールモデル</a>
				</li>
				<li>
					<a href="#">奨学金</a>
				</li>
				<li>
					<a href="#">相談する</a>
				</li>
			</ul>
		</header>
		<div id="content">
			{if isset($error)}
				<div class="alert alert-danger" role="alert">{$error}</div>
			{/if}
			{include file="$content_path"}
		</div>
	</div>
</body>
</html>