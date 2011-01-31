{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Add Team{/block}

{block name=main_content}
<script>
    $(function()
        {
        $("#xTR_Error").hide();
        $("teamName").tipsy();
        });

    function ValidateData()
        {
        var xTeam = $("#teamName");

        if ( IsEmpty(xTeam.val()) )
            {
            ErrorShow(xTeam, "Team Name is required");

            xTeam.focus();
            return;
            }

        $.ajax(
            {
            url: "/tourney/team/ValidateTeam/",
            type: "POST",
            data: "teamName=" + xTeam.val() + "&tourneyID=" + $("#tourneyID").val(),
            success: function(iData){ ValidReturn(iData); }
            });
        }

    function ValidReturn(iData)
        {
        if ( iData == "GOOD" )
            {
            $("#xF_Main").submit();
            return;
            }

        ErrorShow($("#xTeam"), iData);
        }
</script>

    <h3>Add a Team - {$Tourney->showName}</h3>
    <hr />
    <form id="xF_Main" name="xF_Main" action="/tourney/team/saveNew" method="post" enctype="multipart/form-data">
        <input type="hidden" id="tourneyID" name="tourneyID" value="{$Tourney->tourneyID}" />
        <table>
            <tr>
                <td class="DataLabel">Team Name:</td>
                <td><input type="text" id="teamName" name="teamName" maxlength="50" size="50" title="Team Name" /></td>
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
            <tr id="xTR_Error">
                <td colspan="2" class="TBErrorText"></td>
            </tr>
            <tr><td colspan="2" align="center"><input type="button" value="Save" class="MyButton" title="Save this Team" onclick="Javascript:ValidateData();" /></td></tr>
        </table>
    </form>
{/block}