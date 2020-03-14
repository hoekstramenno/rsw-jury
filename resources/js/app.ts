require('jquery');
require('bootstrap');
require('chart.js');

import "circular-std";
import "@fortawesome/fontawesome-free/js/all.js"

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        RadarChart: () => import('./components/RadarComponent.vue'),
        BarChart: () => import('./components/BarComponent.vue'),
        LineChart: () => import('./components/LineComponent.vue'),
        HikeTime: () => import('./components/Hike/HikeTimeComponent.vue'),
    }
});
