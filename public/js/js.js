// JavaScript Document

function myFunction() {
var x = document.getElementById("status").checked;
if (x == true){
    document.getElementById("announcementplugininformation").style.display = "block";
}else{
    document.getElementById("announcementplugininformation").style.display = "none";
}
console.log(x);
}

function buttonsave(url) {
    
    var status = document.getElementById("status").checked;
    var descriptiontab = document.getElementById("descriptiontab").checked;
    var titlecolor = document.getElementById("titlepdfcolor").value.substring(1);
    var background = document.getElementById("backgroundpdfcolor").value.substring(1);
    var title = document.getElementById("title").value;

    var margintop = document.getElementById("margintop").value;
    var marginbottom = document.getElementById("marginbottom").value;
    var paddingtop = document.getElementById("paddingtop").value;
    var paddingbottom = document.getElementById("paddingbottom").value;
    var fontsizetitle = document.getElementById("fontsizetitle").value;
    var fontsizepdftitle = document.getElementById("fontsizepdftitle").value;
    var pdftitlecolor = document.getElementById("pdftitlecolor").value.substring(1);

    var icon = "1";
    var radios = document.getElementsByName('icon');
    for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
        icon = i+1;
        break;
    }
    }

    var newurl = url + "?status=" + status + "&pdftitlecolor=" + pdftitlecolor + "&fontsizepdftitle=" + fontsizepdftitle + "&fontsizetitle=" + fontsizetitle + "&paddingbottom=" + paddingbottom + "&paddingtop=" + paddingtop + "&marginbottom=" + marginbottom + "&margintop=" + margintop + "&descriptiontab=" + descriptiontab + "&titlecolor=" + titlecolor + "&background=" + background + "&icon=" + icon + "&title=" + title;
 
    var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	//document.getElementById('texterror').innerHTML = "aqui";
	window.location.href='?page=my-menu-pdf';
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
    
}

function pdfbuttonsave2(url, productid) {

    

    var url2 = document.getElementById("image_url").value;

    var imageurl2 = document.getElementById("image_urll2").value;

    var title = document.getElementById("pdftitle").value;
    var subtitle = document.getElementById("pdfsubtitle").value;

    const words = url2.split('uploads/');
    const words2 = imageurl2.split('uploads/');

    var last3 = url2.slice(-3);
    

    if(!url2){

        document.getElementById("pdferror").innerHTML = "Please choose your PDF File";

        return;

    }
    if(!imageurl2){

        document.getElementById("pdferror").innerHTML = "Please choose the Image";

        return;

    }
    if(last3 != "pdf" && last3 != "PDF"){

        document.getElementById("pdferror").innerHTML = "This is not a PDF file!";
        return;

    }
    var urldelete = url.replace("bm-pdf.php", "bm-pdf-delete.php");


    var newurl = url + "?pdfurl=" + words[1] + "&imageurl=" + words2[1] + "&pdftitle=" + title + "&pdfsubtitle=" + subtitle + "&pdfid=" + productid;

    //console.log(newurl);

    //document.getElementById("bm-pdf-button").style.color = "#ff0000";

    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText;
        var element = document.createElement("div");
        element.style.cssText = 'margin-top:20px;width:100%;display:inline-block;min-width: 100% !important;';
        var pproductid = "p" + response;
        element.setAttribute("id", pproductid)
        var p = document.getElementById("productgeral");
        p.appendChild(element);
        var element2 = document.createElement("div");
        element2.style.cssText = 'cursor: pointer;float:left;width:80px;height:25px;size:16px;background-color:#aa3210;color:white;text-align:center;padding-top:5px;margin-right:10px';
        element2.appendChild(document.createTextNode('Delete'));
        var texttoadd = "pdfbuttondelete('" + urldelete + "', '" + response + "')";
        element2.setAttribute("onclick",texttoadd);
        var p2 = document.getElementById(pproductid);
        p2.appendChild(element2);

        var element3 = document.createElement("div");
        element3.style.cssText = 'float:left;padding-top:5px;size:45px;font-weight:bold;';
        element3.appendChild(document.createTextNode(title));
        document.getElementById(pproductid).appendChild(element3);
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}


function pdfbuttondelete(url, productid) {

    var divremove = "p" + productid;
    var newurl = url + "?id=" + productid;

    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
        document.getElementById(divremove).remove();
	}

	};

	xhttp.open("GET", newurl, true);

	xhttp.send();

}