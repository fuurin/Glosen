{* Post Article Page *}
<div>
	<h2>新規投稿</h2>
	<form action="./post.php" method="post" class="well" enctype="multipart/form-data">

		<div class="form-group">
			<label>タイトル</label>
			<input type="text" name="title" class="form-control">
		</div>
		<div class="form-group">
			<label>国</label>
			<input type="text" name="country" class="form-control">
		</div>
		<div class="form-group">
			<label>大学</label>
			<input type="text" name="university" class="form-control">
		</div>
		<div class="form-group">
			<label>本文</label>
			<textarea class="form-control" name="article" rows="20"></textarea>
		</div>
		<div class="form-group">
			<label>写真</label>
			<input type="file" name="picture" class="form-control">
		</div>
		<div class="form-group">
			<label>
			<input type="checkbox" name="location[]" value="">
			位置情報を添付	
			</label>
	    	<div id="map_canvas" style="width:500px; height:300px"></div>

			<input type="hidden" name="lat" id="lat" value="">
			<input type="hidden" name="lng" id="lng" value="">
			<input type="hidden" name="zoom" id="zoom" value="">
		</div>

		<div class="form-group">
			<input type="submit" value="投稿" class="btn btn-default">
		</div>
	</form>
</div>
<script type="text/javascript">
    	window.onload = function(){
			var latlng = new google.maps.LatLng(35.709984,139.810703);
			var opts = {
			zoom: 3,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map_canvas"), opts);

			map.addListener('idle', function() {
			    console.log('idle'+map.getCenter());
			    var latlng = map.getCenter();
			    var zoom = map.getZoom();
			    $('#lat').val(latlng.lat());
			    $('#lng').val(latlng.lng());
			    $('#zoom').val(zoom);
			});

    	}
    </script>