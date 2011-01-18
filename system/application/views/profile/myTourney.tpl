{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Tournaments{/block}

{block name=main_content_right}
<ul>
    <li><a href="/profile/edit">Edit Profile</a></li>
    {if !empty($UserData.IAmCaptain)}
        <li><a href="/profile/myTeams">My Teams</a></li>
    {/if}

    <li><b>My Tournaments</b></li>
</ul>
{/block}

{block name=main_content}

{/block}