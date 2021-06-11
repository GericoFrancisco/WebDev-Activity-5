<?php session_start();
if(isset($_SESSION['users'])){
    $isLoggedIn = $_SESSION['users'];
    if($isLoggedIn == "Wrong")
        header("Location: index.php");
}else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        #modal{
            position: absolute;
            background-color: white;
            box-shadow: black 2px 2px 2px 2px;
            width: 40%;
            border-radius: 1em;
            height: max-content;
            display: none;
        }
        #title{
            text-align: center;
            font-weight: bolder;
        }
        hr{
            height: 1.5px;
            background-color: black;
            width: 95%;
        }
        label{
            font-weight: bolder;
        }
        p:not(#title){
            text-indent: 5px;
        }
        img{
            width: 42%;
            padding-left: 2%;
            padding-right: 8px;
        }
        img, #details{
            display: inline-block;
        }
        #details{
            vertical-align: top;
        }
        #user-panel{
            background-color: rgb(76, 235, 129);
            height: 200px;
            width: 400px;
        }
        #chat{
            background-color: white;
            height: 400px;
            width: 300px;
            display: none;
        }
        #name-header{
            background-color: black;
            color: white;
            width: 100%;
            height: 50px;
        }
        #close-chat-button{
            position: relative;
            top: 5px;
            right: 5px;
            color: white;
        }
    </style>
</head>
<body >
    <div id="header">
        <button id="logout" >Log Out</button>
    </div>
    <div id="modal"></div>
    <form id="bside">
        <div id="table"></div>
        <div id="user-panel">Active Users:</div>
        <div id="chat">
            <div id="name-header">
                <!-- <div id="close-chat-button">&times;</div> -->
            </div>
            <div id="conversation"></div>
            <div id="chat-input">
                <input type="text" name="chat-message" id="chat-message">
                <button id="send-message">Send</button>
            </div>
        </div>
        <script src="table.js"></script>
    </form>
</body>
</html>