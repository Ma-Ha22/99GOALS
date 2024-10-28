let currentWorkSlide = 0;
const imagesWorkToShow = 4; // Number of images to show at a time
const totalImagesWork = document.querySelectorAll('.work_slider img').length;

function moveWorkSlide(direction) {
    const slider = document.querySelector('.work_slider');
    const imageWidth = document.querySelector('.work_slider img').clientWidth;

    // Update the currentWorkSlide index
    currentWorkSlide += direction;

    // Ensure the currentWorkSlide doesn't exceed bounds
    if (currentWorkSlide < 0) {
        currentWorkSlide = totalImagesWork - imagesWorkToShow; // Prevent moving before the first set
    } else if (currentWorkSlide > totalImagesWork - imagesWorkToShow) {
        currentWorkSlide = 0; // Prevent moving beyond the last set
    }

    // Move the slider by adjusting the transform
    slider.style.transform = `translateX(-${currentWorkSlide * imageWidth}px)`;
}

window.addEventListener('resize', () => {
    // Update the slider position on window resize
    const imageWidth = document.querySelector('.slider img').clientWidth;
    document.querySelector('.slider').style.transform = `translateX(-${currentWorkSlide * imageWidth}px)`;
});

// end work section 
//





let currentSlide = 0;
const imagesToShow = 4; // Number of images to show at a time
const totalImages = document.querySelectorAll('.slider img').length;

function moveSlide(direction) {
    const slider = document.querySelector('.slider');
    const imageWidth = document.querySelector('.slider img').clientWidth;

    // Update the currentSlide index
    currentSlide += direction;

    // Ensure the currentSlide doesn't exceed bounds
    if (currentSlide < 0) {
        currentSlide = totalImages - imagesToShow; // Prevent moving before the first set
    } else if (currentSlide > totalImages - imagesToShow) {
        currentSlide = 0; // Prevent moving beyond the last set
    }

    // Move the slider by adjusting the transform
    slider.style.transform = `translateX(-${currentSlide * imageWidth}px)`;
}

window.addEventListener('resize', () => {
    // Update the slider position on window resize
    const imageWidth = document.querySelector('.slider img').clientWidth;
    document.querySelector('.slider').style.transform = `translateX(-${currentSlide * imageWidth}px)`;
});
















// Function to animate the counters


function animateCounter(id, start, end, duration) {
    const obj = document.getElementById(id);
    const range = end - start;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const progress = Math.min((currentTime - startTime) / duration, 1);
        obj.innerText = Math.floor(progress * range + start).toLocaleString();
        if (progress < 1) {
            requestAnimationFrame(animation);
        }
    }
    requestAnimationFrame(animation);
}

// Initializing the counters
document.addEventListener('DOMContentLoaded', () => {
    animateCounter('reach', 0, 4438086, 3000); 
    animateCounter('results', 0, 86880, 3000);
    animateCounter('cpc', 0, 0.001, 3000);  
});
