
function toggleContact(e)
{
    var popup = document.getElementById('contactPopup');
    var classes = Array.from(popup.classList);
    if(classes.includes("hidden"))
    {
        document.body.style.overflow = 'hidden';
        popup.classList.remove("hidden");
    }
    else
    {
        document.body.style.overflow = '';
        popup.classList.add("hidden");
    }
}

function newPageRedirect(url)
{
    window.open(url,'_blank');
}

function newInteractionRegister(interactionType)
{


}

$(function(){
    
    
    $("#contactBtn").on("click", toggleContact);
    $("#closePopupBtn").on("click", toggleContact);
    $("#linkedinBtn").on("click", function(){newPageRedirect("https://www.linkedin.com/in/leandro-guia-dev/")});
    $("#githubBtn").on("click", function(){newPageRedirect("https://github.com/leanx22")});
    $("#githubBtn").on("click", function(){newInteractionRegister("visitas_github")});
});