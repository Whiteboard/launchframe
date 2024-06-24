export default () => {
    avalanche.delay = {
        ...avalanche.delay,
        default: 0.25,
        enter: 1,
    }

    avalanche.textClass.words = {
        h1: 'pb-[0.9%]',
    }

    // Example
    // avalanche.textClass.chars = {
    //     h1: '-mr-1 pr-1',
    // }

    Alpine.store('barba', {
        currentHeight: 0,
        started: false,
    })

    Alpine.store('focusState', false)
}
