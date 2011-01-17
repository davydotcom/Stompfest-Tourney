{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Team Based{/block}
{block name=main_content}
    <script>
        function DoWhat()
            {
            var xWhat = $("#xDoWhat").val();
            var xTeam = $("#teamID");

            if ( xTeam == undefined )
                return;

            if ( xWhat == "T" )
                xTeam.style.visibility = "visible"
            else
                xTeam.style.visibility = "hidden"
            }
    </script>

    <div class="TourneyShow">
        <h3>{$Tourney->name}</h3>
        <hr />
        <form action="/tourney/team/DoIt" method="post">
            <input type="hidden" id="tourneyID" value="{$Tourney->tourneyID}" />
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
                <tr>
                    <td class="DataLabel">I want to:</td>
                    <td>
                        <select id="xDoWhat" name="xDoWhat" onchange="Javascript:DoWhat();">
                            {if $NumTeams != 0}
                                <option value="T">Join an existing Team</option>
                            {/if}
                                <option value="N">Create a new Team</option>
                                <option value="L">Freelance (looking for a Team)</option>
                        </select>
                        <br />
                        {if $NumTeams != 0}
                            <select id="teamID" name="teamID">
                                {foreach $Teams as $xTeam}
                                    <option value="{$xTeam.teamID}">{$xTeam.teamName}</option>
                                {/foreach}
                            </select>
                        {/if}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="MyButton" value="Go for It!" title="Go for it" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <table>
    </table>
{/block}