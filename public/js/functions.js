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
    document.getElementById('logo_imagebox').style = "display:none";
    document.getElementById('logo_img').src = "";
    document.getElementById('logo_image_url').value="";
    document.getElementById('logo_image_remove_button').style = "display:none";
    document.getElementById('logo_original_image').value = "";
}

// SOCIAL MEDIA ----------
function newsocialmediainput() {

    
}

function logoimageremove() {
    document.getElementById('logo_imagebox').style = "display:none";
    document.getElementById('logo_img').src = "";
    document.getElementById('logo_image_url').value="";
    document.getElementById('logo_image_remove_button').style = "display:none";
    document.getElementById('logo_original_image').value = "";
}