
function IsEmpty(iWho)
    {
    if ( iWho == null || iWho == undefined )
        return true;

    iWho = jQuery.trim(iWho);
    
    if ( iWho == "" || iWho == 0 || iWho == false || iWho.toLowerCase() == "false" )
        return true;

    return false;
    }

function DoFade(iWho)
    {
    $("#" + iWho).fadeOut("slow");
    }

    $(document).ready(function(){
       $('.flash').delay(5000).fadeOut('slow');

    });

function ErrorShow(iWho, iMessage)
    {
    iWho.addClass("TBError");

    alert(iMessage + "\n\nAdd a fancy Balloon or CSS error message thingy later.  Haven't had much luck. :(");
    }

function ErrorClear(iWho)
    {
    iWho.removeClass("TBError");
    }
