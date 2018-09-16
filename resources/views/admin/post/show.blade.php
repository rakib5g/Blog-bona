@extends('layouts.backend.app')

@section('title', 'view post')

@push('css')

@endpush

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="box-footer">
                @if($post->is_approved == false)
                    <form action="{{ route('admin.post.approve', $post->id) }}" method="POST"
                          id="approved-form-{{ $post->id }}" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form>
                    <button class="btn bg-green-active" onclick="if (confirm('Are ' +
                            'you sure to Approve This post..?'))
                            {
                            event.preventDefault();
                            document.getElementById('approved-form-{{ $post->id }}').submit();
                            }else {
                            event.preventDefault();
                            }">
                        <i class="fa fa-check-square-o"></i> Approve ?
                    </button>
                @else
                    <button type="submit" class="btn bg-black-active text-green" disabled>
                        <i class="fa fa-check-square-o"></i> APPROVED</button>
                @endif
                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn bg-aqua-active">
                    <i class="fa fa-edit"></i> EDIT</a>
                <a href="{{ route('admin.post.index') }}" class="btn bg-red-active
                                pull-right"> <i class="fa  fa-chevron-left"></i> CANCEL</a>
            </div>
            <br>
            <!-- form start -->
                <div class="row">
                <!-- right column -->
                    <div class="col-md-8">
                    <!-- Horizontal Form -->
                    <div class="box">
                        <div class="box-header with-border bg-black-active">
                            <h4 class="box-title"> {{ $post->title }} </h4><br>
                            <small>Posted By <strong><a href="#">{{ $post->user->name }}</a></strong> on {{
                                $post->created_at->toFormattedDateString() }}</small>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <p>{!! $post->body !!}</p>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                    <div class="col-md-4">
                        <!-- Horizontal Form -->
                        <div class="box">
                            <div class="box-header with-border bg-blue-active">
                                <h3 class="box-title">Categories</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    @foreach($post->categories as $category)
                                        <span class="label bg-blue">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border bg-green-active">
                                <h3 class="box-title">Tags</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    @foreach($post->tags as $tag)
                                        <span class="label bg-green-active">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border bg-yellow-active">
                                <h3 class="box-title">Feature image</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <img class="img-fluid img-thumbnail" src="{{ Storage::url('post/'.$post->image) }}" alt="{{
                                    $post->image }}">
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                <!--/.col (right) -->
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')

@endpush