@extends('layouts.pelatih')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jadwal Latihan</div>

                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                      <tbody>
                        <tr>
                          <td>Hari</td>
                          <td>:</td>
                          <td>{{ $hari[$jadwal->hari] }}</td>
                        </tr>
                        <tr>
                          <td>Grup</td>
                          <td>:</td>
                          <td>{{ $jadwal->group->nama_grup }}</td>
                        </tr>
                        <tr>
                          <td>Sesi</td>
                          <td>:</td>
                          <td>{{ $sesi[$jadwal->sesi] }}</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Info Anggota</div>

                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>No. HP</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($anggota->anggota as $a)
                        <tr>
                          <td>{{ $a->name }}</td>
                          <td>{{ $a->alamat }}</td>
                          <td>{{ $a->no_hp }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Info Lokasi</div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered">
                    <tbody>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $location->alamat }}</td>
                      </tr>
                      <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{ $location->kecamatan->name }}</td>
                      </tr>
                      <tr>
                        <td>Penanggung Jawab Lokasi</td>
                        <td>:</td>
                        <td>{{ $location->user->name }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div id="map" style="height:250px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function(){
            $('#menu-agenda').addClass('active');
        });
    </script>
    <script>

      var markers = [];

      function initMap() {
        var latitude = Number({{ $location->latitude }});
        var longitude = Number({{ $location->longitude }});
        var myLatLng = {lat: latitude , lng: longitude};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });
        placeMarker(myLatLng, map);
      
    }

    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    function clearMarkers() {
      setMapOnAll(null);
    }

    function deleteMarkers() {
      clearMarkers();
      markers = [];
    }

    function placeMarker(position, map) {
      var marker = new google.maps.Marker({
          position: position,
          map: map
      });
      $('#latitude').val(position.lat);
      $('#longitude').val(position.lng);
      map.panTo(position);
      markers.push(marker);
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3Y8V01JqINBeAjqxAXcMHsk9LCREw&callback=initMap">
    </script>
@endpush