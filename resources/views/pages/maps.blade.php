@extends('layouts.master')

@section('title','CCI Maps')

@section('conten')
<style>
    #map{
        width:82vw;
        height:80vh;
        margin:0;
    }
</style>

<div class="card">
    <div class="card-header bg-white">
        <h3 style="text-align: center;">CCI Maps</h3>
    </div>

    <div class="card-body">
        <div id="map"></div>
    </div>

</div>


@endsection

@push('service')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
    let map = L.map('map').setView([-6.290733644820784, 106.82472304001975], 13);
    let latLng1 = L.latLng(-6.290733644820784, 106.82472304001975);
    let latLng2 = L.latLng(-6.28753120773981, 106.84530439214467);
    let wp1 = new L.Routing.Waypoint(latLng1);
    let wp2 = new L.Routing.Waypoint(latLng2);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.Routing.control({
        waypoints: [latLng1, latLng2]
    }).addTo(map);

    let routeUs = L.Routing.osrmv1();
    routeUs.route([wp1,wp2],(err, routes)=>{
        if(!err)
        {
          let best = 100000000000000;
          let bestRoute = 0;
          for(i in routes)
          {
            if(routes[i].summary.totalDistance < best){
                bestRoute = i;
                best = routes[i].summary.totalDistance;
            }
          }
          console.log('best route', routes[bestRoute]);
          L.Routing.line(routes[bestRoute], {
            styles : [
                {
                    color: 'green',
                    weight: '10'
                }
            ]
          }).addTo(map);
        }
    })
</script>
@endpush
