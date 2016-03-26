var map = null;

var openedInfoWindow;

function addInfoWindow(marker, content){
	google.maps.event.addListener(marker, 'click', function(event) {
		if (openedInfoWindow) openedInfoWindow.close();
		openedInfoWindow = new google.maps.InfoWindow({
			content: content
		}).open(marker.getMap(), marker);
	});
}

window.onload = function(){
	var latlng = new google.maps.LatLng(35.709984,139.810703);
	var opts = {
	zoom: 1,
	center: latlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("top_map_canvas"), opts);

	$('.bxslider').bxSlider({
		infiniteLoop: false,
		hideControlOnEnd: true
	});

	$.ajax({
	  type: "GET",
	  url: "./api/list.php",
	  data: {limit: "12"}
	}).done(function(resp) {
		// console.log(resp);
		var len = resp.length;	  	
	  	for(var i=0; i<3; i++){
	  		for(var j=0; j<4; j++){
	  			var count =i*4+j; 
	  			if(count<len){

	  				// 新着記事をスライダーに表示
	  				var title = $('<a>').attr({'href':'./show.php?a_id='+resp[count]['a_id']}).text(resp[count]['title']);
	  				var img = $('<img>').attr({'src':'./picture.php?a_id='+resp[count]['a_id']});
	  				var text = $('<p>').text(resp[count]['article']);
	  				var href = $('<a>').attr({'href':'./show.php?a_id='+resp[count]['a_id']});
	  				var t = resp[count]['date'].split(/[- :]/);
	  				var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	  				var date = $('<span>').text(d.getFullYear()+"/"+(d.getMonth()+1)+"/"+d.getDay()).addClass("date");
	  				href.append(img);
	  				var div = $('<div>').addClass('col-lg-3 digest');
	  				div.append(title);
	  				div.append(href);
	  				div.append(date);
	  				div.append(text);
	  				$('.bxslider').children(':eq('+i+')').append(div);

	  				//マーカーを表示
	  				var lat = resp[count]['lat'];
	  				var lng = resp[count]['lng'];
	  				// console.log(lat)
	  				if (lat!=null && lng!=null){
	  					var marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map
					  	});
						var content = "<a href=\"./show.php?a_id="+resp[count]['a_id']+"\">"+resp[count]['title']+"</a>";
						addInfoWindow(marker, content);
	  				}
	  			}
	  		}
	  	}

	});
}