@extends('layouts.backend.app')

@section('title', 'comments')

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
                            <h5 class="box-title">Comments List
                                <span class="label label-success">{{ $comments->count() }}</span>
                            </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th class="text-center">Comment info</th>
                                    <th class="text-center">Post info</th>
                                    <th class="text-center" width="14%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $key => $comment)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img src="{{ Storage::disk('public')->url('profile/'
                                                        .$comment->user->image) }}" alt="image" lass="media-object"
                                                             width="64" height="64">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">
                                                        {{ $comment->user->name }}
                                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    </h5>
                                                    <p>{{ $comment->comment }}</p>
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug.
                                                    '#comment') }}">
                                                        Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a target="_blank" href="{{ route('post.details',
                                                    $comment->post->slug) }}">
                                                        <img src="{{ Storage::disk('public')->url('post/'
                                                        .$comment->post->image) }}" width="64" height="64" alt="image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ route('post.details', $comment->post->slug) }}"
                                                       target="_blank">
                                                        <h5 class="media-heading">{{ str_limit($comment->post->title,
                                                         '40') }}</h5>
                                                    </a>
                                                    <p>by <strong>{{ $comment->user->name }}</strong></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST"
                                                  id="delete-form-{{ $comment->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn bg-red-active btn-xs py-0" onclick="if (confirm('Are ' +
                                                    'you sure to delete This?'))
                                                {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $comment->id }}').submit();
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
                                    <th class="text-center">Comment info</th>
                                    <th class="text-center">Post info</th>
                                    <th class="text-center" width="14%">Action</th>
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