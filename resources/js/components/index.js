import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import modalForm from './modales/modalFormulario'
import modalB from './modales/modalB'
import modalEliminar from './modales/modalEliminar'
import menuCvpc from './MenuCvpc'
// import SelectAreas from './select/selectAreas'
// import SelectRoles from './select/selectRoles'
import selectEncargados from './select/selectEncargados'
import selectProveedores from './select/selectProveedores'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
    Card,
    Child,
    Button,
    Checkbox,
    HasError,
    AlertError,
    AlertSuccess,
    modalForm,
    modalB,
    modalEliminar,
    selectEncargados,
    selectProveedores,
    // SelectAreas,
    // SelectRoles,
].forEach(Component => {
    Vue.component(Component.name, Component)
})

const requireComponent = require.context(
    '~/components', true, /\.vue$/
)

requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName)

    const componentName = upperFirst(
        camelCase(fileName.replace(/^\.\//, '').replace(/\.\w+$/, ''))
        )

        Vue.component(componentName, componentConfig.default || componentConfig)
    })
