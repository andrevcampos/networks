// JavaScript Document

// NETWORKERS -------------------------------------------------------------






function checkemail(email) {
    const regexExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/gi;
    return regexExp.test(email);
}

// FRANCHISE ---------------------------------------------------------------
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

function newfranchise() {

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

function updatefranchise() {

    var password = document.getElementById('password').value;
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;

    if(!firstName || !lastName || !email || !phone){
        document.getElementById('messagetitle').innerHTML = "Error";
        document.getElementById('message').innerHTML = "All Field are required.";
        document.getElementById('regionmessage').style = "display:block"
        document.getElementById('memberbox').style = "display:none"
        return;
    }
    
    if(password.length > 1 && password.length < 8){
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

function newregion() {
    var name = document.getElementById('name').value;

    if(name.length < 5){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Name must have 3 characters long."
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
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

//INDUSTRY --------------------------------------------------------------

function newindustry() {

    var name = document.getElementById('name').value;

    if(name.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Name must have 3 characters long."
        document.getElementById('networkersmessage').style = "display:block"
        document.getElementById('networkersbox').style = "display:none"
        return;
    }

    document.getElementById("myForm").submit();
    return;
}
function updateindustry() {

    var name = document.getElementById('name').value;

    if(name.length < 3){
        document.getElementById('messagetitle').innerHTML = "Error"
        document.getElementById('message').innerHTML = "Name must have 3 characters long."
        document.getElementById('networkersmessage').style = "display:block"
        document.getElementById('networkersbox').style = "display:none"
        return;
    }

    document.getElementById("myForm").submit();
    return;
}


// GROUPS -------------------------------------------------------------------------

function franchiseinputsearch() {
    
    var region = document.getElementById('facilitator').value;
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

function franchiseaddsearch(id, name) {

    // remove all options from main intup
    document.getElementById('facilitator').value = "";
    const collection = document.getElementsByClassName("hideinputinside");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this region selected
    const inputfacilitator = document.getElementsByClassName("inputfacilitator");
    for (let i = 0; i < inputfacilitator.length; i++) {
        if(inputfacilitator[i].value == name){
            return;
        }
    }

    document.getElementById('facilitatorbox').style = "position:relative;display:none;"
    document.getElementById('pfacilitator01').style = "display:none;"
    document.getElementById('pfacilitator02').style = "display:none;"

    //add new input to the regions
    var addList = document.getElementById('facilitators');
    var text = document.createElement('div');
    text.className = "facilitatordiv";
    text.innerHTML = '<input class="inputfacilitator" type="text" value="'+name+'" name="facilitatorselected" style="width:calc(100% - 250px);" readonly><div class="inputfacilitatorremove" onclick="removefacilitator(this)">X</div>';
    addList.appendChild(text);

}

function removefacilitator(index) {
    const allregionremovebuttom = document.getElementsByClassName("inputfacilitatorremove");
    const allregionclass = document.getElementsByClassName("facilitatordiv");
    for (let i = 0; i < allregionremovebuttom.length; i++) {
        if(allregionremovebuttom[i] == index){
            allregionclass[i].remove();
        }
    }
    document.getElementById('facilitatorbox').style = "position:relative;display:block;"
    document.getElementById('pfacilitator01').style = "display:block;"
    document.getElementById('pfacilitator02').style = "display:block;"
}

function newgroup() {

    var name = document.getElementById('name').value;
    var weekday = document.getElementById('weekday').value;
    var laddress = document.getElementById('laddress').value;
    var lsuburb = document.getElementById('lsuburb').value;
    var lcity = document.getElementById('lcity').value;
    var lpostcode = document.getElementById('lpostcode').value;
    const allregion = document.getElementsByClassName("regionid");

    
    if(!name || name.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Name must have 3 characters long."
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
        return;
    }
    if(weekday == ""){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Group must have a week day."
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
        return;
    }
    if(!laddress || !lsuburb || !lcity || !lpostcode){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Group required addrress (street, suburb, city and postcode)."
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
        return;
    }
    if(allregion.length == 0){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "You must add a region to this group"
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
        return;
    }

    document.getElementById("myForm").submit();
    return;
}



// FUNCTIONS ------------------------------------------

// REGION ----------

function searchregion() {
    
    var region = document.getElementById('region').value;
    const collection = document.getElementsByClassName("hideinputinside");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }

    if (region.length > 2){
        for (let i = 0; i < collection.length; i++) {
            if (collection[i].innerHTML.toLowerCase().includes(region.toLowerCase())){
                collection[i].style = "display:block"
            }
        }
    }else{
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:block"
        }
    }
}

function cleansearch(){
    const collection = document.getElementsByClassName("hideinputinside");

    var a = document.querySelector('.hideinputinside:hover');
    if (a) {
        console.log("over")
    }
    else {
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:none"
        }
    }
}

function addregion(id, name, multiple) {

    console.log(multiple);

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

    const regions = document.getElementsByClassName("inputregion");
    console.log(regions.length)
    if(regions.length > 0 && multiple == false){
        console.log("Can only add one")
    }else{
        //add new input to the regions
        var addList = document.getElementById('regions');
        var text = document.createElement('div');
        text.className = "regiondiv";
        text.style = "width:100%;max-width:500px;display:flex";
        text.innerHTML = '<input class="inputregion regionid" type="text" value="'+id+'" name="regionid[]" style="width:50px;display:none" readonly><input class="inputregion" type="text" value="'+name+'" name="region[]" style="width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;" readonly><div class="regionremove" onclick="removeregion2(this,'+multiple+')">X</div>';
        addList.appendChild(text);

        if(multiple == false){
            document.getElementById('region').style="display:none";
            document.getElementById('regiontext01').style="display:none";
            document.getElementById('regiontext02').style="display:none";
        }

    }

}

function removeregion2(index, multiple) {
    const allregionremovebuttom = document.getElementsByClassName("regionremove");
    const allregionclass = document.getElementsByClassName("regiondiv");
    for (let i = 0; i < allregionremovebuttom.length; i++) {
        if(allregionremovebuttom[i] == index){
            allregionclass[i].remove();
        }
    }
    if(multiple == false){
        document.getElementById('region').style="display:block";
        document.getElementById('regiontext01').style="display:block";
        document.getElementById('regiontext02').style="display:block";
    }
}

// POPUP ----------

// message box
function popupbutton() {
    document.getElementById('popupbox').style="display:none";
}

// Remove box
function PopupRemoveBox(title, id, name, url) {
    document.getElementById('popupRemoveTitle').innerHTML = title;
    document.getElementById('popupRemoveName').innerHTML = name;
    document.getElementById('popupRemoveForm').action = url;
    document.getElementById('popupRemoveID').value = id;
    document.getElementById('popupRemoveBox').style = "display:block"
    document.getElementById('networkersbox').style = "display:none"
    console.log("url " + url + "?" + id)
}

function PopupRemoveGoback() {
    document.getElementById('popupRemoveBox').style = "display:none"
    document.getElementById('networkersbox').style = "display:block"
}

function PopupRemoveCheck() {
    let deletebutton = document.getElementById('popupRemoveImput').value.toLowerCase();
    if(deletebutton == "delete"){
        document.getElementById('popupRemoveGoback').style="display:none;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px"
        document.getElementById('popupRemoveButton').style="display:block;cursor: pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px"
    }else{
        document.getElementById('popupRemoveGoback').style="display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px"
        document.getElementById('popupRemoveButton').style="display:none;cursor: pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px"
    }
}

// IMAGE ----------
function checkimage(input) {

    var imagedisplay = document.getElementById('groupimg');
    var imagebox = document.getElementById('imagebox');
    var imageremovebutton = document.getElementById('imageremovebutton');
    var imagecomment = document.getElementById('imagecomment');
    imagedisplay.src = "";
    imagebox.style = "width:100%;display:none;margin-top:20px";
    imagecomment.style = "font-size:16px;display:none;color:red;";
    imagecomment.innerHTML = "";

    var file = input.files[0];
    var filename = file.name.toLowerCase();
    if (!filename.match(/\.(jpg|jpeg|png|gif)$/i)){
        imagebox.style = "width:100%;display:none;margin-top:20px";
        imagedisplay.src = "";
        imagecomment.innerHTML = "Please choose an image in the following formats: JPG, JPEG, PNG, or GIF.";
        imagecomment.style = "font-size:16px;display:block;color:red;";
        document.getElementById('image_url').value='';
        return;
    }

    console.log(Math.ceil(file.size / 1000) + "kbs")

    if (file) {
        var image = new Image();

        image.onload = function() {
            console.log("image Dimention: " + this.width + "x" +this.height)
        };
        image.src = URL.createObjectURL(file);
        imagedisplay.src = URL.createObjectURL(file);
        imagebox.style = "width:100%;display:block;margin-top:20px";
        imageremovebutton.style = "display:block";
        document.getElementById('originalimage').value = "";
    }

}
function removeimage() {
    document.getElementById('imagebox').style = "display:none";
    document.getElementById('groupimg').src = "";
    document.getElementById('image_url').value="";
    document.getElementById('imageremovebutton').style = "display:none";
    document.getElementById('originalimage').value = "";
}