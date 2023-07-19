// LOGO IMAGE ----------
function logoimagecheck(input) {

    var imagedisplay = document.getElementById('logo_img');
    var imagebox = document.getElementById('logo_imagebox');
    var imageremovebutton = document.getElementById('logo_image_remove_button');
    var imagecomment = document.getElementById('logo_image_comment');
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
        document.getElementById('logo_image_url').value='';
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
        document.getElementById('logo_original_image').value = "";
    }

}
function logoimageremove() {
    console.log("aqui")
    document.getElementById('logo_imagebox').style = "display:none";
    document.getElementById('logo_img').src = "";
    document.getElementById('logo_image_url').value="";
    document.getElementById('logo_image_remove_button').style = "display:none";
    document.getElementById('logo_original_image').value = "";
}

// SOCIAL MEDIA ----------
function newsocialmediainput() {

    var smbox = document.getElementById('social_media_box');

    var smsection = document.createElement('div');
    smsection.className = "socialmediaseciton";
    smbox.appendChild(smsection);

    var titleinput = document.createElement('input');
    titleinput.className = "d-block socialmediatitle";
    titleinput.type = "text";
    titleinput.name = "socialmediatitle[]";
    titleinput.placeholder = "Title: Ex: Website, Facebook, Instagram";
    titleinput.style = "width:calc(100% - 50px);margin-top:5px";
    smsection.appendChild(titleinput);

    var linkinput = document.createElement('input');
    linkinput.className = "d-block socialmedialink";
    linkinput.type = "text";
    linkinput.name = "socialmedialink[]";
    linkinput.placeholder = "Link: Ex: https://your-website-here";
    linkinput.style = "width:calc(100% - 50px);margin-top:5px";
    smsection.appendChild(linkinput);

    var closebutton = document.createElement('div');
    closebutton.className = "smremovebutton";
    closebutton.onclick = function () {
        socialmediaremove(this);
    };
    smsection.appendChild(closebutton);

    var buttonspam = document.createElement('spam');
    buttonspam.innerHTML = "X";
    closebutton.appendChild(buttonspam);

}

function socialmediaremove(index) {

    const smremovebutton = document.getElementsByClassName("smremovebutton");
    const socialmediaseciton = document.getElementsByClassName("socialmediaseciton");
    for (let i = 0; i < smremovebutton.length; i++) {
        if(smremovebutton[i] == index){
            socialmediaseciton[i].remove();
        }
    }

}

function getlatlong(url){
    console.log("aqui")
    var country = document.getElementById('country').value;
    var address = document.getElementById('streetaddress1').value;
    var address2 = document.getElementById('streetaddress2').value;
    if(address2)
        address += ", " + address2;
    var suburb = document.getElementById('suburb').value;
    if(suburb)
        address += ", " + suburb;
    var city = document.getElementById('city').value;
    if(city)
        address += ", " + city;
    var postalcode = document.getElementById('postalcode').value;
    if(postalcode)
        address += " " + postalcode;

    var params = 'country=' + country + '&address=' + address;
    url = url + '?' + params;

    console.log("url " + url)
    var xhr = new XMLHttpRequest();

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        var response = xhr.responseText;
        var result = JSON.parse(response);
        var lat = result[0];
        var lng = result[1];
        console.log("lat " + lat)
        } else {
        // Handle errors or other status codes here
        // ...
        }
    };
    xhr.send();
}

function getmap(lat,lon){
    var mapOptions = {
    center: new google.maps.LatLng(lat,lon),
    zoom: 8,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
}