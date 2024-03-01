import { API_LINK, WEB_LINK } from "../consts.js";

$(function(){    
    getProjectLinks();
    getProjectStats();
    newInteraction("views");
});

function newInteraction(interactionType)
{
    var data = {
        project:getSlugFromURL(),
        type:interactionType
    };

    $.ajax({
        type:'POST',
        url:API_LINK+'/projects/stats/increment',
        dataType:"json",
        data:data,
        async:true,
    }).fail((function(xhr, status, error){

        let message = error;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }

        console.log('Dev error: '+error+" | Message:"+message);

    }));

}

function getProjectLinks()
{
    var githubLink = null;
    var webLink = null;

    $.ajax({
        type:'GET',
        url:API_LINK+'/projects/links/'+getSlugFromURL(),
        dataType:"json",
        async:true,
    }).done(function(response){

        githubLink = response.links.github;
        webLink = response.links.web;
        setLinks(githubLink, webLink);

    }).fail((function(xhr, status, error){

        let message = error;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }

        console.log('Dev error: '+error+" | Message:"+message);

    }));
}

function getProjectStats()
{
    $.ajax({
        type:'GET',
        url:API_LINK+'/projects/stats/'+getSlugFromURL(),
        dataType:"json",
        async:true,
    }).done(function(response){

        setStats(response.stats.views,response.stats.interactions);

    }).fail((function(xhr, status, error){

        let message = error;
        if(xhr.responseText)
        {
            let response = JSON.parse(xhr.responseText);
            message = response.message;
        }

        console.log('Dev error: '+error+" | Message:"+message);

    }));
}

function getSlugFromURL()
{
    var proj = window.location.href;
    proj = proj.split('proyectos/');
    return proj[1];
}

function setLinks(github, web)
{
    if(github)
    {
        $("#btn_github").prop("disabled",false);
        $("#btn_github").on("click",function(){
            window.open(github,'_blank');
            newInteraction('interactions');
        });
    }

    if(web)
    {
        $("#btn_web").prop("disabled",false);
        $("#btn_web").on("click",function(){
            window.open(web,'_blank');
            newInteraction('interactions');
        });
    }
}

function setStats(views, interactions)
{
    $("#stat_views").html("Veces visto: "+views);
    $("#stat_interactions").html("Cant. interacciones: "+interactions);
}