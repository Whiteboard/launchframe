export default () => {
    const loader = document.getElementById('primary-loader')
    const curtain = loader.querySelector('[data-curtain]')

    const enter = gsap.timeline({
        defaults: { ease: 'circ.inOut' },
        onComplete: () => {
            document.body.classList.remove('cursor-wait')
            Alpine.store('scroll').pause(false)
        },
    })

    enter.to(curtain, { duration: 0.4, opacity: 0 }).to(loader, { duration: 0.3, autoAlpha: 0 }, '<0.25')
}
