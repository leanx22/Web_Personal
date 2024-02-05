import { API_LINK } from "../consts.js";

var context;

$(function(){

    $("#stats_container").on("click","button",toggleConfirmPopup);
    $("#cancelBtn").on("click",toggleConfirmPopup);
    $("#acceptBtn").on("click",restartStat);
});

function toggleConfirmPopup(e)
{
    if(e)
    {
        context = e.target;
    }
    
    var popup = document.getElementById('confirmPopup');
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

function restartStat(e)
{
    let button = context;
    let id = button.id;
    
    let column = getColumn(id);

    if(column == false)
    {
        console.log("ID no coincidente en getColumn()");
        return;
    }

    let data = {};
    data.column = column;

    toggleButtons();

    $.ajax({
        type:'POST',
        url:API_LINK+'/restartStat',
        dataType:"json",
        data:data,
        async:true,
    }).done(function(response){

        console.log(response.message);
        location.reload();

    }).fail((function(xhr, status, error){

        let message = null;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }

        console.error('Dev error: '+error+" Response: "+message);

    })).always(function(){        
        toggleConfirmPopup();
        toggleButtons();
    });

}

function toggleButtons()
{
    let sendButton = document.getElementById('acceptBtn');
    let closeButton = document.getElementById('cancelBtn');

    sendButton.disabled == true ? false:true;
    closeButton.disabled == true ? false:true;
}

function getColumn(btnID)
{
    let column;
    switch(btnID){
        case 'restart_views':
            column = "visitas";
            break;
        case 'restart_contact':
            column = "interacciones_contacto";
            break;
        case 'restart_linkedin':
            column = "vistas_linkedin";
            break;
        case 'restart_github':
            column = "visitas_github";
            break;
        default:
            column = false;
    }
    return column;
}