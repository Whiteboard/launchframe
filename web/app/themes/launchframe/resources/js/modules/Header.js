export default () => {
    return {
        sticky: false,

        init() {
            ScrollTrigger.create({
                trigger: document.body,
                start: '400px top',
                end: 'bottom bottom',
                onEnter: () => {
                    this.sticky = true
                    console.log('scrolled')
                },
                onLeaveBack: () => {
                    this.sticky = false
                    console.log('not scrolled')
                },
            })
        },
    }
}
