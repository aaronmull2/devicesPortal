@extends('layout')

@section('head')     
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>
let map;

var marker = {};
var markers = [];
var content = {};
var contents = [];
var infoWindow = {};
var infoWindows = [];

function markerData(site) {
    return new google.maps.Marker({
        position: { lat:site.location.lat, lng:site.location.lng },
        map,
        title: site.name,
    });
}

function contentData(site) {
  var dStatusCss = {1:"#7FFF00",2:"#FFA500",3:"#FF0000"};
  var dStatusName = {1:"Working",2:"Working With Issue",3:"Not Working"};

  var ad2 = "";
  if(site.location.address_line_2 != ''){
      ad2 = String(site.location.address_line_2) + ", ";
  }

  var dev = "";
  for(var i = 0; i < site.device.length; i++) {
    dev += "<li class='status-list'><span class='dot' style='background-color:" + dStatusCss[site.device[i].device_status_id] +" !important;'></span>&nbsp;"+ site.device[i].name+ "</li>";
  }

  return "<div id='siteContent'>" +
    "<div id='siteNotice'>" +
    "<h6 id='siteHeading' class='siteHeading'>" + site.name + "</h6>" +
    "<div id='siteContent'>" +
    "<p id='siteAddress'><strong>Address: </strong>" + site.location.address_line_1 + ", " + ad2 + site.location.city_town+", "+ site.location.county+", "+ site.location.postcode+ " </p>" +
    "<p class='status-list'><strong>Devices: </strong></p>" +
    "<ul class='no-bullets'>" +
    dev +
    "</ul>" +
    "</div>" +
    "</div>" +
    "</div>";
}

function addListener(marker,content,infoWindow) {
    google.maps.event.addListener(marker,'click',(function(marker,content,infoWindow){
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

  var sites = @json($sites);

for(var i = 0; i < sites.length; i++) {

  marker[i] = markerData(sites[i]);
  content[i] = contentData(sites[i]);
  infoWindow[i] = new google.maps.InfoWindow();

  console.log(marker[i],content[i],infoWindow[i]);

  markers.push(marker[i]); 
  addListener(marker[i],content[i],infoWindow[i]);
}

}
</script>

@endsection

@section('header') Sites Map @endsection

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
  $.get( "/sites/map/data", function( data ) {
    for (const element of markers) {
        element.setMap(null);
    }
    for (const site of data) {
      var m = markerData(site);
      m.setMap(map);
      var c = contentData(site);
      infoWindow = new google.maps.InfoWindow();
      addListener(m,c,infoWindow);
    }
  });   
}, 30000);
</script>
@endsection