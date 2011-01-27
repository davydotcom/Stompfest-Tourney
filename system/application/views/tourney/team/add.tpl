{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Add Team{/block}
{block name=main_content}
    <h3>Add a Team - {$Tourney->name}</h3>
    <hr />
    <form action="/tourney/team/saveNew" method="post" enctype="multipart/form-data">
        <input type="hidden" id="tourneyID" name="tourneyID" value="{$Tourney->tourneyID}" />
        <table>
            <tr>
                <td class="DataLabel">Team Name:</td>
                <td><input type="text" id="teamName" name="teamName" maxlength="50" size="50" /></td>
            </tr>
            <tr>
                <td class="DataLabel">Team Website:</td>
                <td><input type="text" id="teamURL" name="teamURL" maxlength="125" size="50" /></td>
            </tr>
            <tr>
                <td class="DataLabel">Team Icon:</td>
                <td><input type="file" id="teamIcon" name="teamIcon" maxlength="50" size="40" class="MyButton" /></td>
            </tr>
            <tr><td colspan="2"><hr /></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" value="Save" class="MyButton" title="Save this Team" /></td></tr>
        </table>
    </form>
{/block}