function rateMedia(mediaId, rate, numStar, starWidth) {
    $('#group' + mediaId + ' .star_bar #' + rate).removeAttr('onclick'); // Remove the onclick attribute: prevent multi-click
    $('.box' + mediaId).html('<img src="' + window.loader + '" alt="" />'); // Display a processing icon
    var data = {mediaId: mediaId, rate: rate}; // Create JSON which will be send via Ajax
    $.ajax({
        type: 'POST',
        url: ROOT_URL + 'ajax/starrating/update/data',
        data: data,
        dataType: 'json',
        timeout: 3000,
        success: function(response) {
            Cookies.set("symfonyRatingSystem" + mediaId, "Rated", { expires : 7 }); // Add jQuery Cookie Plugin to use this function
            $('.box' + mediaId).html('<div style="font-size: small; color: green">Bewertung erfolgreich</div>'); // Return "Thank you for rating"
            // We update the rating score and number of rates
            $('.resultMedia' + mediaId).html('<div class="resultMedia\'.$mediaId.\' vr-article__metadata">' + response.avgAbs + ' bei ' + response.nbrRate + ' Bewertungen</div>');
            // We recalculate the star bar with new selected stars and unselected stars
            var nbrPixelsInDiv = numStar * starWidth;
            var numEnlightedPX = Math.round(nbrPixelsInDiv * response.avg / numStar);
            $('#group' + mediaId + ' .star_bar').attr('style', 'width:' + nbrPixelsInDiv + 'px; height:' + starWidth + 'px; background: linear-gradient(to right, #e22713 0%,#e22713 ' + numEnlightedPX + 'px,#c2c2c2 ' + numEnlightedPX + 'px,#ccc 100%);');
            $('#group' + mediaId).removeClass('notVoted');
            $.each($('#group' + mediaId + ' .star_bar > div'), function () {
                $(this).removeAttr('onmouseover onclick');
            });
        },
        error: function() {
            $('#box').text('Problem');
        }
    });
}

function overStar(mediaId, myRate, numStar) {
    for ( var i = 1; i <= numStar; i++ ) {
        if (i <= myRate) $('#group' + mediaId + ' .star_bar #' + i).attr('class', 'star_hover');
        else $('#group' + mediaId + ' .star_bar #' + i).attr('class', 'star');
    }
}

function outStar(mediaId, myRate, numStar) {
    for ( var i = 1; i <= numStar; i++ ) {
        $('#group' + mediaId + ' .star_bar #' + i).attr('class', 'star');
    }
}