require('./bootstrap');

import Vue from 'vue';

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(key
        .split("/")
        .pop()
        .split(".")[0],
        files(key).default
    )
);

window.app = new Vue().$mount('#app');
