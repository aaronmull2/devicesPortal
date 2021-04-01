@extends('layout')

@section('head')     
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>

<script>
let map;
let infoWindow = new google.maps.InfoWindows();
function initMap() {

  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 54.214919, lng:-2.23852 },
    zoom: 5.5,
  });

  var oms = new OverlappingMarkerSpiderfier(map, {
    markersWontMove: true,
    markersWontHide: true,
    basicFormatEvents: true
  });

  @foreach($alerts as $alert)
    var alert{{ $alert->id }} = new google.maps.Marker({
        position: { lat:{{ $alert->device->site->location->lat }}, lng:{{ $alert->device->site->location->lng }} },
        map,
        title: "{{ $alert->title }}",
    });

    var contentSite{{ $alert->id }} =
    "<div id='siteContent'>" +
    "<div id='siteNotice'>" +
    "<h6 id='siteHeading' class='siteHeading'><a href='/alerts/{{ $alert->id }}'>{{ $alert->title }}</a></h6>" +
    "<div id='siteContent'>" +
    "<table>" +
    "<tr>" +
    "<td><strong>Site:</strong></td>" +
    "<td><a href=/sites/{{ $alert->device->site->id }}'>{{ $alert->device->site->name }}</a></td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Alert Status:</strong></td>" +
    "<td><span class='dot' style='background-color:{{ $alert->alertStatus->css }} !important;'></span>&nbsp;-&nbsp;{{ $alert->alertStatus->name }}</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Assigned To:</strong></td>" +
    "<td><a href='/users/{{ $alert->user->id }}'>{{ $alert->user->name }}</a></td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Message:</strong></td>" +
    "<td>{{ $alert->message }}</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Device:</strong></td>" +
    "<td>{{ $alert->device->name }}</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Device Status:&nbsp;</strong></td>" +
    "<td><span class='dot' style='background-color:{{ $alert->device->deviceStatus->css }} !important;'></span>&nbsp;-&nbsp;{{ $alert->device->deviceStatus->name }}</td>" +
    "</tr>" +
    "<tr>" +
    "<td><strong>Priority:</strong></td>" +
    "<td>{{ $alert->priority }}</td>" +
    "</tr>" +
    "</table>" +
    "</div>" +
    "</div>" +
    "</div>";


    var infoWindowSite{{ $alert->id }} = new google.maps.InfoWindow();
    
    google.maps.event.addListener(alert{{ $alert->id }},'spider_click',(function(alert{{ $alert->id }},contentSite{{ $alert->id }},infoWindowSite{{ $alert->id }}){
        return function() {
            infoWindowSite{{ $alert->id }}.setContent(contentSite{{ $alert->id }});
            infoWindowSite{{ $alert->id }}.open(map,alert{{ $alert->id }})
        };
    })(alert{{ $alert->id }},contentSite{{ $alert->id }},infoWindowSite{{ $alert->id }}));

    oms.addMarker(alert{{ $alert->id }});
  @endforeach

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
@endsection