export default () => ({
    show: false,
    pillarLabel: null,
    projectsLabel: null,

    init() {
        this.pillarLabel = new SplitText(this.$refs.pillarLabel, {
            type: 'chars, words, lines',
            wordsClass: 'overflow-hidden',
        });

        this.projectsLabel = new SplitText(this.$refs.projectsLabel, {
            type: 'chars, words, lines',
            wordsClass: 'overflow-hidden',
        });

        this.$watch('$store.navigator.open', value => {
            if (value) {
                this.open();
            } else {
                this.close();
            }
        });
    },

    animationFinisher() {
        this.$store.navigator.animating = false;
    },

    open() {
        document.body.classList.add('no-scroll');
        this.show = true;

        const enter = gsap.timeline({
            defaults: { ease: 'circ.inOut' },
            onComplete: () => {
                this.animationFinisher();
            }
        });

        enter.fromTo(this.$refs.navBackground,
        { yPercent: -101 },
        { duration: 0.8, yPercent: 0 });

        enter.addLabel('left', '>-=0.2');
        enter.addLabel('right', '>');
        enter.addLabel('bottom', '>-=0.3');
        enter.addLabel('header', '>');

        enter.fromTo(
            '[data-nav-action]',
            {
                xPercent: -10,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.05,
                ease: 'quint.out',
            },
            'left'
        )

        .fromTo(
            this.$refs.divider,
            {
                xPercent: -101
            },

            {
                xPercent: 0,
                duration: 0.5,
            },
            'left'
        )

        .fromTo(
            this.$refs.cta,
            {
                xPercent: -10,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.4,
                ease: 'quint.out',
            },
            `<+=0.1`
        )

        .fromTo(
            this.pillarLabel.chars,
            {
                xPercent: 150,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.018,
                ease: 'expo.out',
            },
            'right'
        )

        .fromTo(
            '[data-nav-pillar]',
            {
                xPercent: 10,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.05,
                ease: 'expo.out',
            },
            'right'
        )

        .fromTo(
            this.projectsLabel.chars,
            {
                xPercent: 150,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.018,
                ease: 'expo.out',
            },
            'right+=0.3'
        )

        .fromTo(
            '[data-nav-projects]',
            {
                xPercent: 10,
                opacity: 0,
            },

            {
                xPercent: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.05,
                ease: 'expo.out',
            },
            'right+=0.3'
        )

        .fromTo(
            this.$refs.bottomBackground,
            {
                yPercent: 101,
            },

            {
                yPercent: 0,
                duration: 0.8,
            },
            'bottom'
        )

        .fromTo(
            this.$refs.bottomContent,
            {
                opacity: 0,
            },

            {
                opacity: 1,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            '<0.4'
        )

        .fromTo(
            this.$refs.logo,
            {
                opacity: 0,
            },

            {
                opacity: 1,
                duration: 0.4,
                ease: 'quad.inOut',
            },
            'header'
        )

        .fromTo(
            this.$refs.navMain,
            {
                opacity: 0,
            },

            {
                opacity: 1,
                duration: 0.4,
                ease: 'quad.inOut',
            },
            '>-0.2'
        )

        .fromTo(
            this.$refs.search,
            {
                opacity: 0,
            },

            {
                opacity: 1,
                duration: 0.4,
                ease: 'quad.inOut',
            },
            '>-0.2'
        )

        .fromTo(
            this.$refs.close,
            {
                opacity: 0,
            },

            {
                opacity: 1,
                duration: 0.4,
                ease: 'quad.inOut',
            },
            '>-0.2'
        )

    },

    close() {
        const leave = gsap.timeline({
            defaults: { ease: 'circ.inOut' },
            onComplete: () => {
                document.body.classList.remove('no-scroll');
                this.show = false;
                this.animationFinisher();
            }
        });


        leave.addLabel('left');
        leave.addLabel('right');
        leave.addLabel('bottom');
        leave.addLabel('header');


        leave.to(
            this.$refs.close,
            {
                opacity: 0,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            'header'
        )

        .to(
            this.$refs.search,
            {
                opacity: 0,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            '>-0.15'
        )

        .to(
            this.$refs.navMain,
            {
                opacity: 0,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            '>-0.15'
        )

        .to(
            this.$refs.logo,
            {
                opacity: 0,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            '>-0.15'
        )

        .to(
            this.$refs.bottomContent,
            {
                opacity: 0,
                duration: 0.3,
                ease: 'quad.inOut',
            },
            'bottom'
        )

        .to(
            this.$refs.bottomBackground,
            {
                yPercent: 101,
                duration: 0.5,
            },
            '<0.2'
        )

        .to(
            '[data-nav-action]',
            {
                xPercent: -10,
                opacity: 0,
                duration: 0.4,
                stagger: 0.05,
                ease: 'quint.in',
            },
            'left'
        )

        .to(
            this.$refs.divider,
            {
                xPercent: 101,
                duration: 0.5,
            },
            'left'
        )


        .to(
            this.$refs.cta,
            {
                xPercent: -10,
                opacity: 0,
                duration: 0.4,
                ease: 'quint.in',
            },
            `<+=0.1`
        )

        .to(
            this.pillarLabel.chars,
            {
                xPercent: -100,
                opacity: 0,
                duration: 0.4,
                stagger: 0.013,
                ease: 'expo.inOut',
            },
            'right'
        )

        .to(
            '[data-nav-pillar]',
            {
                xPercent: 10,
                opacity: 0,
                duration: 0.5,
                stagger: 0.022,
                ease: 'expo.inOut',
            },
            'right'
        )

        .to(
            this.projectsLabel.chars,
            {
                xPercent: -100,
                opacity: 0,
                duration: 0.4,
                stagger: 0.013,
                ease: 'expo.inOut',
            },
            'right+=0.1'
        )

        .to(
            '[data-nav-projects]',
            {
                xPercent: 10,
                opacity: 0,
                duration: 0.4,
                stagger: 0.02,
                ease: 'expo.inOut',
            },
            'right+=0.1'
        )

        .to(this.$refs.navBackground, { duration: 0.3, yPercent: -101 }, 'right+=0.8')
    },

    toggle() {
        if (this.$store.navigator.open) {
            this.$store.navigator.toggle();
        }
    }
})
