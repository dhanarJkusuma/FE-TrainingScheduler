@extends('layouts.admin_template')


@section('content')

<div class="box box-success">
    <input name="_method" type="hidden" value="PUT" />
    <div class="box-header">
      <i class="fa fa-address-book-o"></i>

      <h3 class="box-title">Lihat Pelatih</h3>

    </div>
    <div class="box-body">
      <div class="form-horizontal">
        {!! csrf_field() !!}

        <div class="form-group">
          <label for="nama" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $location->nama }}" disabled />
          </div>
        </div>

        <div class="form-group">
          <label for="kecamatan" class="col-sm-2 control-label">Kecamatan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ $location->kecamatan->name }}" disabled>
          </div>
        </div>

        <div class="form-group">
          <label for="alamat" class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-10">
            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat" disabled>{{ $location->alamat }}</textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label for="pelatih" class="col-sm-2 control-label">Penanggung Jawab</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ $location->user->name }}" disabled>
          </div>
        </div>
        

        <div id="map" style="height:250px;"></div>
        
      </div>
    </div>
    
  </form>
</div>

@endsection

@push('javascript')
    <script>
      $(document).ready(function(){
        $('#menu-lokasi').addClass('active');
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