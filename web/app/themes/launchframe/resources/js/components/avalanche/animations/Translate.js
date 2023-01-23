export default () => ({
    axis: 'y', // or 'x'

    x: {
        start: null,
        end: 50,
    },

    y: {
        start: null,
        end: 50,
    },

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
            if (this.x.start) {
                animation.fromTo(
                    this.$refs.element,
                    { xPercent: this.x.start },
                    {
                        xPercent: this.x.end,
                        duration: this.duration,
                        ease: this.ease
                    }
                );
            } else {
                animation.to(this.$refs.element, {
                    xPercent: this.x.end,
                    duration: this.duration,
                    ease: this.ease
                });
            }
        } else {
            if (this.y.start) {
                animation.fromTo(
                    this.$refs.element,
                    { yPercent: this.y.start },
                    {
                        yPercent: this.y.end,
                        duration: this.duration,
                        ease: this.ease
                    }
                );
            } else {
                animation.to(this.$refs.element, {
                    yPercent: this.y.end,
                    duration: this.duration,
                    ease: this.ease
                });
            }
        }
    }
})
