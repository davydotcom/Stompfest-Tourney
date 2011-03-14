<p><label for="subject">Title</label><br/>
            <input name="subject" type="text" size="75" value="{$announcement->subject|default:""}"/>
</p>

<p><label for="content">Content</label><br/>
            <textarea name="content" cols="40" rows="5">{$announcement->content|default:""}</textarea>
</p>

<p><label for="active">Active?</label>
    <input name="active" type="checkbox" value="{$announcement->active|default:"0"}"/>
</p>