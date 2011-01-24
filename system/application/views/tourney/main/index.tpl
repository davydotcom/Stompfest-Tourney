{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Tournament List{/block}

{block name=main_content}
    <script>
    $(function()
        {
		$("#xAccMain").accordion(
            {
			collapsible: true,
            active: false
            });
        });
    </script>

<div id="xAccMain">
    {foreach $Tourneys as $xTourney}
        <h3>
            <a href="#">{$xTourney->showName}</a>
            <div>{$xTourney->Status}</div>
        </h3>
        <div>
            <table>
                <tr>
                    <td class="DataLabel">Type:</td>
                    <td>{$xTourney->Type}</td>
                </tr>
                {if !empty($xTourney->Reggy)}
                    <tr>
                        <td class="DataLabel">Registration:</td>
                        <td>{$xTourney->Reggy}</td>
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
            </table>
        </div>
    {/foreach}
</div>

{/block}