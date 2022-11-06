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
                            <div class="yoast_breadcrumb hidden-xs"><span><span>
                                        @foreach ($movie->movie_category as $mc)
                                            »
                                            <a
                                                href="{{ url('client/categories', ['slug' => $mc->slug]) }}">{{ $mc->name }}</a>
                                        @endforeach
                                        » <span><a href="danhmuc.php">{{ $movie->country->name }}</a> » <span
                                                class="breadcrumb_last"
                                                aria-current="page">{{ $movie->name }}</span></span>
                                    </span></span></div>
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
                                        <a href="{{ route('movie.watch', ['slug' => $movie->slug, 'episode' => $firstEp->episodes]) }}"
                                            class="bwac-btn">
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
                                                <span class="episode">Tập {{ $episodeCount }} / {{ $movie->episodes }} Tập
                                                    -
                                                    {{ $movie->episodes == $episodeCount ? 'Hoàn Thành' : 'Đang Cập Nhật' }}</span>
                                            @else
                                                <span
                                                    class="episode">{{ $movie->episodes == $episodeCount ? 'Hoàn Thành' : 'Đang Cập Nhật' }}</span>
                                            @endif
                                        </li>
                                        <li class="list-info-group-item"><span>Điểm IMDb</span> : <span
                                                class="imdb">7.2</span></li>
                                        <li class="list-info-group-item"><span>Năm sản xuất</span> : <span
                                                class="year_release">{{ $movie->year_release }}</span></li>
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
                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="post-38424" class="item-content">
                                    Phim <a href="https://phimhay.co/goa-phu-den-38424/">{{ $movie->name }}</a> -
                                    {{ $movie->country->name }}:
                                    {!! $movie->description !!}
                                </article>
                            </div>
                        </div>
                        <div id="halim_trailer">
                            <h2 class="section-title"><span style="color:#ffed4d">Trailer Phim</span></h2>
                            <br>
                            <iframe width="100%" height="420" src="https://www.youtube.com/embed/{{ $movie->trailer }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>

                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Bình luận phim</span></h2>
                        </div>

                        @auth
                            <div class="entry-content htmlwrap clearfix">
                                <div class="video-item halim-entry-box">
                                    <section class="content-item" id="comments">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul class="errors"></ul>
                                                <form method="POST" action="{{ route('client.addComment') }}"
                                                    id="AddComment">
                                                    {{ csrf_field() }}
                                                    <fieldset style="clear: both;">
                                                        <div class="row">
                                                            <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                                <textarea class="form-control" id="message" placeholder="Your message" name="content"></textarea>
                                                                <input type="hidden" name="user_id" id="user_id"
                                                                    value="{{ \Auth::user()->id }}">
                                                                <input type="hidden" name="movie_id" id="movie_id"
                                                                    value="{{ $movie->id }}">
                                                            </div>
                                                            <div class="col-sm-2"
                                                                style="display: flex; justify-content: center; height: 55px;">
                                                                <button type="submit"
                                                                    class="btn btn-normal pull-right">Send</button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>


                                                <div class="row reload-list">
                                                    @foreach ($comments as $cmt)
                                                        <div class="media"
                                                            style="border-top: 1px dashed #DDDDDD;
                                            padding: 30px 0;
                                            margin: 0;">
                                                            <div class="media-body">
                                                                <h4 class="media-heading">{{ $cmt->user->name }}</h4>
                                                                <p>{{ $cmt->content }}</p>
                                                                <ul class="list-unstyled list-inline media-detail pull-left">
                                                                    <li><i class="fa fa-calendar"
                                                                            style="margin-right: 10px"></i>{{ $cmt->created_at }}</li>
                                                                </ul>
                                                                <ul class="list-unstyled list-inline media-detail pull-right">
                                                                    <li class=""><a href="">Like</a></li>
                                                                    <li class=""><a href="">Reply</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>


                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        @else
                            <div class="entry-content htmlwrap clearfix">
                                <div class="video-item halim-entry-box">
                                    <section class="content-item" id="comments">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="alert alert-warning" role="alert">Bạn cần đăng nhập để bình luận
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        @endauth
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
