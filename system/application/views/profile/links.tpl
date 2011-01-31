<ul id="contextual_actions">
    <li><a href="/profile/main/edit" {if $xPage == "Edit"}class="active"{/if}>Edit Profile</a></li>
    {if !empty($UserData->IAmCaptain)}
        <li><a href="/profile/myTeams" {if $xPage == "Team"}class="active"{/if}>My Teams</a></li>
    {/if}
    <li><a href="/profile/myTourney" {if $xPage == "Tourney"}class="active"{/if}>My Tournaments</a></li>
</ul>
