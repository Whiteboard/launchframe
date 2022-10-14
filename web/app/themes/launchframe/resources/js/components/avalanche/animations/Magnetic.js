export default (force = 25) => ({
    force: 25,

    init() {
        this.force = force;
    },

    magnetize(ev, item, element) {
        const boundingRect = item.getBoundingClientRect();
        const relX = ev.clientX - boundingRect.left;
        const relY = ev.clientY - boundingRect.top;

        gsap.to(element, {
            x: ((relX - boundingRect.width / 2) / boundingRect.width) * this.force,
            y: ((relY - boundingRect.height / 2) / boundingRect.height) * this.force,
            duration: 0.3,
            transformOrigin: 'center',
            ease: 'power1.out'
        });
    },

    demagnetize(element) {
        gsap.to(element, {
            x: 0,
            y: 0,
            duration: 0.3
        });
    }
})
