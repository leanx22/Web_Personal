import { API_LINK, WEB_LINK } from "../consts.js";

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

function toggleProjectsPlaceHolder()
{
    $('.proj-placeholder').hasClass('hidden') ? $('.proj-placeholder').remove('hidden') : $('.proj-placeholder').addClass('hidden');
}

function getProjects()
{   
    return new Promise((resolve, reject)=>{

        $.ajax({
            type:'GET',
            url:API_LINK+'/projects',
            dataType:"json",
            async:true,
        })
        .done(function (response){
            resolve(response.results);
        })
        .fail((function(xhr, status, error){
            console.error('No se pudo obtener los proyectos:'+error);
            reject(null);
        }));

    });
}

async function printProjects()
{
    console.time('Proyectos');
    toggleProjectsPlaceHolder();
    
    try{
        
        let projects = await getProjects();        
        if(projects == null)
        {
            console.warn('No hay proyectos'); 
            return;
        }

        let container = document.getElementById('proj_container');
        let bloque="";

        for(let project of projects)
        {            
            let link = WEB_LINK+"proyectos/"+project.slug;
            let tagshtml="";
            for(let tag of project.tags)
            {
                tagshtml+='<label class="text-white text-center font-semibold bg-white/25 backdrop-blur-lg p-2 min-w-[58px] ms-1 rounded-lg">'+tag+'</label>\r\n';
            }
            
            bloque += '<div class="col-span-12 md:col-span-6 flex flex-col bg-white mx-2 xl:mx-20 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14 hover:scale-[1.02] auto_fade">\
            <div class="relative">\
              <img class="rounded-t-lg min-w-full min-h-full" src="img/'+project.image+'" alt="Imagen del proyecto">\
              <div class="absolute inset-0 flex items-end justify-end p-4">\
              '+tagshtml+'\
              </div>\
            </div>\
            <div class="flex flex-col mt-3">\
              <h2 class="text-[24px] font-bold ms-4">'+project.title+'</h2>\
              <div class="flex items-center p-1 ps-4 min-h-[138px] md:min-h-[124px] lg:min-h-[110px]">\
                <p class="text-start text-[15px] lg:text-[18px]">\
                  '+project.description+'\
                </p>\
              </div>\
            </div>\
            <div class="flex items-end justify-end p-1 min-h-[52px] max-h-[52px]">\
              <a href="'+link+'" class="m-1 p-1 px-3 min-h-10 min-w-24 bg-black rounded-lg text-white font-semibold auto_fade text-center">\
                <p class="my-1">Ver mas</p>\
              </a>\
            </div>\
          </div>\r\n';
        }

        //Si es impar, coloco una tarjeta para mejorar el diseno
        if((projects.length)%2 != 0)
        {
            bloque += '<div class="col-span-12 md:col-span-6 flex items-center justify-center bg-gray-100 mx-2 xl:mx-20 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14">\
            <label class="w-full h-auto text-[29px] lg:text-[38px] text-center text-gray-400 font-semibold">Más proyectos próximamente...</label></div>';
        }

        container.innerHTML = bloque;

    }catch(e){
        console.error('No se pudo imprimir los proyectos: '+e);
        //poner algo en la pag para que no quede el espacio vacío
    }
    toggleProjectsPlaceHolder();
    console.timeEnd("Proyectos");
}

function changeNavBg()
{
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 150) {
        navbar.classList.add('backdrop-blur-md');
        navbar.classList.add('bg-black/50');
        navbar.classList.add('shadow-md');
    } else {
        navbar.classList.remove('backdrop-blur-md');
        navbar.classList.remove('bg-black/50');
        navbar.classList.remove('shadow-md');
        //hacer transparente
    }
}

$(function(){                        

    window.addEventListener('scroll', changeNavBg);
    
    $("#linkedinBtn").on("click", function(){newRedirect("https://www.linkedin.com/in/leandro-guia-dev/")});
    $("#githubBtn").on("click", function(){newRedirect("https://github.com/leanx22")});
    
    $("#linkedinBtn").on("click", function(){saveNewInteraction("vistas_linkedin")});
    $("#githubBtn").on("click", function(){saveNewInteraction("visitas_github")});

    $("#contactBtn").on("click", function(){saveNewInteraction("interacciones_contacto")});

    printProjects();
    saveNewPageView();
    
});