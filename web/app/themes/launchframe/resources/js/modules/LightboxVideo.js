import Plyr from 'plyr';
import Player from '@vimeo/player/src/player';

export default () => {
    return {
        player: {},
        options: {
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
            hideYouTubeDOMError: true
        },
        animating: false,

        init() {
            gsap.set(this.$refs.background, { yPercent: 101 });

            this.$watch('$store.lightboxVideo.open', value => {
                if (value && this.$store.lightboxVideo.source === 'vimeo') {
                    this.vimeoInit();
                } else if (value) {
                    this.playerInit();
                }
            });
        },

        playerInit() {
            this.player = new Plyr('#video-lightbox', this.options);

            if (this.$store.lightboxVideo.source === 'local') {
                this.player.source = {
                    type: 'video',
                    sources: [
                        {
                            src: this.$store.lightboxVideo.mp4,
                            type: 'video/mp4',
                            size: 1080
                        },
                        {
                            src: this.$store.lightboxVideo.webm,
                            type: 'video/webm',
                            size: 1080
                        }
                    ],
                    poster: this.$store.lightboxVideo.poster
                };
            } else if (this.$store.lightboxVideo.source === 'youtube' || this.$store.lightboxVideo.source === 'vimeo') {
                this.player.source = {
                    type: 'video',
                    sources: [
                        {
                            src: this.$store.lightboxVideo.videoID,
                            provider: this.$store.lightboxVideo.source
                        }
                    ]
                };
            }

            if (!this.animating) {
                this.open();
            }
        },

        vimeoInit() {
            let size = window.innerWidth * 0.8;
            const options = {
                id: this.$store.lightboxVideo.videoID,
                width: size
            };

            this.player = new Player(this.$refs.player, options);

            if (!this.animating) {
                this.open();
            }
        },

        open() {
            document.body.classList.add('no-scroll');
            this.animating = true;

            const openLightbox = gsap.timeline({
                onComplete: () => {
                    this.animating = false;
                    this.player.play();
                }
            });

            openLightbox
                .fromTo(this.$refs.background, { yPercent: 104 }, { duration: 0.8, yPercent: 0, ease: 'expo.inOut' })
                .set(this.$refs.screen, { opacity: 1 })
                .fromTo(this.$refs.screenCover, { yPercent: 0 }, { duration: 0.6, yPercent: -104, ease: 'circ.inOut' })
                .to(this.$refs.button, { duration: 0.3, autoAlpha: 1 });
        },

        close() {
            if (!this.$store.lightboxVideo.open) {
                return;
            }

            this.animating = true;
            this.player.pause();

            const closeLightbox = gsap.timeline({
                onComplete: () => {
                    this.animating = false;
                    this.$store.lightboxVideo.open = false;
                    this.player.destroy();
                    this.player = {};
                }
            });

            closeLightbox
                .to(this.$refs.button, { duration: 0.3, autoAlpha: 0 })
                .fromTo(
                    this.$refs.screenCover,
                    { yPercent: 104 },
                    { duration: 0.6, yPercent: 0, ease: 'circ.inOut' },
                    '<0'
                )
                .set(this.$refs.screen, { opacity: 0 })
                .to(this.$refs.background, { duration: 0.8, yPercent: -104, ease: 'expo.inOut' });

            document.body.classList.remove('no-scroll');
        }
    };
};
