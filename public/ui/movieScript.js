document.addEventListener("DOMContentLoaded", () => {
    const carousels = document.querySelectorAll('.carousel-wrapper');

    carousels.forEach((wrapper, index) => {
        const carousel = wrapper.querySelector('.carousel');
        const prevBtn = wrapper.querySelector('.prev-btn');
        const nextBtn = wrapper.querySelector('.next-btn');
        const item = carousel.querySelector('.movie-card');

        if (!carousel || !item) return;

        const itemWidth = item.offsetWidth + 20;

        // Function to append cloned items when reaching the end
        const maybeCloneItems = () => {
            if (carousel.scrollLeft + carousel.offsetWidth >= carousel.scrollWidth - itemWidth) {
                const items = carousel.querySelectorAll('.movie-card');
                items.forEach(cloneItem => {
                    const newItem = cloneItem.cloneNode(true);
                    carousel.appendChild(newItem);
                });
            }
        };

        prevBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: -itemWidth, behavior: 'smooth' });
        });

        nextBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: itemWidth, behavior: 'smooth' });
            maybeCloneItems();
        });

        if (index === 0) {
            let autoScroll = setInterval(() => {
                carousel.scrollBy({ left: itemWidth, behavior: 'smooth' });
                maybeCloneItems();
            }, 3000);

            wrapper.addEventListener("mouseenter", () => clearInterval(autoScroll));
            wrapper.addEventListener("mouseleave", () => {
                autoScroll = setInterval(() => {
                    carousel.scrollBy({ left: itemWidth, behavior: 'smooth' });
                    maybeCloneItems();
                }, 3000);
            });
        }
    });
});
