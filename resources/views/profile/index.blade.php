@extends('layout')
@section('title','Pengaturan Profil')
@section('content')
    <!-- BEGIN Page Content -->
    <!-- BEGIN Page Content -->
    <div class="row no-gutters align-items-center justify-content-center h-100">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-body">
                    <div class="text-center mb-4">
                        <!-- BEGIN Avatar -->
                        <div class="avatar avatar-label-primary avatar-circle widget12" style="cursor: pointer" id="qrAvatar">
                            <div class="avatar-display">
                                <i class="fa fa-user-alt"></i>
                            </div>
                        </div>
                        <!-- END Avatar -->
                    </div>
                    
                    @if (session('error'))
                        <div class="alert alert-danger">{!! session('error') !!}</div>
                    @elseif(session('success'))
                        <div class="alert alert-success">{!! session('success') !!}</div>
                    @endif
                    <!-- BEGIN Form -->
                        {!! Form::open(['method' => 'post', 'route' => ['profile.update',['id' => auth()->user()->id] ]]) !!}
                        <!-- BEGIN Form Group -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        {!! Form::text('username', auth()->user()->username, ['class' => 'form-control form-control-lg', 'id' => 'username']) !!}
                                        <label for="username">Username</label>
                                    </div>
                                    @error('username')
                                        <small class="text-danger">{{ '*'. $errors->first('username') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        {!! Form::password('password', ['class' => 'form-control form-control-lg', 'id' => 'password', 'placeholder' => 'Password']) !!}
                                        <label for="password">Password</label>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ '*'. $errors->first('password') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        {!! Form::password('confirm_password', ['class' => 'form-control form-control-lg', 'id' => 'konfirmasiPassword', 'placeholder' => 'Konfirmasi Password']) !!}
                                        <label for="konfirmasiPassword">Konfirmasi Password</label>
                                    </div>
                                    <small class="text-danger err_confirm_new_pass"></small>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-label-primary btn-lg btn-widest">Simpan</button>
                        </div>
                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- END Portlet -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
