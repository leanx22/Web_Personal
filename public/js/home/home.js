function toggleContact(e)
{
    var popup = document.getElementById('contactPopup');
    console.log(popup);
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

$(function(){
    
    
    $("#contactBtn").on("click", toggleContact);
    $("#closePopupBtn").on("click", toggleContact);
    $("#linkedinBtn").on("click", function(){newPageRedirect("https://www.linkedin.com/in/leandro-guia-dev/")});
    $("#githubBtn").on("click", function(){newPageRedirect("https://github.com/leanx22")});
});