export default () => ({
    scaleStart: 1.28,
    scaleEnd: 1.28,
    yStart: -25,
    yEnd: 25,
    start: 'top bottom',
    end: 'bottom top',
    scrub: true,
    markers: false,
    trigger: null,

    mounted() {
        if (!this.trigger) {
            this.trigger = this.$refs.container;
        }

        gsap.fromTo(
            this.$refs.background,
            { yPercent: this.yStart, scale: this.scaleStart },
            {
                yPercent: this.yEnd,
                scale: this.scaleEnd,
                ease: 'none',
                scrollTrigger: {
                    start: this.start,
                    end: this.end,
                    trigger: this.trigger,
                    markers: this.markers,
                    scrub: this.scrub
                }
            }
        );
    }
})
