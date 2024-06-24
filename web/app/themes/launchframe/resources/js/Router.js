import barba from '@barba/core'
import mouse from '@components/MouseController'
import primaryOnce from '@modules/pageTransitions/PrimaryOnce'
import primaryLeave from '@modules/pageTransitions/PrimaryLeave'
import primaryEnter from '@modules/pageTransitions/PrimaryEnter'
// import secondaryLeave from '@modules/pageTransitions/SecondaryLeave'
// import secondaryEnter from '@modules/pageTransitions/SecondaryEnter'

window.barba = barba

export default () => {
    barba.hooks.beforeOnce(() => {
        Alpine.start()

        // Post Setup Utilities
        Alpine.store('scroll', {
            init(allow = true) {
                if (smoother) {
                    smoother.paused(!allow)
                } else if (allow) {
                    document.body.classList.remove('no-scroll')
                } else {
                    document.body.classList.add('no-scroll')
                }
            },
        })
    })

    barba.hooks.afterOnce(() => {
        Alpine.store('barba').started = true
        const elements = [...document.querySelectorAll('a, button')]
        mouse.set(elements)
    })

    barba.hooks.beforeEnter(() => {
        window.smoother = ScrollSmoother.create({
            smooth: 1,
            effects: true,
            smoothTouch: false,
            ignoreMobileResize: true,
        })
        ScrollTrigger.refresh()
        smoother.scrollTo(0)
    })

    barba.hooks.enter(() => {
        setTimeout(() => {
            ScrollTrigger.refresh()
        }, 200)
    })

    barba.hooks.afterEnter(() => {
        mouse.createEvent('cursorLoadingLeave')
        const elements = [...document.querySelectorAll('a, button')]
        mouse.set(elements)

        setTimeout(() => {
            Alpine.store('audioPause', false)
        }, 500)
    })

    barba.hooks.beforeLeave(() => {
        const elements = [...document.querySelectorAll('a, button')]
        mouse.remove(elements)
    })

    barba.hooks.leave(() => {
        Alpine.store('audioPause', true)

        mouse.createEvent('cursorLoadingEnter')
        if (Alpine.store('overlay').nav.open) {
            Alpine.store('overlay').nav.toggle()
        }
    })

    barba.hooks.afterLeave(() => {
        avalanche.delay.enter = 1.3
    })

    barba.hooks.after(() => {
        ga('set', 'page', window.location.pathname)
        ga('send', 'pageview')
    })

    if (history.scrollRestoration) {
        history.scrollRestoration = 'manual'
    }

    barba.init({
        timeout: 30000,
        transitions: [
            {
                name: 'primary',
                once() {
                    primaryOnce()
                },
                leave(data) {
                    const done = this.async()
                    Alpine.store('barba').currentHeight = data.current.container.clientHeight
                    primaryLeave(data.current.container, done)
                },
                enter() {
                    primaryEnter()
                },
            },
        ],
        schema: {
            prefix: 'data-portal',
            wrapper: 'realm',
            container: 'destination',
        },
    })
}
