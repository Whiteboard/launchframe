export default () => ({
        xStart: -80,
        xEnd: -40,
        scope: null,
        start: 'top bottom',
        end: 'bottom top',
        scrub: 1,

        mounted() {
            if (!this.scope) {
                this.marquee();
            } else {
                this.setBreakpoint();
            }
        },

        setBreakpoint() {
            if (this.scope === 'xl') {
                ScrollTrigger.matchMedia({
                    '(min-width: 1280px)': () => {
                        this.marquee();
                    }
                });
            } else if (this.scope === 'lg') {
                ScrollTrigger.matchMedia({
                    '(min-width: 1024px)': () => {
                        this.marquee();
                    }
                });
            } else if (this.scope === 'md') {
                ScrollTrigger.matchMedia({
                    '(min-width: 768px)': () => {
                        this.marquee();
                    }
                });
            } else if (this.scope === 'sm') {
                ScrollTrigger.matchMedia({
                    '(min-width: 640px)': () => {
                        this.marquee();
                    }
                });
            }
        },

        marquee() {
            gsap.fromTo(
                this.$refs.element,
                { xPercent: this.xStart },
                {
                    xPercent: this.xEnd,
                    ease: 'none',
                    scrollTrigger: {
                        start: this.start,
                        end: this.end,
                        trigger: this.$refs.container,
                        scrub: this.scrub
                    }
                }
            );
        }
});
