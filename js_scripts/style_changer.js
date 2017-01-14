window.onload = function() {
    generateStyleComboboxInMenu();
    var selectElement = document.getElementById("styleChanger");
    selectElement.onchange = function() {
        setActiveStyleSheet(selectElement.options[selectElement.selectedIndex].value);
    }
    if (document.getElementsByTagName("head")[0].getAttribute("data_validation") == "true")
        initializeDateValidation();
}

function generateStyleComboboxInMenu() {

    var styleTags = document.getElementsByTagName('link');
    var selectElement = document.getElementById("styleChanger");

    if (styleTags.length > 1)
        selectElement.style.visibility = 'visible';

    for (var i=0; i< styleTags.length; i++) {
        var option = document.createElement("option");
        option.value = styleTags[i].title;
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