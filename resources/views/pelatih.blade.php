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

<div class="box box-success">
  <div class="box-header">
    <i class="fa fa-address-book-o"></i>

    <h3 class="box-title">Daftar Pelatih</h3>

  </div>
  <div class="box-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" href="#form-new"><i class="glpyhicon glyphicon-plus"></i> Tambah Pelatih</button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th>Kecamatan</th>
          <th>Alamat</th>
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
        <td>{{ $user->alamat }}</td>
        <td>
          <a href="{{ url('pelatih') }}/{{ $user->id }}/edit">
            <button class="btn btn-sm btn-success">
              Ubah
            </button>
          </a>
           <a data-toggle="modal" href="#form-chpass">
            <button class="btn btn-sm btn-info chpass" data-id="{{ $user->id }}">
              Ganti Password
            </button>
          </a>
          <button class="btn btn-sm btn-danger delete" data-toggle="modal" href="#form-delete" data-id="{{ $user->id }}">
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
    {{ $users->links() }}
  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="form-chpass">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="#" id="url-chpass" method="POST" class="form-horizontal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ganti Password</h4>
        </div>
        <div class="modal-body">
                    
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="menu" value="pelatih">

            <div class="form-group">
              <label for="c_password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="c_password" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label for="c_cpassword" class="col-sm-2 control-label">Password Confirmation</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password_confirmation" id="c_cpassword" placeholder="Confirm Password">
              </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Ya</button>
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
          <h4 class="modal-title">Hapus Pelatih</h4>
        </div>
        <div class="modal-body">
            Apakah anda benar-benar ingin menghapus pelatih ini?
            <br/>
            <br/>
            <br/>
            <br/>
            <strong>Note : Pelatih yang masih menjadi penanggung jawab lokasi atau masih melatih sebagi "Pelatih 1" tidak dapat dihapus.</strong>
            <br/>
            <small>#Mohon untuk melepas tanggung jawab sebagai penanggung jawab lokasi atau mengganti pelatih 1 yang terkait dengan pelatih tersebut</small>
            <input name="_method" type="hidden" value="DELETE" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="user_id">
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
      <form action="{{ url('pelatih') }}" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Pelatih</h4>
        </div>
        <div class="modal-body">
        <div class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">E-Mail</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="no-hp" class="col-sm-2 control-label">No. Hp</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="no_hp" id="no-hp" placeholder="No. Hp">
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
                    <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="2" name="alamat"></textarea>
                </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label for="password_confirm" class="col-sm-2 control-label">Confirm Password</label>
              <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirm" placeholder="Password Confirmation">
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

      $('#menu-pelatih').addClass('active');

      $('body').delegate('.delete','click',function(){
        var id = $(this).data('id');
        var url = "{{ url('pelatih') }}" + "/" + id;
        $('#url-delete').attr('action', url);
      });

      $('body').delegate('.chpass','click',function(){
        var id = $(this).data('id');
        var url = "{{ url('users/password') }}" + "/" + id;
        $('#url-chpass').attr('action', url);
      });

  });
</script>
@endpush