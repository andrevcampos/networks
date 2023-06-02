// JavaScript Document

function addnewphone() {
    var addList = document.getElementById('memberphone');
    var text = document.createElement('div');
    text.className = "phonediv";
    text.innerHTML = '<input class="phone" type="text" style="width:calc(100% - 80px)"><div class="memberphoneremove" onclick="removephone(this)">X</div><br>';
    addList.appendChild(text);
}
function removephone(index) {
    const allphoneremovebuttom = document.getElementsByClassName("memberphoneremove");
    const allphoneclass = document.getElementsByClassName("phonediv");
    for (let i = 0; i < allphoneremovebuttom.length; i++) {
        if(allphoneremovebuttom[i] == index){
            allphoneclass[i].remove();
        }
    }
}
function generatepassword() {
    var randomstring = Math.random().toString(36).slice(-11);
    document.getElementById('password').value = randomstring;
}

function newfranchise(url) {

    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var region = document.getElementById('region').value;

    document.getElementById("myForm").submit();
return;
    console.log(url);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
    const body = JSON.stringify({
    "login": login,
    "password": password,
    "firstName": firstName,
    "lastName": lastName,
    "email": email,
    "phone": phone,
    "region": region,
    });
    console.log(body);
    xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(JSON.parse(xhr.responseText));
    } else {
        console.log(`Error: ${xhr.status}`);
    }
    };
    xhr.send(body);

}