import lightboxVideo from '@modules/LightboxVideo';
import navigation from '@modules/Navigation';

import avalanche from '@components/avalanche/Avalanche';
import cursor from '@components/Cursor';
import mouse from '@components/MouseController';

export default () => {
    Alpine.data('lightboxVideo', lightboxVideo);
    Alpine.data('navigation', navigation);

    Alpine.data('cursor', cursor);
    window.mouse = mouse;
    avalanche();
};
