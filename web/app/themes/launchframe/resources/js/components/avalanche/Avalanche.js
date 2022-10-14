import fadeIn from '@components/avalanche/animations/FadeIn.js';
import lettersUp from '@components/avalanche/animations/LettersUp.js';
import lines from '@components/avalanche/animations/Lines.js';
import magnetic from '@components/avalanche/animations/Magnetic.js';
import marquee from '@components/avalanche/animations/Marquee.js';
import parallax from '@components/avalanche/animations/Parallax.js';
import parallaxBackground from '@components/avalanche/animations/ParallaxBackground.js';
import revealer from '@components/avalanche/animations/Revealer.js';
import spin from '@components/avalanche/animations/Spin.js';
import translate from '@components/avalanche/animations/Translate.js';
import words from '@components/avalanche/animations/Words.js';

// π ----
// :: 🏔 AVALANCHE ---------------------------::
// ____
/* :: Utility Alpine Animation Library
{+} ---------------------------------- */
export default () => {
    Alpine.data('fadeIn', fadeIn);
    Alpine.data('lettersUp', lettersUp);
    Alpine.data('lines', lines);
    Alpine.data('magnetic', magnetic);
    Alpine.data('marquee', marquee);
    Alpine.data('parallax', parallax);
    Alpine.data('parallaxBackground', parallaxBackground);
    Alpine.data('revealer', revealer);
    Alpine.data('spin', spin);
    Alpine.data('translate', translate);
    Alpine.data('words', words);
};
