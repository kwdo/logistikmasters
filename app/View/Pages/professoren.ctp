<?php
echo $this->element('http_fetcher', array('url' => 'http://www.verkehrsrundschau.de/sixcms/detail.php?id=1035234&template=vkr_lm_professoren_blank'));
?>
<script type="text/javascript">
    $(function() {
        $(".prof-select-header a").bind("click", function(e) {
            e.preventDefault();
            $(".prof-select-header a").removeClass("active");
            $(this).addClass("active");
            $(".profs-history").load($(this).attr("href").replace(/\?/, "?template=vkr_lm_professoren_blank&") + " .profs-history" );
        });
    });
</script>
