@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Halaman Daftar</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-eor' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                           rr         <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                            <label for="no_hp" class="col-md-4 control-label">No. Hp</label>

                            <div class="col-md-6">
                                <input id="no_hp" type="number" class="form-control" name="no_hp" value="{{ old('no_hp') }}" required>

                                @if ($errors->has('no_hp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_hp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="provinsi" class="col-md-4 control-label">Provinsi</label>

                            <div class="col-md-6">
                                <select class="form-control" disabled>
                                    <option>JAWA TENGAH</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten" class="col-md-4 control-label">Kabupaten</label>

                            <div class="col-md-6">
                                <select class="form-control" disabled>
                                    <option>KABUPATEN KLATEN</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kecamatan_id') ? ' has-error' : '' }}">
                            <label for="kecamatan_id" class="col-md-4 control-label">Kecamatan</label>

                            <div class="col-md-6">
                                <select class="form-control" name="kecamatan_id">
                                    @foreach($kecamatan as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('kecamatan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kecamatan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="2" name="alamat"></textarea>
                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
