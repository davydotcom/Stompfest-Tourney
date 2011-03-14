
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
function setupCheckboxes()
{
    $(":checkbox").each(function() {
        cb = $(this);
        cb.attr('id',cb.attr('name'));
        cb.removeAttr('name');
        var hb = document.createElement('input');
        $(hb).attr('type','hidden');
        $(hb).attr('name',cb.attr('id'));
        $(hb).attr('value',cb.attr('value'));
        if(cb.attr('value') == '1')
        {
            cb.attr('checked',true);
        }
        $(hb).attr('id',cb.attr('id') + '_actual');
        cb.bind('change',checkBoxChanged);
        $(hb).insertAfter(cb);
    });
}
function setupDataMethods()
{
    $('a[data-confirm]').bind('click',function(ev) {
        if(!confirm($(this).attr('data-confirm')))
        {
            ev.preventDefault();
            return false;
        }
    });
}

function checkBoxChanged(ev)
{
    var cb = $(this);
    if(cb.attr('checked') == true)
    {
        $("#" + $(this).attr('id') + "_actual").attr('value','1');
    }
    else
    {
        $("#" + $(this).attr('id') + "_actual").attr('value','0');
    }
    
}

$(document).ready(function(){
    $('.flash').delay(5000).fadeOut('slow');
    setupCheckboxes();
    setupDataMethods();
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
