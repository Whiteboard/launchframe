import Alpine from 'alpinejs'
import Avalanche from 'avalanchejs'
import focus from '@alpinejs/focus'
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'
import { gsap } from 'gsap'
import { DrawSVGPlugin } from 'gsap/DrawSVGPlugin'
import { ScrollToPlugin } from 'gsap/ScrollToPlugin'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { ScrollSmoother } from 'gsap/ScrollSmoother'
import { SplitText } from 'gsap/SplitText'

import stateManager from '@/StateManager'
import core from '@/Core'
import router from '@/Router'

Alpine.plugin(persist)
Alpine.plugin(focus)
Alpine.plugin(collapse)
window.Alpine = Alpine

gsap.registerPlugin(DrawSVGPlugin, ScrollTrigger, ScrollToPlugin, ScrollSmoother, SplitText)
window.gsap = gsap
window.mm = gsap.matchMedia()
ScrollTrigger.normalizeScroll(true)
window.ScrollSmoother = ScrollSmoother
window.ScrollTrigger = ScrollTrigger
window.SplitText = SplitText
Avalanche()

core()
stateManager()
console.log(
    `%cCrafted with ❤ by https://whiteboard.is`,
    'background: #5DC9F0; color: #0B2254; font-size: 13px; padding: 4px 8px;',
)
router()
