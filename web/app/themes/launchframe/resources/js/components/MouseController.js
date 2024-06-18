const mouse = {
    set(elements) {
        elements.forEach(element => {
            /* So if we want to manually call these events
             * (great for dynamically pulled in content after page load) */
            if (element.hasAttribute('data-mouse-manual')) {
                return
            }

            element.addEventListener('mouseenter', () => {
                this.createEvent('cursorEnter')
            })

            element.addEventListener('mouseleave', () => {
                this.createEvent('cursorLeave')
            })

            element.addEventListener('click', () => {
                this.createEvent('cursorClick')
            })
        })
    },

    createEvent(name) {
        const event = new Event(name, { bubbles: true })
        window.dispatchEvent(event)
    },

    remove(elements) {
        elements.forEach(element => {
            element.removeEventListener('mouseenter')
            element.removeEventListener('mouseleave')
            element.removeEventListener('click')
        })
    },
}

export default mouse
