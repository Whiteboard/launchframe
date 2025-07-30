import Swiper, { Navigation, Keyboard, Pagination, EffectFade, Controller } from 'swiper'
import 'swiper/swiper-bundle.min.css'

export default () => {
    return {
        testimonialSliderHash: null,
        cardSliderHash: null,

        mounted() {
            const testimonialSlider = new Swiper(`.testimonial-slider-${this.testimonialSliderHash}`, {
                modules: [Navigation, Pagination, EffectFade],
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
                navigation: {
                    nextEl: `.testimonial-slider-next-${this.testimonialSliderHash}`,
                    prevEl: `.testimonial-slider-prev-${this.testimonialSliderHash}`,
                },
            })

            const cardSlider = new Swiper(`.card-slider-${this.cardSliderHash}`, {
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
                    nextEl: `.card-slider-next-${this.cardSliderHash}`,
                    prevEl: `.card-slider-prev-${this.cardSliderHash}`,
                },
            })
        },
    }
}
