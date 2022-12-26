@extends('layout')
@section('title', 'Perusahaan')
@section('content')

<div class="portlet">
    <div class="portlet-header portlet-header-bordered">
        <h3 class="portlet-title">Monitoring Kendaraan</h3>
    </div>
    <div class="portlet-body">
        <table class="table table-consonend table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Class</th>
                    <th>Action</th>
                    <th>Url</th>
                    <th>Method</th>
                    <th>Activity</th>
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
                    {data: 'created_at', name: 'log_activity.created_at'},
                    {data: 'class', name: 'log_activity.class'},
                    {data: 'action', name: 'log_activity.action'},
                    {data: 'url', name: 'log_activity.url'},
                    {data: 'method', name: 'log_activity.method'},
                    {data: 'activity', name: 'log_activity.activity'},
                ]
            })
        });
    </script>
@endpush