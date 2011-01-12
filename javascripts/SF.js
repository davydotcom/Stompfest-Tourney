
function FadeItOut(iWho)
    {
    setTimeout("DoFade('" + iWho + "')", 5000);
    }

function DoFade(iWho)
    {
    $("#" + iWho).fadeOut("slow");
    }