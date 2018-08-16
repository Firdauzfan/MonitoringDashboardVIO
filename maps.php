<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT VIO Intelligence Maps</title>
  <style type="text/css">
    html,body{margin:0px;height:100%;width:100%}
    .container2{width:100%;height:100%}
    .pane2{padding:0px 15px;background:#34495e;line-height:28px;color:#fff;z-index:10;position:absolute;top:20px;right:20px}
  </style>
 <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/maptalks/dist/maptalks.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/maptalks/dist/maptalks.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/three@0.84.0/build/three.min.js"></script>
  <script type="text/javascript" src="../dist/maptalks.three.js"></script>
  <script type="text/javascript" src="buildings.js"></script>
  <body>

    <div id="map" class="container2"></div>
    <div class="pane2"> Drag with Ctrl + left mouse or right mouse to tilt and rotate map </div>

    <script>
      var map = new maptalks.Map('map', {
        center: [106.7444622,-6.198187],
        zoom: 15,
        zoomControl : true,
        //allow map to drag pitching, true by default
        dragPitch : true,
        //allow map to drag rotating, true by default
        dragRotate : true,
        //enable map to drag pitching and rotating at the same time, false by default
        dragRotatePitch : true,
        baseLayer: new maptalks.TileLayer('base', {
          urlTemplate: 'http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',
          subdomains: ['a','b','c','d'],
          attribution: '&copy; <a href="http://gspe.co.id">PT VIO Intelligence</a>'
        }),
        layers: [
          new maptalks.VectorLayer('v')
        ]
      });

      var dcims = [
		  ['PT VIO Intelligence', 106.7476558,-6.201541]
		];


      var layer = new maptalks.VectorLayer('vector').addTo(map);

       for (var i = 0; i < dcims.length; i++) {
		    var dcim = dcims[i];
		    var marker = new maptalks.Marker(
	        [dcim[1],dcim[2]],
	        {
	          'properties' : {
	            'name' : dcim[0]
	          },
	          symbol : [
	            {
	              'markerFile'   : 'dist/img/pin.png',
	              'markerWidth'  : 35,
	              'markerHeight' : 40
	            },
	            {
	              'textFaceName' : 'sans-serif',
	              'textName' : '{name}',
	              'textSize' : 14,
	              'textDy'   : 24
	            }
	          ]
	        }
	      ).addTo(layer);
	  }
	  	marker.url= 'http://35.202.49.101:8080/dashboards/6f923810-7aab-11e8-ae79-6b7f9ada6497?publicId=6de3c430-9edb-11e8-8ddf-df0b78435755';

		marker.on('click', function () {
        window.location.href = this.url;
      })

    </script>



</script> -->
  </body>
</html>