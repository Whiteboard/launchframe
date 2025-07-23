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
}
