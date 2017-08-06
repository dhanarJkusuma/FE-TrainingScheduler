@extends('layouts.admin_template')


@section('content')
<div class="box box-default">
  <div class="box-header">
    <i class="fa fa-dashboard"></i>

    <h3 class="box-title">Dashboard</h3>

  </div>
  <div class="box-body">
    <h3 align="center">Selamat Datang {{ Auth::user()->name }}</h3>
  

  </div>
  <!-- /.chat -->
  <div class="box-footer">
  
  </div>
</div>
@endsection


@push('javascript')
  <script>
    $(document).ready(function(){
      $('#menu-dashboard').addClass('active');
    });
  </script>
@endpush
