@extends('layouts.backend.app')

@section('title', 'Dashboard')

@push('css')
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Dashboard</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green-active"><i class="fa fa-building-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL POSTS</span>
                            <span class="info-box-number">{{ $posts->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple-active"><i class="fa fa-heart-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">FAVORITE POSTS</span>
                            <span class="info-box-number">{{ Auth::user()->favorite_posts()->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red-active"><i class="fa fa-circle-o-notch"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">PENDING POSTS</span>
                            <span class="info-box-number">{{ $total_pending_post }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua-active"><i class="fa fa-eye"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL VIEW</span>
                            <span class="info-box-number">{{ $all_view_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue-active"><i class="fa fa-th"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL CATEGORY</span>
                            <span class="info-box-number">{{ $category_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow-active"><i class="fa fa-tags"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL POSTS</span>
                            <span class="info-box-number">{{ $tag_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-maroon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL AUTHORS</span>
                            <span class="info-box-number">{{ $tag_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-inverse"><i class="fa fa-user-plus"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">NEW AUTHORS</span>
                            <span class="info-box-number">{{ $new_authors_today }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border bg-gray-active">
                            <h3 class="box-title">MOST POPULAR POST</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead class="bg-gray-light">
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th width="25%">Title</th>
                                        <th><i class="fa fa-user"></i></th>
                                        <th><i class="fa fa-eye"></i></th>
                                        <th><i class="fa fa-heart"></i></th>
                                        <th><i class="fa fa-comments"></i></th>
                                        <th>Status</th>
                                        <th width="20%" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-gray-light">
                                    @foreach($popular_post as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title, 20) }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorite_to_users_count }}</td>
                                            <td>{{ $post->comments_count }}</td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="label label-success">Published</span>
                                                @else
                                                    <span class="label label-danger">Pending</span>
                                                @endif
                                            </td>
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

                                                <a target="_blank" href="{{ route('post.details', $post->slug) }}" class="btn
                                            bg-orange-active btn-xs py-0">
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
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Info boxes -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border bg-gray-active">
                            <h3 class="box-title">TOP 10 ACTIVE AUTHORS</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead class="bg-gray-light">
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>Name</th>
                                        <th>Posts</th>
                                        <th><i class="fa fa-heart"></i></th>
                                        <th><i class="fa fa-comments"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-gray-light">
                                    @foreach($active_authors as $key => $author)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->posts->count() }}</td>
                                            <td>{{ $author->view_count }}</td>
                                            <td>{{ $author->favorite_posts_count }}</td>
                                            <td>{{ $author->comments_count }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')

@endpush