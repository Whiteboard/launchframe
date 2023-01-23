export default () => ({
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    stagger: 0.015,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,
    markers: false,

    mounted() {
        if (!this.trigger) {
            this.trigger = this.$refs.container;
        }

        if (this.scrollTrigger) {
            this.scrollSettings = {
                start: this.start,
                end: this.end,
                toggleActions: this.toggleActions,
                trigger: this.trigger,
                markers: this.markers,
            };
        }

        this.animate();
    },

    animate() {
        const split = new SplitText(this.$refs.element, {
            type: 'chars, words, lines',
            wordsClass: 'py-1',
            linesClass: 'overflow-hidden'
        });

        gsap.from(split.chars, {
            opacity: 0,
            xPercent: -15,
            yPercent: 30,
            scale: 0.9,
            rotate: '5deg',
            duration: 0.8,
            stagger: this.stagger,
            delay: this.delay,
            ease: 'expo.out',
            scrollTrigger: this.scrollSettings
        });
    }
})
