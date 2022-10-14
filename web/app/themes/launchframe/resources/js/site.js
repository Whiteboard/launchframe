import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

import stateManager from '@/StateManager';
import core from '@/Core';
import router from '@/Router';

Alpine.plugin(persist);
Alpine.plugin(focus);
window.Alpine = Alpine;

gsap.registerPlugin(ScrollTrigger, SplitText);
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.SplitText = SplitText;

stateManager();
core();
router();

console.log(
    `%cCrafted with ❤ by https://whiteboard.is`,
    'background: #FC3A2D; color: #ffffff; font-size: 13px; padding: 4px 8px;'
);
