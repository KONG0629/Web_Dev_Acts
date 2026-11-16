const mainHead = document.querySelector('.main-head');
const showcase = document.querySelector('.showcase');

const title = document.querySelector('.title');
const overlay = document.querySelector('.overlay');
const toggler1 = document.querySelector('.toggler1');
const toggler = document.querySelector('.toggler');

toggler.addEventListener('click', function () {
    mainHead.classList.toggle('active');
    overlay.classList.toggle('disabled');
    // Hide toggler when clicked
    toggler.style.display = 'none';
});

toggler1.addEventListener('click', function () {
    mainHead.classList.toggle('active');
    title.classList.toggle('width');
    // Show toggler when toggler1 is clicked
    toggler.style.display = 'inline-block';
});
