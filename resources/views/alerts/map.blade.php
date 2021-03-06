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

function markerData(alert) {
    return new google.maps.Marker({
        position: { lat:alert.device.site.location.lat, lng:alert.device.site.location.lng },
        map,
        title: alert.title,
    });
}

function contentData(alert) {
  var aStatusCss = {1:"#7FFF00",2:"#FFA500",3:"#FF0000",4:"#B3B3B3"};
  var dStatusCss = {1:"#7FFF00",2:"#FFA500",3:"#FF0000"};
  var aStatusName = {1:"In Progress",2:"Paused",3:"Backlog",4:"On Hold"};
  var dStatusName = {1:"Working",2:"Working With Issue",3:"Not Working"};

  return     "<div id='siteContent'>" +
    "<div id='siteNotice'>" +
    "<h6 id='siteHeading' class='siteHeading'><a href='/alerts/" + alert.id + "'>" + alert.title + "</a></h6>" +
    "<div id='siteContent'>" +
    "<table>" +
    "<tr>" +
    "<td><strong>Site:</strong></td>" +
    "<td><a href=/sites/" + alert.device.site.id + "'>" + alert.device.site.name + "</a></td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Alert Status:</strong></td>" +
    "<td><span class='dot' style='background-color:" + aStatusCss[alert.alert_status_id] + " !important;'></span>&nbsp;-&nbsp;" + aStatusName[alert.alert_status_id] + "</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Assigned To:</strong></td>" +
    "<td><a href='/users/" + alert.user.id + "'>" + alert.user.name + "</a></td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Message:</strong></td>" +
    "<td>" + alert.message + "</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Device:</strong></td>" +
    "<td>" + alert.device.name + "</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Device Status:&nbsp;</strong></td>" +
    "<td><span class='dot' style='background-color:" + dStatusCss[alert.device.device_status_id] + " !important;'></span>&nbsp;-&nbsp;" + dStatusName[alert.device.device_status_id] + "</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Priority:</strong></td>" +
    "<td>" + alert.priority + "</td>" +
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

  var alerts = @json($alerts);

  for(var i = 0; i < alerts.length; i++) {

    marker[i] = markerData(alerts[i]);
    content[i] = contentData(alerts[i]);
    infoWindow[i] = new google.maps.InfoWindow();

    markers.push(marker[i]); 
    addListener(marker[i],content[i],infoWindow[i]);

    oms.addMarker(marker[i]);

  }
  
}
</script>

@endsection

@section('header') Alerts Map @endsection

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
  $.get( "/alerts/map/data", function( data ) {
    for (const element of markers) {
        element.setMap(null);
        oms.removeAllMarkers();
    }
    for (const alert of data) {
      var m = markerData(alert);
      m.setMap(map);
      var c = contentData(alert);
      infoWindow = new google.maps.InfoWindow();
      addListener(m,c,infoWindow);
      oms.addMarker(m);
    }
  });   
}, 30000);
</script>
@endsection