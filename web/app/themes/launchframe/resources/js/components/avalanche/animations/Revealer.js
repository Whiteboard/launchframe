export default () => ({
    direction: 'right',
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,
    translate: null,

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

        if (!this.delay) {
            this.delay = this.$store.site.animationDelay;
        }

        const animation = gsap.timeline({
            delay: this.delay,
            scrollTrigger: this.scrollSettings,
        });

        gsap.set(this.$refs.element, { autoAlpha: 0 });

        if (this.direction === 'left' || this.direction === 'right') {
            this.revealX(animation);
        } else if (this.direction === 'top' || this.direction === 'bottom') {
            this.revealY(animation);
        }
    },

    revealX(animation) {
        const start = this.direction === 'left' ? 101 : -101;
        const end = this.direction === 'left' ? -101 : 101;

        animation
            .fromTo(this.$refs.curtain, { xPercent: start }, { duration: 0.55, xPercent: 0, ease: 'expo.inOut' });

        if (this.$refs.cover) {
            animation.set(this.$refs.cover, { opacity: 0 });
        }

        animation
            .set(this.$refs.element, { autoAlpha: 1 })
            .to(this.$refs.curtain, { duration: 0.55, xPercent: end, ease: 'expo.inOut' });

        if (this.$refs.curtainWrapper) {
            animation.to(this.$refs.curtainWrapper, { autoAlpha: 0, duration: 0.2 });
        }
    },

    revealY(animation) {
        const start = this.direction === 'bottom' ? 101 : -101;
        const end = this.direction === 'bottom' ? -101 : 101;

        animation
            .fromTo(this.$refs.curtain, { yPercent: start }, { duration: 0.55, yPercent: 0, ease: 'expo.inOut' });

        if (this.$refs.cover) {
            animation.set(this.$refs.cover, { opacity: 0 });
        }

        animation
            .set(this.$refs.element, { autoAlpha: 1 })
            .to(this.$refs.curtain, { duration: 0.55, yPercent: end, ease: 'expo.inOut' });

        if (this.$refs.curtainWrapper) {
            animation.to(this.$refs.curtainWrapper, { autoAlpha: 0, duration: 0.2 });
        }
    }
})
