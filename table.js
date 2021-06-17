var d = document;

d.getElementById('logout').addEventListener('click', logOutFunc);

window.onload = function(){
    getData();
    getImage();
    getActiveUsers();
}


function showUploadForm(){
    d.getElementById("uploadImageForm").style.display = "block";
    console.log("clicked");
}

d.getElementById("uploadImageForm").addEventListener('submit', e => {
    e.preventDefault();
    const myForm = d.getElementById("uploadImageForm");
    const inpFile = d.getElementById("inpFile");
    
    const endpoint = "uploadImage.php";
    const formData = new FormData();
    
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
    var recipient = d.getElementById("name-header").innerHTML;

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
}, 3000);

setInterval(function(){
    getMessages();
}, 1000);

function getMessages(){
    var xhr = new XMLHttpRequest();

    var recipient = d.getElementById("name-header").innerHTML;

    xhr.open("GET", "getMessages.php?recipient="+recipient, true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            d.getElementById("conversation").innerHTML = this.responseText;
        }
    }
    xhr.send();
}

function printUSN(usn){
    d.getElementById("chat").style.display = "block";
    d.getElementById("name-header").innerHTML = usn;
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


