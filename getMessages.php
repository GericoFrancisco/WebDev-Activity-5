<?php
session_start();
$recipient = $_GET["recipient"];
$sender = $_SESSION['activeUsers'];

$xml = new DOMDocument();
$xml->load("messages.xml");

$messages = $xml->getElementsByTagName("message");

$html = "";
foreach($messages as $message){
    $msgSender = $message->getAttribute("sender");
    $msgReceiver = $message->getAttribute("receiver");
    // if(($sender == $msgSender || $sender == $msgReceiver) && 
    // ($recipient == $msgSender || $recipient == $msgReceiver)){
    //     $msgText = $message->getElementsByTagName("messageTxt")[0]->nodeValue;
    //     $msgDateTime = $message->getElementsByTagName("dateTime")[0]->nodeValue;
    //     $html .= $msgText . "<br>" . $msgDateTime. "<br><br>";
    // }
    if( $sender == $msgReceiver && $recipient == $msgSender ){
        $msgText = $message->getElementsByTagName("messageTxt")[0]->nodeValue;
        $msgDateTime = $message->getElementsByTagName("dateTime")[0]->nodeValue;
        $html .= "<br><div class='receiver'>" . $msgText . "<br><br><div class='dateTime'>" . $msgDateTime. "</div></div>";
    }
    if($sender == $msgSender  && $recipient == $msgReceiver){
        $msgText = $message->getElementsByTagName("messageTxt")[0]->nodeValue;
        $msgDateTime = $message->getElementsByTagName("dateTime")[0]->nodeValue;
        $html .= "<div class='sender'>".$msgText . "<br><br><div class='dateTime'>" . $msgDateTime. "</div></div>";
    }
}
echo $html;