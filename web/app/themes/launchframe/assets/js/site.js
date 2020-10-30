/* :: Import Dependencies
{+} ---------------------------------- */
import 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/* :: Set Globals
{+} ---------------------------------- */
global.gsap = gsap;
global.ScrollTrigger = ScrollTrigger;

/* :: Import Local
{+} ---------------------------------- */
import Router from '@/utilities/Router';
import core from '@/core';

/* :: Router Setup
{+} ---------------------------------- */
const routes = new Router({
    core
});

console.log(
    `%cCrafted with ❤ by https://whiteboard.is`,
    'background: #f60038; color: #ffffff; font-size: 13px; padding: 4px 8px;'
);

/* :: Load!
{+} ---------------------------------- */
window.onload = () => {
    routes.loadEvents();
};
