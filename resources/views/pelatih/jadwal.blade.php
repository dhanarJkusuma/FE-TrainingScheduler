@extends('layouts.pelatih')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
@endsection

@push('javascript')
    <script>
        $(document).ready(function(){
            $('#menu-jadwal').addClass('active');
        });
    </script>
@endpush
