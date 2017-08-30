window.addEventListener("load", function()
{
    var links = document.querySelectorAll("#lmnews div.newsEntry a");
    if(links)
    {
        links.forEach(function(a)
        {
            a.setAttribute('href', 'https://www.verkehrsrundschau.de/nachrichten' + a.getAttribute('href'));
        });
    }
});