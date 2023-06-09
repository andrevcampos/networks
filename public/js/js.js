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
function setnewpassword() {
    document.getElementById('password').style = "display:block";
    document.getElementById('generatepasswordbutton').style = "background-color:#b5c5e4;color:black;display:block";
    document.getElementById('setnewpasswordbutton').style = "margin-top:10px;background-color:#b5c5e4;color:black;display:none";
    document.getElementById('ppassword').style = "display:block;margin-top:-20px;margin-bottom:20px";
    
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

}

function updatefranchise(url) {

    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var region = document.getElementById('region').value;

    document.getElementById("myForm").submit();
    return;


}