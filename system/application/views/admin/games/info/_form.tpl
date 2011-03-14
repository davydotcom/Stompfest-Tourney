<p><label for="name">Name</label><br/>
            <input name="name" type="text" size="75" value="{$game_gamer_info->name|default:""}"/>
</p>

<p><label for="defaultValue">Default Value</label><br/>
            <input name="defaultValue" type="text" size="25" value="{$game_gamer_info->defaultValue|default:""}"/>
</p>
<p><label for="required">Required?</label>
            <input name="required" type="checkbox" value="{$game_gamer_info->required|default:"0"}"/>


</p>
<p><label for="globalField">Global Field?</label>
            <input name="globalField" type="checkbox" value="{$game_gamer_info->globalField|default:"0"}"/>

            
</p>
