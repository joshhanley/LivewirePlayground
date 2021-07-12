require('./bootstrap')

import Vue from 'vue'
import 'livewire-vue'

window.Vue = Vue

Vue.component('example-component', require('./components/ExampleComponent.vue').default)

var app = new Vue({
    el: '#app',
})
