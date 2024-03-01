import { API_LINK, WEB_LINK } from "../../consts.js";


$(function(){
    $("#sendBtn").on("click",createProject);
    $("#close_errors").on("click",toggleErrors);
});

function createProject()
{  
    var form_data = new FormData($("#form")[0]);  
    
    var file = $('#img')[0].files[0];    
    form_data.append('img', file);

    // form_data.append('title',$("#title").val());
    // form_data.append('slug',$("#slug").val());
    // form_data.append('description',$("#description").val());
    // form_data.append('github',$("#github").val());
    // form_data.append('web',$("#web").val());
    // form_data.append('tags',$("#tags").val());
    // form_data.append('visible',$("#visible_cbox").is(':checked'));
    // form_data.append('order',$("#orderInput").val());

    console.log(form_data);

    $.ajax({
       type:'POST',
       data:form_data,
       async:true,
       dataType:'json',
       url:API_LINK+'/projects/store',
       headers:{
        'Authorization':'Bearer '+sessionStorage.getItem('JWT_AUTH')
       },
       processData:false,
       contentType:false
    }).done(function(response){

        console.log("Todo OK");
        window.location.replace(WEB_LINK+"proyectos");

    }).fail(function(xhr, status, error){
        
        if(xhr.responseText)
        {
            var response = JSON.parse(xhr.responseText);
            if(response.errors)
            {
                var errors = Object.entries(response.errors);
                
                addErrors(errors);
                toggleErrors();

                errors.forEach(function(element){
                    //element[0] accede a la id del elemento.
                    //element[1] accede a otro array que contiene los errores.
                    showInputError(element[0]);
                    
                });
            }
            else
            {
                addSingleError(response.message);
                toggleErrors();
            }
        }
        


    }).always();

}

function showInputError(elementID)
{
    //var input = $("#"+elementID);
    var input = document.getElementById(elementID);
    //input.classList.remove("bg-gray-100");
    //input.classList.add("bg-red-100");
    input.classList.add("border");
    input.classList.add("border-red-400");
    // $("#"+elementID).removeClass("bg-gray-100");
    // $("#"+elementID).addClass("bg-red-200");
}

function toggleErrors()
{
    const err_prompt = document.getElementById("error_prompt");
    err_prompt.classList.toggle("hidden");
}

function addErrors(errors)
{
    var str = "";
    errors.forEach(function(element){
        str+="<li><strong>"+element[0]+"</strong>: "+element[1]+"</li><br>";
    });
    $("#lista_errores").html(str);
    
}

function addSingleError(message)
{
    $("#lista_errores").html("<li><strong>"+message+"</strong></li>");
}