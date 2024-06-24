export default () => {
    Alpine.store('header', {
        height: 100,
        theme: 'dark',

        init() {
            this.setSize()
            window.addEventListener('resize', () => {
                this.setSize()
            })
        },

        setSize() {
            this.height = document.getElementById('site-header')?.clientHeight || 0
        },
    })
}
