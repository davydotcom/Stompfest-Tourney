<?php

$this->mysmarty->registerPlugin("function", "OutID", "OutID");
$this->mysmarty->registerPlugin("function", "OutCancel", "OutCancel");

function OutID($iParams, $smarty)
    {
    if ( empty($iParams["tourneyID"]) )
        return "";

    return sprintf('<input type="hidden" id="TourneyID" name="TourneyID" value="%s" />', $iParams["tourneyID"]);
    }

function OutCancel($smarty)
    {
    return sprintf('<input type="button" class="MyButton" value="Cancel Registration" onclick="javascript:ConfirmCancel();" title="Cancel my register for this Tournament" />');
    }