<?php

session_start(); //start the session

if(isset($_SESSION["ad"])) { //take the session

    $_SESSION["ad"] = null;
    session_destroy(); //destroy the session

    echo ("success");
}

?>