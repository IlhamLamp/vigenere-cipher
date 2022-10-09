// show password
function pwFunction() {
    var x = document.getElementById("show_pw");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function cpwFunction() {
    var x = document.getElementById("show_cpw");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}