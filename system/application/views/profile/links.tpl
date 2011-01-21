<ul id="contextual_actions">
    <li>{if $xPage == "Edit"}<a href="" class="active">{else}<a href="/profile/main/edit">{/if}Edit Profile</a></li>
    {if !empty($UserData.IAmCaptain)}
        <li>{if $xPage == "Team"}<a href="" class="active">{else}<a href="/profile/myTeams">{/if}My Teams</a></li>
    {/if}
    <li>{if $xPage == "Tourney"}<a href="" class="active">{else}<a href="/profile/myTourney">{/if}My Tournaments</a></li>
</ul>
