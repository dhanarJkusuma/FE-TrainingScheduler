@extends('layouts.admin_template')


@section('content')

<div class="nav-tabs-custom">
  <!-- Tabs within a box -->
  <ul class="nav nav-tabs pull-right">
    <li><a href="#lokasi" data-toggle="tab">Lokasi</a></li>
    <li><a href="#anggota" data-toggle="tab">Anggota</a></li>
    <li class="active"><a href="#overview" data-toggle="tab">Ringkasan</a></li>
    <li class="pull-left header"><i class="fa fa-database"></i> Data Grup "{{ $group->nama_grup }}"</li>
  </ul>
  <div class="tab-content no-padding">
    <!-- Morris chart - Sales -->
    <div class="chart tab-pane" id="lokasi" style="position: relative; height: 400px;">
      <div style="width: 70%; margin-left: auto; margin-right: auto">
        <table class="table table-bordered" >
          <tbody>
             <tr>
              <th>Nama Lokasi Latihan</th>
              <td>:</td>
              <td>{{ $group->location->nama }}</td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>:</td>
              <td>{{ $group->location->alamat }}</td>
            </tr>
          </tbody>
        </table>
        <div id="map" style="height:250px;"></div>
      </div>

    </div>
    <div class="chart tab-pane" id="anggota" style="position: relative; height: 300px;">
      <div style="width: 70%; margin-left: auto; margin-right: auto">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>Nama Anggota</th>
              <th>No.HP</th>
              <th>Kecamatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
             <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->no_hp }}</td>
              <td>{{ $user->kecamatan->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="chart tab-pane active" id="overview" style="position: relative; height: 300px;">
      <div style="width: 70%;margin-left:auto;margin-right:auto;">
        <table class="table table-bordered" style="margin-top:80px;">
        <tbody>
          <tr>
            <th>Nama Grup</th>
            <td>:</td>
            <td>{{ $group->nama_grup }}</td>
          </tr>
          <tr>
            <th>Ketua Grup</th>
            <td>:</td>
            <td>{{ $group->user->name }}</td>
          </tr>
        </tbody>
      </table>      
      </div>
    </div>
  </div>
</div>


@endsection

@push('javascript')
    <script>
      $(document).ready(function(){
        $('#menu-grup').addClass('active');
      });
    </script>
    <script>

      var markers = [];

      function initMap() {
        var latitude = Number({{ $group->location->latitude }});
        var longitude = Number({{ $group->location->longitude }});
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

