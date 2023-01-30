import Swiper, { Navigation, Keyboard, Pagination, EffectFade, Controller } from 'swiper';
import 'swiper/swiper-bundle.min.css';

export default () => {
    return {
        mounted() {

            const testimonialSlider = new Swiper('.testimonial-slider', {
            modules: [Navigation, Pagination, EffectFade],
            loop: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: '.testimonial-slider-next',
                prevEl: '.testimonial-slider-prev'
            },
            });

        }
    }
}
