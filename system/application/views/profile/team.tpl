{if $xTourn->lookingForTeam == 0}
    <input type="hidden" id="teamID_{$xTourn->tourneyID}" name="teamID_{$xTourn->tourneyID}" value="{$xTourn->teamID}" />
    <tr>
        <td class="DataLabel">Team Name:</td>
        <td>
            {if $xTourn->IAmTeamCaptain == 1 && $xTourn->locked == 0}
                <input type="text" id="teamName_{$xTourn->tourneyID}" name="teamName_{$xTourn->tourneyID}" value="{$xTourn->teamName}" maxlength="50" size="50" />
            {else}
                {$xTourn->teamName}
            {/if}
        </td>
    </tr>
    <tr>
        <td class="DataLabel">Team URL:</td>
        <td>
            {if $xTourn->IAmTeamCaptain == 1 && $xTourn->locked == 0}
                <input type="text" id="teamURL_{$xTourn->tourneyID}" name="teamURL_{$xTourn->tourneyID}" value="{$xTourn->teamURL}" maxlength="125" size="50" />
            {else}
                {if empty($xTourn->teamURL)}
                    &nbsp;
                {else}
                    <a href="{$xTourn->teamURL}" target="_blank">{$xTourn->teamURL}</a>
                {/if}
            {/if}
        </td>
    </tr>
    <tr>
        <td class="DataLabel">Members:</td>
        <td>
            <table width="100%" class="DG" border="1">
                <thead>
                    <th>Handle</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    {foreach $xTourn->Members as $xMember}
                        <tr id="xTR_M{$xMember->TTID}">
                            <td>{$xMember->handle}</td>
                            <td>
                                {if $xMember->IsCaptain == 1}
                                    <img src="/images/Captain.png" title="Captain" />
                                    {if $xTourn->IAmTeamCaptain == 1 && sizeof($xTourn->Members) > 1}
                                        <input type="radio" id="xRB_M0" name="xRG_Cap_{$xTourn->tourneyID}" value="0" checked>
                                    {/if}
                                {/if}
                                {if $xTourn->IAmTeamCaptain == 1 && $xMember->IsCaptain == 0}
                                    <a href="Javascript:RemoveTeamMember('{$xMember->TTID}');"><img src="/images/Delete.png" border="0" title="Remove this Gamer from my Team" /></a>
                                    <input type="radio" id="xRB_M{$xMember->userID}" name="xRG_Cap_{$xTourn->tourneyID}" value="{$xMember->userID}">
                                    <label for="xRB_M{$xMember->userID}">Make team captain</label>
                                {/if}
                                {if $xMember->ThisIsMe == 1 && $xMember->IsCaptain == 0}
                                    <a href="Javascript:RemoveMe('{$xMember->TTID}');"><img src="/images/Delete.png" border="0" title="Remove me from this Team" /></a>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </td>
    </tr>
    {if $xTourn->IAmTeamCaptain == 1 && $xTourn->locked == 0}
        <tr>
            <td colspan="2" align="center">
                {OutDisband  teamID=$xTourn->teamID}
                <input type="submit" value="Save" title="Save my changes" class="MyButton" />
            </td>
        </tr>
    {/if}
{else}
    <tr>
        <td class="DataLabel">Comments:</td>
        <td><textarea cols="50" rows="5">{$xTourn->comments}</textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {OutCancel}
            {OutFoundTeam tourneyID=$xTourn->tourneyID}
            {OutNewTeam tourneyID=$xTourn->tourneyID}
        </td>
    </tr>
{/if}