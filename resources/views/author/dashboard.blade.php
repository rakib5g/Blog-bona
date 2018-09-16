@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Dashboard </h1>
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
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border bg-navy-active">
                            <h3 class="box-title">TOP 5 POPULAR POST</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th width="8%">Rank List</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Favorite</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popular_post as $key => $post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ str_limit($post->title, 40) }}</td>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix bg-navy-active">

                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')

@endsection