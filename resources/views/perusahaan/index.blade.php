@extends('layout')
@section('title', 'Perusahaan')
@section('content')

<div class="portlet">
    <div class="portlet-header portlet-header-bordered">
        <h3 class="portlet-title">Perusahaan</h3>
    </div>
    <div class="portlet-body">
        <div class="text-right">
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="create()">Create</button>
            </div>
        </div>
        <table class="table table-consonend table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>Jenis Perusahaan</th>
                    <th width="150px"></th>
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
                ajax: '{{ route('perusahaan') }}',
                columns: [
                    {data: 'nama_perusahaan', name: 'perusahaan.nama_perusahaan'},
                    {data: 'alamat', name: 'perusahaan.alamat'},
                    {data: 'utama', name: 'perusahaan.utama'},
                    {data: '_', searchable: false, orderable: false, class: 'text-center'},
                ]
            })
        });

        function create() {
            $.ajax({
                url: '{{ route('perusahaan.create') }}',
                success: function(response) {
                    bootbox.dialog({
                        title: 'Create Perusahaan',
                        message: response,
                    })
                }
            })
        }

        function store() {
            $('#formCreate .alert').remove();
            $.ajax({
                url: '{{ route('perusahaan.store') }}',
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
                url: '{{ route('perusahaan.edit') }}/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Perusahaan',
                        message: response,
                    })
                }
            })
        }
        
        function view(id) {
            $.ajax({
                url: '{{ route('perusahaan.view') }}/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Lihat Perusahaan',
                        message: response,
                    })
                }
            })
        }

        function update(id) {
            $('#formEdit .alert').remove();
            $.ajax({
                url: '{{ route('perusahaan.update') }}/'+id,
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
                        url: '{{ route('perusahaan.delete') }}/'+id,
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