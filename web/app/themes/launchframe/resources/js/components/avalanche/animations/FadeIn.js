export default () => ({
    delay: false,
    scrollTrigger: true,
    scrollSettings: false,
    start: 'top 85%',
    end: 'bottom top',
    toggleActions: 'play none play none',
    trigger: null,

    duration: {
        opacity: 0.3,
        translate: 0.3,
        scale: 0.3,
    },

    ease: {
        scale: 'circ.inOut'
    },

    x: {
        start: -25,
        end: 0,
    },

    y: {
        start: 25,
        end: 0,
    },

    translate: null,
    scale: false,
    scaleStart: 1.1,
    scaleEnd: 1,
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

        if (!this.delay) {
            this.delay = this.$store.animationDelay;
        }

        const animation = gsap.timeline({
            delay: this.delay,
            scrollTrigger: this.scrollSettings
        });

        animation.addLabel('start');

        animation.fromTo(this.$refs.element,
            { opacity: 0 },
            { duration: this.duration.opacity, opacity: 1 },
            'start'
        );

        if (this.translate === 'x') {
            animation.fromTo(
                this.$refs.element,
                { xPercent: this.x.start },
                { duration: this.duration.translate, xPercent: this.x.end },
                'start'
            );
        } else if (this.translate === 'y') {
            animation.fromTo(
                this.$refs.element,
                { yPercent: this.y.start },
                { duration: this.duration.translate, yPercent: this.y.end },
                'start'
            );
        }

        if (this.scale) {
            animation.fromTo(
                this.$refs.element,
                { scale: this.scaleStart },
                { duration: this.duration.scale, scale: this.scaleEnd, ease: this.ease.scale },
                'start'
            );
        }
    }
})
