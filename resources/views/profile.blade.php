@extends('layouts.frontend.app')

@section('title', 'profile')


@push('css')
    <link href="{{ asset('asset/frontend/blog-sidebar/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/frontend/blog-sidebar/css/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>AUTHOR'S DETAILS</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
            @if(!$posts->count() == 0)
                @foreach($posts as $post)
                <div class="col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image)
                    }}" lt="Blog Image">
                            </div>

                            <a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
                                <img src="{{ Storage::disk('public')->url ('profile/'.$post->user->image) }}"
                                     alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{
                        $post->title
                        }}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);" onclick="toastr.warning('To add ' +
                                     'favorite list need to login first.', 'Warning', {
                                        closeButton: true,
                                        progressBar: true,
                                     })"><i
                                                        class="ion-heart"></i>{{
                                    $post->favorite_to_users->count()
                                    }}</a>
                                        @else
                                            <a href="javascript:void(0);" onclick="document.getElementById
                                                    ('favorite-form-{{ $post->id }}').submit();">
                                                <i class="ion-heart {{ !Auth::user()->favorite_posts->where
                                        ('pivot.post_id',$post->id)->count() == 0 ? 'text-danger' :
                                        ''}}"></i>
                                                {{  $post->favorite_to_users->count() }}
                                            </a>
                                            <form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite',
                                    $post->id) }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count()
                            }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            @else
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-info">
                                <p class="py-5 mt-4 h4 text-danger">Sorry no result found :(</p>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endif
                    </div><!-- row -->

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <img class="img-thumbnail" src="{{ Storage::disk('public')->url('profile/'.$author->image) }}"
                                 alt="image" style="width: 150px; height: 150px;"><br>
                            <h6 class="title mb-0 mt-2"><b>{{ $author->name }}</b></h6>
                            <p><small>{{ $author->email }}</small></p>
                            <p><small>Since: {{ $author->created_at->toDatestring() }}</small></p>
                            <strong>Total Posts - <span class="badge badge-danger">{{ $author->posts->count()
                            }}</span></strong>
                            <hr>
                            <p>{{ $author->about }}</p>
                        </div>

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('scripts')
@endpush