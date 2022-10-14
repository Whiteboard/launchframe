// π ----
// :: MODULES BOOTSTRAP ---------------------------::
// ____

/* :: Imports
---------------------------------- */
// import Vue from 'vue';

import animate from './partials/components/animations';
import hero from './partials/modules/hero';

export default {
    init() {
        animate.init();
    },
    finalize() {
        hero.init();
    }
};
