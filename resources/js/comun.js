window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.getElementById('app')){
    const app = new Vue({
        el: '#app',
    });
}

if (document.getElementById('product')){
    require('./admin/product');
}

if (document.getElementById('confirmdelete')){
    require('./confirmdelete');
}

if (document.getElementById('api_search_autocomplete')) {
    require('./admin/api_search_autocomplete');
}
