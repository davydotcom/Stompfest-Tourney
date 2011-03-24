{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Team Based{/block}

{block name=main_content}
    <script>
        $(function()
            {
            $("#xTR_Comm").hide();
            });

        function DoWhat()
            {
            var xWhat = $("#xDoWhat").val();
            var xTeam = $("#teamID");
            var xComm = $("#xTR_Comm");

            if ( xTeam == undefined )
                return;

            if ( xWhat == "T" )
                xTeam.show();
            else
                xTeam.hide();

            if ( xWhat == "L" )
                xComm.show();
            else
                xComm.hide();
            }
    </script>

    <h3>{$Tourney->showName}</h3>
    <hr />

    <div class="TourneyRegShow">
        {if !empty($Tourney->photo_file_name)}
            <div class="TourneyRegPic">
                <img src="/images/Tourney/{$Tourney->photo_file_name}" />
            </div>
        {/if}

        <div class="TourneyRegData">
            <form action="/tourney/team/DoIt" method="post">
                <input type="hidden" id="tourneyID" name="tourneyID" value="{$Tourney->tourneyID}" />
                <table width="100%">
                    {if !empty($Tourney->description)}
                        <tr>
                            <td class="DataLabel">Description:</td>
                            <td><span class="TourneyListDesc">{$Tourney->description}</span></td>
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
                    {if $Options == 0}
                        <input type="hidden" id="xDoWhat" name="xDoWhat" value="T" />
                    {else}
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
                            </td>
                        </tr>
                    {/if}
                    {if $NumTeams != 0}
                        <tr id="xTR_Teams">
                            <td class="DataLabel">{if $Options == 0}Teams:{else}&nbsp;{/if}</td>
                            <td>
                                <select id="teamID" name="teamID">
                                    {foreach $Teams as $xTeam}
                                        <option value="{$xTeam->teamID}">{$xTeam->teamName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    {/if}
                    <tr id="xTR_Comm">
                        <td class="DataLabel">Comment:</td>
                        <td><textarea id="comments" name="comments" cols="50" rows="5"></textarea></td>
                    </tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" class="MyButton" value="Go for It!" title="Go for it" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
{/block}