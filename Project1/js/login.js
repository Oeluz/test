// var form = document.forms["login"]
// form.addEventListener("keyup", function (e) {
//     if (e.keyCode === 13) {
//         e.preventDefault()
//         document.getElementById("loginBtn").click()
//     }
// })

function log_in(){
    var username = document.forms['login']['username'];
    var password = document.forms['login']['password'];

    var obj = {};
    obj.username = username;
    obj.password = password;
    obj.type = "login";

    var request = JSON.stringify(obj);

    const http = new XMLHttpRequest();
    http.open("POST", "./backend/attendee_backend.php", true);
    http.send(request);

    alert(http.responseText);
}