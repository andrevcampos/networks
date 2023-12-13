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
    text.innerHTML = '<input class="phone" name="phone[]" type="text" style="width:calc(100% - 80px)"><div class="memberphoneremove" onclick="removephone(this)">X</div><br>';
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
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "All Field are required.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    
    if(login.length < 8){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Username must have 8 characters long";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(password.length < 8){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "password must have 8 characters long";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(firstName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "First name is too short.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(lastName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Last name is too short.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(phone.length < 8){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Invalid phone number.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(!checkemail(email)){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Invalid email address.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
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
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "All Field are required.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    
    if(password.length > 1 && password.length < 8){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "password must have 8 characters long";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(firstName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "First name is too short.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(lastName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "Last name is too short.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(phone.length < 8){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "Invalid phone number.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(!checkemail(email)){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Franchise";
        document.getElementById('message').innerHTML = "Invalid email address.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
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
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Name must have 3 characters long.";
        document.getElementById('popupbox').style = "display:block";
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
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Name must have 3 characters long.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }

    document.getElementById("myForm").submit();
    return;
}
function updateindustry() {

    var name = document.getElementById('name').value;

    if(name.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Update Industry";
        document.getElementById('message').innerHTML = "Name must have 3 characters long.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }

    document.getElementById("myForm").submit();
    return;
}

//MEMBER --------------------------------------------------------------

function newmember() {

    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var businessname = document.getElementById('businessname').value;
    var paymentcheckbox = document.getElementById('paymentcheckbox').checked;
    var newslettercheckbox = document.getElementById('newslettercheckbox').checked;
    var businessinformationcheckbox = document.getElementById('businessinformationcheckbox').checked;
    var agreecheckbox = document.getElementById('agreecheckbox').checked;

    if(firstName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Invalid First Name";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(lastName.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Invalid Last Name";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(businessname.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "Invalid Business Name";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
    if(!paymentcheckbox || !newslettercheckbox || !businessinformationcheckbox || !agreecheckbox){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration";
        document.getElementById('message').innerHTML = "You must accept all terms and coditions";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }

    document.getElementById("myForm").submit();
    return;
}

function membercheck(url) {

console.log(url)

var businessname = document.getElementById('businessname').value;
const fullUrl = url + "?businessname=" + businessname;

const xhr = new XMLHttpRequest();
xhr.open('GET', fullUrl, true);
xhr.onreadystatechange = function () {
  if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
        if (xhr.responseText == "false"){
            newmember();
        }else{
            document.getElementById('messagetitle').innerHTML = "Duplicate Registration";
            document.getElementById('message').innerHTML = "This Business name has already been taken";
            document.getElementById('popupbox').style = "display:block";
            window.scrollTo(0, 0);
            return;
        }
    } else {
        document.getElementById('messagetitle').innerHTML = "Error";
        document.getElementById('message').innerHTML = "Please try again.";
        document.getElementById('popupbox').style = "display:block";
        window.scrollTo(0, 0);
        return;
    }
  }
};
xhr.send();

}

function updatemember(url) {

    var orginalname = document.getElementById('orginalname').value;
    var businessname = document.getElementById('businessname').value;
    if(orginalname == businessname){
        newmember();
    }else{
        membercheck(url)
    }
    
}

function updateliststatus() {

    var memberstatus = document.getElementById('memberstatus').value;
    if(memberstatus == "All Members"){
        window.location.href = '/wp-admin/admin.php?page=networkers-members';
    }else{
        window.location.href = '/wp-admin/admin.php?page=networkers-members&s='+memberstatus;
    }
    
    
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
    // if(!laddress || !lsuburb || !lcity || !lpostcode){
    //     document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
    //     document.getElementById('message').innerHTML = "Group required addrress (street, suburb, city and postcode)."
    //     document.getElementById('popupbox').style = "display:block"
    //     window.scrollTo(0, 0);
    //     return;
    // }
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


// FACILITATOR -------------------------------------------------------------------------

function newfacilitator() {

    var name = document.getElementById('Name').value;
    var email = document.getElementById('email').value;

    if(!name || name.length < 3){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Name must have 3 characters long."
        document.getElementById('popupbox').style = "display:block"
        window.scrollTo(0, 0);
        return;
    }
    if(email == ""){
        document.getElementById('messagetitle').innerHTML = "Unable to Complete Registration"
        document.getElementById('message').innerHTML = "Facilitator must have a email."
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

// GROUP ----------

function searchgroup() {
    
    var group = document.getElementById('group').value;
    const collection = document.getElementsByClassName("hideinputinsidegroup");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }

    if (group.length > 2){
        for (let i = 0; i < collection.length; i++) {
            if (collection[i].innerHTML.toLowerCase().includes(group.toLowerCase())){
                collection[i].style = "display:block"
            }
        }
    }else{
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:block"
        }
    }
}

function cleansearchgroup(){
    const collection = document.getElementsByClassName("hideinputinsidegroup");

    var a = document.querySelector('.hideinputinsidegroup:hover');
    if (a) {
        console.log("over")
    }
    else {
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:none"
        }
    }
}

function addgroup(id, name, multiple) {

    console.log(multiple);

    // remove all options from main intup
    document.getElementById('group').value = "";
    const collection = document.getElementsByClassName("hideinputinsidegroup");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this group selected
    const inputgroup = document.getElementsByClassName("inputgroup");
    for (let i = 0; i < inputgroup.length; i++) {
        if(inputgroup[i].value == name){
            return;
        }
    }

    const groups = document.getElementsByClassName("inputgroup");
    console.log(groups.length)
    if(groups.length > 0 && multiple == false){
        console.log("Can only add one")
    }else{
        //add new input to the groups
        var addList = document.getElementById('groups');
        var text = document.createElement('div');
        text.className = "groupdiv";
        text.style = "width:100%;max-width:500px;display:flex";
        text.innerHTML = '<input class="inputgroup groupid" type="text" value="'+id+'" name="groupid[]" style="width:50px;display:none" readonly><input class="inputgroup" type="text" value="'+name+'" name="group[]" style="width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;" readonly><div class="groupremove" onclick="removegroup2(this,'+multiple+')">X</div>';
        addList.appendChild(text);

        if(multiple == false){
            document.getElementById('group').style="display:none";
            document.getElementById('grouptext01').style="display:none";
            document.getElementById('grouptext02').style="display:none";
        }

    }

}

function removegroup2(index, multiple) {
    const allgroupremovebuttom = document.getElementsByClassName("groupremove");
    const allgroupclass = document.getElementsByClassName("groupdiv");
    for (let i = 0; i < allgroupremovebuttom.length; i++) {
        if(allgroupremovebuttom[i] == index){
            allgroupclass[i].remove();
        }
    }
    if(multiple == false){
        document.getElementById('group').style="display:block";
        document.getElementById('grouptext01').style="display:block";
        document.getElementById('grouptext02').style="display:block";
    }
}


// Industry ----------

function searchindustry() {
    
    var industry = document.getElementById('industry').value;
    const collection = document.getElementsByClassName("hideinputinsideindustry");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }

    if (industry.length > 2){
        for (let i = 0; i < collection.length; i++) {
            if (collection[i].innerHTML.toLowerCase().includes(industry.toLowerCase())){
                collection[i].style = "display:block"
            }
        }
    }else{
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:block"
        }
    }
}

function cleansearchindustry(){
    const collection = document.getElementsByClassName("hideinputinsideindustry");

    var a = document.querySelector('.hideinputinsideindustry:hover');
    if (a) {
        console.log("over")
    }
    else {
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:none"
        }
    }
}

function addindustry(id, name, multiple) {

    console.log(multiple);

    // remove all options from main intup
    document.getElementById('industry').value = "";
    const collection = document.getElementsByClassName("hideinputinsideindustry");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this industry selected
    const inputindustry = document.getElementsByClassName("inputindustry");
    for (let i = 0; i < inputindustry.length; i++) {
        if(inputindustry[i].value == name){
            return;
        }
    }

    const industrys = document.getElementsByClassName("inputindustry");
    console.log(industrys.length)
    if(industrys.length > 0 && multiple == false){
        console.log("Can only add one")
    }else{
        //add new input to the industrys
        var addList = document.getElementById('industrys');
        var text = document.createElement('div');
        text.className = "industrydiv";
        text.style = "width:100%;max-width:500px;display:flex";
        text.innerHTML = '<input class="inputindustry industryid" type="text" value="'+id+'" name="industryid[]" style="width:50px;display:none" readonly><input class="inputindustry" type="text" value="'+name+'" name="industry[]" style="width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;" readonly><div class="industryremove" onclick="removeindustry2(this,'+multiple+')">X</div>';
        addList.appendChild(text);

        if(multiple == false){
            document.getElementById('industry').style="display:none";
            document.getElementById('industrytext01').style="display:none";
            document.getElementById('industrytext02').style="display:none";
        }

    }

}

function removeindustry2(index, multiple) {
    const allindustryremovebuttom = document.getElementsByClassName("industryremove");
    const allindustryclass = document.getElementsByClassName("industrydiv");
    for (let i = 0; i < allindustryremovebuttom.length; i++) {
        if(allindustryremovebuttom[i] == index){
            allindustryclass[i].remove();
        }
    }
    if(multiple == false){
        document.getElementById('industry').style="display:block";
        document.getElementById('industrytext01').style="display:block";
        document.getElementById('industrytext02').style="display:block";
    }
}

// Refered By ----------

function searchreferedby() {
    
    var referedby = document.getElementById('referedby').value;
    const collection = document.getElementsByClassName("hideinputinsidereferedby");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }

    if (referedby.length > 2){
        for (let i = 0; i < collection.length; i++) {
            if (collection[i].innerHTML.toLowerCase().includes(referedby.toLowerCase())){
                collection[i].style = "display:block"
            }
        }
    }else{
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:block"
        }
    }
}

function cleansearchreferedby(){
    const collection = document.getElementsByClassName("hideinputinsidereferedby");

    var a = document.querySelector('.hideinputinsidereferedby:hover');
    if (a) {
        console.log("over")
    }
    else {
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:none"
        }
    }
}

