//editprofile
// JavaScript for content sliding functionality
let currentSlide = 0;
const slides = document.querySelectorAll('#content-slider .content');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'flex' : 'none';
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

// Initialize the first slide
showSlide(currentSlide);
// JavaScript for content sliding functionality



//for mouse or mobile sliding page
let startX = 0;
let endX = 0;

function startSwipe(e) {
    startX = e.type === "mousedown" ? e.clientX : e.touches[0].clientX;
}

function endSwipe(e) {
    endX = e.type === "mouseup" ? e.clientX : e.changedTouches[0].clientX;
    handleSwipe();
}


function handleSwipe() {
    if (startX > endX + 50) {
        nextSlide();
    } else if (startX < endX - 50) {
        prevSlide();
    }
}

const contentSlider = document.getElementById("content-slider");

contentSlider.addEventListener("mousedown", startSwipe);
contentSlider.addEventListener("mouseup", endSwipe);
contentSlider.addEventListener("touchstart", startSwipe);
contentSlider.addEventListener("touchend", endSwipe);
//for mouse or mobile sliding page
