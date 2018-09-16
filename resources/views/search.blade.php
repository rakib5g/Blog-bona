@extends('layouts.frontend.app')

@section('title')
    {{ $query }}
@endsection

@push('css')
    <link href="{{ asset('asset/frontend/category/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/frontend/category/css/responsive.css') }}" rel="stylesheet">
    <style>
        .slider{ height: 400px; width: 100%; background-image: url({{asset('asset/frontend/images/slider-1.jpg')}});
            background-size:
                    cover; }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $posts->count() }} - Result For {{ $query }}</b></h1>
    </div><!-- slider -->
    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @if(!$posts->count() == 0)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="single-post post-style-1">

                                    <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image)
                                }}" lt="Blog Image">
                                    </div>

                                    <a class="avatar" href="{{ route('author.profile',$post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'
                                .$post->user->image) }}" alt="Profile Image"></a>

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
                                            <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
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
        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('scripts')
@endpush