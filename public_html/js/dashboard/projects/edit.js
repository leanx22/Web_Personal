import { API_LINK, WEB_LINK } from "../../consts.js";


$(function(){
    $("#sendBtn").on("click",editProject);
    $("#deleteBtn").on("click",deleteProject);

    $("#del_form").on("submit",function(e){
        e.preventDefault();
    });

    $("#close_errors").on("click",toggleErrors);
});

function editProject()
{
    var form_data = new FormData($("#form")[0]);

    var file = $('#img')[0].files[0];
    if(file)
    {
        form_data.append('img', file);
    }

    $.ajax({
       type:'POST',
       data:form_data,
       async:true,
       dataType:'json',
       url:API_LINK+'/projects/update',
       headers:{
        'Authorization':'Bearer '+sessionStorage.getItem('JWT_AUTH')
       },
       processData:false,
       contentType:false
    }).done(function(response){

        window.location.replace(WEB_LINK+"proyectos");

    }).fail(function(xhr, status, error){

        if(xhr.responseText)
        {
            var response = JSON.parse(xhr.responseText);
            if(response.errors){
                var errors = Object.entries(response.errors);
                //console.log(errors[0][0]);
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

function deleteProject()
{
    var form_data = new FormData($("#del_form")[0]);    

    $.ajax({
       type:'POST',
       async:true,
       dataType:'json',
       url:API_LINK+'/projects/destroy',
       data:form_data,
       headers:{
        'Authorization':'Bearer '+sessionStorage.getItem('JWT_AUTH')
       },
       processData:false,
       contentType:false
    }).done(function(response){

        //window.location.replace(WEB_LINK+"proyectos");

    }).fail(function(xhr, status, error){
        console.error(error);
    }).always();

}

function showInputError(elementID)
{
    var input = document.getElementById(elementID);
    // input.classList.remove("bg-gray-100");
    // input.classList.add("bg-red-100");
    input.classList.add("border");
    input.classList.add("border-red-400");
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