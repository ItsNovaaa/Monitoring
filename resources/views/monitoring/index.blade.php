@extends('layout')
@section('title', 'Perusahaan')
@section('content')

<div class="portlet">
    <div class="portlet-header portlet-header-bordered">
        <h3 class="portlet-title">Monitoring Kendaraan</h3>
    </div>
    <div class="portlet-body">
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Pegawai</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>BBM Yang Diperlukan</th>
                    <th>Waktu Service</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script>

        var dataTable;
        $(function() {
            dataTable = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '',
                columns: [
                    {data: 'nama_kendaraan', name: 'kendaraan.nama_kendaraan'},
                    {data: 'nama_pegawai', name: 'pegawai.nama_pegawai'},
                    {data: 'tujuan_pemesanan', name: 'request_kendaraan.tujuan_pemesanan'},
                    {data: 'status', name: 'status'},
                    {data: 'bbm', name: 'bbm'},
                    {data: 'jadwal_service', name: 'jadwal_service'},
                ]
            })
        });
    </script>
@endpush