const animations = {
    'fade-in': 'fade-in-play',
    'fade-in-blur':'fade-in-blur-play',
    'fade-in-right-blur': 'fade-in-right-blur-play',
    'fade-in-up-blur': 'fade-in-up-blur-play',
    'fade-in-left-blur': 'fade-in-left-blur-play',
};

$(function(){

    const observer = new IntersectionObserver((elementos) => {
        elementos.forEach(elemento => {
            if (elemento.isIntersecting) {
                const animationClass = Object.keys(animations).find(key => elemento.target.classList.contains(key));
                if (animationClass) {
                    elemento.target.classList.add(animations[animationClass]);
                }
            }
            else
            {
                const animationClass = Object.keys(animations).find(key => elemento.target.classList.contains(key));
                elemento.target.classList.remove(animations[animationClass]);
            }
        });
    });
    
    const hiddenElements = document.querySelectorAll('.animated');
    hiddenElements.forEach((elemento)=>{
        observer.observe(elemento);
    });

});

