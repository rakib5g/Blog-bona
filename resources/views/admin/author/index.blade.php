@extends('layouts.backend.app')

@section('title', 'author info')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header bg-navy-active">
                            <h5 class="box-title">Author information
                                <p class="label label-success">{{ $authors->count() }}</p>
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th class="text-center"><i class=" fa fa-comments"></i></th>
                                    <th class="text-center"><i class=" fa fa-heart"></i></th>
                                    <th>Created At</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $key => $author)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $author->name }}</td>
                                        <td>{{ $author->posts->count() }}</td>
                                        <td class="text-center">{{ $author->comments->count() }}</td>
                                        <td class="text-center">{{ $author->favorite_posts->count() }}</td>
                                        <td>{{ $author->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.author.destroy', $author->id) }}" method="POST"
                                                  id="delete-form-{{ $author->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn bg-red-active btn-xs py-0" onclick="if (confirm('Are ' +
                                                    'you sure to delete This?'))
                                                    {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $author->id }}').submit();
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
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th class="text-center"><i class=" fa fa-comments"></i></th>
                                    <th class="text-center"><i class=" fa fa-heart"></i></th>
                                    <th>Created At</th>
                                    <th class="text-center" width="5%">Action</th>
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