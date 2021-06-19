<?php
session_start();
$xml = new DOMDocument();
$xml->load("users.xml");

$activeUser = $_SESSION['activeUsers'];
$fileName = $_GET['fileName'];


$users = $xml->getElementsByTagName('user');

foreach($users as $user){
    $usn = $user->getAttribute('username');
    if($usn == $activeUser){
        $oldPW = $user->getElementsByTagName("password")[0]->nodeValue;
        $oldFN = $user->getElementsByTagName("firstName")[0]->nodeValue;
        $oldLN = $user->getElementsByTagName("lastName")[0]->nodeValue;
        $oldStatus = $user->getElementsByTagName("status")[0]->nodeValue;

        $newNode = $xml->createElement("user");
        $newNode->setAttribute("username", $usn);
        $newNode->appendChild($xml->createElement("password", $oldPW));
        $newNode->appendChild($xml->createElement("firstName", $oldFN));
        $newNode->appendChild($xml->createElement("lastName", $oldLN));
        $newNode->appendChild($xml->createElement("profilePic", "images/".$fileName));
        $newNode->appendChild($xml->createElement("status", $oldStatus));

        $xml->getElementsByTagName("users")[0]->replaceChild($newNode, $user);
        $xml->save("users.xml");
        echo "images\/".$fileName;
        // changeImagePath($user);
        break;
    }
}

// function changeImagePath($user){
//     $fileName = $_GET['fileName'];
//     $xml = $xml = new DOMDocument();
//     $xml->load("users.xml");

    
// }
