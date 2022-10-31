@extends('client.app')

@section('contents')
    <div class="container">
        <div class="row fullwith-slider"></div>
    </div>
    <div class="container">
        <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                            href="{{ url('client/categories', ['slug' => $movie->category->slug]) }}">{{ $movie->category->name }}</a>
                                        » <span><a href="danhmuc.php">{{ $movie->country->name }}</a> » <span
                                                class="breadcrumb_last"
                                                aria-current="page">{{ $movie->name }}</span></span></span></span></div>
                        </div>
                    </div>
                </div>
                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
                <section id="content" class="test">
                    <div class="clearfix wrap-content">

                        <div class="halim-movie-wrapper">
                            <div class="title-block">
                                <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                    <div class="halim-pulse-ring"></div>
                                </div>
                                <div class="title-wrapper" style="font-weight: bold;">
                                    Bookmark
                                </div>
                            </div>
                            <div class="movie_info col-xs-12">
                                <div class="movie-poster col-md-3">
                                    <img class="movie-thumb"
                                        src="{{ \Storage::disk('s3')->temporaryURL('uploads/movies/' . $movie->image, now()->addMinutes(10)) }}"
                                        alt="{{ $movie->name }}">
                                    <div class="bwa-content">
                                        <div class="loader"></div>
                                        <a href="{{ route('movie.watch', ['slug' => $movie->slug, 'episode' => $firstEp->episodes]) }}" class="bwac-btn">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="film-poster col-md-9">
                                    <h1 class="movie-title title-1"
                                        style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                        {{ $movie->name }}</h1>
                                    <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                    <ul class="list-info-group">
                                        <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                                @if ($movie->resolution == 1)
                                                    FullHD
                                                @elseif($movie->resolution == 0)
                                                    CAM
                                                @elseif($movie->resolution == 2)
                                                    HDRip
                                                @elseif($movie->resolution == 3)
                                                    HD
                                                @endif
                                            </span><span
                                                class="episode">{{ $movie->subtitle == 1 ? 'Vietsub' : 'Thuyết Minh' }}</span>
                                                @if ($episodeCount > 1)
                                                <span
                                                class="episode">Tập {{ $episodeCount }} / {{ $movie->episodes }} Tập - {{$movie->episodes == $episodeCount ? 'Hoàn Thành' : 'Đang Cập Nhật'}}</span>
                                                @else
                                                <span
                                                class="episode">{{$movie->episodes == $episodeCount ? 'Hoàn Thành' : 'Đang Cập Nhật'}}</span>
                                                @endif
                                        </li>
                                        <li class="list-info-group-item"><span>Điểm IMDb</span> : <span
                                                class="imdb">7.2</span></li>
                                        <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->duration }}
                                        </li>
                                        <li class="list-info-group-item"><span>Thể loại</span> :
                                            @foreach ($movie->movie_genre as $gens)
                                                <a href="" rel="category tag">{{ $gens->name }} </a>
                                            @endforeach
                                        <li class="list-info-group-item"><span>Quốc gia</span> : <a href=""
                                                rel="tag">{{ $movie->country->name }}</a></li>
                                        <li class="list-info-group-item last-item"
                                            style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                            <span>Diễn viên</span> :
                                            @foreach ($movie->movie_actor as $acs)
                                                <a href="" rel="nofollow"
                                                    title="{{ $acs->name }}">{{ $acs->name }} </a>
                                            @endforeach
                                    </ul>
                                    <div class="movie-trailer hidden"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Trailer Phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="post-38424" class="item-content">
                                    Phim <a href="https://phimhay.co/goa-phu-den-38424/">{{ $movie->name }}</a> -
                                    {{ $movie->country->name }}:
                                    {!! $movie->description !!}
                                    {{-- <h5>Từ Khoá Tìm Kiếm:</h5>
                                    <ul>
                                        <li>black widow vietsub</li>
                                        <li>Black Widow 2021 Vietsub</li>
                                        <li>phim black windows 2021</li>
                                        <li>xem phim black windows</li>
                                        <li>xem phim black widow</li>
                                        <li>phim black windows</li>
                                        <li>goa phu den</li>
                                        <li>xem phim black window</li>
                                        <li>phim black widow 2021</li>
                                        <li>xem black widow</li>
                                    </ul> --}}
                                </article>
                            </div>
                        </div>
                        <div id="halim_trailer">
                            <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                            <br>
                            <iframe width="100%" height="420" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </section>
                <section class="related-movies">
                    <div id="halim_related_movies-2xx" class="wrap-slider">
                        <div class="section-bar clearfix">
                            <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                        </div>
                        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php" title="Đại Thánh Vô Song">
                                        <figure><img class="lazy img-responsive"
                                                src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-w860_-tiHFI/YO7DW5hwmNI/AAAAAAAAJqg/yFXRsVIh70oslGUKU4Fg3NxipcmCiPt3ACLcBGAsYHQ/s320/unnamed.jpg"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">Đại Thánh Vô Song</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php" title="Đại Thánh Vô Song">
                                        <figure><img class="lazy img-responsive"
                                                src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-w860_-tiHFI/YO7DW5hwmNI/AAAAAAAAJqg/yFXRsVIh70oslGUKU4Fg3NxipcmCiPt3ACLcBGAsYHQ/s320/unnamed.jpg"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">Đại Thánh Vô Song</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php" title="Đại Thánh Vô Song">
                                        <figure><img class="lazy img-responsive"
                                                src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-w860_-tiHFI/YO7DW5hwmNI/AAAAAAAAJqg/yFXRsVIh70oslGUKU4Fg3NxipcmCiPt3ACLcBGAsYHQ/s320/unnamed.jpg"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">Đại Thánh Vô Song</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php" title="Đại Thánh Vô Song">
                                        <figure><img class="lazy img-responsive"
                                                src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-w860_-tiHFI/YO7DW5hwmNI/AAAAAAAAJqg/yFXRsVIh70oslGUKU4Fg3NxipcmCiPt3ACLcBGAsYHQ/s320/unnamed.jpg"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">Đại Thánh Vô Song</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php" title="Đại Thánh Vô Song">
                                        <figure><img class="lazy img-responsive"
                                                src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-w860_-tiHFI/YO7DW5hwmNI/AAAAAAAAJqg/yFXRsVIh70oslGUKU4Fg3NxipcmCiPt3ACLcBGAsYHQ/s320/unnamed.jpg"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">Đại Thánh Vô Song</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>

                        </div>
                        <script>
                            jQuery(document).ready(function($) {
                                var owl = $('#halim_related_movies-2');
                                owl.owlCarousel({
                                    loop: true,
                                    margin: 4,
                                    autoplay: true,
                                    autoplayTimeout: 4000,
                                    autoplayHoverPause: true,
                                    nav: true,
                                    navText: ['<i class="hl-down-open rotate-left"></i>',
                                        '<i class="hl-down-open rotate-right"></i>'
                                    ],
                                    responsiveClass: true,
                                    responsive: {
                                        0: {
                                            items: 2
                                        },
                                        480: {
                                            items: 3
                                        },
                                        600: {
                                            items: 4
                                        },
                                        1000: {
                                            items: 4
                                        }
                                    }
                                })
                            });
                        </script>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
