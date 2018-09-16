@extends('layouts.backend.app')

@section('title', 'favorite post')

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
                            <h5 class="box-title">Favorite Post
                                <p class="label label-success">{{ $favoritePosts->count() }}</p>
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th class="text-center"><i class=" fa fa-heart"></i></th>
                                    <th class="text-center"><i class=" fa fa-comments"></i></th>
                                    <th class="text-center"><i class=" fa fa-eye"></i></th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($favoritePosts as $key => $favoritePost)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($favoritePost->title, 30) }}</td>
                                        <td>{{ $favoritePost->user->name }}</td>
                                        <td class="text-center">{{ $favoritePost->favorite_to_users->count() }}</td>
                                        <td class="text-center">{{ $favoritePost->comments->count() }}</td>
                                        <td class="text-center">{{ $favoritePost->view_count }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('post.favorite', $favoritePost->id) }}" method="POST"
                                                  id="favorite-form-{{ $favoritePost->id }}" style="display: none;">
                                                @csrf
                                            </form>
                                            <button class="btn bg-red-active btn-xs py-0" onclick="document.getElementById
                                                    ('favorite-form-{{ $favoritePost->id }}').submit();">
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
                                    <th>Author</th>
                                    <th class="text-center"><i class=" fa fa-heart"></i></th>
                                    <th class="text-center"><i class=" fa fa-comments"></i></th>
                                    <th class="text-center"><i class=" fa fa-eye"></i></th>
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