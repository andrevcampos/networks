// JavaScript Document

function checkemail(email) {
    const regexExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/gi;
    return regexExp.test(email);
}

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
function franchisegoback() {
    document.getElementById('regionmessage').style = "display:none"
    document.getElementById('memberbox').style = "display:block"
}

function newfranchise(url) {

    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;

    if(!login || !password || !firstName || !lastName || !email || !phone){
        document.getElementById('messagetitle').innerHTML = "Error";
        document.getElementById('message').innerHTML = "All Field are required.";
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    
    if(login.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Username must have 8 characters long"
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(password.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "password must have 8 characters long"
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(firstName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "First name is too short."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(lastName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Last name is too short."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(phone.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Invalid phone number."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(!checkemail(email)){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Invalid email address."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }

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

    if(!login || !password || !firstName || !lastName || !email || !phone){
        document.getElementById('messagetitle').innerHTML = "Error";
        document.getElementById('message').innerHTML = "All Field are required.";
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    
    if(login.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Username must have 8 characters long"
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(password.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "password must have 8 characters long"
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(firstName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "First name is too short."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(lastName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Last name is too short."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(phone.length < 8){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Invalid phone number."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    if(!checkemail(email)){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Invalid email address."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }

    document.getElementById("myForm").submit();
    return;
}

function franchisesearchregion() {
    
    var region = document.getElementById('region').value;
    const collection = document.getElementsByClassName("hideinputinside");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    console.log(region)
    if (region.length > 2){
        if(region == "all"){
            for (let i = 0; i < collection.length; i++) {
                collection[i].style = "display:block"
            }
        }else{
            for (let i = 0; i < collection.length; i++) {
                if (collection[i].innerHTML.toLowerCase().includes(region.toLowerCase())){
                    collection[i].style = "display:block"
                }
            }
        }
        
    }

}

function franchiseaddregion(id, name) {

    // remove all options from main intup
    document.getElementById('region').value = "";
    const collection = document.getElementsByClassName("hideinputinside");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this region selected
    const inputregion = document.getElementsByClassName("inputregion");
    for (let i = 0; i < inputregion.length; i++) {
        if(inputregion[i].value == name){
            return;
        }
    }

    //add new input to the regions
    var addList = document.getElementById('regions');
    var text = document.createElement('div');
    text.className = "regiondiv";
    text.innerHTML = '<input class="inputregion" type="text" value="'+name+'" name="region[]" style="width:calc(100% - 250px);" readonly><div class="franchiseregionremove" onclick="removeregion(this)">X</div>';
    addList.appendChild(text);

}

function removeregion(index) {
    const allregionremovebuttom = document.getElementsByClassName("franchiseregionremove");
    const allregionclass = document.getElementsByClassName("regiondiv");
    for (let i = 0; i < allregionremovebuttom.length; i++) {
        if(allregionremovebuttom[i] == index){
            allregionclass[i].remove();
        }
    }
}



//REGION --------------------------------------------------------------

function newregion(url) {
    var name = document.getElementById('name').value;

    if(name.length < 5){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Name must have 5 characters long."
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }

    document.getElementById("myForm").submit();
    return;
}

function regiongoback() {
    document.getElementById('regionmessage').style = "display:none";
    document.getElementById('memberbox').style = "display:block";
}

function regionremovecheck() {
    let deletebutton = document.getElementById('inputremoveregion').value.toLowerCase();
    if(deletebutton == "delete"){
        document.getElementById('buttongobackregion').style="display:none;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px"
        document.getElementById('buttonremoveregion').style="display:block;cursor: pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px"
    }else{
        document.getElementById('buttongobackregion').style="display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px"
        document.getElementById('buttonremoveregion').style="display:none;cursor: pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px"
    }
}

function regionremovebox(id, name) {
    document.getElementById('textregionremove').innerHTML = "Region Name: " + name;
    document.getElementById('regionremoveid').value = id;
    document.getElementById('inputremoveregion').value = "";
    document.getElementById('regionremove').style = "display:block";
    document.getElementById('regionedit').style = "display:none";
    document.getElementById('regiontable').style = "display:none";
}
function regioneditbox(id, name) {
    document.getElementById('editregionid').value = id;
    document.getElementById('editregionname').value = name;
    document.getElementById('regionedit').style = "display:block";
    document.getElementById('regionremove').style = "display:none";
    document.getElementById('regiontable').style = "display:none";
}