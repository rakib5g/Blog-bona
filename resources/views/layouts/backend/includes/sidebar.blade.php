<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tag.index') }}">
                        <i class="fa fa-tags"></i> Tags
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="fa fa-th-large"></i> Categories
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                    <a href="{{ route('admin.post.index') }}">
                        <i class="fa fa-file-text"></i> Posts
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                    <a href="{{ route('admin.post.pending') }}">
                        <i class="fa fa-road"></i> Pending Posts
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscribers*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscriber.index') }}">
                        <i class="fa fa-envelope"></i> Subscriber
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/favorite*') ? 'active' : '' }}">
                    <a href="{{ route('admin.favorite.post') }}">
                        <i class="fa fa-heart"></i> Favorite posts
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/comment*') ? 'active' : '' }}">
                    <a href="{{ route('admin.comment.index') }}">
                        <i class="fa fa-comments"></i> Comments
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/authors*') ? 'active' : '' }}">
                    <a href="{{ route('admin.author.index') }}">
                        <i class="fa fa-users"></i> Authors
                        <span class="pull-right-container"> </span>
                    </a>
                </li>

                <li class="header">SYSTEM</li>
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}">
                        <i class="fa fa-wrench"></i> Settings
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
            @endif

            <!--FOR AUTHOR-->

            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="{{ route('author.post.index') }}">
                        <i class="fa fa-file-text"></i> Posts
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('author/favorite*') ? 'active' : '' }}">
                    <a href="{{ route('author.favorite.post') }}">
                        <i class="fa fa-heart"></i> Favorite posts
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li class="{{ Request::is('author/comment*') ? 'active' : '' }}">
                    <a href="{{ route('author.comment.index') }}">
                        <i class="fa fa-comments"></i> Comments
                        <span class="pull-right-container"> </span>
                    </a>
                </li>

                <li class="header">SYSTEM</li>
                <li class="{{ Request::is('author/settings*') ? 'active' : '' }}">
                <a href="{{ route('author.settings') }}">
                    <i class="fa fa-wrench"></i> Settings
                    <span class="pull-right-container"> </span>
                </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>