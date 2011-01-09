<?php
require_once(APPPATH . "/models/sfmodel.php");

class Game extends SFModel
{

   function __construct()
   {
       parent::__construct();
       $this->primaryKeyName = 'gameID';
   }



}
