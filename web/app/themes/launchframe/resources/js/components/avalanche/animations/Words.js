export default () => ({
    // π ----
    // :: SETTINGS ---------------------------::
    // ____
    x: {
        start: 0,
        end: 0,
    },

    y: {
        start: 101,
        end: 0,
    },

    opacity: {
        start: 1,
        end: 1,
    },

    splitText:{
        type: 'words, lines',
        linesClass: 'overflow-hidden',
        wordsClass: '-mt-6 pt-2 md:pt-0 pb-5 md:pb-4',
    },

    duration: 0.8,
    stagger: 0.06,
    delay: false,

    /* :: Easing
    {+} ---------------------------------- */
    ease: 'quint.out',

    /* :: ScrollTrigger
    {+} ---------------------------------- */
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,
    markers: false,

    // π ----
    // :: SETUP ---------------------------::
    // ____
    mounted() {
        if (!this.$refs.element) {
            // avalancheError.element('Words');
            return;
        }

        if (!this.trigger && this.scrollTrigger) {
            if (!this.$refs.container) {
                // avalancheError.trigger('Words');
                return;
            }

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

    // π ----
    // :: ANIMATE ---------------------------::
    // ____
    animate() {
        const split = new SplitText(this.$refs.element, this.splitText);

        gsap.fromTo(split.words,
            {
                opacity: this.opacity.start,
                xPercent: this.x.start,
                yPercent: this.y.start,
            },
            {
                opacity: this.opacity.end,
                xPercent: this.x.end,
                yPercent: this.y.end,

                duration: this.duration,
                stagger: this.stagger,
                delay: this.delay,
                ease: this.ease,
                scrollTrigger: this.scrollSettings
            }
        );

    }
})
