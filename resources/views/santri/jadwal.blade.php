@extends('layouts.santri')

@section('content')
<div class="container">
  @foreach($messages as $m)
    <div class="alert alert-dismissible {{ ($m->status=='biasa') ? 'alert-success' : 'alert-danger' }}">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ $m->pesan }}</strong>
    </div>
  @endforeach
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jadwal Pelatihan</div>

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
                  @foreach ($group->jadwal as $j)
                    @if($j->hari == $day)
                    <tr>
                      <td style="width: 10px"><b>{{ $index }}</b></td>
                      <td><b>{{ $hari[$j->hari-1] }}</b></td>
                      <td><b>{{ $j->group->nama_grup }} (Ketua: {{ $j->group->user->name }} )</b></td>
                      <td><b>{{ $sesi[$j->sesi-1] }}</b></td>
                    </tr>
                    @else
                    <tr>
                      <td style="width: 10px">{{ $index }}</td>
                      <td>{{ $hari[$j->hari-1] }}</td>
                      <td>{{ $j->group->nama_grup }} (Ketua: {{ $j->group->user->name }} )</td>
                      <td>{{ $sesi[$j->sesi-1] }}</td>
                    </tr>
                    @endif
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
            $('#menu-agenda').addClass('active');
        });
    </script>
@endpush
