export default () => {
    Alpine.store('overlay', {
        lightbox: {
            open: false,
        },

        alertbar: {
            open: false,
        },

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

        toolbar: {
            editUrl: null,
        },
    })
}
