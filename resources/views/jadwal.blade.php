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

<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-users"></i>

    <h3 class="box-title">Info Grup</h3>

  </div>
  <div class="box-body">
    <table class="table table-bordered">
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

<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-calendar"></i>

    <h3 class="box-title">Jadwal</h3>
  
  </div>
  <div class="box-body">
    <button type="button" class="btn btn-success" data-toggle="modal" href="#form-add">
      <i class="fa fa-plus"></i> Tambah Jadwal
    </button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Hari</th>
          <th>Sesi</th>
          <th>Pelatih I</th>
          <th>Pelatih II</th>
          <th>Pelatih III</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php
        $index = 1
      @endphp
      @foreach ($jadwal as $j)
      <tr>
        <td style="width: 10px">{{ $index }}</td>
        <td>{{ $hari[$j->hari-1] }}</td>
        <td>{{ $sesi[$j->sesi-1] }}</td>
        <td>{{ ($j->pelatih1 != null) ? $j->pelatih1->name : "Tidak ada pelatih" }}</td>
        <td>{{ ($j->pelatih2 != null) ? $j->pelatih2->name : "Tidak ada pelatih" }}</td>
        <td>{{ ($j->pelatih3 != null) ? $j->pelatih3->name : "Tidak ada pelatih" }}</td>
        <td>
          <a href="{{ url('jadwal') }}/{{ $j->id }}/edit">
            <button class="btn btn-success">
              Ubah
            </button>
          </a>
          <button class="btn btn-danger delete" data-toggle="modal" href="#form-delete" data-id="{{ $j->id }}">
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
    {{ $jadwal->links() }}
  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="form-add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="POST" action="{{ url('jadwal') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Jadwal</h4>
        </div>
        <div class="modal-body">
            {!! csrf_field() !!}

            <input type="hidden" name="grup_id" value="{{ $group->id }}"/>

            <div class="form-group">
              <label for="hari" class="col-sm-2 control-label">Hari</label>
              <div class="col-sm-10">
                <select class="form-control" name="hari">
                  <option value="1">Senin</option>
                  <option value="2">Selasa</option>
                  <option value="3">Rabu</option>
                  <option value="4">Kamis</option>
                  <option value="5">Jumat</option>
                  <option value="6">Sabtu</option>
                  <option value="7">Minggu</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="sesi" class="col-sm-2 control-label">Sesi</label>
              <div class="col-sm-10">
                <select class="form-control" name="sesi">
                  <option value="1">{{ $sesi[0] }}</option>
                  <option value="2">{{ $sesi[1] }}</option>
                  <option value="3">{{ $sesi[2] }}</option>
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
            Apakah anda benar-benar ingin menghapus jadwal ini?
            <input name="_method" type="hidden" value="DELETE" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

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

        $('#menu-grup').addClass('active');

        $('#pelatih_i').select2();
        $('#pelatih_ii').select2();
        $('#pelatih_iii').select2();

        $('body').delegate('.delete','click',function(){
          var id = $(this).data('id');
          var url = "{{ url('jadwal') }}" + "/" + id;
          $('#url-delete').attr('action', url);
        });
      });
    </script>
@endpush