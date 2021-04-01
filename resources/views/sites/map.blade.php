@extends('layout')

@section('head')     
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>
let map;
let infoWindow = new google.maps.InfoWindows();
function initMap() {

  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 54.214919, lng:-2.23852 },
    zoom: 5.5,
  });
  @foreach($sites as $site)
    var site{{ $site->id }} = new google.maps.Marker({
        position: { lat:{{ $site->location->lat }}, lng:{{ $site->location->lng }} },
        map,
        title: "{{ $site->name }}",
    });
    var contentSite{{ $site->id }} = 
    "<div id='siteContent'>" +
    "<div id='siteNotice'>" +
    "<h6 id='siteHeading' class='siteHeading'>{{ $site->name }}</h6>" +
    "<div id='siteContent'>" +
    "<p id='siteAddress'><strong>Address: </strong>{{ $site->location->address_line_1 }},@if($site->location->address_line_2 != '') {{ $site->location->address_line_2 }}, @endif {{ $site->location->city_town }}, {{ $site->location->county }}, {{ $site->location->postcode }} </p>" +
    "<p class='status-list'><strong>Devices: </strong></p>" +
    "<ul class='no-bullets'>" +
    @foreach($devices as $device)
        @if($device->site_id == $site->id)
            "<li class='status-list'><span class='dot' style='background-color:{{ $device->deviceStatus->css }} !important;'></span>&nbsp;{{ $device->name }}</li>" +
        @endif
    @endforeach
    "</ul>" +
    "</div>" +
    "</div>" +
    "</div>"




    var infoWindowSite{{ $site->id }} = new google.maps.InfoWindow();
    
    google.maps.event.addListener(site{{ $site->id }},'click',(function(site{{ $site->id }},contentSite{{ $site->id }},infoWindowSite{{ $site->id }}){
        return function() {
            infoWindowSite{{ $site->id }}.setContent(contentSite{{ $site->id }});
            infoWindowSite{{ $site->id }}.open(map,site{{ $site->id }})
        };
    })(site{{ $site->id }},contentSite{{ $site->id }},infoWindowSite{{ $site->id }}));
  @endforeach

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
@endsection