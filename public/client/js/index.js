
$(document).ready(function($) {
    var owl = $('#hot_movies');
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
                items: 5
            }
        }
    })
});



    $(document).ready(function () {
        $(".change_link").click(function() {
            movie = $(this).attr("data-movie");
            ep = $(this).attr("data-episode");
            $('#watch_movie_zone').empty();
            $('.hydrax-title').removeClass('active-hydrax')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url : '/client/watch/'+ movie +'/backup/' + ep,
                type : 'GET',
                data : {
                    movie: movie,
                    ep: ep
                },
                dataType:'json',
                success : function(data) {
                    $('.hydrax-title').addClass('active-hydrax');
                    $('#watch_movie_zone').append(data.get_ep_link2[0].link2);
                },
                error : function(request,error)
                {
                    console.log("Request: "+JSON.stringify(request));
                }
            });
        });
    });