function addreferedby(id, name, multiple) {

    console.log(multiple);

    // remove all options from main intup
    document.getElementById('referedby').value = "";
    const collection = document.getElementsByClassName("hideinputinsidereferedby");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this industry selected
    const inputreferedby = document.getElementsByClassName("inputreferedby");
    for (let i = 0; i < inputreferedby.length; i++) {
        if(inputreferedby[i].value == name){
            return;
        }
    }

    const referedbys = document.getElementsByClassName("inputreferedby");
    console.log(referedbys.length)
    if(referedbys.length > 0 && multiple == false){
        console.log("Can only add one")
    }else{
        //add new input to the industrys
        var addList = document.getElementById('referedbys');
        var text = document.createElement('div');
        text.className = "referedbydiv";
        text.style = "width:100%;max-width:500px;display:flex";
        text.innerHTML = '<input class="inputreferedby referedbyid" type="text" value="'+id+'" name="referedbyid[]" style="width:50px;display:none" readonly><input class="inputreferedby" type="text" value="'+name+'" name="referedby[]" style="width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;" readonly><div class="referedbyremove" onclick="removereferedby2(this,'+multiple+')">X</div>';
        addList.appendChild(text);

        if(multiple == false){
            document.getElementById('referedby').style="display:none";
            document.getElementById('referedbytext01').style="display:none";
            document.getElementById('referedbytext02').style="display:none";
        }

    }

}

