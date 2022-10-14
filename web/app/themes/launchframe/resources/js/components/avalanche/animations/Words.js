export default () => {
    return {
        delay: false,
        scrollTrigger: true,
        scrollSettings: false,
        yPercent: 101,
        duration: 0.5,
        start: 'top 85%',
        end: 'bottom top',
        toggleActions: 'play none play none',
        wordClass: '-mt-2 py-1',
        trigger: null,
        markers: false,

        mounted() {
            if (!this.trigger) {
                this.trigger = this.$refs.element;
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
                type: 'words, lines',
                linesClass: 'overflow-hidden',
                wordsClass: this.wordClass,
            });

            gsap.from(split.words, {
                yPercent: this.yPercent,
                duration: this.duration,
                stagger: 0.08,
                delay: this.delay,
                ease: 'quint.out',
                scrollTrigger: this.scrollSettings
            });
        }
    };
};
