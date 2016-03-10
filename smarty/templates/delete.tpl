{* Confirm and Delete Article Page *}

	<script type="text/javascript">
		function deleteArticle(a_id) {
			console.log(a_id);
			$.ajax({
			  type: "POST",
			  url: "api/deleteExec.php",
			  data: "a_id=" + a_id,
			  success: function(){
				alert('記事を削除しました。');
				document.location = "./list.php";
			  }
			});
		}
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
				onclick="deleteArticle({$a_id});">
				記事を削除
			</button>

			<br/><br/>

			<a href="./show.php?a_id={$a_id}">
				<button type="deleteBtn" class="btn btn-primary">
					記事に戻る
				</button>
			</a>
		</div>

	</div>
</div>