import Vue from 'vue'

import './axios'
import './fontawesome'
import 'bootstrap'
import './element'
import './croppa'
// import './calendar'
import Global from '~/mixin/Global'
import lodash from 'lodash'
import flatpickr from 'flatpickr';


Vue.mixin(Global)

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

import Helper  from '~/Funciones';
Vue.prototype.$Helper = Helper;

import Flatpickr from 'flatpickr';
import FlatpickrI18n from 'flatpickr/dist/l10n/es';
Flatpickr.localize(FlatpickrI18n.es);
// const flatpickr = require("flatpickr");

import VueFlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
Vue.use(VueFlatPickr);


import { ValidationProvider, ValidationObserver, extend } from 'vee-validate'
// import { ValidationProvider, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules'
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

import Vuesax from 'vuesax'
// import { vsButton, vsNavbar } from 'vuesax'
import 'vuesax/dist/vuesax.css'
Vue.use(Vuesax)
//
// Vue.use(vsButton)
// Vue.use(vsNavbar)
// Vue.use(vsPopup)
