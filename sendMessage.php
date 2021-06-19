<?php
session_start();
date_default_timezone_set("Asia/Manila");
$msg = $_GET["message"];
$recipient = $_GET["recipient"];
$receiver = $_SESSION['receiver'];

$sender = $_SESSION['activeUsers'];

$xml = new DOMDocument();
$xml->load("messages.xml");

$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;

$dateTime = date("Y/m/d h:i:sa");

$message = $xml->createElement("message");
$messageTxt = $xml->createElement("messageTxt", $msg);
$messageDateTime = $xml->createElement("dateTime", $dateTime);

$message->setAttribute("sender", $sender);
$message->setAttribute("receiver", $receiver);
$message->appendChild($messageTxt);
$message->appendChild($messageDateTime);

$xml->getElementsByTagName("messages")[0]->appendChild($message);
$xml->save("messages.xml");


