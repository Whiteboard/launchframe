import Plyr from 'plyr';
import Player from '@vimeo/player/src/player';

export default () => {
    return {
        player: null,
        source: null,
        autoplay: false,
        endRedirect: false,
        redirect: null,

        mounted() {
            let player;

            if (this.source === 'vimeo') {
                player = new Player(this.$refs.player, {
                    title: false,
                    color: 'A88D64'
                });

            } else {
                player = new Plyr(this.$refs.player, {
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
                });
            }

            if (this.endRedirect) {
                player.on('ended', () => {
                    barba.go(this.redirect);
                });
            }

            if (this.autoplay) {
                player.play();
            }

            this.player = player;
        }
    };
};
