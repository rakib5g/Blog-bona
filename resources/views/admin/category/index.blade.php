@extends('layouts.backend.app')

@section('title', 'tags')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <a href="{{ route('admin.category.create') }}" class="btn bg-navy">
                <i class="fa fa-plus"></i> ADD NEW CATEGORY
            </a>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header bg-navy-active">
                            <h5 class="box-title">All Categories
                                <span class="label label-success">{{ $categories->count() }}</span>
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>Total Post</th>
                                    <th width="10%" class="text-center">Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center" width="14%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->posts->count() }}</td>
                                        <td>
                                            <img src="{{ Storage::url('category/'.$category->image) }}"
                                                 alt="image" width="80px" height="50px" class="img-fluid text-center">
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td class="text-center">

                                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn bg-green-active
                                            btn-xs py-0">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.category.show', $category->id) }}" class="btn
                                            bg-blue-active btn-xs disabled py-0">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                                  id="delete-form-{{ $category->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn bg-red-active btn-xs py-0" onclick="if (confirm('Are ' +
                                                    'you sure to delete This?'))
                                                {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $category->id }}').submit();
                                                }else {
                                                     event.preventDefault();
                                                    }">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Total Post</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('asset/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endpush