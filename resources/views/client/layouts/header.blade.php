<header id="header">
    <div class="container">
        <div class="row" id="headwrap">
            <div class="col-md-3 col-sm-6 slogan">
                <p class="site-title"><a class="logo" href="" title="phim hay ">Phim Hay</p>
                </a>
            </div>
            <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                <div class="header-nav">
                    <div class="col-xs-12">
                        <form id="search-form-pc" name="halimForm" role="search" action="" method="GET">
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input id="search" type="text" name="s" class="form-control"
                                        placeholder="Tìm kiếm..." autocomplete="off" required>
                                    <i class="animate-spin hl-spin4 hidden"></i>
                                </div>
                            </div>
                        </form>
                        <ul class="ui-autocomplete ajax-results hidden"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs" style="display: flex;">
                <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span
                        class="count">0</span></div>
                <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                    <ul style="margin: 0;"></ul>
                </div>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ \Auth::user()->name }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <form style="padding: 12px;" action="{{ route('client.logout') }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" style="width: 100%;" class="btn btn-primary">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="btn-group" role="group" aria-label="...">
                <form action="{{ route('client.logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div> --}}
                @else
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="{{ route('client.showlogin') }}" class="btn btn-primary">Login</a>
                    </div>
                @endauth


            </div>

        </div>
    </div>
</header>
<div class="navbar-container">
    <div class="container">
        <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                    data-target="#halim" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right expand-search-form"
                    data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                    <span class="hl-search" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                    Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                    <span class="count">0</span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                    <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i
                            class="fas fa-filter"></i></a>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="halim">
                <div class="menu-menu_1-container">
                    <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ url('client/home') }}">Trang
                                Chủ</a>
                        </li>
                        <li class="mega dropdown">
                            <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach ($genres as $genre)
                                    <li><a title="{{ $genre->name }}" href="danhmuc.php">{{ $genre->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="mega dropdown">
                            <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach ($countries as $country)
                                    <li><a title="{{ $country->name }}" href="danhmuc.php">{{ $country->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @foreach ($categories as $category)
                            <li class="mega"><a title="{{ $category->name }}"
                                    href="{{ url('/client/categories', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <ul class="nav navbar-nav navbar-left" style="background:#000;">
                    <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                </ul>
            </div>
        </nav>
        <div class="collapse navbar-collapse" id="search-form">
            <div id="mobile-search-form" class="halim-search-form"></div>
        </div>
        <div class="collapse navbar-collapse" id="user-info">
            <div id="mobile-user-login"></div>
        </div>
    </div>
</div>
