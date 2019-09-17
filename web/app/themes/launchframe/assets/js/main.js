/* :: Import Dependencies
{+} ---------------------------------- */
import 'gsap';
import ScrollMagic from 'scrollmagic';
import 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap';
global.ScrollMagic = ScrollMagic;

/* :: Import Local
{+} ---------------------------------- */
import Router from './util/Router';
import core from './bootstrap';

/* :: Router Setup
{+} ---------------------------------- */
const routes = new Router({
    core
});

console.log(
    `%cCrafted by https://whiteboard.is`,
    'background: #129BE5; color: #ffffff; font-size: 13px; padding: 4px 8px;'
);

/* :: Load!
{+} ---------------------------------- */
jQuery(document).ready(() => routes.loadEvents());
