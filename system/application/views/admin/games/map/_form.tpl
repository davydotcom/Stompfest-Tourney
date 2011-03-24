<p><label for="name">Name</label><br/>
            <input name="name" type="text" size="75" value="{$game_map->name|default:""}"/>
</p>

<p><label for="shortName">Short Name</label><br/>
            <input name="shortName" type="text" size="25" value="{$game_map->shortName|default:""}"/>
</p>

<p><label for="maxPlayers">Max Players</label><br/>
            <input name="maxPlayers" type="text" size="25" value="{$game_map->maxPlayers|default:""}"/>
</p>

<p><label for="official">Official?</label>
            <input name="official" type="checkbox" value="{$game_map->official|default:"0"}"/>


</p>
<p><label for="active">Active?</label>
            <input name="active" type="checkbox" value="{$game_map->active|default:"0"}"/>

            
</p>
