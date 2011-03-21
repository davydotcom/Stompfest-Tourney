<?php

class Core
    {
    public static function GetBool($iWhat)
        {
        if ( is_null($iWhat) )
            return false;

        if ( is_numeric($iWhat) && $iWhat == 1 )
            return true;

        if ( strtolower($iWhat) == "true" )
            return true;

        if ( is_bool($iWhat) && $iWhat === true )
            return true;

        return false;
        }
    }
