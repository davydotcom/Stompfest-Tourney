{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: {$UserData->handle}{/block}

{block name=main_content_right}
    {include file='profile/links.tpl' xPage='Main'}
{/block}

{block name=main_content}
    <script>
        function DeleteNews(iNewsID)
            {
            $.ajax(
                {
                url: "/profile/main/DeleteNews/" + iNewsID,
                type: "POST",
                success: function(iData){ DoneDidDelete(iData); }
                });
            }

        function DoneDidDelete(iData)
            {
            $("#xTR_New" + iData).remove();
            }
    </script>

    <h2>{$UserData->handle}</h2>
    <hr />
    <table width="100%" class="NewsList" cellpadding="0" cellspacing="0">
        {foreach $UserData->News as $xNews}
            <tr id="xTR_New{$xNews->newsID}">
                <td><span class="NewsListAt">{$xNews->sentAt}:</span> {$xNews->message}</td>
                <td width="18"><img src="/images/Delete.png" title="Delete" onclick="Javascript:DeleteNews('{$xNews->newsID}')" class="ImageLink" /></td>
            </tr>
        {/foreach}
    </table>
{/block}
