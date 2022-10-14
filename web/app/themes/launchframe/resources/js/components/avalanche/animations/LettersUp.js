export default () => ({
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    duration: 0.8,
    opacity: 0,
    yPercent: 60,
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

        if (!this.delay) {
            this.delay = this.$store.animationDelay;
        }

        this.animate();
    },

    animate() {
        const split = new SplitText(this.$refs.element, {
            type: 'chars, words, lines',
            wordsClass: '-mt-2 py-1',
            linesClass: 'overflow-hidden'
        });

        gsap.from(split.chars, {
            opacity: this.opacity,
            yPercent: this.yPercent,
            duration: this.duration,
            stagger: this.stagger,
            delay: this.delay,
            ease: 'expo.out',
            scrollTrigger: this.scrollSettings
        });
    }
})
