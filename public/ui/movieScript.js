document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
    const carousel = wrapper.querySelector('.carousel');
    const items = carousel.querySelectorAll('.movie-card');
    const itemCount = items.length;

    // Clone all items and append to enable infinite scroll
    items.forEach(item => {
        const clone = item.cloneNode(true);
        carousel.appendChild(clone);
    });

    const totalItems = itemCount * 2; // original + clone count
    const itemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginRight) || 0;

    let index = 0; // current item index
    const delay = 4000; // ms to pause on each item

    function scrollToIndex(i) {
        // Scroll smoothly to item i
        carousel.scrollTo({
            left: i * itemWidth,
            behavior: 'smooth'
        });
    }

    function step() {
        index++;
        // If reached the cloned items, reset scrollLeft and index seamlessly
        if (index >= itemCount) {
            carousel.scrollLeft = 0;
            index = 0;
        }

        scrollToIndex(index);

        setTimeout(step, delay);
    }

    // Start the carousel
    step();

    // Optional: pause on hover
    let timeoutId;
    wrapper.addEventListener('mouseenter', () => {
        clearTimeout(timeoutId);
    });

    wrapper.addEventListener('mouseleave', () => {
        timeoutId = setTimeout(step, delay);
    });
});
//nouman