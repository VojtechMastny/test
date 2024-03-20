
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




