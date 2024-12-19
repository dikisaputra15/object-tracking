@extends('layouts.master')

@section('title','All Maps')

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
        height: 500px;
    }
</style>

@endpush

@section('conten')
<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3 style="text-align: center;">All Maps</h3>
    </div>

    <div id="map"></div>

</div>


@endsection

@push('service')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-6.200000, 106.816666], 4);

        // Tambahkan layer peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Data lokasi dari database
        const locations = @json($locations);

        // Tambahkan marker untuk setiap lokasi
        locations.forEach(location => {
            L.marker([location.latitude, location.longitude]).addTo(map)
                .bindPopup(`<b>${location.deskripsi}</b>`);
        });
    </script>
@endpush
