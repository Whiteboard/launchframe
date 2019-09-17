export function addAnimations(animations, trigger, hook, offset, duration, controller, replay = true) {
    let scene = '';
    const tween = new TimelineMax();
    tween.insertMultiple(animations, 0, 0);

    if (hook && duration) {
        scene = new ScrollMagic.Scene({
            triggerElement: trigger,
            triggerHook: hook,
            offset,
            duration
        })
            .setTween(tween)
            .addTo(controller);
    } else if (duration) {
        scene = new ScrollMagic.Scene({
            triggerElement: trigger,
            offset,
            duration
        })
            .setTween(tween)
            .addTo(controller);
    } else {
        scene = new ScrollMagic.Scene({
            triggerElement: trigger,
            offset,
            reverse: replay
        })
            .setTween(tween)
            .addTo(controller);
    }

    return;
}
