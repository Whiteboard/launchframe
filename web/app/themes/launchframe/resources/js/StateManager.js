export default () => {
    Alpine.store('animationDelay', 0.25);
    Alpine.store('enterDelay', 1);

    Alpine.store('navigator', {
        open: false,
        animating: false,

        toggle() {
            if (!this.animating) {
                this.animating = true; // End of animations set this to false
                this.open = !this.open;
            }
        }
    });

    Alpine.store('search', {
        open: false,
    });

    Alpine.store('audioMute', false); // User Toggled & Persisted
    Alpine.store('audioPause', false);

    document.addEventListener('visibilitychange', () => {
        Alpine.store('audioPause', document.hidden);
    });

    Alpine.store('lightboxVideo', {
        open: false,
        source: '',
        youtube: '',
        vimeo: '',
        mp4: '',
        webm: '',
        poster: ''
    });

};
