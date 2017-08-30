<?php
echo $this->element('http_fetcher', array('url' => 'http://www.verkehrsrundschau.de/sixcms/detail.php?id=1035233&template=vkr_lm_hochschulen_blank'));
?>
<script type="text/javascript">
    $(function ()
    {
        $(".hochschulen").on("click", "a", function (e)
        {
            e.preventDefault();
            $(".hochschulen").load($(this).attr("href") + " .hochschulen");
        });
    });
</script>