function removereferedby2(index, multiple) {
    const allreferedbyremovebuttom = document.getElementsByClassName("referedbyremove");
    const allreferedbyclass = document.getElementsByClassName("referedbydiv");
    for (let i = 0; i < allreferedbyremovebuttom.length; i++) {
        if(allreferedbyremovebuttom[i] == index){
            allreferedbyclass[i].remove();
        }
    }
    if(multiple == false){
        document.getElementById('referedby').style="display:block";
        document.getElementById('referedbytext01').style="display:block";
        document.getElementById('referedbytext02').style="display:block";
    }
}


// Facilitator ----------

function searchfacilitator() {
    
    var facilitator = document.getElementById('facilitator').value;
    const collection = document.getElementsByClassName("hideinputinsidefacilitator");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }

    if (facilitator.length > 2){
        for (let i = 0; i < collection.length; i++) {
            if (collection[i].innerHTML.toLowerCase().includes(facilitator.toLowerCase())){
                collection[i].style = "display:block"
            }
        }
    }else{
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:block"
        }
    }
}

function cleansearchfacilitator(){
    const collection = document.getElementsByClassName("hideinputinsidefacilitator");

    var a = document.querySelector('.hideinputinsidefacilitator:hover');
    if (a) {
        console.log("over")
    }
    else {
        for (let i = 0; i < collection.length; i++) {
            collection[i].style = "display:none"
        }
    }
}

