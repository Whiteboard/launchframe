import ScrollMagic from 'scrollmagic';
import * as Util from '../../util/utilities';

export default {
    init() {
        const scrollcontrol = new ScrollMagic.Controller();
        const windowHalfX = window.innerHeight / 2;

        this.fadeIn(scrollcontrol, windowHalfX);
        this.fadeInUp(scrollcontrol, windowHalfX);
        this.fadeInRight(scrollcontrol, windowHalfX);
        this.fadeInLeft(scrollcontrol, windowHalfX);
        this.zoomOut(scrollcontrol, windowHalfX);
        this.rotateForward(scrollcontrol, windowHalfX);
    },
    /* :: Fade-In
    {+} ---------------------------------- */
    fadeIn(scrollcontrol, windowHalfX) {
        if ($('[data-fadein]').length) {
            $('[data-fadein]').each(function() {
                let delay;
                let data = this.getAttribute('data-fadein');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.1;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0
                            },
                            {
                                opacity: 1,
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    },

    /* :: Fade-In Up
    {+} ---------------------------------- */
    fadeInUp(scrollcontrol, windowHalfX) {
        if ($('[data-fadein-up]').length) {
            $('[data-fadein-up]').each(function() {
                let delay;
                let data = this.getAttribute('data-fadein-up');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.1;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0,
                                y: '32'
                            },
                            {
                                opacity: 1,
                                y: '0',
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    },

    /* :: Fade-In Right
    {+} ---------------------------------- */
    fadeInRight(scrollcontrol, windowHalfX) {
        if ($('[data-fadein-right]').length) {
            $('[data-fadein-right]').each(function() {
                let delay;
                let data = this.getAttribute('data-fadein-right');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.1;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0,
                                x: '-32'
                            },
                            {
                                opacity: 1,
                                x: '0',
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    },

    /* :: Fade-In Left
    {+} ---------------------------------- */
    fadeInLeft(scrollcontrol, windowHalfX) {
        if ($('[data-fadein-left]').length) {
            $('[data-fadein-left]').each(function() {
                let delay;
                let data = this.getAttribute('data-fadein-left');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.32;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0,
                                x: '32'
                            },
                            {
                                opacity: 1,
                                x: '0',
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    },

    /* :: Zoom Out
    {+} ---------------------------------- */
    zoomOut(scrollcontrol, windowHalfX) {
        if ($('[data-zoomout]').length) {
            $('[data-zoomout]').each(function() {
                let delay;
                let data = this.getAttribute('data-zoomout');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.1;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0,
                                y: '32'
                            },
                            {
                                opacity: 1,
                                y: '0',
                                scale: 1,
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    },

    /* :: Rotate Forward
    {+} ---------------------------------- */
    rotateForward(scrollcontrol, windowHalfX) {
        if ($('[data-rotate-forward]').length) {
            $('[data-rotate-forward]').each(function() {
                let delay;
                let data = this.getAttribute('data-rotate-forward');
                const yoyo = $(this).data('replay');
                let repeat = yoyo == undefined ? false : true;

                if (data) {
                    delay = data;
                } else {
                    delay = 0.1;
                }

                Util.addAnimations(
                    [
                        TweenMax.fromTo(
                            $(this),
                            0.8,
                            {
                                opacity: 0,
                                rotation: 20,
                                scale: 0.56
                            },
                            {
                                opacity: 1,
                                rotation: 0,
                                scale: 1,
                                delay: delay,
                                ease: Power3.easeOut
                            }
                        )
                    ],
                    this,
                    '',
                    -windowHalfX + 100,
                    '',
                    scrollcontrol,
                    repeat
                );
            });
        }
    }
};
