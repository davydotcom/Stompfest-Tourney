<p><label for="command">Command</label><br/>
            <input name="command" type="text" size="75" value="{$game_server_command->commnad|default:""}"/>
</p>
<p><label for="description">Description</label><br/>
            <textarea name="description" cols="40" rows="5">{$game_server_command->description|default:""}</textarea>
</p>


