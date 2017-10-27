window.addEventListener("load", function()
{
    var links = document.querySelectorAll("#lmnews div.newsEntry a");
    if(links && links.length)
    {
        for(var i=0; i<links.length; i++)
        {
            links[i].setAttribute('href', 'https://www.verkehrsrundschau.de/nachrichten' + links[i].getAttribute('href'));
        }
    }
});