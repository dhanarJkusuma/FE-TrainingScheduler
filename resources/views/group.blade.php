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

<div class="box box-success">
  <div class="box-header">
    <i class="fa fa-address-book-o"></i>

    <h3 class="box-title">Daftar Grup</h3>

  </div>
  <div class="box-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" href="#form-new"><i class="glpyhicon glyphicon-plus"></i> Tambah Grup</button>
    <a href="{{ url('print/group') }}">
      <button type="button" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Unduh PDF</button>
    </a>
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Nama Grup</th>
          <th>Ketua</th>
          <th>Lokasi Latihan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php
        $index = 1
      @endphp
      @foreach ($groups as $group)
      <tr>
        <td style="width: 10px">{{ $index }}</td>
        <td>{{ $group->nama_grup }}</td>
        <td>{{ $group->user->name }}</td>
        <td>{{ $group->location->nama }}</td>
        <td>
          <a href="{{ url('group') }}/{{ $group->id }}">
            <button class="btn btn-info">
              <span class="glyphicon glyphicon-eye-open"></span>
            </button>
          </a>
          <a href="{{ url('group/jadwal') }}/{{ $group->id }}">
            <button class="btn btn-default">
              Kelola Jadwal
            </button>
          </a>
          <a href="{{ url('group') }}/{{ $group->id }}/edit">
            <button class="btn btn-success">
              Ubah
            </button>
          </a>
          <button class="btn btn-danger delete" data-toggle="modal" href="#form-delete" data-id="{{ $group->id }}">
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
    {{ $groups->links() }}
  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="form-delete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="#" id="url-delete" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Grup</h4>
        </div>
        <div class="modal-body">
            Apakah anda benar-benar ingin menghapus data ini?
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


<div class="modal fade" tabindex="-1" role="dialog" id="form-new">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ url('group') }}" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Grup</h4>
        </div>
        <div class="modal-body">
          <div class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="nama_grup" class="col-sm-2 control-label">Nama Grup</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_grup" id="nama_grup" placeholder="Nama Grup">
              </div>
            </div>
            <div class="form-group">
              <label for="ketua_grup_id" class="col-sm-2 control-label">Ketua Grup</label>
              <div class="col-sm-10">
                <select class="form-control" id="ketua" name="ketua_grup_id" style="width:100%;">
                  @foreach($santri as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                  @endforeach
                </select>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
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
      $('#ketua').select2();
      $('#lokasi').select2();

      $('body').delegate('.delete','click',function(){
        var id = $(this).data('id');
        var url = "{{ url('group') }}" + "/" + id;
        $('#url-delete').attr('action', url);
      });
  });
</script>
@endpush