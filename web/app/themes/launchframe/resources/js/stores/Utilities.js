export default () => {
    Alpine.store('isTouch', !!(
        ('ontouchstart' in window) ||
        window.matchMedia?.('(pointer: coarse)')?.matches ||
        navigator?.maxTouchPoints > 0 ||
        navigator?.msMaxTouchPoints > 0
    ))

    Alpine.store('parseHtmlEntities', str =>
        (str || '')
            .replace(/&#([0-9]{1,4});/gi, (match, numStr) => String.fromCharCode(parseInt(numStr, 10)))
            .replaceAll('&amp;', '&'),
    )

    Alpine.store('isFirefox', !!navigator.userAgent.match(/firefox|fxios/i))
    Alpine.store(
        'isSafari',
        !!navigator.userAgent.match(/safari/i) && !!!navigator.userAgent.match(/chrome|chromium|crios/i),
    )

    Alpine.store('formatNumber', el => {
        return el.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    })

    Alpine.store('breakpoints', {
        isMobile: null,
        isMD: null,
        isDesktop: null,
        isXL: null,
        isTwoXL: null,
        isThreeXL: null,

        mobileQuery: window.matchMedia('(max-width: 639px)'),
        mdQuery: window.matchMedia('(max-width: 767px)'),
        desktopQuery: window.matchMedia('(max-width: 1023px)'),
        xlQuery: window.matchMedia('(max-width: 1279px)'),
        twoXLQuery: window.matchMedia('(max-width: 1535px)'),
        threeXLQuery: window.matchMedia('(max-width: 1679px)'),

        init() {
            this.isMobile = this.mobileQuery.matches
            this.isMD = !this.mdQuery.matches
            this.isDesktop = !this.desktopQuery.matches
            this.isXL = !this.xlQuery.matches
            this.isTwoXL = !this.twoXLQuery.matches
            this.isThreeXL = !this.threeXLQuery.matches

            this.mobileQuery.addEventListener('change', e => {
                this.isMobile = e.matches
            })

            this.mdQuery.addEventListener('change', e => {
                this.isMD = !e.matches
            })

            this.desktopQuery.addEventListener('change', e => {
                this.isDesktop = !e.matches
            })

            this.xlQuery.addEventListener('change', e => {
                this.isXL = !e.matches
            })

            this.twoXLQuery.addEventListener('change', e => {
                this.isTwoXL = !e.matches
            })

            this.threeXLQuery.addEventListener('change', e => {
                this.isThreeXL = !e.matches
            })
        },
    })

    /* :: Custom Scroll Handler
    {+ ---------------------------------- */
    Alpine.store('scroll', {
        isScrollingPaused: false,

        init() {
            this.isScrollingPaused = false
            this.pause(false)
        },
        pause(paused = false) {
            if (window.smoother && !Alpine.store('isTouch')) {
                this._handlePausedScrollingWithSmoother(paused)
            } else {
                this._handlePausedScrollingWithoutSmoother(paused)
            }
        },
        _handlePausedScrollingWithSmoother(paused = false) {
            smoother.paused(paused)
            this.isScrollingPaused = !!paused
        },
        _handlePausedScrollingWithoutSmoother(paused = false) {
            if (paused) {
                this.createSmoother()
                smoother.paused(true)
                this.isScrollingPaused = true
            } else {
                this.destroySmoother()
                this.isScrollingPaused = false
            }
        },
        toggle() {
            this.pause(!this.isScrollingPaused)
        },
        createSmoother() {
            window.smoother = ScrollSmoother.create({
                smooth: 1,
                effects: true,
                smoothTouch: false,
                ignoreMobileResize: true,
            })
        },
        destroySmoother() {
            if (window.smoother) {
                window.smoother.kill()
                window.smoother = null
                document.body.classList.remove('no-scroll')
                this.isScrollingPaused = false
            }
        },
        handleScrollToElement(target, offset = Alpine.store('header').scrollingOffsetPx) {          
            if (window.smoother && target) {
                smoother.scrollTo(target, true, `top ${Alpine.store('header').height + offset}px`)
            } else if (target) {
                const elementPosition = target.getBoundingClientRect().top + window.scrollY
                window.scrollTo({
                    top: elementPosition - Alpine.store('header').height - offset,
                    behavior: 'smooth',
                })
            }
        },
        resetPositionToTop() {
            if (window.smoother) {
                smoother.scrollTo(0)
            } else {
                window.scrollTo(0, 0)
            }
        },
    })
}
