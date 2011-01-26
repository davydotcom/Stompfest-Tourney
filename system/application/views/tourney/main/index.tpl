{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Tournament List{/block}

{block name=main_content}
    <script>
    $(function()
        {
        $("#xConCancel").dialog(
            {
			modal: true,
            width: 250,
            hide: "Fold",
            show: "Fold",
            autoOpen: false,
			resizable: false,
			buttons:
                {
				"Close": NeverMind,
				"Cancel my Registration": CancelReg
                }
			});

        $("#xAccMain").accordion(
            {
			collapsible: true,
            active: false
            });
        });

        function ConfirmCancel()
            {
            $("#xConCancel").dialog("open");
            }

        function CancelReg(iTourneyID)
            {
            window.location.href('/tourney/main/cancelReggy/' + iTourneyID);
            }

        function NeverMind()
            {
            $("#xConCancel").dialog("close");
            }
    </script>

<div id="xConCancel" title="Stompfest Tournament">
    <span class="ui-icon ui-icon-alert"></span>
    Are you sure you want to cancel your registration for this Tournament?
</div>

<div id="xAccMain">
    {foreach $Tourneys as $xTourney}
        <h3>
            <table width="100%">
                <tr>
                    <td><a href="#">{$xTourney->showName}</a></td>
                    <td align="right">{$xTourney->Status}</td>
                </tr>
            </table>
        </h3>
        <div>
            <table width="100%">
                <tr>
                    <td class="DataLabel">Type:</td>
                    <td>{$xTourney->Type}</td>
                </tr>
                {if !empty($xTourney->ReggyAt)}
                    <tr>
                        <td class="DataLabel">Registration:</td>
                        <td>{$xTourney->ReggyAt}</td>
                    </tr>
                {/if}
                {if !empty($xTourney->description)}
                    <tr>
                        <td class="DataLabel">Description:</td>
                        <td class="TourneyListDesc">{$xTourney->description}</td>
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
                {if $xTourney->Next == "O"}
                    <tr>
                        <td colspan="2" align="center">
                            {if $xTourney->Next == "O"}
                                <input type="button" class="MyButton" value="Cancel" onclick="javascript:ConfirmCancel('{$xTourney->tourneyID}');" title="Cancel my register for this Tournament" />
                            {/if}
                            {if $xTourney->Next == "L" || $xTourney->Next == "R"}
                                <input type="button" class="MyButton" value="Register" onclick="location.href='/tourney/main/register/{$xTourney->tourneyID}'" title="Register for this Tournament" /></td>
                            {/if}
                        </td>
                    </tr>
                {/if}
            </table>
        </div>
    {/foreach}
</div>

{/block}