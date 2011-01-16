{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Team Based{/block}
{block name=main_content}
    <div class="TourneyShow">
        <h3>{$Tourney->name}</h3>
        <hr />
        <table>
            {if !empty($Tourney->photo_file_name)}
                <tr><td colspan="2"><img src="{$Tourney->photo_file_name}" /></td></tr>
            {/if}
            {if !empty($Tourney->description)}
                <tr>
                    <td class="DataLabel">Description:</td>
                    <td><textarea rows="4" cols="50" readonly="readonly">{$Tourney->description}</textarea></td>
                </tr>
            {/if}
            {if !empty($Tourney->genre)}
                <tr>
                    <td class="DataLabel">Genre:</td>
                    <td>{$Tourney->genre}</td>
                </tr>
            {/if}
            <tr>
                <td class="DataLabel">Current # of Team:</td>
                <td>{$NumTeams}</td>
            </tr>
            <tr><td colspan="2"><hr /></td></tr>
            {if $NumTeams != 0}
                <tr>
                    <td class="DataLabel">Team:</td>
                    <td>
                        <select id="xCB_Team" name="xCB_Team">
                            {foreach $Teams as $xTeam}
                                <option value="{$xTeam.teamID}">{$xTeam.teamName}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
            {/if}
            <tr>
                <td colspan="2">
                    <input type="button" class="MyButton" onclick="location.href='/tourney/team/add/{$Tourney->tourneyID}'" value="New Team" title="Create a new Team for this tournament" />
                </td>
            </tr>
        </table>
    </div>
    
    <table>
    </table>
{/block}