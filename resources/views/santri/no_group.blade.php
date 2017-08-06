@extends('layouts.santri')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jadwal Pelatihan</div>

                <div class="panel-body">
                  <p align="center">Maaf, Anda belum memilih grup.</p>
                  <p align="center">Mohon hubungi admin untuk dapat grup.</p>
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
