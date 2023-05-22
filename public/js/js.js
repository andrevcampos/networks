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