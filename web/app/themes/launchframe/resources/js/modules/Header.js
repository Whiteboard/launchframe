export default () => ({
    sticky: false,

    init() {
        ScrollTrigger.create({
            trigger: document.body,
            start: '400px top',
            end: 'bottom bottom',
            onEnter: () => {
                this.sticky = true;
            },
            onLeaveBack: () => {
                this.sticky = false;
            }
        });
    }
})
