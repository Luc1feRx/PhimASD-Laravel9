
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


//add comment

$(document).ready(function () {
    $('#AddComment').submit(function(e) {
        e.preventDefault();
        $('.errors').html('');
        $('.errors').removeClass('alert alert-danger');
        var user_id = $('#user_id').val();
        var movie_id = $('#movie_id').val();
        var content = $('#message').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/client/addComment",
            data: {content: content, movie_id: movie_id, user_id: user_id},
            dataType: "json",
            success: function(data) {
                Swal.fire(
                    'Successfully!',
                    data.message,
                    'success'
                )

            },
            error: function(jqXHR) {
                $('.errors').html("");
                $('.errors').addClass('alert alert-danger');
                $.each(jqXHR.responseJSON.errors, function(index, error) {
                    $('.errors').append('<li>' + error + '</li>');
                });
            }
        });

    });
});