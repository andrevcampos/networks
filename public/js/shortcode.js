
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

function searchcategorybutton(category) {

    var businessbutton = document.getElementById('cbusiness');
    var memberbutton = document.getElementById('cmember');
    var industrybutton = document.getElementById('cindustry');
    var categoryimput = document.getElementById('categoryimput');
    var spamtext = document.getElementById('spamtext');
    var searchbox = document.getElementById('searchbox');
    var industrybox = document.getElementById('industrybox');
    var regionbox = document.getElementById('regionbox');

    searchbox.value = "";
    industrybox.selectedIndex = 0;
    regionbox.selectedIndex = 0;

    categoryimput.value = category;
    businessbutton.style = "background-color:white;color:black";
    memberbutton.style = "background-color:white;color:black";
    industrybutton.style = "background-color:white;color:black";

    if(category == "business"){
        businessbutton.style = "background-color:#5F259F;color:white";
        spamtext.innerHTML = "Search by Business name";
        searchbox.style = "width:calc(100% - 30px);height:40px;background-color:#f1f2f3;border:none;margin-left:15px;margin-right:15px";
    }
    if(category == "member"){
        memberbutton.style = "background-color:#5F259F;color:white";
        spamtext.innerHTML = "Search by Member name";
        searchbox.style = "width:calc(100% - 30px);height:40px;background-color:#f1f2f3;border:none;margin-left:15px;margin-right:15px";
    }
    if(category == "industry"){
        industrybutton.style = "background-color:#5F259F;color:white";
        spamtext.innerHTML = "Search by Industry";
        searchbox.style = "display:none";
    }
}