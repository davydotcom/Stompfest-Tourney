{if $xTourn->lookingForTeam == 0}
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
        <tr><td colspan="2"><hr /></td></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Save above Changes" title="Save my changes" class="MyButton" />

                {OutDisband tourneyID=$xTourn->tourneyID}

                {if $xTourn->ShowLooking}
                    <input type="button" value="Pickup Player(s)" title="Pick up Gamers who are looking for a team" class="MyButton" onclick="Javascript:PickupPlayers('{$xTourn->tourneyID}');" />
                {/if}
            </td>
        </tr>
    {/if}
{else}
    {if !empty($xTourn->Invites)}
        <tr>
            <td class="DataLabel">Team Invites:</td>
            <td>
                <tr>
                    <table width="100%" class="DG" border="1">
                        <thead>
                            <th>Team</th>
                            <th>Captain</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                        {foreach $xTourn->Invites as $xI_Invite}
                            <tr id="xTR_Invite{$xI_Invite->inviteID}">
                                {if empty($xI_Invite->teamURL)}
                                    <td>{$xI_Invite->teamName}</td>
                                {else}
                                    <td><a href="{$xI_Invite->teamURL}" target="_blank">{$xI_Invite->teamName}</a></td>
                                {/if}
                                <td>{$xI_Invite->handle}</td>
                                <td>
                                    <a href="Javascript:InviteAccept('{$xI_Invite->tourneyID}', '{$xI_Invite->teamID}');">Accept</a>
                                    <a href="Javascript:InviteDecline('{$xI_Invite->tourneyID}', '{$xI_Invite->teamID}');">Decline</a>
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </tr>
            </td>
        </tr>
    {/if}
    <tr>
        <td colspan="2">You are looking for a team.  Here you can leave a message for Team captains who might want you to join their team.</td>
    </tr>
    <tr>
        <td class="DataLabel">Comments:</td>
        <td><textarea id="xIN_Comm_{$xTourn->tourneyID}" name="xIN_Comm_{$xTourn->tourneyID}" cols="60" rows="6">{$xTourn->comments}</textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><input type="button" value="Save" title="Save my changes" class="MyButton" onclick="Javascript:SaveLooking('{$xTourn->tourneyID}');" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2" align="center">
            {OutCancel tourneyID=$xTourn->tourneyID}
            {OutFoundTeam tourneyID=$xTourn->tourneyID}
            {OutNewTeam tourneyID=$xTourn->tourneyID}
        </td>
    </tr>
{/if}