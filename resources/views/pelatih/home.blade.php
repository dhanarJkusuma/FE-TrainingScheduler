@extends('layouts.pelatih')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-12">
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
            <div class="panel panel-default">
                <div class="panel-heading">Jadwal Hari ini</div>

                <div class="panel-body">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Hari</th>
                      <th>Grup</th>
                      <th>Sesi</th>
                      <th></th>
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
                    <td>{{ $j->group->nama_grup }}</td>
                    <td>{{ $sesi[$j->sesi-1] }}</td>
                    <td>
                        <a href="{{ url('home/pelatih/jadwal') }}/{{ $j->id }}">
                            <button type="button" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> Lihat Detail
                            </button>
                        </a>
                        <a href="#pemberitahuan" data-toggle="modal" >
                            <button type="button" class="btn btn-sm btn-warning broadcast" data-id="{{ $j->id }}">
                                <i class="fa fa-volume-up"></i> Sebar Pemberitahuan
                            </button>
                        </a>
                        <a href="#pembatalan" data-toggle="modal" >
                            <button type="button" class="btn btn-sm btn-danger cancelation" data-id="{{ $j->id }}">
                                <i class="fa fa-window-close"></i> Batalkan Latihan
                            </button>
                        </a>
                    </td>
                  </tr>
                  @php
                    $index++
                  @endphp
                  @endforeach
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="pemberitahuan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="#" class="form-horizontal" id="url-broadcast">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Sebarkan Pemberitahuan</h4>
        </div>
        <div class="modal-body">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('pesan') ? ' has-error' : '' }}">
                <label for="pesan" class="col-md-2 control-label">Pesan</label>

                <div class="col-md-10">
                    <textarea class="form-control" name="pesan" id="pesan"></textarea>

                    @if ($errors->has('pesan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pesan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="pembatalan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="#" class="form-horizontal" id="url-cancelation">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Batalkan Pelatihan</h4>
        </div>
        <div class="modal-body">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('pesan') ? ' has-error' : '' }}">
                <label for="pesan" class="col-md-2 control-label">Pesan</label>

                <div class="col-md-10">
                    <textarea class="form-control" name="pesan" id="pesan"></textarea>

                    @if ($errors->has('pesan_batal'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pesan_batal') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Kirim</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('javascript')
    <script>
        $(document).ready(function(){
            $('#menu-agenda').addClass('active');

            $('body').delegate('.broadcast','click',function(){
              var id = $(this).data('id');
              var url = "{{ url('message/broadcast') }}" + "/" + id;
              $('#url-broadcast').attr('action', url);
            });

            $('body').delegate('.cancelation','click',function(){
              var id = $(this).data('id');
              var url = "{{ url('message/cancel') }}" + "/" + id;
              $('#url-cancelation').attr('action', url);
            });
        });
    </script>
@endpush