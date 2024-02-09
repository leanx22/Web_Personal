import { API_LINK } from "../consts.js";

function registerInteraction(id, type)
{
    let data = [];
    data.type = type;
    data.projectId = id;
    
    $.ajax({
        type:'POST',
        url:API_LINK+'/saveInteraction',
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


$(function(){




});