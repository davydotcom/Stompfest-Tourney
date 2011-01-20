{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: {$UserData.handle}{/block}
{block name=main_content_right}
<ul>
    <li><a href="/profile/main/edit">Edit Profile</a></li>
    {if !empty($UserData.IAmCaptain)}
        <li><a href="/profile/myTeams">My Teams</a></li>
    {/if}
    <li><a href="/profile/myTourney">My Tournaments</a></li>
</ul>
{/block}
{block name=main_content}
    <h2>{$UserData.handle}</h2>
    <hr />
    <b>Some stuff here...  list of messages, tournament info, start times, etc</b>
{/block}
