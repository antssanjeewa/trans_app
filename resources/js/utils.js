
import { throttle } from "lodash";
import { pickBy } from "lodash";
import { router } from '@inertiajs/vue3';

export function createThrottledHandler(form, routeName, delay = 150) {
    return throttle(() => {
        // Filter out empty or undefined values from the form
        const query = pickBy(form); 

        // If the form has valid data, use it, otherwise default to { remember: "forget" }
        const queryParams = Object.keys(query).length ? query : { remember: "forget" };

        // Perform the Inertia visit
        router.visit(window.route(routeName, queryParams), { preserveState: true });
    }, delay);
}

export function formatCurrency(value) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    }).format(value);
}

export function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
