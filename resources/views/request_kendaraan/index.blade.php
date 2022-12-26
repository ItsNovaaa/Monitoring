@extends('layout')
@section('title', 'Request Kendaraan')
@section('content')

<div class="portlet">
    <div class="portlet-header portlet-header-bordered">
        <h3 class="portlet-title">Permintaan Kendaraan</h3>
    </div>
    <div class="portlet-body">
        @if (auth()->user()->role <> 'pejabat')
            <div class="text-right">
                <div class="form-group">
                    @if (auth()->user()->role <> 'pegawai')
                        <a href="{{ route('request-kendaraan.export') }}" role="button" class="btn btn-warning">Export</a>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="create()">Create</button>
                </div>
            </div>
        @else
        <div class="text-right form-group">
            <a href="{{ route('request-kendaraan.export') }}" role="button" class="btn btn-success">Export</a>
        </div>
        @endif
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>Pegawai</th>
                    <th>Kendaraan</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Approve By</th>
                    <th width="180px">Status</th>
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
                ajax: '{{ route('request-kendaraan') }}',
                columns: [
                    {data: 'nama_pegawai', name: 'nama_pegawai'},
                    {data: 'nama_kendaraan', name: 'nama_kendaraan'},
                    {data: 'tujuan_pemesanan', name: 'request_kendaraan.tujuan_pemesanan'},
                    {data: 'status', name: 'request_kendaraan.status', class: 'text-center'},
                    {data: 'nama_pejabat', name: 'nama_pejabat'},
                    {data: '_', searchable: false, orderable: false, class: 'text-center'},
                ]
            })
        });

        function create() {
            $.ajax({
                url: '{{ route('request-kendaraan.create') }}',
                success: function(response) {
                    bootbox.dialog({
                        title: 'Create Request Kendaraan',
                        message: response,
                    })
                }
            })
        }

        function store() {
            $('#formCreate .alert').remove();
            $.ajax({
                url: '{{ route('request-kendaraan.store') }}',
                type: 'POST',
                dataType: 'JSON',
                data: $('#formCreate').serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success('Success', response.message);
                        dataTable.api().ajax.reload();
                    } else {
                        toastr.error('Failed', response.message);
                    }
                    bootbox.hideAll();
                },
                error: function(error) {
                    var response = JSON.parse(error.responseText);
                    $('#formCreate').prepend(validation(response))
                }
            })
        }
        
        function edit(id) {
            $.ajax({
                url: '{{ route('request-kendaraan.edit') }}/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Request Kendaraan',
                        message: response,
                    })
                }
            })
        }
        
        function view(id) {
            $.ajax({
                url: '{{ route('request-kendaraan.view') }}/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Lihat Request Kendaraan',
                        message: response,
                    })
                }
            })
        }

        function update(id) {
            $('#formEdit .alert').remove();
            $.ajax({
                url: '{{ route('request-kendaraan.update') }}/'+id,
                type: 'POST',
                dataType: 'JSON',
                data: $('#formEdit').serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success('Success', response.message);
                        dataTable.api().ajax.reload();
                    } else {
                        toastr.error('Failed', response.message);
                    }
                    bootbox.hideAll();
                },
                error: function(error) {
                    var response = JSON.parse(error.responseText);
                    $('#formEdit').prepend(validation(response))
                }
            })
        }

        function destroy(id) {
            bootbox.confirm("Apakah anda yakin ingin menghapus data ini?", function(result) { 
                if (result) {
                    $.ajax({
                        url: '{{ route('request-kendaraan.delete') }}/'+id,
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Success', response.message);
                                dataTable.api().ajax.reload();
                            } else {
                                toastr.error('Failed', response.message);
                            }
                        }
                    })
                }
            });
        }

        function approve(id) {
           $.ajax({
                url: '{{ route('request-kendaraan.approve') }}/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Confirm Approve',
                        message: response
                    })
                }
           })
        }

        function approved(id) {
            $('#formApprove .alert').remove();
            $.ajax({
                url: '{{ route('request-kendaraan.approved') }}/'+id,
                type: 'POST',
                dataType: 'JSON',
                data: $('#formApprove').serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success('Success', response.message);
                        dataTable.api().ajax.reload();
                    } else {
                        toastr.error('Failed', response.message);
                    }
                    bootbox.hideAll();
                },
                error: function(error) {
                    var response = JSON.parse(error.responseText);
                    $('#formEdit').prepend(validation(response))
                }
            })
        }

        function approve_by_pejabat(id) {
            bootbox.confirm('Apakah anda yakin ingin menyetujui permintaan ini?', function(result) {
                if (result) {
                    $.ajax({
                        url: '{{ route('request-kendaraan.approved-by-pejabat') }}/'+id,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Success', response.message);
                                dataTable.api().ajax.reload();
                            } else {
                                toastr.error('Failed', response.message);
                            }
                        }
                    })
                }
            })
        }

        function reject(id) {
            bootbox.confirm("Apakah anda yakin ingin membatalkan data ini?", function(result) { 
                if (result) {
                    $.ajax({
                        url: '{{ route('request-kendaraan.reject') }}/'+id,
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Success', response.message);
                                dataTable.api().ajax.reload();
                            } else {
                                toastr.error('Failed', response.message);
                            }
                        }
                    })
                }
            });
        }

        function validation(errors){
            var validations = '<div class="alert alert-danger">';
            validations += '<ul>'
            $.each(errors.errors, function(i, error){
                validations += '<li>'+$.ucfirst(error[0])+'</li>';
            });
            validations += '</ul>'
            validations += '</div>';
            return validations;
        }

    </script>
@endpush