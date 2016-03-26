{* Post Article Page *}
<div>
	<h2 class="white_text">新規投稿</h2>
	<form action="./post.php" method="post" class="well" enctype="multipart/form-data">

		<div class="form-group">
			<label>タイトル</label>
			<input type="text" name="title" class="form-control" {if isset($params['title'])}value="{$params['title']}"{/if}>
		</div>
		<div class="form-group">
			<label>国</label>
			<input type="text" name="country" class="form-control" {if isset($params['country'])}value="{$params['country']}"{/if}>
		</div>
		<div class="form-group">
			<label>大学</label>
			<input type="text" name="university" class="form-control" {if isset($params['university'])}value="{$params['university']}"{/if}>
		</div>
		<div class="form-group">
			<label>本文</label>
			<textarea class="form-control" name="article" rows="20">{if isset($params['article'])}{$params['article']}{/if}</textarea>
		</div>
		<div class="form-group">
			<label>写真</label>
			<input type="file" name="picture" class="form-control">
		</div>
		<div class="form-group">
			<label>
			<input type="checkbox" name="location[]" value="" {if isset($params['location'])}checked="checked"{/if}>
			位置情報を添付	
			</label>
	    	<div id="map_canvas" style="width:500px; height:300px"></div>

			<input type="hidden" name="lat" id="lat" {if isset($params['lat'])}value="{$params['lat']}"{else}value="35.709984"{/if}>
			<input type="hidden" name="lng" id="lng" {if isset($params['lng'])}value="{$params['lng']}"{else}value="139.810703"{/if}>
			<input type="hidden" name="zoom" id="zoom" {if isset($params['zoom'])}value="{$params['zoom']}"{else}value="3"{/if}>
		</div>

		<div class="form-group">
			<input type="submit" value="投稿" class="btn btn-default">
		</div>
	</form>
</div>
<script type="text/javascript">
    	window.onload = function(){
			var latlng = new google.maps.LatLng(parseFloat($('#lat').val()), parseFloat($('#lng').val()));
			var opts = {
			zoom: parseInt($('#zoom').val()),
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