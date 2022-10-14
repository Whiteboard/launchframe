export default () => ({
    axis: 'y', // or 'x'
    xStart: null,
    xEnd: 50,
    yStart: null,
    yEnd: 50,
    duration: 0.5,
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,
    ease: 'quad.inOut',

    mounted() {
        if (!this.trigger) {
            this.trigger = this.$refs.container;
        }

        if (this.scrollTrigger) {
            this.scrollSettings = {
                start: this.start,
                end: this.end,
                toggleActions: this.toggleActions,
                trigger: this.trigger
            };
        }

        const animation = gsap.timeline({
            delay: this.delay,
            scrollTrigger: this.scrollSettings
        });

        if (!this.delay) {
            this.delay = this.$store.animationDelay;
        }

        if (this.axis == 'x') {
            if (this.xStart) {
                animation.fromTo(
                    this.$refs.element,
                    { xPercent: this.xStart },
                    {
                        xPercent: this.xEnd,
                        duration: this.duration,
                        ease: this.ease
                    }
                );
            } else {
                animation.to(this.$refs.element, {
                    xPercent: this.xEnd,
                    duration: this.duration,
                    ease: this.ease
                });
            }
        } else {
            if (this.yStart) {
                animation.fromTo(
                    this.$refs.element,
                    { yPercent: this.yStart },
                    {
                        yPercent: this.yEnd,
                        duration: this.duration,
                        ease: this.ease
                    }
                );
            } else {
                animation.to(this.$refs.element, {
                    yPercent: this.yEnd,
                    duration: this.duration,
                    ease: this.ease
                });
            }
        }
    },

    xTranslate() {
    },

    yTranslate() {
    }
})
