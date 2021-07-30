@extends('layouts.master')

@section('title', 'Merchants')

@section('content')
    <div class="merchants mb-5">
        <div class="header mb-4">
            <div class="btn-group">
                <button onclick="addForm('{{ route('merchant.store') }}')" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-circle"></i> New Merchant</button>
            </div>
        </div>        
        <table class="table table-striped" id="merchants">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Merchant Name</th>
                    <th>Country Code</th>
                    <th>Total Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@includeIf('merchant.modal')
@endsection

@push('js')
    <script>
        $(function () {
            $('#merchants').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('merchants.data') }}',
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'merchant_name'},
                    {data: 'country_code'},
                    {data: 'total_products'},
                    {data: 'action', searchable: false, sortable: false},
                ]
            });

            $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        toastr.success(response.success);
                        $('#merchants').DataTable().ajax.reload();
                    })
                    .fail((errors) => {
                        toastr.error('Something went wrong, please check your input data');
                        return;
                    });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('New Merchant');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=merchant_name]').focus();
            $('#modal-form [name=country_code]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Merchant');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=merchant_name]').focus();
            $('#modal-form [name=country_code]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=merchant_name]').val(response.merchant_name);
                    $('#modal-form [name=country_code]').val(response.country_code);
                })
                .fail((errors) => {
                    toastr.error('Something went wrong');
                    return;
                });
        }

        function deleteData(url) {
        if (confirm('Are you sure you want to delete selected data?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    toastr.success(response.success);
                    $('#merchants').DataTable().ajax.reload();
                })
                .fail((errors) => {
                    toastr.error('Something went wrong');
                    return;
                });
        }
    }
    </script>
@endpush