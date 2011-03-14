{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Tournament | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Tournament</h2>
    <hr />

    <form class="sf_form" action="/admin/tourneys/update/{$tourney->tourneyID}" method="post">
        {include file="admin/tourneys/_form.tpl" games=$games tourney=$tourney}

        <input type="submit" value="Save Tournament."/> or <a href="/admin/tourneys/show/{$tourney->tourneyID}">cancel</a>
    </form>


{/block}
