jQuery(document).ready(function($) {
    /* Responsive Videos Start */
    var $allVideos = $("div.video-player > iframe"),
        $fluidEl = $("div.video-player");

    $allVideos.each(function() {
        $(this)
            .attr('data-aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');
    });

    $(window).resize(function() {
        var newWidth = $fluidEl.width();
        $allVideos.each(function() {
            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.attr('data-aspectRatio'));
        });
    }).resize();
    /* Responsive Videos End */



    $('.vr-top-themen-item-text p').fewlines({lines : 8});
    $('.vr-related-themes-item__heading').fewlines({lines : 4});

    $('#actual-tag-block .vr-item__heading').fewlines({lines : 4});


    $('div.well-nachrichten article.vr-item h2.vr-news-item__heading').fewlines({lines : 4});



    $('.vr-related-themes-item__heading').fewlines({lines : 4});

    $('#actual-tag-block .vr-item__heading').matchHeight();

    $('#index-top-tags h2.vr-item__heading').matchHeight();
    $('#index-top-tags div.vr-item__teaser').matchHeight();
    $("div.well-nachrichten article.vr-item h2.vr-news-item__heading").matchHeight();


    /* CompanyCatalog */
    $("article.vr-branchenguide-start-brand-item h3").matchHeight();
    $(".well-brenchenguide-start-related-themes h3.vr-branchenguide-start-item__title").matchHeight();

});

window.addEventListener('load', function()
{
    var top = document.createElement("div");
    top.id = "to-top";
    top.onclick = function() { window.scrollTo(0, 0); };
    top.appendChild(document.createElement("div"));
    document.body.appendChild(top);

    window.addEventListener("scroll", function()
    {
        var h = document.body.scrollHeight-document.body.clientHeight;
        var y = window.pageYOffset;
        top.style.display = (y/h > 0.7) ? "block" : "none";
    });

});
