import { API_LINK } from "../consts.js";

$(function(){
    $("#contactBtn").on("click", toggleForm);
    $("#closePopupBtn").on("click", toggleForm); 
    $("#contactSendBtn").on("click", sendData);
});

function sendData(e)
{
    e.preventDefault();
    let sendButton = document.getElementById('contactSendBtn');
    let form = document.getElementById('contactForm');

    //var csrfToken = $(form).find('input[name="_token"]').val();

    let formData = $(form).serialize();

    toggleButtons();
    toggleLoader();
    $.ajax({
        type:'POST',
        url:API_LINK+'/saveContactInfo',
        dataType:"json",
        data:formData,
        async:true,
        //headers:{'X-CSRF-TOKEN':csrfToken},
    }).done(function(response){

        newMessage(response.message,'text-lime-400');
        showMessageContainer(true);
        clearInfo();

    }).fail((function(xhr, status, error){

        let message = error;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }

        newMessage('Error: '+message,'text-red-400');
        showMessageContainer(true);
        console.log('Dev error: '+error);

    })).always(function(){
        
        toggleButtons()
        toggleLoader();
    });

}

function toggleLoader()
{
    let loader = document.getElementById("loaderDiv");
    let classes = Array.from(loader.classList);
    classes.includes("hidden") == true ? loader.classList.remove("hidden") : loader.classList.add("hidden");    
}

function toggleButtons()
{
    let sendButton = document.getElementById('contactSendBtn');
    let closeButton = document.getElementById('closePopupBtn');

    sendButton.disabled == true ? false:true;
    closeButton.disabled == true ? false:true;
}

function showMessageContainer(visible)
{
    let container = document.getElementById("contactForm_notification");       
    visible == true ? container.classList.remove("hidden") : container.classList.add("hidden");    
}

function newMessage(message,classColor)
{
    $("#contactForm_notification_text").removeClass();

    $("#contactForm_notification_text").addClass('font-semibold');
    $("#contactForm_notification_text").addClass(classColor);
    $("#contactForm_notification_text").text(message);
}

function clearInfo()
{
    $("#contactForm")[0].reset();
}

function toggleForm(e)
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
        clearInfo();
        document.body.style.overflow = '';
        popup.classList.add("hidden");
    }
}