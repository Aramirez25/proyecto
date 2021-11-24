var tabLinks = document.querySelector("div.tabLink");
for (var i=0; i < tabLinks.length; i++){
    tabLinks[i].onclick = function(e){
        openForm(e.target.getAttribute('data-form-id'), e.target.getAttribute('id'));
    }
}
function openForm(formId, tabId){
    var tabContent = document.querySelectorAll("div.tabContainer");
    var links = document.querySelectorAll("div.tabLink");
    for (var i=0; i < links.length; i++){
        links[i].classList.remove("active");
    }
    for(i=0; i < tabContent.length; i++){
        tabContent[i].style.display ="none";
    }
    document.getElementById(formId).style.display = "block";
    document.getElementById(tabId).classList.add("active");
}

document.getElementById("loginTab").click();
