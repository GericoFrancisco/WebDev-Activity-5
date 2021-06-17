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
            width: 38.1%;
            height: max-content;
            background-color: white;
            box-shadow: black 2px 2px 2px 2px;
            border-radius: 1em;
            z-index: 1;
            display: none;
        }
        #title{
            text-align: center;
            font-weight: bolder;
        }
        hr{
            height: 1px;
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
            width: 40%;
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
            position: fixed;
            background-color: white;
            height: 100%;
            width: 15%;
            right: 0;
            top: 8%;
        }
        .user-img, .active-users{
            display: inline-block;
            vertical-align: middle;
        }
        .user-img{
            width: 10%;
        }
        #chat{
            position: fixed;
            background-color: white;
            right: 17%;
            bottom: 0;
            height: 450px;
            width: 300px;
            border-radius: 7px;
            display: none;
        }
        #name-header{
            background-color: black;
            color: white;
            width: 100%;
            height: 40px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
        }
        #close-chat-button{
            position: relative;
            top: 5px;
            right: 5px;
            color: white;
        }
        .active-users:hover{
            cursor: pointer;
        }
        #chat-input{
            padding-top: 3.5%;
            padding-left: 4%;
        }
        .sender{
            height: max-content;
            width: 45%;
            margin-left: auto;
            margin-right: 4%;
            margin-bottom: 5%;
            background-color: purple;
            border-top-right-radius: 7px;
            border-top-left-radius: 7px;
            border-bottom-left-radius: 7px;
            padding: 2%;
            color: white;
            font-size: 14px;
        }
        .dateTime{
            font-size: 10px;
        }
        .receiver{
            height: max-content;
            width: 45%;
            margin-left: 4%;
            margin-right: auto;
            margin-bottom: 5%;
            background-color: white;
            border-top-right-radius: 7px;
            border-top-left-radius: 7px;
            border-bottom-right-radius: 7px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 2%;
            font-size: 14px;
        }
        #conversation{
            max-height: 340px;
            height: 100%;
            box-shadow:inset 0px -4px 4px -3px rgba(0, 0, 0, 0.2);
            overflow: auto;
            padding-top: 7%;
        }
        #chat-message{
            padding: 2%;
            border-radius: 2px;
            border: 1px solid #d3d3d3;
            width: 75%;
        }
        #send-message{
            background-image: url('https://cdn2.iconfinder.com/data/icons/font-awesome/1792/send-o-512.png');
            background-size: 55%;
            background-repeat: no-repeat;
            background-position: center;
            width: 10%;
            padding: 5% 6%;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            vertical-align: top;
            border: none;
            background-color: gray;
        }
        #send-message:hover{
            background-color: black;
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
        <div id="user-panel"></div>
        <div id="chat">
            <div id="name-header">
                <!-- <div id="close-chat-button">&times;</div> -->
            </div>
            <div id="conversation"></div>
            <div id="chat-input">
                <input type="text" name="chat-message" id="chat-message" placeholder="Type a message here...">
                <button id="send-message"></button>
            </div>
        </div>
        <script src="table.js"></script>
    </form>
</body>
</html>