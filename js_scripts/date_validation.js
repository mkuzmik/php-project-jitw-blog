/**
 * Created by M.Kuzmik on 13.01.2017.
 */

// converts number to String i.e. 0 = "00", 10 = "10"
function toStringTwo(number) {
    if (number < 10) {
        return "0".concat(number.toString());
    }
    else {
        return number.toString();
    }
}

function getDate() {
    var date = new Date();
    var year = toStringTwo(date.getFullYear());
    var month = toStringTwo(date.getMonth() + 1);
    var day = toStringTwo(date.getDate());
    return year.concat("-").concat(month).concat("-").concat(day);
}

function getTime() {
    var date = new Date();
    var hour = toStringTwo(date.getHours());
    var minutes = toStringTwo(date.getMinutes());
    return hour.concat(":").concat(minutes);
}

function setActualDateAndTime() {
    document.getElementById('postDate').value = getDate();
    document.getElementById('postTime').value = getTime();
}

function isDateValid() {
    var pattern = new RegExp("^[0-9]{4}-[0-9]{2}-[0-9]{2}$");
    var dateReference = document.getElementById('postDate');

    if (pattern.test(dateReference.value) && areDateValuesValid()) {
        return true;
    }
    else {
        return false;
    }
}

function areDateValuesValid() {
    if (isYearValid() && isMonthValid() && isDayValid())
        return true;
    else
        return false;
}

function isYearValid() {
    var dateReference = document.getElementById('postDate');
    var year = parseInt(dateReference.value.substr(0,4));

    if (year > 0)
        return true;
    else
        return false;
}

function isMonthValid() {
    var dateReference = document.getElementById('postDate');
    var month = parseInt(dateReference.value.substr(5,2));

    if (month > 0 && month < 12)
        return true;
    else
        return false;
}

function isDayValid() {
    var dateReference = document.getElementById('postDate');
    var month = parseInt(dateReference.value.substr(5,2));
    var day = parseInt(dateReference.value.substr(8,2));
    var year = parseInt(dateReference.value.substr(0,4));

    if (day > 0 && day <= getMaxDaysInGivenMonth(month, year)) {
        return true;
    }
    else {
        return false;
    }
}

function getMaxDaysInGivenMonth(month, year) {
    switch (month) {
        case 2:
            if (year % 4 == 0)
                return 29;
            else
                return 28;
            break;
        case 1:
        case 3:
        case 5:
        case 7:
        case 9:
        case 11:
            return 31;
            break;
        default:
            return 30;
    }
}

function setDateAnnotationIfNotValid() {
    var dataAnnotation = document.getElementById("dataAnnotation");
    if (!isDateValid()) {
        dataAnnotation.innerHTML = "Not valid! (must be yyyy-mm-dd format)";
    }
    else {
        dataAnnotation.innerHTML = "";
    }
}

function isTimeValid() {
    var pattern = new RegExp("^[0-9]{2}:[0-9]{2}$");
    var timeReference = document.getElementById('postTime');

    if (pattern.test(timeReference.value) && isTimeValueValid()) {
        return true;
    }
    else {
        return false;
    }
}

function isTimeValueValid() {
    var timeReference = document.getElementById('postTime');
    var hour = timeReference.value.substr(0, 2);
    var minute = timeReference.value.substr(3, 2);

    if(minute >= 0 && minute < 60 && hour >= 0 && hour < 24)
        return true;
    else
        return false;
}

function setTimeAnnotationIfNotValid() {
    var timeAnnotation = document.getElementById("timeAnnotation");
    if (!isTimeValid()) {
        timeAnnotation.innerHTML = "Not valid! (must be yyyy-mm-dd format)";
    }
    else {
        timeAnnotation.innerHTML = "";
    }
}

function initializeDateValidation() {
    setActualDateAndTime();

    var postDate = document.getElementById('postDate');
    var postTime = document.getElementById('postTime');
    var submitButton = document.getElementById('submitButton');
    var postForm = document.getElementById('postform');

    postDate.onchange = function() {
        //setDateAnnotationIfNotValid();
        if (!isDateValid())
            setActualDateAndTime();
    };
    postTime.onchange = function() {
        //setTimeAnnotationIfNotValid();
        if (!isTimeValid())
            setActualDateAndTime();
    };
}
