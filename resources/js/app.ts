require('jquery');
require('bootstrap');
require('chart.js');

import "circular-std";
import "@fortawesome/fontawesome-free/js/all.js"

window.Vue = require('vue');

// Vue.component('radar-chart', require('./components/Radar.component.vue').default);
// Vue.component('bar-chart', require('./components/Bar.component.vue').default);

const app = new Vue({
    el: '#app',
    components: {
        RadarChart: () => import('./components/RadarComponent.vue'),
        BarChart: () => import('./components/BarComponent.vue'),
        LineChart: () => import('./components/LineComponent.vue')
    }
});
