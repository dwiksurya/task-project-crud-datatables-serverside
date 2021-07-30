@extends('layouts.master')

@section('title', 'Products')

@section('content')
    <div class="products mb-5">        
        <div class="header mb-4">
            <div class="btn-group">
                <button onclick="addForm('{{ route('product.store') }}')" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-circle"></i> New Product</button>
                <button onclick="activeSelected('{{ route('products.active') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-check"></i> Active Selected</button>
                <button onclick="deleteSelected('{{ route('products.delete') }}')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Delete Selected</button>
            </div>
        </div>  
        <form action="" method="post" class="product-form">
            @csrf @method('post')
        <table class="table table-striped" id="products">
            <thead>
                <tr>
                    <th width="5%">
                        <input type="checkbox" name="select_all" id="select_all">
                    </th>
                    <th width="5%">#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Merchant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </form>
    </div>

@includeIf('product.modal')
@endsection

@push('js')
    <script>
        $(function () {
            $('#products').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.data') }}',
                columns: [
                    {data: 'select_all', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'name'},
                    {data: 'price'},
                    {data: 'status'},
                    {data: 'merchant'},
                    {data: 'action', searchable: false, sortable: false},
                ]
            });

            $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        toastr.success(response.success);
                        $('#products').DataTable().ajax.reload();
                    })
                    .fail((errors) => {
                        toastr.error('Something went wrong, please check your input data');
                        return;
                    });
                }
            });

            $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('New Product');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=name]').focus();
            $('#modal-form [name=price]').focus();
            $('#modal-form [name=status]').focus();
            $('#modal-form [name=merchant_id]').focus();
            
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Product');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=name]').focus();
            $('#modal-form [name=price]').focus();
            $('#modal-form [name=status]').focus();
            $('#modal-form [name=merchant_id]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=name]').val(response.name);
                    $('#modal-form [name=price]').val(response.price);
                    $('#modal-form [name=merchant_id]').val(response.merchant_id);
                    $('#modal-form [name=status]').prop("checked", response.status);

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
                    $('#products').DataTable().ajax.reload();
                })
                .fail((errors) => {
                    toastr.error('Something went wrong');
                    return;
                });
        }
    }
    
    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Are you sure you want to delete selected data?')) {
                $.post(url, $('.product-form').serialize())
                    .done((response) => {
                        toastr.success(response.success);
                        $('#products').DataTable().ajax.reload();
                    })
                    .fail((errors) => {
                        toastr.error('Something went wrong');
                        return;
                    });
            }
        } else {
            toastr.info('No data selected');
            return;
        }
    }

        
    function activeSelected(url) {
        $('.product-form [name=_method]').val('put');
        if ($('input:checked').length >= 1) {
            $.post(url, $('.product-form').serialize())
                .done((response) => {
                    toastr.success(response.success);
                    $('#products').DataTable().ajax.reload();
                })
                .fail((errors) => {
                    toastr.error(response.success);
                    return;
                });
        } else {
            toastr.info('No data selected');
            return;
        }
    }
    </script>
  
@endpush