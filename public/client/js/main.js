const { splitVendorChunkPlugin } = require("vite");



$(document).ready(function($) {				
    var owl = $('#phimchieurap_index');
    owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 5}}})});



    $(document).ready(function () {
        $(".change-ep-ajax").click(function() {
            // slug = $(this).attr("data-title");
            // ep = $(this).attr("data-episode");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            alert('ddd');

            // $.ajax({
            //     url : 'client/watch/movie/'+ slug +'/episode-' + ep,
            //     type : 'GET',
            //     data : {
            //         slug: slug,
            //         ep: ep
            //     },
            //     dataType:'json',
            //     success : function(data) {              
            //         console.log(data);
            //     },
            //     error : function(request,error)
            //     {
            //         alert("Request: "+JSON.stringify(request));
            //     }
            // });
        });
    });