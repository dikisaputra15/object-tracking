@extends('layouts.master')

@section('title','CCI Maps')

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
            height: 400px;
        }
    #coordinates {
            margin-top: 10px;
        }
</style>

@endpush

@section('conten')

<div class="card">
    <div class="card-header bg-white">
        <h3 style="text-align: center;">Form Input Lokasi</h3>
    </div>

    <div class="card-body">

    <div class="row">
        <div class="col-6">
            <div class="form-group">
            <input type="text" id="address" placeholder="Masukkan alamat" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <button id="findLocation" class="btn btn-primary">Cari Lokasi</button>
        </div>
    </div>

        <div id="map"></div>


    <form action="/Store-Lokasi" method="post">
    @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" id="latitude" name="lat" class="form-control" readonly>
                </div>
             </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" id="longitude" name="long" class="form-control" readonly>
                </div>
             </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="simpan" value="Save" />
                </div>
            </div>
        </div>
    </form>

    </div>

</div>


@endsection

@push('service')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch/dist/geosearch.umd.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-6.200000, 106.816666], 13); // Koordinat Jakarta

        // Tambahkan layer peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const { latitude, longitude } = position.coords;
                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('Anda berada di sini!')
                    .openPopup();
                map.setView([latitude, longitude], 13);

                // Tampilkan koordinat di input text
                document.getElementById('latitude').value = latitude.toFixed(6);
                document.getElementById('longitude').value = longitude.toFixed(6);
            });
        }

        // Fungsi untuk mencari lokasi berdasarkan alamat
        const search = new GeoSearch.OpenStreetMapProvider();

        document.getElementById('findLocation').addEventListener('click', () => {
            const address = document.getElementById('address').value;
            search.search({ query: address }).then((result) => {
                if (result.length > 0) {
                    const { y, x } = result[0];
                    L.marker([y, x]).addTo(map)
                        .bindPopup(result[0].label)
                        .openPopup();
                    map.setView([y, x], 13);

                   // Tampilkan latitude dan longitude di input text
                    document.getElementById('latitude').value = y.toFixed(6);
                    document.getElementById('longitude').value = x.toFixed(6);
                } else {
                    alert('Alamat tidak ditemukan');
                }
            });
        });
    </script>
@endpush
