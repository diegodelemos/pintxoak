<?php
include_once "../core/Session.php";

if(isset($_POST["userName"]) && isset($_POST["password"])){
    try {
        $session = new Session();
        $session->login($_POST["userName"], $_POST["password"]);
        print_r($session->getData());
        echo "login correct";
    } catch (Exception $e) {
        echo $e->getMessage();
    }

} else {
    echo "Failed to auth";
}
