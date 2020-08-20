<header class="mb-3">
    <nav class="navbar navbar-expand-sm navbar-dark"  style="background-color:#0000ff;"> 
        <a class="navbar-brand" href="/">Safety Confirmation Easy</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        @if(Auth::user()->admin == "9")
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}（管理者）</a>
                        @else
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        @endif
                        <ul class="dropdown-menu dropdown-menu-right">
                            @if(Auth::user()->admin == "9")
                            <li class="dropdown-item">{!! link_to_route('disasters.index', '災害一覧', []) !!}</li>
                            <li class="dropdown-divider"></li>
                            @else
                            <li class="dropdown-item">{!! link_to_route('safety.editByUser', '安否登録', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            @endif
                            <li class="dropdown-item">{!! link_to_route('users.edit', 'ユーザー情報変更', ['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>
