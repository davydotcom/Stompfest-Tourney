{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Team Based{/block}
{block name=main_content}
    <div class="TourneyShow">
        <h3>{$Tourney->name}</h3>
        <hr />
        <table>
            <tr>
                <td class="DataLabel">Description:</td>
                <td><textarea rows="4" cols="50" readonly="readonly">{$Tourney->description}</textarea></td>
            </tr>
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
        </table>
    </div>
    
    <table>
    </table>
{/block}