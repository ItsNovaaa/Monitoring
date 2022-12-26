@extends('auth.layout')

@section('content')
    <div class="content ">
        <div class="container-fluid">
            <div class="row no-gutters align-items-center justify-content-center h-100">
                <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
                    <div class="portlet">
                        <div class="portlet-body">
                            <div class="text-center mb-4">
                                <h2 class="text-primary"></h2>
                                <b>Login Terlebih Dahulu</b>
                            </div>
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" />
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @elseif (session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @endif
                            {!! Form::open(['id' => 'formAuth', 'method' => 'post', 'route' => ['admin.login-post']]) !!}
                                <div id="reader" width="600px"></div>
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Masukkan Username">
                                        <label for="username">Username</label>
                                    </div>
                                    @error('username')
                                        <small class="text-danger">{{ '*'. $errors->first('username') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Masukkan Nama Lengkap">
                                        <label for="password">Password</label>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ '*'. $errors->first('password') }}</small>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
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
@push('scripts')
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            $.ajax({
                url: '{{ route('api.user.authenticate') }}/',
                dataType: 'json',
                type: 'post',
                data: 'id='+decodedText + "&_token={{ csrf_token() }}&role=admin|petugas",
                success: function(response) {
                    if (response.success) {
                        if (response.data.role != 'user') {
                            if (response.data.role == 'admin') {
                                document.location.href="{{ route('admin.home') }}"
                            } else {
                                document.location.href="{{ route('admin.daftar-petugas') }}"
                            }
                        } else {
                            toastr.error('Failed', 'Anda tidak memiliki akses');
                        }
                    } else {
                        toastr.error('Failed', response.message);
                    }
                }
            })
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush
