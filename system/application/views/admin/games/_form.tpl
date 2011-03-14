<p><label for="name">Name</label><br/>
            <input name="name" type="text" size="75" value="{$game->name|default:""}"/>
</p>

<p><label for="short_name">Short Name</label><br/>
            <input name="short_name" type="text" size="25" value="{$game->short_name|default:""}"/>
</p>

<p><label for="genre">Genre</label><br/>
            <input name="genre" type="text" size="75" value="{$game->genre|default:""}"/>
</p>

<p><label for="description">Description</label><br/>
            <textarea name="description" cols="40" rows="5">{$game->description|default:""}</textarea>
</p>

<p><label for="active">Active?</label>
    <input name="active" type="checkbox" value="{$game->active|default:"0"}"/>
</p>