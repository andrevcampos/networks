
function regiondropdownchange() {
    
    const regionid = document.getElementById('selectBox').value;
    if(regionid == "notselected"){
        var allelements = document.getElementsByClassName('allgroups');
        for (var i = 0; i < allelements.length; i++) {
            allelements[i].style.display = "";
        }
        return;
    }
    var allelements = document.getElementsByClassName('allgroups');
    for (var i = 0; i < allelements.length; i++) {
        allelements[i].style.display = "none";
    }
    var elementsToShow = document.getElementsByClassName(regionid);
    for (var i = 0; i < elementsToShow.length; i++) {
        elementsToShow[i].style.display = "";
    }
}
function membersearchchange() {
    
    const regionid = document.getElementById('selectBox').value;
    if(regionid == "notselected"){
        var allelements = document.getElementsByClassName('allindustrys');
        for (var i = 0; i < allelements.length; i++) {
            allelements[i].style.display = "";
        }
        return;
    }
    var allelements = document.getElementsByClassName('allindustrys');
    for (var i = 0; i < allelements.length; i++) {
        allelements[i].style.display = "none";
    }
    var elementsToShow = document.getElementsByClassName(regionid);
    for (var i = 0; i < elementsToShow.length; i++) {
        elementsToShow[i].style.display = "";
    }
}

function pinboxinfo(index) {
    var allelements = document.getElementsByClassName('info-box');
    for (var i = 0; i < allelements.length; i++) {
        if(i == index){
            console.log('aqui1')
            allelements[i].style.display = "block";
            allelements[i].style.opacity = "1";
        }else{
            console.log('aqui2')
            allelements[i].style.display = "none";
            allelements[i].style.opacity = "0";
        }
    }
}