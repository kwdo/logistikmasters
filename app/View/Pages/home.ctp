<?php
echo $this->element('http_fetcher', array('url' => 'http://www.verkehrsrundschau.de/sixcms/detail.php?id=1025501&template=vkr_logistkmasters_start_neu'));
?>
<script type="text/javascript">
    window.addEventListener("load", function()
    {
        $("#lmnews").on("click", "div.pager a", function(e) {
            e.preventDefault();
            $(".pager a").removeClass("active");
            $(this).addClass("active");
            $("#lmnews").load($(this).attr("href").replace(/\?/, "?template=vkr_logistkmasters_start_neu&") + " #lmnews", function()
            {
                if($("span.pre"))
                {
                    $("span.pre").parent().css('float', 'left');
                }
                var links = document.querySelectorAll("#lmnews div.newsEntry a");
                if(links)
                {
                    links.forEach(function(a)
                    {
                        a.setAttribute('href', 'https://www.verkehrsrundschau.de/nachrichten' + a.getAttribute('href'));
                    });
                }
            });
        });
    });
</script>