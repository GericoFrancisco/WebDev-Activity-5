<?php
session_start();
$usn = $_GET['recipient'];

$_SESSION['receiver'] = $usn;

$xml = new DOMdocument();
$xml->load("users.xml");

$users = $xml->getElementsByTagName("user");

$name = "";

foreach($users as $user){
    $username = $user->getAttribute("username");
    if($username == $usn){
        $name .= $user->getElementsByTagName("firstName")[0]->nodeValue. " " . $user->getElementsByTagName("lastName")[0]->nodeValue;
    }
}
echo $name;