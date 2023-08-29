import barba from '@barba/core';
import primaryOnce from '@modules/pageTransitions/PrimaryOnce';
import primaryLeave from '@modules/pageTransitions/PrimaryLeave';
import primaryEnter from '@modules/pageTransitions/PrimaryEnter';
import mouse from '@components/MouseController';

window.barba = barba;

export default () => {
    barba.hooks.beforeOnce(() => {
        Alpine.start();
    });

    barba.hooks.afterOnce(() => {
        const elements = [...document.querySelectorAll('a, button')];
        mouse.set(elements);
    });

    barba.hooks.enter(() => {
        setTimeout(() => {
            ScrollTrigger.refresh();
        }, 200);
    });

    barba.hooks.afterEnter(() => {
        mouse.createEvent('cursorLoadingLeave');
        const elements = [...document.querySelectorAll('a, button')];
        mouse.set(elements);

        setTimeout(() => {
            Alpine.store('audioPause', false);
        }, 500);
    });

    barba.hooks.beforeLeave(() => {
        const elements = [...document.querySelectorAll('a, button')];
        mouse.remove(elements);
    });

    barba.hooks.leave(() => {
        Alpine.store('audioPause', true);

        mouse.createEvent('cursorLoadingEnter');
        if (Alpine.store('navigator').open) {
            Alpine.store('navigator').toggle();
        }
    });

    barba.hooks.afterLeave(() => {
        Alpine.store('enterDelay', 0.5);
    });

    // :: GOOGLE ANALYTICS
    // {+} ----------------------------------

    barba.hooks.after(() => {
        gtag('event', 'page_view', {
            'page_title': document.title,
            'page_location': location.href,
            'page_path': location.pathname,
        });
    });

    if (history.scrollRestoration) {
        history.scrollRestoration = 'manual';
    }

    barba.init({
        timeout: 30000,
        transitions: [
            {
                once() {
                    primaryOnce();
                },
                leave(data) {
                    const done = this.async();
                    primaryLeave(data.current.container, done);
                },
                enter() {
                    primaryEnter();
                }
            }
        ],
        schema: {
            prefix: 'data-portal',
            wrapper: 'realm',
            container: 'destination'
        }
    });
};
