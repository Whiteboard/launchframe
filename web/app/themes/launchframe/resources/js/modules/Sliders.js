import Swiper, { Navigation, Keyboard, Pagination, EffectFade, Controller } from 'swiper'
import 'swiper/swiper-bundle.min.css'

export default () => {
    return {
        mounted() {
            const testimonialSlider = new Swiper('.testimonial-slider', {
                modules: [Navigation, Pagination, EffectFade],
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
                navigation: {
                    nextEl: '.testimonial-slider-next',
                    prevEl: '.testimonial-slider-prev',
                },
            })

            const cardSlider = new Swiper('.card-slider', {
                modules: [Navigation],
                loop: true,
                slidesPerView: 1,
                spaceBetween: 36,
                breakpoints: {
                    800: {
                        slidesPerView: 2,
                    },
                    1000: {
                        slidesPerView: 3,
                    },
                    1200: {
                        slidesPerView: 2.75,
                    },
                    1700: {
                        slidesPerView: 3.25,
                    },
                    2000: {
                        slidesPerView: 4.25,
                    },
                    2500: {
                        slidesPerView: 5,
                    },
                },
                navigation: {
                    nextEl: '.card-slider-next',
                    prevEl: '.card-slider-prev',
                },
            })
        },
    }
}
