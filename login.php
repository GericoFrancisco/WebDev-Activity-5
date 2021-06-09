<?php
session_start();
$username = "";
$password = "";
if(isset($_GET['username']))
    $username = $_GET['username'];
if(isset($_GET['password']))
    $password = $_GET['password'];

$xml = $xml = new DOMDocument();
$xml->load("users.xml");

$userList = $xml->getElementsByTagName("user");

// $response = "Missing";

$_SESSION["users"] = "Wrong";
foreach($userList as $user){
    $usn = $user->getAttribute("username");
    $pw = $user->getElementsByTagName("password")[0]->nodeValue;
    if(($username == $usn && $password == $pw) && (strlen($password) == strlen($pw))){
        $response = "Correct";
        $_SESSION["users"] = "Correct";
        $_SESSION["activeUsers"] = $usn;
        setOnline($usn);
        break;
    }
    else if($username == "" || $password == ""){
        $response = "Missing";
    }
    else if($username != $usn || $password != $pw){
        $response = "Wrong";
    }
}

function setOnline($username){
    $xml = $xml = new DOMDocument();
    $xml->load("users.xml");

    $userList = $xml->getElementsByTagName("user");
    foreach($userList as $user){
        if($username == $user->getAttribute("username")){
            $oldPW = $user->getElementsByTagName("password")[0]->nodeValue;
            $oldFN = $user->getElementsByTagName("firstName")[0]->nodeValue;
            $oldLN = $user->getElementsByTagName("lastName")[0]->nodeValue;
            $oldPic = $user->getElementsByTagName("profilePic")[0]->nodeValue;

            $newNode = $xml->createElement("user");
            $newNode->setAttribute("username", $username);
            $newNode->appendChild($xml->createElement("password", $oldPW));
            $newNode->appendChild($xml->createElement("firstName", $oldFN));
            $newNode->appendChild($xml->createElement("lastName", $oldLN));
            $newNode->appendChild($xml->createElement("profilePic", $oldPic));
            $newNode->appendChild($xml->createElement("status", "online"));

            $xml->getElementsByTagName("users")[0]->replaceChild($newNode, $user);
            $xml->save("users.xml");

            break;
        }
    }
}


echo $response;

