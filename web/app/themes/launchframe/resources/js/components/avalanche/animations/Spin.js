export default () => ({
    duration: 100,
    scrollTrigger: true,
    scrollSettings: false,
    scrub: 0.6,
    start: 'top bottom',
    end: '200% top',
    rotate: '-120deg',

    mounted() {
        if (this.scrollTrigger) {
            this.scrollSettings = {
                start: this.start,
                end: this.end,
                trigger: this.$refs.element,
                scrub: this.scrub
            };
        }

        gsap.to(this.$refs.element, {
            duration: this.duration,
            rotate: this.rotate,
            ease: 'none',
            repeat: -1,
            scrollTrigger: this.scrollSettings
        });
    }
});
