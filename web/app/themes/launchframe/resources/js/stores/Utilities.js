export default () => {
    Alpine.store('isTouch', 'ontouchstart' in document.documentElement && navigator.userAgent.match(/Mobi/))

    Alpine.store('parseHtmlEntities', str =>
        str?.replace(/&#([0-9]{1,4});/gi, (match, numStr) => String.fromCharCode(parseInt(numStr, 10))),
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
