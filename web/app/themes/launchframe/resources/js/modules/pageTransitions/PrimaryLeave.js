export default (container, done) => {
    const loader = document.getElementById('primary-loader')
    const curtain = loader.querySelector('[data-curtain]')
    const logo = loader.querySelector('[data-logo]')

    document.body.classList.add('cursor-wait')
    Alpine.store('scroll').pause(true)

    const leave = gsap.timeline({
        defaults: { ease: 'circ.inOut' },
        onComplete: () => {
            Alpine.store('scroll').resetPositionToTop()

            setTimeout(() => {
                done()
            }, 1200)
        },
    })

    leave
        .set(loader, { autoAlpha: 1 })
        .fromTo(curtain, { opacity: 0 }, { duration: 0.4, opacity: 1 })
        .fromTo(logo, { opacity: 0 }, { duration: 0.3, opacity: 1 }, '<0.15')
}
