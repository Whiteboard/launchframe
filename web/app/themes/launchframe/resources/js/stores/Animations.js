export default () => {
    avalanche.delay = {
        ...avalanche.delay,
        default: 0.25,
        enter: 1,
    }

    avalanche.textClass.words = {
        h1: 'pb-[0.9%]',
    }

    Alpine.store('focusState', false)
}
