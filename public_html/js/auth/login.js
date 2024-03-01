import { API_LINK, WEB_LINK } from "../consts.js";

$(function(){

    $("#sendBtn").on("click", login);

});

function toggleBtn()
{
    let sendButton = document.getElementById('sendBtn');
    sendButton.disabled == true ? false:true;
}

function toggleLoader()
{
    let loader = document.getElementById("loader_container");
    let classes = Array.from(loader.classList);
    classes.includes("hidden") == true ? loader.classList.remove("hidden") : loader.classList.add("hidden");    
}

function showMessage(message, success)
{
    let container = document.getElementById("message_container");
    let text = document.getElementById("message_text");

    container.classList.remove("bg-red-200");
    container.classList.remove("bg-lime-200");

    text.classList.remove("text-red-500");
    text.classList.remove("text-green-600");

    container.classList.remove("hidden")
    if(success == true)
    {
        container.classList.add("bg-lime-200");
        text.classList.add("text-green-600");
        //text.classList.add("font-semibold");
    }
    else
    {
        container.classList.add("bg-red-200");
        text.classList.add("text-red-500");
    }
       
    text.innerHTML = message;
}

function login(e)
{
    let form = document.getElementById('loginForm');
    let formData = $(form).serialize();
    
    e.preventDefault();

    toggleBtn();
    toggleLoader();
    
    $.ajax({
        type:'POST',
        url:API_LINK+'/getJWT',
        dataType:"json",
        data:formData,
        async:true,
    }).done(function(response){

        sessionStorage.setItem('JWT_AUTH',response.JWT);
        showMessage(response.message+" Redireccionando...",true);
        
        setTimeout(form.submit(),2000);
        
    }).fail((function(xhr, status, error){

        let message = error;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }
        showMessage(message,false);
        console.log('Dev error: '+error);

    })).always(function(){
        toggleLoader();
        toggleBtn();
    });

}



