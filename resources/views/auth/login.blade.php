@extends('auth.layout')

@section('content')
    <div class="content bg-dark ">
        <div class="container-fluid">
            <div class="row no-gutters align-items-center justify-content-center h-100">
                <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="portlet">
                        <div class="portlet-body">
                            <div class="text-center mb-4">
                                <h2 class="text-primary"></h2>
                                <b>Loginn Terlebih Dahulu</b>
                            </div>
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" />
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @elseif (session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @endif
                            {!! Form::open(['id' => 'formAuth', 'method' => 'post', 'route' => ['user.login-post']]) !!}
                                <div id="reader" width="600px"></div>
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        {!! Form::text('username', null, ['class' => 'form-control form-control-lg', 'id' => 'username', 'placeholder' => 'Username']) !!}
                                        {!! Form::label('username', 'Username') !!}
                                    </div>
                                    @error('username')
                                        <small class="text-danger">{{ '*'. $errors->first('username') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        {!! Form::password('password', ['class' => 'form-control form-control-lg', 'id' => 'password', 'placeholder' => 'Password']) !!}
                                        {!! Form::label('password', 'Password') !!}
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ '*'. $errors->first('password') }}</small>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="submit" class="btn btn-label-primary btn-lg btn-widest">Login</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
