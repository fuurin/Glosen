{* Top Page *}
<div>
	<link href="./css/jquery.bxslider.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="./js/top.js"></script>

	<form action="./list.php" method="get" class="well">
		<h3>記事を探す</h3>
		<div class="input-group">
			<input type="text" name="query" class="form-control" placeholder="キーワード">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default" type="button">検索</button>
			</span>
		</div>
	</form>
	
    <div id="top_map_canvas"></div>

   <ul class="bxslider">
	   	<li></li>
	   	<li></li>
	   	<li></li>
	</ul>
</div>