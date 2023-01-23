export default () => ({
    axis: 'y', // or 'x'
    xStart: -101,
    yStart: 101,
    duration: 1.2,
    stagger: 0.1,
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 80%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    linesClass: 'overflow-hidden',
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
                markers: this.markers
            };
        }

        this.animate();
    },

    animate() {
        const animation = gsap.timeline({ defaults: { ease: 'expo.out' }, scrollTrigger: this.scrollSettings });

        const split = new SplitText(this.$refs.element, {
            type: 'lines',
            linesClass: this.linesClass,
        });

        if (this.axis === 'x') {
            animation.from(split.lines, {
                xPercent: this.xStart,
                duration: this.duration,
                stagger: this.stagger,
                delay: this.delay
            });

        } else if (this.axis === 'y') {
            animation.from(split.lines, {
                yPercent: this.yStart,
                opacity: 0,
                duration: this.duration,
                stagger: this.stagger,
                delay: this.delay
            });
        }
    }
})
