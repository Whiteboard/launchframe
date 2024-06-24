export default () => {
    avalanche.delay = {
        ...avalanche.delay,
        default: 0.25,
        enter: 2,
    }

    avalanche.textClass.words = {
        h1: 'pb-[0.9%]',
    }

    // Example
    // avalanche.textClass.chars = {
    //     h1: '-mr-1 pr-1',
    // }

    /* :: Misc Global UI
    {+} ---------------------------------- */
    Alpine.store('focusState', false)
    Alpine.store('alertBar', false)
    Alpine.store('isTouch', 'ontouchstart' in document.documentElement && navigator.userAgent.match(/Mobi/))

    Alpine.store('header', {
        theme: 'dark',
    })

    /* :: Overlays
    {+} ---------------------------------- */
    Alpine.store('overlay', {
        cards: {
            open: false,
        },

        form: {
            open: false,
        },

        person: {
            open: false,
            active: 1,

            toggle(active) {
                this.open = !this.open
                active ? (this.active = active) : null
                smoother.paused(!smoother.paused())
            },

            close() {
                smoother.paused(false)
                this.open = false
            },
        },

        nav: {
            open: false,

            toggle() {
                this.open = !this.open
                smoother.paused(!smoother.paused())
            },

            close() {
                smoother.paused(false)
                this.open = false
            },
        },

        search: {
            open: false,
        },

        toast: {
            open: false,
        },

        video: {
            open: false,
            source: null,
            video: null,
            poster: null,
        },
    })

    /* :: Audio
    {+} ---------------------------------- */
    Alpine.store('audioMute', false) // User Toggled & Persisted
    Alpine.store('audioPause', false)
    document.addEventListener('visibilitychange', () => {
        Alpine.store('audioPause', document.hidden)
    })
}
