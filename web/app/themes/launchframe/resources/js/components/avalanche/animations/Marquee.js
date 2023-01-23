export default () => ({
    // π ----
    // :: SETTINGS ---------------------------::
    // ____
    x: {
        start: -80,
        end: -40,
    },

    start: 'top bottom',
    end: 'bottom top',
    scrub: 1,
    trigger: null,
    markers: false,

    // π ----
    // :: SETUP ---------------------------::
    // ____
    mounted() {
        if (!this.$refs.element) {
            // avalancheError.element('Marquee');
            return;
        }

        if (!this.trigger) {
            if (!this.$refs.container) {
                // avalancheError.trigger('Marquee');
                return;
            }

            this.trigger = this.$refs.container;
        }

        this.animate();
    },

    // π ----
    // :: ANIMATE ---------------------------::
    // ____
    animate() {

        gsap.fromTo(this.$refs.element,
            { xPercent: this.x.start },
            {
                xPercent: this.x.end,
                ease: 'none',

                scrollTrigger: {
                    start: this.start,
                    end: this.end,
                    trigger: this.$refs.container,
                    scrub: this.scrub,
                    markers: this.markers,
                }
            }
        );
    }
});
