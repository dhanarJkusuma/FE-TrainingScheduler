@extends('layouts.admin_template')


@section('content')


@if(session()->has('status'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{ session('status') }}</strong>
  </div>
@endif

@if(session()->has('error'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{ session('error') }}</strong>
  </div>
@endif


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
      <div style="width: 70%; margin-left: auto; margin-right: auto;margin-top:20px;">
      @if(count($users) > 0)
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
              @if($user->user != null)
              <td>
                @if($user->id == $group->user->id )
                <span class="glyphicon glyphicon-tower"></span> Ketua Grup
                @else
                <a href="#form-chleader" data-toggle="modal">
                  <button class="btn btn-sm btn-primary chleader" data-id="{{ $user->id }}">
                    Jadikan Ketua
                  </button>
                </a>
                @endif
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-info" role="alert">
          <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
          Belum ada anggota.
        </div>
        @endif
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
            <td>{{ ($group->user != null) ? $group->user->name : "Belum Tersedia." }}</td>
          </tr>
        </tbody>
      </table>      
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="form-chleader">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="#" id="url-leader" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Jadikan Ketua Grup</h4>
        </div>
        <div class="modal-body">
            Apakah anda benar-benar ingin menjadikan santri ini menjadi ketua grup ?
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="leader" id="user_id">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@push('javascript')
    <script>
      $(document).ready(function(){
        $('#menu-grup').addClass('active');

        $('body').delegate('.chleader', 'click', function(){
          var id = $('.chleader').data('id');
          $('#user_id').val(id);

          var url = "{{ url('group/leader') }}/" + "{{ $group->id }}";

          $('#url-leader').attr('action', url);
        });
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

