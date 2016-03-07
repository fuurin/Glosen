{* Register  Page *}
<div>
	<h2 class="white_text">新規ユーザー登録</h2>
	<form action="./register.php" method="post" class="well">
		<div class="form-group">
			<label>ユーザー名</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label>パスワード</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<label>パスワード(再入力)</label>
			<input type="password" name="password_confirm" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" value="ログイン" class="btn btn-default">
		</div>
	</form>
</div>