document.addEventListener('DOMContentLoaded', function() {
    // Get slider elements
    const heroSlider = document.querySelector('.hero-slider');
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-slider-dot');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    const heroTitle = document.getElementById('hero-title');
    const heroDescription = document.getElementById('hero-description');

    let currentSlide = 0;
    const totalSlides = heroSlides.length;

    // Function to update content based on current slide
    function updateContent(index) {
        const slide = heroSlides[index];
        const currentLang = document.documentElement.lang || 'en';
        
        // Update title
        heroTitle.textContent = slide.dataset[`title${currentLang === 'en' ? 'En' : 'Ar'}`];
        
        // Update description
        heroDescription.textContent = slide.dataset[`desc${currentLang === 'en' ? 'En' : 'Ar'}`];
    }

    // Function to show slide
    function showSlide(index) {
        // Update slides
        heroSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        // Update dots
        heroDots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        // Update content
        updateContent(index);

        currentSlide = index;
    }

    // Navigation
    nextBtn.addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    });

    prevBtn.addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    });

    // Dot navigation
    heroDots.forEach(dot => {
        dot.addEventListener('click', () => {
            const slideIndex = parseInt(dot.dataset.index);
            showSlide(slideIndex);
        });
    });

    // Auto-slide
    let slideInterval = setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }, 5000);

    // Pause on hover
    heroSlider.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
    });

    heroSlider.addEventListener('mouseleave', () => {
        slideInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }, 5000);
    });

    // Language switching support
    window.addEventListener('languageChanged', (e) => {
        updateContent(currentSlide);
    });

    // Initialize first slide
    showSlide(0);
}); 