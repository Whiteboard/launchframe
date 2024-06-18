// import lightboxVideo from '@modules/LightboxVideo';
import navigation from '@modules/Navigation'
import header from '@modules/Header'
// import sliders from '@modules/Sliders';

import cursor from '@components/Cursor'
import mouse from '@components/MouseController'
import videoPlayer from '@components/VideoPlayer'

export default () => {
    // Alpine.data('sliders', sliders);
    // Alpine.data('lightboxVideo', lightboxVideo);
    Alpine.data('header', header)
    Alpine.data('navigation', navigation)

    Alpine.data('cursor', cursor)
    Alpine.data('videoPlayer', videoPlayer)
    window.mouse = mouse
}
