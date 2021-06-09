<?php
$xml = $xml = new DOMDocument();
$xml->load("users.xml");

$userList = $xml->getElementsByTagName("user");

$activeUsers = "";
foreach($userList as $user){
    $status = $user->getElementsByTagName("status")[0]->nodeValue;

    if($status == "online"){
        $activeUsers .= $user->getAttribute("username") . "</br>";
    }
}
echo $activeUsers;
