
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
