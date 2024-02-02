$(function(){
        
    $("#contactSendBtn").on("click", toggleFakeLoad);

});


function toggleFakeLoad()
{
    let loader = document.getElementById("loadingContactSendDiv");
    let classes = Array.from(loader.classList);
    classes.includes("hidden") == true ? loader.classList.remove("hidden") : loader.classList.add("hidden");    
    setTimeout(window.open(WEB_LINK),1500);
}
