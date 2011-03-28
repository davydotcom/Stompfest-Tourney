<hr />
<h3>
    <table width="100%">
        <tr>
            <td><b>{$xTourney->showName}</b></td>
            <td align="right">{$xTourney->Status}</td>
        </tr>
    </table>
</h3>
<div>
    <table width="100%">
        <tr>
            <td class="DataLabel">Type:</td>
            <td>{$xTourney->TypeDesc}</td>
        </tr>
        {if !empty($xTourney->ReggyAt)}
            <tr>
                <td class="DataLabel">Registration:</td>
                <td>{$xTourney->ReggyAt}</td>
            </tr>
        {/if}
        {if !empty($xTourney->maxTeams)}
            <tr>
                <td class="DataLabel">Max # of Teams:</td>
                <td>{$xTourney->maxTeams}</td>
            </tr>
        {/if}
        {if !empty($xTourney->playersPerTeam)}
            <tr>
                <td class="DataLabel">Players per Team:</td>
                <td>{$xTourney->playersPerTeam}</td>
            </tr>
        {/if}
        {if !empty($xTourney->allowInternetMatches)}
            <tr>
                <td class="DataLabel">Internet based competitors:</td>
                <td><b>Yes</b></td>
            </tr>
        {/if}
        {if !empty($xTourney->description)}
            <tr>
                <td class="DataLabel">Description:</td>
                <td class="TourneyListDesc">{$xTourney->description}</td>
            </tr>
        {/if}
        {if !empty($xTourney->Next)}
            <tr>
                <td colspan="2" align="center">
                    {if $xTourney->Next == "L" || $xTourney->Next == "R"}
                        {OutID tourneyID={$xTourney->tourneyID}}
                        {OutCancel tourneyID={$xTourney->tourneyID}}

<br><b>Type: {$xTourney->Type} -- Look: {$xTourn->lookingForTeam} -- cap: {$xTourn->IAmTeamCaptain} -- Lock: {$xTourn->locked}</b><br>

                        {if $xTourney->Type == 1}
                            {include file="/profile/team.tpl"}
                        {/if}
                    {/if}
                    {if $xTourney->Next == "L"}
                        {if $xTourney->NumTeams > 0}
                            {OutFoundTeam tourneyID={$xTourney->tourneyID}}
                        {/if}
                        {OutNewTeam tourneyID={$xTourney->tourneyID}}
                    {/if}
                    {if $xTourney->Next == "O"}
                        <input type="button" class="MyButton" value="Register" onclick="location.href='/tourney/main/register/{$xTourney->tourneyID}'" title="Register for this Tournament" />
                    {/if}
                </td>
            </tr>
        {/if}
    </table>
</div>
