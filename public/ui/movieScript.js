const carousel = document.querySelector('.carousel');
const items = document.querySelectorAll('.carousel-item');
const leftArrow = document.querySelector('.arrow.left');
const rightArrow = document.querySelector('.arrow.right');

if (items.length > 0) {
    let index = 0;
    let itemWidth = items[0].offsetWidth + 10; // item + gap
    let visibleItems = Math.floor(document.querySelector('.carousel-container').offsetWidth / itemWidth);
    let maxIndex = items.length - visibleItems;

    function updateCarousel() {
        carousel.style.transform = `translateX(-${index * itemWidth}px)`;
    }

    leftArrow.addEventListener('click', () => {
        index = Math.max(index - 1, 0);
        updateCarousel();
    });

    rightArrow.addEventListener('click', () => {
        index = Math.min(index + 1, maxIndex);
        updateCarousel();
    });

    setInterval(() => {
        index = (index + 1) > maxIndex ? 0 : index + 1;
        updateCarousel();
    }, 2000);
}
