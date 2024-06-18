export default () => {
    // Convert to Alpine
    window.scroll(allow = true) {
        if (smoother) {
            smoother.paused(!allow)
        } else if (allow) {
            document.body.classList.remove('no-scroll')
        } else {
            document.body.classList.add('no-scroll')
        }
    })

}

    Alpine.store('avalanche', {
        delay: {
            default: 0.25,
            enter: 1,
        },
        charsClass: {
            // h1: '',
        },
        wordsClass: {
            h1: 'pb-5',
            h2: 'pb-1 lg:pb-2',
        },
    })

    Alpine.store('audioMute', false) // User Toggled & Persisted
    Alpine.store('audioPause', false)

    document.addEventListener('visibilitychange', () => {
        Alpine.store('audioPause', document.hidden)
    })

    Alpine.store('lightboxVideo', {
        open: false,
        source: '',
        youtube: '',
        vimeo: '',
        mp4: '',
        webm: '',
        poster: '',
    })
}
