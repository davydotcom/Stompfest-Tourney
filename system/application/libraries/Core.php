<?php

class Core
    {
    public static function GetBool($iWhat)
        {
        if ( empty($iWhat) )
            return false;

        if ( is_bool($iWhat) )
            return (bool)$iWhat;

        if ( $iWhat == 1 || strtolower($iWhat) == "true" )
            return true;

        return false;
        }
    }
