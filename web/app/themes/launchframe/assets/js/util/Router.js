import camelCase from './camelCase';

class Router {
    constructor(routes) {
        this.routes = routes;
    }

    fire(route, event = 'init', arg) {
        const fire = route !== '' && this.routes[route] && typeof this.routes[route][event] === 'function';
        if (fire) {
            this.routes[route][event](arg);
        }
    }

    // π ----
    // :: FIRE EVENTS ---------------------------::
    // ____
    loadEvents() {
        this.fire('core');

        document.body.className
            .toLowerCase()
            .replace(/-/g, '_')
            .split(/\s+/)
            .map(camelCase)
            .forEach(className => {
                this.fire(className);
                this.fire(className, 'finalize');
            });

        // Fire common finalize JS
        this.fire('core', 'finalize');
    }
}

export default Router;
