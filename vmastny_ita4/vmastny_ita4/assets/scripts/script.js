
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
})

document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
  hamburger.classList.remove("active");
  navMenu.classList.remove("active");
}))



function changePhoto()
{
    const slides = document.querySelector("[data-slides]")
    const activeSlide = slides.querySelector("[data-active]")
    let newIndex = [...slides.children].indexOf(activeSlide) + 1
    if (newIndex < 0) newIndex = slides.children.length - 1
    if (newIndex >= slides.children.length) newIndex = 0

    slides.children[newIndex].dataset.active = true
     delete activeSlide.dataset.active
     
}

setInterval(changePhoto, 4000);




var scrollTopBtn = document.getElementById("scrollTopBtn");
var footer = document.querySelector('.footer');
var isButtonVisible = false; 

window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    var scrollDistance = document.documentElement.scrollTop || document.body.scrollTop;
    var windowHeight = window.innerHeight;
    var footerRect = footer.getBoundingClientRect();

    if (footerRect.top < windowHeight) {
        scrollTopBtn.style.bottom = (windowHeight - footerRect.top + 20) + 'px';
    } else {
        scrollTopBtn.style.bottom = '20px';
    }

    
    if ((document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) && !isButtonVisible) {
        isButtonVisible = true; 
        scrollTopBtn.style.display = "block";
        setTimeout(function() {
            scrollTopBtn.style.opacity = 1;
        }, 10); 
    } else if ((document.body.scrollTop <= 20 && document.documentElement.scrollTop <= 20) && isButtonVisible) {
        isButtonVisible = false; 
        scrollTopBtn.style.opacity = 0;
        setTimeout(function() {
            scrollTopBtn.style.display = "none";
        }, 400); 
    }
}

// Smooth scroll to top
scrollTopBtn.onclick = function() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}; 