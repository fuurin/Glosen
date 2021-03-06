{* Article List Page *}
<div>
	<h2></h2>

	{if isset($load_map_js)}
		<script type="text/javascript">
    	window.onload = function(){
			var latlng = new google.maps.LatLng({$article['lat']},{$article['lng']});
			var opts = {
			zoom: {$article['zoom']},
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map_canvas"), opts);
			var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
	    }
	    </script>
	{/if}

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{$article['title']|escape:"html"}</h3>
		</div>
		<div class="panel-body">
			<p>投稿者: {$author_name|escape:"html"}</p>
			<p>国: {$article['country']|escape:"html"}</p>
			<p>大学: {$article['university']|escape:"html"}</p><br/>
			<div>
				{$article['article']}
			</div><br/>
			{if !is_null($article['picture'])}
				<div class="picture">
					<img style="max-width: 100%; height: auto;" src="./picture.php?a_id={$article['a_id']}">
				</div>
			{/if}
			{if isset($load_map_js)}
				<div id="map_canvas"></div>
			{/if}

			<br/>

			<div>
				{if isset($id) && $id==$article['id']}
				<a href="./edit.php?a_id={$article['a_id']}">
					<button type="button" class="btn btn-primary">
						記事を編集
					</button>
				</a>

				<form action="./delete.php" method="post" style="display: inline;">
					<input type="hidden" name="a_id" value="{$article['a_id']}"></input>
					<input type="hidden" name="title" value="{$article['title']}"></input>
					<input type="submit" class="btn btn-primary"　
					style="margin-left: 20px; font-weight: bold;" value="記事を削除">	
				</form>
				{/if}
			</div>

		</div>
	</div>
</div>