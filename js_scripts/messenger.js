function showOrHideMessenger() {
    var checkbox = document.getElementById('isMessengerActive');
    var messengerActivation = document.getElementById('messengerActivation');
    if(checkbox.checked) {
         messengerActivation.style.visibility = 'visible';
    }
    else {
         messengerActivation.style.visibility = 'hidden';
    }
}

function resetMessage() {
    document.getElementById('nickname').value = "";
    document.getElementById('message').value = "";
}

function isMessengerActive() {
    var messengerActivation = document.getElementById('messengerActivation');
    if (messengerActivation.style.visibility == 'visible') {
        return true;
    }
    else {
        return false;
    }
}

function sendMessage() {
    var message = document.getElementById('message').value;
    var nickname = document.getElementById('nickname').value;
    var blogName = document.getElementById('blogName').value;
    var xml = new XMLHttpRequest();
    // xml.open("POST", "messenger.php", true);
    // xml.setRequestHeader("Content-Type", "application/json");
    // xml.send(JSON.stringify(
    //     {
    //         "nickname" : nickname,
    //         "message" : message
    //     }
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
            displayMessages(this.responseText);
        scrollMessengerAreaToTheBottom();
    }
    xml.open("GET","/~kuzmmate/messenger.php?nickname="+nickname+"&message="+message+"&blogname="+blogName,true);
    xml.send();
}

var intervalID;

function turnOnAndOffMessenger() {
    if (document.getElementById('isMessengerActive').checked) {
        intervalID = setInterval(getMessages, 1000);
    }
    else {
        clearInterval(intervalID);
    }
}

function getMessages() {
    var blogName = document.getElementById('blogName').value;
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
            displayMessages(this.responseText);
        scrollMessengerAreaToTheBottom();
    }
    xml.open("GET","/~kuzmmate/messenger.php?nickname=&message=&blogname="+blogName,true);
    xml.send();
}

function displayMessages(response) {
    var messengerArea = document.getElementById('messengerArea');
    messengerArea.value = response;
}

function scrollMessengerAreaToTheBottom() {
    var textArea = document.getElementById('messengerArea');
    textArea.scrollTop = textArea.scrollHeight;
}