function addfacilitator(id, name, multiple) {

    // remove all options from main intup
    document.getElementById('facilitator').value = "";
    const collection = document.getElementsByClassName("hideinputinsidefacilitator");
    for (let i = 0; i < collection.length; i++) {
        collection[i].style = "display:none"
    }
    
    // Check if already have this industry selected
    const inputfacilitator = document.getElementsByClassName("inputfacilitator");
    for (let i = 0; i < inputfacilitator.length; i++) {
        if(inputfacilitator[i].value == name){
            return;
        }
    }

    const facilitators = document.getElementsByClassName("inputfacilitator");
    console.log(facilitators.length)
    if(facilitators.length > 0 && multiple == false){
        console.log("Can only add one")
    }else{
        //add new input to the industrys
        var addList = document.getElementById('facilitators');
        var text = document.createElement('div');
        text.className = "facilitatordiv";
        text.style = "width:100%;max-width:500px;display:flex";
        text.innerHTML = '<input class="inputfacilitator facilitatorid" type="text" value="'+id+'" name="facilitatorid[]" style="width:50px;display:none" readonly><input class="inputfacilitator" type="text" value="'+name+'" name="facilitator[]" style="width:calc(100% - 50px);border-top-right-radius:0px;border-bottom-right-radius:0px;" readonly><div class="facilitatorremove" onclick="removefacilitator2(this,'+multiple+')">X</div>';
        addList.appendChild(text);

        if(multiple == false){
            document.getElementById('facilitator').style="display:none";
            document.getElementById('facilitatortext01').style="display:none";
            document.getElementById('facilitatortext02').style="display:none";
        }

    }

}

function removefacilitator2(index, multiple) {
    const allfacilitatorremovebuttom = document.getElementsByClassName("facilitatorremove");
    const allfacilitatorclass = document.getElementsByClassName("facilitatordiv");
    for (let i = 0; i < allfacilitatorremovebuttom.length; i++) {
        if(allfacilitatorremovebuttom[i] == index){
            allfacilitatorclass[i].remove();
        }
    }
    if(multiple == false){
        document.getElementById('facilitator').style="display:block";
        document.getElementById('facilitatortext01').style="display:block";
        document.getElementById('facilitatortext02').style="display:block";
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


// USER IMAGE ----------
function checkuserimage(input) {

    var imagedisplay = document.getElementById('userimg');
    var imagebox = document.getElementById('userimagebox');
    var imageremovebutton = document.getElementById('userimageremovebutton');
    var imagecomment = document.getElementById('userimagecomment');
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
        document.getElementById('originaluserimage').value = "";
    }

}
function removeuserimage() {
    document.getElementById('userimagebox').style = "display:none";
    document.getElementById('userimg').src = "";
    document.getElementById('userimage_url').value="";
    document.getElementById('userimageremovebutton').style = "display:none";
    document.getElementById('originaluserimage').value = "";
}