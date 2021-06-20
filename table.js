var d = document;

var chatOpen = false;

d.getElementById('logout').addEventListener('click', logOutFunc);


window.onload = function(){
    getData();
    getImage();
    getActiveUsers();
}


function showUploadForm(){
    d.getElementById("uploadImageForm").style.display = "block";
}

d.getElementById("uploadImageForm").addEventListener('submit', e => {
    e.preventDefault();
    const myForm = d.getElementById("uploadImageForm");
    const inpFile = d.getElementById("inpFile");
    
    const endpoint = "uploadImage.php";
    const formData = new FormData();
    
    var filePath = inpFile.value;
    
    // Allowing file type
    // var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    //idk why but some gifs causes GET error
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        inpFile.value = '';
        return false;
    } else{
        formData.append("inpFile", inpFile.files[0]);
        
        fetch(endpoint, {
            method: "POST",
            body: formData,
        }).catch(console.error);
        
        // console.log(inpFile.files[0].name);
        var xhr = new XMLHttpRequest();
        
        xhr.open("GET", "changeImage.php?fileName="+inpFile.files[0].name, true);
        
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                // console.log(this.responseText);
                d.getElementById("user-profilePic").src = this.responseText;
                d.getElementById("uploadImageForm").style.display = "none";
            }
        }
        xhr.send();
    }
    
});

function getImage(){
    var xhr = new XMLHttpRequest();
    
    xhr.open("GET", "getImage.php", true);
    
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("user-image-panel").innerHTML = this.responseText;
        }
    }
    xhr.send();
}


d.getElementById("send-message").addEventListener('click', sendMessage);

function sendMessage(e){
    e.preventDefault();
    // d.getElementById("conversation").innerHTML = d.getElementById("chat-message").value;
    var xhr = new XMLHttpRequest();
    
    var message = d.getElementById("chat-message").value;
    var recipient = d.getElementById("usn-holder").innerHTML;
    
    xhr.open("GET", "sendMessage.php?message="+message+"&recipient="+recipient, true);
    
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("chat-message").value = null;
            // console.log(this.responseText);
        }
    }
    xhr.send();
}

setInterval(function(){
    getActiveUsers();
}, 1000);

setInterval(function() {
    var elem = document.getElementById('conversation');
    elem.scrollTop = elem.scrollHeight;
}, 500);

setInterval(function(){
    if(chatOpen) getMessages();
}, 1000);

function getMessages(){
    var xhr = new XMLHttpRequest();
    var recipient = d.getElementById("usn-holder").innerHTML;
    
    xhr.open("GET", "getMessages.php?recipient="+recipient, true);
    
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("conversation").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function printUSN(usn){
    chatOpen = true;
    d.getElementById("chat").style.display = "block";

    var xhr = new XMLHttpRequest();

    xhr.open("GET", "setReceiver.php?recipient="+usn, true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log("I get id "+this.responseText);
            d.getElementById("name-container").innerHTML = "<span id='usn-holder'>"+this.responseText+"</span><span id='closeBtn' onclick='closeChat();'>x</span>";;
        }
    }
    xhr.send();

}

function closeForm(){
    d.getElementById("uploadImageForm").style.display = "none";
}

function closeChat(){
    chatOpen = false;
    d.getElementById("chat").style.display = "none";
}

function getActiveUsers(){
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "getActiveUsers.php", true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("user-panel").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function getData(){                                             //loads table at the start
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "getData.php", true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("table").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function hover(songCode){
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "onHover.php?songCode="+songCode, true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("modal").style.display = "block";      //shows the modal when hovering a tr
            d.getElementById("modal").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function hoverStop(){
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "#", true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("modal").style.display = "none";   //hides the modal when not hovering a tr
            d.getElementById("modal").innerHTML = "";
        }
    }
    xhr.send();
}

let modal = d.getElementById("modal");

const onMouseMove = (e) =>{
    var x = e.pageX + 10;        //inusad lang para nakaharang sa cursor
    var y = e.pageY - 120;        //pag walaito di gagana yung hover
    modal.style.left = x + "px";
    modal.style.top = y + "px";
}
d.addEventListener("mousemove", onMouseMove);

function logOutFunc(){

    var xhr = new XMLHttpRequest();

    xhr.open("GET", "logout.php", true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            location.replace('index.php');
        }
    }
    xhr.send();
}


