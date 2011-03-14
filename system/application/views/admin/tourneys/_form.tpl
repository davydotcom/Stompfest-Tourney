<p><label for="name">Name</label><br/>
            <input name="name" type="text" size="50" value="{$tourney->name|default:""}"/>
</p>
<p><label for="gameID">Game</label><br/>
    <select name="gameID">
        {foreach $games as $game}
            <option value="{$game->gameID}" {if isset($tourney) && $tourney->gameID == $game->gameID}selected=true{/if}>{$game->name}</option>
        {/foreach}
    </select>
</p>
<p><label for="tourneyType">Tournament Type</label><br/>
    <select name="tourneyType">
        <option value="0" {if isset($tourney) && $tourney->tourneyType == 0}selected=true{/if}>Free for All</option>
        <option value="1" {if isset($tourney) && $tourney->tourneyType == 1}selected=true{/if}>Team Based</option>
        <option value="2" {if isset($tourney) && $tourney->tourneyType == 2}selected=true{/if}>1 vs. 1</option>
    </select>
</p>
<p><label for="description">Description</label><br/>
            <textarea name="description" cols="40" rows="5">{$tourney->description|default:""}</textarea>
</p>

<p><label for="minTeams">Minimum Number of Teams</label><br/>
            <input name="minTeams" type="text" size="5" value="{$tourney->minTeams|default:"0"}"/>
</p>

<p><label for="maxTeams">Maximum Number of Teams</label><br/>
            <input name="maxTeams" type="text" size="5" value="{$tourney->maxTeams|default:"0"}"/>
</p>
<p><label for="playersPerTeam">Players Per team</label><br/>
            <input name="playersPerTeam" type="text" size="5" value="{$tourney->playersPerTeam|default:"0"}"/>
</p>
<p><label for="allowMapVote">Allow Map Vote?</label>
    <input name="allowMapVote" type="checkbox" value="{$tourney->allowMapVote|default:"0"}"/>
</p>
<p><label for="allowInternetMatches">Allow Internet Matches?</label>
    <input name="allowInternetMatches" type="checkbox" value="{$tourney->allowInternetMatches|default:"0"}"/>
</p>
<p><label for="autoSpawnServers">Auto Spawn Servers?</label>
    <input name="autoSpawnServers" type="checkbox" value="{$tourney->autoSpawnServers|default:"0"}"/>
</p>
<p><label for="matchInstructions">Match Instructions</label><br/>
            <textarea name="matchInstructions" cols="40" rows="5">{$tourney->matchInstructions|default:""}</textarea>
</p>

<p><label for="registrationOpensAt">Registration Opens At</label><br/>
            <input name="registrationOpensAt" type="text" widget='calendar' size="25" value="{$tourney->registrationOpensAt|default:""}"/>
</p>

<p><label for="registrationClosesAt">Registration Closes At</label><br/>
            <input name="registrationClosesAt" type="text" widget='calendar' size="25" value="{$tourney->registrationClosesAt|default:""}"/>
</p>

<p><label for="beginsAt">Begins At</label><br/>
            <input name="beginsAt" type="text" widget='calendar' size="25" value="{$tourney->beginsAt|default:""}"/>
</p>
<p><label for="endsAt">Ends At</label><br/>
            <input name="endsAt" type="text" widget='calendar' size="25" value="{$tourney->endsAt|default:""}"/>
</p>