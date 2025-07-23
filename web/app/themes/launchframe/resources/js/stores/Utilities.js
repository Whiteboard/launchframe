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
}
