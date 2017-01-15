window.onload = function() {
    generateStyleComboboxInMenu();

    setStyleFromCookieIfExist();

    var selectElement = document.getElementById("styleChanger");

    selectElement.onchange = function() {
        var title = selectElement.options[selectElement.selectedIndex].value;
        createStyleCookie(title);
        setActiveStyleSheet(title);
    }


    if (document.getElementsByTagName("head")[0].getAttribute("data_validation") == "true")
        initializeDateValidation();
}

function setStyleFromCookieIfExist() {
    setActiveStyleSheet(getStyleCookie());
}

function generateStyleComboboxInMenu() {

    var styleTags = document.getElementsByTagName('link');
    var selectElement = document.getElementById("styleChanger");

    if (styleTags.length > 1)
        selectElement.style.visibility = 'visible';

    for (var i=0; i< styleTags.length; i++) {
        var option = document.createElement("option");
        option.value = styleTags[i].title;
        if (option.value == getStyleCookie())
            option.selected = "selected";
        option.innerHTML = styleTags[i].title;
        selectElement.appendChild(option);
    }
}

function setActiveStyleSheet(title) {
    var i, a;
    for(i=0; i < document.getElementsByTagName("link").length; i++) {
        a = document.getElementsByTagName("link")[i];
        if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
            a.disabled = true;
            if(a.getAttribute("title") == title) a.disabled = false;
        }
    }
}

function createStyleCookie(title) {
    setCookie("activeStyle", title);
}

function getStyleCookie() {
    return showCookie("activeStyle");
}

function setCookie(name, val) {
    document.cookie = name + "=" + val + "; path=/";
}

function showCookie(name) {
    if (document.cookie!="") {
        var cookies=document.cookie.split("; ");
        for (var i=0; i<cookies.length; i++) {
            var cookieName=cookies[i].split("=")[0];
            var cookieVal=cookies[i].split("=")[1];
            if (cookieName===name) {
                return decodeURI(cookieVal)
            }
        }
    }
}