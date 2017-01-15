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