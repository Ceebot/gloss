import Vue from 'vue';
import Admin from "./components/Admin.vue";
import Products from "./components/Products.vue";
import Application from "./components/Application.vue";

import "../css/header.less";
import "../css/footer.less";
import "../css/hero.less";
import "../css/popup-admin.less";
import "../css/do.less";
import "../css/contacts.less";
import "../css/application.less";
import "../css/popup-success.less";


function vueInit(vueEl, vueComponent) {
    if ( !vueEl ) return;
    const props = JSON.parse(vueEl.getAttribute('data-vue'));
    new Vue({
        el: vueEl,
        render: h => h(vueComponent, { props }),
    });
}

vueInit(document.querySelector('.vue-admin'), Admin);
vueInit(document.querySelector('.vue-popup-products'), Products);
vueInit(document.querySelector('.vue-application'), Application);
