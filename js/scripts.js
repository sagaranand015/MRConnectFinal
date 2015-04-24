//this is the file for all the custom javascript functions that will be used in this project!

//this is the function to set the cookies in javascript!!
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

//this is the function to get the cookies that already exists. "" is returned if not exists.
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
} 

//this is the function to check if the cookie exists!
function checkCookie() {
    var username=getCookie("username");
    if (username!="") {
        alert("Welcome again " + username);
    }else{
        username = prompt("Please enter your name:", "");
        if (username != "" && username != null) {
            setCookie("username", username, 365);
        }
    }
} 

//this is the function to get the queryStrings passed to the Page URL.
function getQueryStrings() {
    var assoc = {};
    var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
    var queryString = location.search.substring(1);
    var keyValues = queryString.split('&');

    for (var i in keyValues) {
        var key = keyValues[i].split('=');
        if (key.length > 1) {
            assoc[decode(key[0])] = decode(key[1]);
        }
    }
return assoc;
}

//this is the function to change the active state of the list on the LHS
function changeActiveState(item) {
    $('a.active').removeClass('active');
    $(item).addClass('active');
}

//for the animate effect of the div on the RHS on click of the list on LHS
function showDiv(item) {
    var arr = $('.divsMain');
    var ob = $(item);

    for (var i = 0; i < arr.length; i++) {
        $(arr[i]).hide(1);
        $(arr[i]).css({
          top: '1000px'
        });
    }
    ob.show(1);
    ob.animate({
      top: '0px'
    }, 300);

    // this is for making visible the others.
    // var others = $('.divsSec');
    // for(var i = 0;i<others.length;i++) {
    //     $(others[i]).show();
    //     $(others[i]).css({
    //         top: '0px'
    //     });
    // }
}