<?php

class StarterController {

   public function __construct(){
      session_start();
   }    

   public function logoutSession(){
      session_destroy();
   }
}
