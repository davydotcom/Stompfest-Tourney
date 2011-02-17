<?php

$this->mysmarty->registerPlugin("function", "OutID", "OutID");
$this->mysmarty->registerPlugin("function", "OutCancel", "OutCancel");
$this->mysmarty->registerPlugin("function", "OutDisband", "OutDisband");
$this->mysmarty->registerPlugin("function", "OutNewTeam", "OutNewTeam");
$this->mysmarty->registerPlugin("function", "OutFoundTeam", "OutFoundTeam");

function OutID($iParams, $smarty)
    {
    if ( empty($iParams["tourneyID"]) )
        return "";

    return sprintf('<input type="hidden" id="TourneyID" name="TourneyID" value="%s" />', $iParams["tourneyID"]);
    }

function OutCancel($iParams, $smarty)
    {
    if ( empty($iParams["TTID"]) )
        return "";

    return sprintf('<input type="button" class="MyButton" value="Cancel Registration" onclick="javascript:ConfirmCancel(\'%s\');" title="Cancel my register for this Tournament" />', $iParams["TTID"]);
    }

function OutFoundTeam($iParams, $smarty)
    {
    if ( empty($iParams["tourneyID"]) )
        return "";

    return sprintf('<input type="button" class="MyButton" value="I found a team" onclick="location.href=\'/tourney/main/FoundTeam/%s\'" title="I found a team, let me see the list" />', $iParams["tourneyID"]);
    }

function OutNewTeam($iParams, $smarty)
    {
    if ( empty($iParams["tourneyID"]) )
        return "";

    return sprintf('<input type="button" class="MyButton" value="Create a new Team" onclick="location.href=\'/tourney/team/NewTeam/%s\'" title="Create a new team" />', $iParams["tourneyID"]);
    }

function OutDisband($iParams, $smarty)
    {
    if ( empty($iParams["teamID"]) )
        return "";

    return sprintf('<input type="button" value="Disband Team" title="Disband this team" onclick="Javascript:ConfirmDisband(\'%s\');" class="MyButton" />', $iParams["teamID"]);
    }
