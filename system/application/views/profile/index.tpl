{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: {$UserData->handle}{/block}

{block name=main_content_right}
    {include file='profile/links.tpl' xPage='Main'}
{/block}

{block name=main_content}
    <h2>{$UserData->handle}</h2>
    <hr />
    <b>Some stuff here...  list of messages, tournament info, start times, etc</b>
{/block}
