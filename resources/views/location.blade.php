@extends('layouts.admin_template')


@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
  <div class="box-header">
    <i class="fa fa-map-pin"></i>

    <h3 class="box-title">Location</h3>

  </div>
  <div class="box-body">
    <button type="button" class="btn btn-success" data-toggle="modal" href="#form-add">
      <i class="fa fa-plus"></i> Tambah Lokasi Latihan
    </button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Kecamatan</th>
          <th>Penanggung Jawab</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php
        $index = 1
      @endphp
      @foreach ($location as $loc)
      <tr>
        <td style="width: 10px">{{ $index }}</td>
        <td>{{ $loc->nama }}</td>
        <td>{{ $loc->alamat }}</td>
        <td>{{ $loc->kecamatan->name }}</td>
        <td>{{ $loc->user->name }}</td>
        <td>
          <a href="{{ url('location') }}/{{ $loc->id }}">
            <button class="btn btn-info">
              <span class="glyphicon glyphicon-eye-open"></span>
            </button>
          </a>
          <a href="{{ url('location') }}/{{ $loc->id }}/edit">
            <button class="btn btn-success">
              Ubah
            </button>
          </a>
          <button class="btn btn-danger delete" data-toggle="modal" href="#form-delete" data-id="{{ $loc->id }}">
            Hapus
          </button>
        </td>
      </tr>
      @php
        $index++
      @endphp
      @endforeach
      </tbody>
    </table>
    {{ $location->links() }}
  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="form-add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="POST" action="{{ url('location') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Lokasi</h4>
        </div>
        <div class="modal-body">
            {!! csrf_field() !!}

            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama"/>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat"></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <label for="kecamatan" class="col-sm-2 control-label">Kecamatan</label>
              <div class="col-sm-10">
                <select class="form-control" name="kecamatan_id">
                  @foreach($kecamatan as $kec)
                    <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="pelatih" class="col-sm-2 control-label">Penanggung Jawab</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="penanggung_jawab">
                  @foreach($pelatih as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            

            
              
            <input type="hidden" class="form-control" name="latitude" id="latitude" >
          
            <input type="hidden" class="form-control" name="longitude" id="longitude" >
            

            <div id="map" style="height:250px;"></div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="form-delete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="#" id="url-delete" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Santri</h4>
        </div>
        <div class="modal-body">
            Apakah anda benar-benar ingin menghapus data ini?
            <input name="_method" type="hidden" value="DELETE" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="location_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Ya</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('javascript')
    <script>
      $(document).ready(function(){

        $('#menu-lokasi').addClass('active');

        $('.select2').select2();

        $('body').delegate('.delete','click',function(){
          var id = $(this).data('id');
          var url = "{{ url('location') }}" + "/" + id;
          $('#url-delete').attr('action', url);
        });
      });
    </script>
    <script>

      var markers = [];

      function initMap() {
        var myLatLng = {lat: -7.7730796, lng: 110.6270573};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });
        placeMarker(myLatLng, map);
        map.addListener('click', function(e) {
            if(markers.length > 0){
              clearMarkers();
            }
            placeMarker(e.latLng, map);
        });
      
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