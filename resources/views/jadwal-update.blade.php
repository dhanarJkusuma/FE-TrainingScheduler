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
  <form method="POST" action="{{ url('jadwal') }}/{{ $jadwal->id }}">
    <input name="_method" type="hidden" value="PUT" />
    <div class="box-header">
      <i class="fa fa-address-book-o"></i>

      <h3 class="box-title">Ubah Jadwal</h3>

    </div>
    <div class="box-body">
      <div class="form-horizontal">
        {!! csrf_field() !!}
        <input type="hidden" name="grup_id" value="{{ $jadwal->group->id }}"/>
  
        <div class="form-group">
          <label for="group" class="col-sm-2 control-label">Grup</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ $jadwal->group->nama_grup }}" disabled>
          </div>
        </div>
        
        <div class="form-group">
          <label for="hari" class="col-sm-2 control-label">Hari</label>
          <div class="col-sm-10">
            <select class="form-control" name="hari">
              @php
                $v_hari = 1;
              @endphp
              @foreach($hari as $h)
                @if($jadwal->hari == $v_hari)
                  <option value="{{ $v_hari }}" selected>{{ $h }}</option>
                @else
                  <option value="{{ $v_hari }}">{{ $h }}</option>
                @endif
                @php
                  $v_hari++;
                @endphp
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="sesi" class="col-sm-2 control-label">Sesi</label>
          <div class="col-sm-10">
            <select class="form-control" name="sesi">
              @php
                $v_sesi = 1;
              @endphp
              @foreach($sesi as $s)
                @if($jadwal->sesi == $v_sesi)
                  <option value="{{ $v_sesi }}" selected>{{ $s }}</option>
                @else
                  <option value="{{ $v_sesi }}">{{ $s }}</option>
                @endif
                @php
                  $v_sesi++;
                @endphp
              @endforeach
            </select>
          </div>
        </div>
        
        

        <div class="form-group">
          <label for="pelatih_i" class="col-sm-2 control-label">Pelatih I</label>
          <div class="col-sm-10">
            <select class="form-control" id="pelatih_i" name="pelatih_i" style="width: 100%;">
              <option value="0">Pilih Pelatih I</option>
              @foreach($pelatih as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        
        <div class="form-group">
          <label for="pelatih_ii" class="col-sm-2 control-label">Pelatih II</label>
          <div class="col-sm-10">
            <select class="form-control" id="pelatih_ii" name="pelatih_ii" style="width: 100%;">
              <option value="0">Pilih Pelatih II</option>
              @foreach($pelatih as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="form-group">
          <label for="pelatih_iii" class="col-sm-2 control-label">Pelatih III</label>
          <div class="col-sm-10">
            <select class="form-control" name="pelatih_iii" id="pelatih_iii" style="width: 100%;">
              <option value="0">Pilih Pelatih III</option>
              @foreach($pelatih as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
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
        
        var pelatih_i = {{ $jadwal->pelatih1->id }};
        var pelatih_ii = {{ ($jadwal->pelatih2!=null) ? $jadwal->pelatih2->id : 0 }};
        var pelatih_iii = {{ ($jadwal->pelatih3!=null) ? $jadwal->pelatih3->id : 0 }};

        $('#pelatih_i').select2();
        $('#pelatih_ii').select2();
        $('#pelatih_iii').select2();

        $('#pelatih_i').val(pelatih_i).trigger('change.select2');
        $('#pelatih_ii').val(pelatih_ii).trigger('change.select2');
        $('#pelatih_iii').val(pelatih_iii).trigger('change.select2');
        
        
      });
    </script>
   
@endpush