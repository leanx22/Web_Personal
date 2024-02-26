const observer = new IntersectionObserver((elementos)=>{

    elementos.forEach((elemento)=>{
        if(elemento.isIntersecting)
        {           
            if(elemento.target.classList.contains('left-to-right'))
            {
                elemento.target.classList.add("animate-fade-in-right");
            }else if(elemento.target.classList.contains('bot-to-top'))
            {
                elemento.target.classList.add("animate-fade-in-up");
            }
            else
            {
                elemento.target.classList.add("animate-fade-in-left");
            }
            
            elemento.target.classList.add("animate-duration-1000");
        }
    });

});

const hiddenElements = document.querySelectorAll('.scrollIn');
console.log(hiddenElements);
hiddenElements.forEach((elemento)=>{
    observer.observe(elemento);
});
