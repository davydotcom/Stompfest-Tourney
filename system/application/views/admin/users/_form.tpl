<p><label for="Handle">Handle</label><br/>
            <input name="handle" type="text" size="75" value="{$user->handle|default:""}"/>
</p>

<p><label for="barcode">Barcode</label><br/>
           <input name="barcode" type="text" size="75" value="{$user->barcode|default:""}"/>
</p>
<p><label for="cellCarrier">Cell Carrier</label><br/>
           <input name="cellCarrier" type="text" size="75" value="{$user->cellCarrier|default:""}"/>
</p>
<p><label for="cellNumber">Cell Number</label><br/>
           <input name="cellNumber" type="text" size="75" value="{$user->cellNumber|default:""}"/>
</p>
<p><label for="eMail">E-mail</label><br/>
           <input name="eMail" type="text" size="75" value="{$user->eMail|default:""}"/>
</p>
<p><label for="is_super_admin">Super Administrator?</label>
    <input name="is_super_admin" type="checkbox" value="{$user->is_super_admin|default:"0"}"/>
</p>