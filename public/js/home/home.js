import { API_LINK } from "../consts.js";

function newRedirect(url)
{
    window.open(url,'_blank');
}

function saveNewInteraction(interactionType)
{
    let data = {};
    data.interaction = interactionType;

    $.ajax({
        type:'POST',
        url:API_LINK+'/saveInteraction',
        dataType:"json",
        data:data,
        async:true,
    }).done(function(response){

        console.log('Estadísticas: '+response.message);

    }).fail((function(xhr, status, error){

        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            console.log('Estadisticas: '+response.message);
        }
    }));
}

function saveNewPageView()
{
    $.ajax({
        type:'POST',
        url:API_LINK+'/saveGeneralView',
        dataType:"json",
        async:true,
    }).fail((function(xhr, status, error){
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            console.warn('Vista general: '+response.message);
        }
    }));
}

$(function(){                        

    $("#linkedinBtn").on("click", function(){newRedirect("https://www.linkedin.com/in/leandro-guia-dev/")});
    $("#githubBtn").on("click", function(){newRedirect("https://github.com/leanx22")});
    
    $("#linkedinBtn").on("click", function(){saveNewInteraction("vistas_linkedin")});
    $("#githubBtn").on("click", function(){saveNewInteraction("visitas_github")});

    $("#contactBtn").on("click", function(){saveNewInteraction("interacciones_contacto")});

    saveNewPageView();
});