import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';

document.addEventListener('DOMContentLoaded', () => {
    const heroSwiper = new Swiper('.hero-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        speed: 800,
        navigation: {
            nextEl: '.hero-next',
            prevEl: '.hero-prev',
        },
        pagination: {
            el: '.hero-pagination',
            clickable: true,
        },
    });
    // Gallery Swiper
    new Swiper('.gallery-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 20,
        loop: true,
        grabCursor: true,
        speed: 800,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                spaceBetween: 48,
            }
        }
    });
});