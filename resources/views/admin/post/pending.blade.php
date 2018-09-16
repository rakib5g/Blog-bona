@extends('layouts.backend.app')

@section('title', 'posts')

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
                            <h5 class="box-title">Pending Post
                                <p class="label label-success">{{ $posts->count() }}</p>
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
                                    <th><i class=" fa fa-eye"></i></th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="text-center" width="18%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($post->title, 15) }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>
                                            @if($post->is_approved == true)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <span class="label label-danger">pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="label label-info">Published</span>
                                            @else
                                                <span class="label label-danger">pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at->toFormattedDateString() }}</td>
                                        <td class="text-center">

                                            @if($post->is_approved == false)
                                                <form action="{{ route('admin.post.approve', $post->id) }}" method="POST"
                                                      id="approved-form-{{ $post->id }}" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                                <button class="btn bg-aqua-active btn-xs" onclick="if (confirm('Are ' +
                                                        'you sure to Approve This post..?'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('approved-form-{{ $post->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            @endif

                                            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn bg-green-active
                                            btn-xs py-0">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="{{ route('admin.post.show', $post->id) }}" class="btn
                                            bg-blue-active btn-xs py-0">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST"
                                                  id="delete-form-{{ $post->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn bg-red-active btn-xs py-0" onclick="if (confirm('Are ' +
                                                    'you sure to delete This?'))
                                                {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $post->id }}').submit();
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
                                    <th>Author</th>
                                    <th><i class=" fa fa-eye"></i></th>
                                    <th>Status</th>
                                    <th>Is Approved</th>
                                    <th>Created At</th>
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