@extends('layout')

@section('head')     
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>

<script>
let map;

var marker = {};
var markers = [];
var content = {};
var contents = [];
var infoWindow = {};
var infoWindows = [];
let oms;

function markerData(engineer) {
    return new google.maps.Marker({
        position: { lat:engineer.lat, lng:engineer.lng },
        map,
        title: engineer.user.name,
    });
}

function contentData(engineer) {

  return     "<div id='siteContent'>" +
    "<div id='siteNotice'>" +
    "<h6 id='siteHeading' class='siteHeading'><a href='/users/" + engineer.user.id + "'>" + engineer.user.name + "</a></h6>" +
    "<div id='siteContent'>" +
    "<table>" +
    "<tr>" +
    "<td><strong>Co-ordinates;</strong></td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Latitude:</strong></td>" +
    "<td>"+ engineer.lat +"</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Longitude:</strong></td>" +
    "<td>"+ engineer.lng +"</td>" +
    "</tr>" +
    "</table>" +
    "</div>" +
    "</div>" +
    "</div>";
}

function addListener(marker,content,infoWindow) {
    google.maps.event.addListener(marker,'spider_click',(function(marker,content,infoWindow){
        return function() {
          infoWindow.setContent(content);
          infoWindow.open(map, marker);
        };
    })(marker,content,infoWindow));

}

function initMap() {

  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 54.214919, lng:-2.23852 },
    zoom: 5.5,
  });

  oms = new OverlappingMarkerSpiderfier(map, {
    markersWontMove: true,
    markersWontHide: true,
    basicFormatEvents: true
  });

  var engineers = @json($engineers);
  console.log(engineers);

  for(var i = 0; i < engineers.length; i++) {

    marker[i] = markerData(engineers[i]);
    content[i] = contentData(engineers[i]);
    infoWindow[i] = new google.maps.InfoWindow();

    markers.push(marker[i]); 
    addListener(marker[i],content[i],infoWindow[i]);

    oms.addMarker(marker[i]);

  }
  
}
</script>

@endsection

@section('header') Engineers Locations @endsection

@section ('content')
    <div id="map"></div>
@endsection

@section('scripts')


<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvu0K-WuK4ESlwEIK1VRlS39u_XvfuyS4&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script>
setInterval(function() {
  $.get( "/users/map/data", function( data ) {
    for (const element of markers) {
        element.setMap(null);
        oms.removeAllMarkers();
    }
    for (const engineer of data) {
      var m = markerData(engineer);
      m.setMap(engineer);
      var c = contentData(engineer);
      infoWindow = new google.maps.InfoWindow();
      addListener(m,c,infoWindow);
      oms.addMarker(m);
    }
  });   
}, 30000);
</script>
@endsection