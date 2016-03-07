window.onload = function(){
	var latlng = new google.maps.LatLng(35.709984,139.810703);
	var opts = {
	zoom: 1,
	center: latlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("top_map_canvas"), opts);

	$('.bxslider').bxSlider({
		infiniteLoop: false,
		hideControlOnEnd: true
	});

	$.ajax({
	  type: "GET",
	  url: "./api/list.php",
	  data: {limit: "12"}
	}).done(function(resp) {
		console.log(resp);
		var len = resp.length;
	  	for(var i=0; i<3; i++){
	  		for(var j=0; j<4; j++){
	  			var count =i*4+j; 
	  			if(count<len){
	  				var img = $('<img>').attr({'src':'./picture.php?a_id='+resp[count]['a_id']});
	  				var text = $('<p>').text(resp[count]['article']);
	  				var div = $('<div>').addClass('col-lg-3 digest');
	  				div.append(img);
	  				div.append(text);
	  				$('.bxslider').children(':eq('+i+')').append(div);

	  			}
	  		}
	  	}
	});
}