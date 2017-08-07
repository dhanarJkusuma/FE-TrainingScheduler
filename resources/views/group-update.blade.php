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
  <form method="POST" action="{{ url('group') }}/{{ $group->id }}">
    <input name="_method" type="hidden" value="PUT" />
    <div class="box-header">
      <i class="fa fa-address-book-o"></i>

      <h3 class="box-title">Ubah Group</h3>

    </div>
    <div class="box-body">
      <div class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="nama_grup" class="col-sm-2 control-label">Nama Grup</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_grup" id="nama_grup" placeholder="Nama Grup" value="{{ $group->nama_grup }}">
          </div>
        </div>
        <div class="form-group">
          <label for="lokasi_latihan_id" class="col-sm-2 control-label">Lokasi Latihan</label>
          <div class="col-sm-10">
            <select class="form-control" id="lokasi" name="lokasi_latihan_id" style="width:100%;">
              @foreach($location as $loc)
                <option value="{{ $loc->id }}">{{ $loc->nama }}</option>
              @endforeach
            </select>
          </div>
        </div> 
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">
        Simpan
      </button>
    </div>
  </form>
</div>

@endsection

@push('javascript')
  <script>
  $(document).ready(function(){
    $('#menu-grup').addClass('active');
    
    
    $('#ketua').select2();
    $('#lokasi').select2();


    var lokasi = {{ $group->location->id }};
    $('#lokasi').val(lokasi).trigger('change.select2');
    
    //$('.select2').select2('data', {id: value, a_key: key});
  });
  </script>
@endpush


