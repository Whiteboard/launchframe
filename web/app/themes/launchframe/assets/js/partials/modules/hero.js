import ScrollMagic from 'scrollmagic';
import * as Util from '../../util/utilities';

export default {
    init() {
        if ($('#hero').length) {
            const scrollcontrol = new ScrollMagic.Controller();

            /* :: Parallax
            ---------------------------------- */
            Util.addAnimations(
                [
                    TweenMax.fromTo(
                        $('#hero').find('[data-hero-content]'),
                        2,
                        {
                            y: '0'
                        },
                        {
                            y: '-80%',
                            ease: Linear.easeNone
                        }
                    ),
                    TweenMax.fromTo(
                        $('#hero').find('[data-hero-asset]'),
                        2,
                        {
                            y: '0'
                        },
                        {
                            y: '48%',
                            ease: Linear.easeNone
                        }
                    )
                ],
                '#hero',
                'onLeave',
                0,
                '130%',
                scrollcontrol
            );
        }
    }
};
