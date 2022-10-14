export default () => {
    const loader = document.getElementById('primary-once');
    const curtain = loader.querySelector('[data-curtain]');
    const logo = loader.querySelector('[data-logo]');

    document.body.classList.add('no-scroll', 'cursor-wait');

    const enter = gsap.timeline({
        defaults: { ease: 'circ.inOut' },
        onComplete: () => {
            document.body.classList.remove('no-scroll', 'cursor-wait');
        }
    });

    // logo.classList.remove('text-primary');
    // logo.classList.add('text-neutral-900');

    enter
        .to(curtain, { duration: 0.25, autoAlpha: 0 }, '>1')
        .to(loader, { duration: 0.25, autoAlpha: 0 }, '>');
};
