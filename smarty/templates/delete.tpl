{* Confirm and Delete Article Page *}

	<script type="text/javascript">
		// Delete page has SQL to delete the article, and return top button
	</script>
	
<div>
	<h2 class="white_text">記事の削除</h2>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{$title|escape:"html"}の削除</h3>
		</div>
		<div class="panel-body">
			<p style="color: red;">{$message|escape:"html"}</p><br/>

			<button type="deleteBtn" class="btn btn-primary" style="background-color: red;"
				onclick="alert('記事を削除しました');">
				記事を削除
			</button>
		</div>

	</div>
</div>