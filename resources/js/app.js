
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VeeValidate, {Validator} from 'vee-validate';
import validatorEs from 'vee-validate/dist/locale/es';

Vue.use(VeeValidate,{
    classes: true,
    fieldsBagName: 'veeFields',
    classNames: {
        valid: "is-valid",
        invalid: "is-invalid"
    },
});
Validator.localize('es',validatorEs);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('crear-institucion',require('./components/Institucion/CrearInstitucion.vue').default);
Vue.component('editar-institucion',require('./components/Institucion/EditarInstitucion.vue').default);
Vue.component('principal',require('./components/Institucion/Principal.vue').default);
Vue.component('principal-grupo',require('./components/Grupo/PrincipalGrupo.vue').default);
Vue.component('maestro',require('./components/Maestro/Maestro.vue').default);
Vue.component('maestro-crear',require('./components/Maestro/MaestroCrear.vue').default);
Vue.component('maestro-editar',require('./components/Maestro/MaestroEditar.vue').default);
Vue.component('carreras',require('./components/Carreras/CarrerasComponent').default);
//COMPONENTES DE MAESTROS
Vue.component('maestro-insitucion',require('./components/MaestrosComponents/Instituciones/Instituciones.vue').default);
Vue.component('grupo',require('./components/MaestrosComponents/Grupos/GrupoComponent').default);
//COMPONENTES DE ALUMNOS
Vue.component('felder',require('./components/AlumnosComponents/FelderComponent').default);
Vue.component('conocimiento',require('./components/AlumnosComponents/ConocimientoComponent').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
