import animations from '@stores/Animations'
import audio from '@stores/Audio'
import header from '@stores/Header'
import overlays from '@stores/Overlays'
import utilities from '@stores/Utilities'

export default () => {
    animations()
    audio()
    header()
    overlays()
    utilities()
}
