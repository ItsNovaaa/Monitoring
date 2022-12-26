@extends('auth.layout')

@section('content')
    <!-- BEGIN Page Content -->
    <div class="content ">
        <div class="container-fluid">
            <div class="row no-gutters align-items-center justify-content-center h-100">
                <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-body">
                            <div class="text-center mb-4">
                                <!-- BEGIN Avatar -->
                                <div class="avatar avatar-label-primary avatar-circle widget12">
                                    <div class="avatar-display">
                                        <i class="fa fa-user-alt"></i>
                                    </div>
                                </div>
                                <!-- END Avatar -->
                            </div>
                            <!-- BEGIN Form -->
                            {!! Form::open(['method' => 'post', 'id' => 'register-form']) !!}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Silahkan isi username anda">
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group">
                                            <div class="float-label float-label-lg">
                                                <input class="form-control form-control-lg" type="text" id="nama-depan" name="nama_depan" placeholder="Silahkan isi nama anda">
                                                <label for="first-name">Nama Depan</label>
                                            </div>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group">
                                            <div class="float-label float-label-lg">
                                                <input class="form-control form-control-lg" type="text" id="nama-belakang" name="nama_belakang" placeholder="Silahkan isi name anda">
                                                <label for="last-name">Nama Belakang</label>
                                            </div>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                </div>
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Silahkan isi email anda">
                                        <label for="username">Email</label>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="number" id="no_telp" name="no_telp" placeholder="Silahkan isi nomor telepon anda">
                                        <label for="username">No. Telp</label>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Silahkan isi password anda">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input class="form-control form-control-lg" type="password" id="password-confirm" name="passwordConfirm" placeholder="Silahkan ulangi password anda">
                                        <label for="password-confirm">Confirm password</label>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <!-- BEGIN Form Group -->
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-control-lg custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="agreement" name="agreement">
                                            <label class="custom-control-label" for="agreement">Setujui Layanan</label>
                                        </div>
                                    </div>
                                    <!-- END Form Group -->
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span> Sudah mempunyai akun ? <a href="">Sign In</a>
                                    </span>
                                    <button type="submit" class="btn btn-label-primary btn-lg btn-widest">Register</button>
                                </div>
                            </form>
                            <!-- END Form -->
                        </div>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@push('scripts')
    <script>
        $(function () {
            $("#register-form").validate({
                rules: {
                    username: { required: true },
                    nama_depan: { required: true },
                    nama_belakang: { required: true },
                    email: { required: true, email: true },
                    no_telp: { required: true },
                    password: { required: true, minlength: 6 },
                    passwordConfirm: { required: true, minlength: 6, equalTo: "#password" },
                    agreement: { required: true },
                },
                messages: {
                    username: { required: "Mohon isi username anda"},
                    nama_depan: { required: "Mohon isi nama anda" },
                    nama_belakang: { required: "Mohon isi nama anda" },
                    email: { required: "Mohon isi email anda", email: "Email anda tidak valid" },
                    no_telp: { required: "Mohon isi nomor telepon anda"},
                    password: { required: "Mohon isi password anda", minlength: $.validator.format("Mohon setidaknya password {0} karakter") },
                    passwordConfirm: { required: "Mohon ulangi password anda", minlength: $.validator.format("Mohon setidaknya password {0} karakter"), equalTo: "Password anda tidak sesuai" },
                    agreement: { required: "Centang untuk setujui layanan" },
                },
                submitHandler: function submitHandler(form) {
                    form.submit();
                },
            });
        });
    </script>
@endpush
