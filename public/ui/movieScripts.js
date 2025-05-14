let currentIndex = 0;
const carousel = document.querySelector('.carousel');
const totalItems = document.querySelectorAll('.carousel-item').length;

// Function to move carousel items to the left
function moveToNext() {
    if (currentIndex < totalItems - 1) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateCarouselPosition();
}

// Function to move carousel items to the right
function moveToPrev() {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalItems - 1;
    }
    updateCarouselPosition();
}

// Function to update the carousel's position based on the current index
function updateCarouselPosition() {
    const offset = -(currentIndex * 220); // 220px is the width of each item + margin
    carousel.style.transform = `translateX(${offset}px)`;
}

// Automatic slide every 1 second
setInterval(moveToNext, 2000);

// Attach events to the arrows
document.querySelector('.left-arrow').addEventListener('click', moveToPrev);
document.querySelector('.right-arrow').addEventListener('click', moveToNext);

