{extends file="layouts/admin/application.tpl"}
{block name=title}Stompfest User: {$user->name}{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
<span class="right_floated"><a href="/admin/users/edit/{$user->userID}">edit</a> | <a href="/admin/users/destroy/{$user->userID}" data-confirm="Are you sure you want to remove this user?">remove</a></span>
<h2>User - {$user->handle}</h2>

<hr />

<p><label>Barcode: </label> {$user->barcode}</p>
<p><label>E-mail: </label> {$user->eMail}</p>

<p><label>Cell Carrier: </label> {$user->cellCarrier}</p>
<p><label>Cell Number: </label> {$user->cellNumber}</p>
<p><label>Administrator: </label> {if $user->is_super_admin == 1}Yes{else}No{/if}</p>



{/block}
