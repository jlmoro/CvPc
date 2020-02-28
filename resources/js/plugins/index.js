import Vue from 'vue'

import './axios'
import './fontawesome'
import 'bootstrap'
import './element'
import './croppa'
import Global from '~/mixin/Global'
import lodash from 'lodash'

Vue.mixin(Global)

import Helper  from '~/Funciones';
Vue.prototype.$Helper = Helper;

import Flatpickr from 'flatpickr';
import FlatpickrI18n from 'flatpickr/dist/l10n/es';
Flatpickr.localize(FlatpickrI18n.es);
