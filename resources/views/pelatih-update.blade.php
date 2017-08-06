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
  <form method="POST" action="{{ url('pelatih') }}/{{ $user->id }}">
    <input name="_method" type="hidden" value="PUT" />
    <div class="box-header">
      <i class="fa fa-address-book-o"></i>

      <h3 class="box-title">Ubah Pelatih</h3>

    </div>
    <div class="box-body">
      <div class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" value="{{ $user->name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">E-Mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
          </div>
        </div>
        <div class="form-group">
          <label for="no-hp" class="col-sm-2 control-label">No. Hp</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="no_hp" id="no-hp" placeholder="No. Hp" value="{{ $user->no_hp }}">
          </div>
        </div>
        <div class="form-group">
          <label for="provinsi" class="col-sm-2 control-label">Provinsi</label>
          <div class="col-sm-10">
            <select class="form-control" disabled>
              <option>JAWA TENGAH</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="kabupaten" class="col-sm-2 control-label">Kabupaten</label>
          <div class="col-sm-10">
            <select class="form-control" disabled>
              <option>KABUPATEN KLATEN</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="kecamatan" class="col-sm-2 control-label">Kecamatan</label>
          <div class="col-sm-10">
            <select class="form-control" name="kecamatan_id">
              @foreach($kecamatan as $kec)
                @if($user->kecamatan_id == $kec->id)
                  <option value="{{ $kec->id }}" selected>{{ $kec->name }}</option>
                @else
                  <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                @endif
                
              @endforeach
            </select>
          </div>
        </div> 
        <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="2" name="alamat">{{ $user->alamat }}</textarea>
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
      $('#menu-pelatih').addClass('active');
    });
  </script>
@endpush


