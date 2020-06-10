<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Display map navigation controls</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<div id="map"></div>
<script>
	mapboxgl.accessToken = '<your access token here>';
var map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v11',
center: [-74.5, 40], // starting position
zoom: 9 // starting zoom
});
 
// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl());
</script>
 
</body>
</html>