<?php
session_start();
$activeUser = $_SESSION['activeUsers'];

$xml = new DOMdocument();
$xml->load("users.xml");

$users = $xml->getElementsByTagName("user");

$html = "";

foreach($users as $user){
    $usn = $user->getAttribute("username");
    if($usn == $activeUser){
        $name = $user->getElementsByTagName("firstName")[0]->nodeValue. " " . $user->getElementsByTagName("lastName")[0]->nodeValue;
        $img = $user->getElementsByTagName("profilePic")[0]->nodeValue;
        $html .= "<img src='$img' id='user-profilePic' >".$name;
    }
}
echo $html;