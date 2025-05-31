document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.item');
    const dots = document.querySelectorAll('.dot');
    let current = 0;
    const slideDuration = 3000;

    function updateCarousel(index) {
        items.forEach((el, i) => {
            el.classList.toggle('hidden', i !== index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-gray-800', i === index);
            dot.classList.toggle('bg-gray-400', i !== index);
        });
    }

    function nextSlide() {
        current = (current + 1) % items.length;
        updateCarousel(current);
    }

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            current = parseInt(dot.dataset.index);
            updateCarousel(current);
        });
    });

    updateCarousel(current);
    setInterval(nextSlide, slideDuration);
});
