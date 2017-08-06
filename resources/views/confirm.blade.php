@extends('layouts.admin_template')


@section('content')

@if(session()->has('status'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{ session('status') }}</strong>
  </div>
@endif

<div class="box box-success">
  <div class="box-header">
    <i class="fa fa-check-circle"></i>

    <h3 class="box-title">Konfirmasi Santri Baru</h3>

  </div>
  <div class="box-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th>Kecamatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php
        $index = 1
      @endphp
      @foreach ($users as $user)
      <tr>
        <td style="width: 10px">{{ $index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->no_hp }}</td>
        <td>{{ $user->kecamatan->name }}</td>
        <td>
          <button class="btn btn-success approve" data-toggle="modal" href="#form-confirm" data-id="{{ $user->id }}">
            Approve
          </button>
          <button class="btn btn-danger remove" data-toggle="modal" href="#form-remove" data-id="{{ $user->id }}">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
      @php
        $index++
      @endphp
      @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="form-confirm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ url('confirm') }}" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Santri</h4>
        </div>
        <div class="modal-body">
            Approve user ini?
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="user_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Approve</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="form-remove">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ url('remove') }}" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Calon Santri</h4>
        </div>
        <div class="modal-body">
            Apakah anda benar-benar ingin menghapus data ini?
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="user_id_del">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@push('javascript')
<script>
  $(document).ready(function(){
      $('#menu-confirm').addClass('active');

      $('body').delegate('.approve','click',function(){
        var id = $(this).data('id');
        $('#user_id').val(id);
      });
      $('body').delegate('.remove','click',function(){
        var id = $(this).data('id');
        $('#user_id_del').val(id);
      });
  });
</script>
@endpush