window.onload = function(){
    var scrolled;
    var timer; 
    
    if(document.getElementById('button') != null)
    {
        document.getElementById('button').onclick = function(){
            scrolled = window.pageYOffset;
            scrollToTop();
        }
        function scrollToTop() {
            //alert(1);
            if (scrolled > 0) {
                window.scrollTo(0,scrolled);
                scrolled = scrolled - 30; 
                timer = setTimeout(scrollToTop, 3);
            }
            else {
                clearTimeout(timer);
                window.scrollTo(0,0);
            }
            
        }
    }
} 

const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        nav.classList.toggle('nav-active');

        navLinks.forEach((link, index) => {
            if (link.style.animation){
                link.style.animation = '';
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
            }
        }); 
    });
}

navSlide();
