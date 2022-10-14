export default () => ({
    axis: 'y', // or 'x'
    x: {
        start: 25,
        end: -25,
    },
    y: {
        start: 25,
        end: -25,
    },
    scope: null,
    start: 'top bottom',
    end: 'bottom top',
    scrub: true,
    trigger: null,
    fade: null,

    mounted() {
        if (!this.trigger) {
            this.trigger = this.$refs.container;
        }

        if (!this.scope) {
            this.parallax();
        } else {
            this.setBreakpoint();
        }
    },

    setBreakpoint() {
        if (this.scope === 'xl') {
            ScrollTrigger.matchMedia({
                '(min-width: 1280px)': () => {
                    this.parallax();
                }
            });
        } else if (this.scope === 'lg') {
            ScrollTrigger.matchMedia({
                '(min-width: 1024px)': () => {
                    this.parallax();
                }
            });
        } else if (this.scope === 'md') {
            ScrollTrigger.matchMedia({
                '(min-width: 768px)': () => {
                    this.parallax();
                }
            });
        } else if (this.scope === 'sm') {
            ScrollTrigger.matchMedia({
                '(min-width: 640px)': () => {
                    this.parallax();
                }
            });
        }
    },

    parallax() {
        const animation = gsap.timeline({
            defaults: { ease: 'none' },
            scrollTrigger: {
                start: this.start,
                end: this.end,
                trigger: this.trigger,
                scrub: this.scrub
            }
        });

        animation.addLabel('start');

        if (this.axis === 'x') {
            animation.fromTo(this.$refs.element, { xPercent: this.x.start }, { xPercent: this.x.end }, 'start');
        } else if (this.axis === 'y') {
            animation.fromTo(this.$refs.element, { yPercent: this.y.start }, { yPercent: this.y.end }, 'start');
        }

        if (this.fade === 'in') {
            animation.fromTo(this.$refs.element, { opacity: 0 }, { opacity: 1 }, 'start');
        } else if (this.fade === 'out') {
            animation.to(this.$refs.element, { opacity: 0 }, 'start');
        }
    },
})
