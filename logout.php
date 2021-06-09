<?php
    session_start();
    if(isset($_SESSION["activeUsers"])){
        setOffline($_SESSION["activeUsers"]);
    }else{
        echo "nothing";
    }

    unset($_SESSION['users']);
    session_destroy();

    function setOffline($username){
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
                $newNode->appendChild($xml->createElement("status", "offline"));
    
                $xml->getElementsByTagName("users")[0]->replaceChild($newNode, $user);
                $xml->save("users.xml");
    
                break;
            }
        }
    }
?>