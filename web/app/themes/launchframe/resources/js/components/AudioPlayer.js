import { Howl, Howler } from 'howler';

export default () => {
    return {
        src: null,
        audio: null,
        playing: false,

        mounted() {
            this.audio = new Howl({
                src: this.src,
                onplay: () => {
                    this.playing = true;
                },
                onpause: () => {
                    this.playing = false;
                },
                onend: () => {
                    this.playing = false;
                }
            });
        },

        toggle() {
            if (this.playing) {
                this.audio.pause();
            } else {
                this.audio.play();
            }
        },

        stop() {
            if (this.playing) {
                this.audio.pause();
            }
        }
    };
};
