export default () => ({
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,
    opacityDuration: 0.5,
    xStart: -100,
    xEnd: 0,
    yStart: 80,
    yEnd: 0,
    translate: null,
    scale: false,
    scaleStart: 1.1,
    scaleEnd: 1,

    mounted() {
        if (!this.trigger) {
            this.trigger = this.$refs.element;
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
            this.delay = this.$store.animationDelay;
        }

        const animation = gsap.timeline({
            delay: this.delay,
            scrollTrigger: this.scrollSettings
        });

        animation.addLabel('start');

        animation.fromTo(this.$refs.element, { opacity: 1 }, { duration: this.opacityDuration, opacity: 0 }, 'start');

        if (this.translate === 'x') {
            animation.fromTo(
                this.$refs.element,
                { xPercent: this.xStart },
                { duration: 0.3, xPercent: this.xEnd },
                'start'
            );

        } else if (this.translate === 'y') {
            animation.fromTo(
                this.$refs.element,
                { yPercent: this.yStart },
                { duration: 0.3, yPercent: this.yEnd },
                'start'
            );
        }

        if (this.scale) {
            animation.fromTo(
                this.$refs.element,
                { scale: this.scaleStart },
                { duration: 0.4, scale: this.scaleEnd, ease: 'circ.inOut' },
                'start'
            );
        }
    },
})
