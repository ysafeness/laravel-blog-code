<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a href="/" class="nav-link">首页</a>
    </li>
    @auth 
        <li @if (Request::is("admin/post*")) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/post" class="nav-link">文章</a>
        </li>
        <li @if (Request::is("admin/tag*")) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/tag" class="nav-link">标签</a>
        </li>
        <li @if (Request::is("admin/upload*")) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/upload" class="nav-link">上传</a>
        </li>
    @endauth
</ul>

<ul class="navbar-nav ml-auto">
    @guest
        <li class="nav-item">
            <a href="/login" class="nav-link">登录</a>
        </li>
    @else 
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="/logout" class="dropdown-item">退出</a>
            </div>
        </li>
    @endguest
</ul>