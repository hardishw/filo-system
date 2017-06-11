function getCookie(name) {
  var cookie = document.cookie;
  var prefix = name + "=";
  var begin = cookie.indexOf("; " + prefix);
  if (begin == -1) {
    begin = cookie.indexOf(prefix);
    if (begin != 0) return null;
  } else {
    begin += 2;
    var end = document.cookie.indexOf(";", begin);
    if (end == -1) {
      end = cookie.length;
    }
  }
  return unescape(cookie.substring(begin + prefix.length, end));
}

var myCookie = getCookie("filo-login");

if (myCookie == null) {
    document.getElementById("login").innerHTML = '<a href="html/login.html">Login</a>'
}
else {
    document.getElementById("login").innerHTML = myCookie + ' <input type="button" value ="logout" onclick= \'document.cookie = "filo-login=; expires=Thu, 01 Jan 2000 00:00:00 GMT"; location.reload(true);\'/>';
}
