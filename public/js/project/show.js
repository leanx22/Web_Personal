import { API_LINK, WEB_LINK } from "../consts.js";

$(function(){

    //newInteraction();


});


function newInteraction(interactionType)
{

    var proj = window.location.href;
    proj = proj.split('proyectos/');
    var data = {
        project:proj[1],
        type:interactionType
    };

    $.ajax({
        type:'POST',
        url:API_LINK+'/'+proj[1],
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

