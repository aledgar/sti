<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Instituciones</h4>
            </div>
            <div class="card-body">
                <div class="float-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleInst">Crear</button>
                </div>
                <div class="row">
                    <div class="col-md-4 mr-0">
                        <div class="input-group">
                            <input type="text" v-model="textSearch" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-dark" @click="institucionFilter">Buscar</button>
                                <button class="btn btn-link" v-if="textSearch!=='' && textSearch!== undefined && textSearch!==null" @click="getInstituciones">Reset</button>
                            </span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-top: 40px">
                    <div v-if="institucionFilter && instituciones.length" class="col-md-12">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Opciones</th>
                                </thead>
                                <tbody>
                                <tr v-for="(institucion, index) in instituciones">
                                    <td>{{index+1}}</td>
                                    <td>{{institucion.nombre}}</td>
                                    <td>
                                        <button v-if="!institucion.deleted" class="btn btn-danger"
                                                @click="cambioStatus(institucion,'des')">Desactivar
                                        </button>
                                        <button v-else class="btn btn-info" style="color: #ffffff"
                                                @click="cambioStatus(institucion,'ac')">Activar
                                        </button>
                                        <button class="btn btn-success" @click="editarModal(institucion, index)">
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else class="col-md-12">
                        <div class="alert alert-warning">
                            <h4>No hay intituciones.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" ref="exampleInst" id="exampleInst" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear institución</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <crear-institucion @guardar="guardarInstitucion" :institucion="institucion"></crear-institucion>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" ref="edicionInst" id="edicionInst" tabindex="-1" role="dialog"
             aria-labelledby="edicionInstModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar institución</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <editar-institucion @editar="editarInstitucion" :institucion="institucion"></editar-institucion>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import CrearInstitucion from './CrearInstitucion';
    import swal from 'sweetalert';

    export default {
        name: "Principal",
        data() {
            return {
                instituciones: [],
                institucion: {
                    index: '',
                    id: '',
                    nombre: ''
                },
                textSearch: ''
            }
        },
        mounted() {
            // this.getInstituciones();
            this.institucionFilter();
        },
        components: {
            CrearInstitucion
        },
        computed: {},
        methods: {
            institucionFilter() {
                var textSearch = this.textSearch;
                console.log('ts ' + textSearch);
                if (textSearch === null || textSearch === undefined || textSearch === '') {
                    this.getInstituciones();
                } else {
                    axios
                        .get(`/insituciones/buscar/${textSearch}`)
                        .then((response) => {
                            this.instituciones = response.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            },
            getInstituciones() {
                this.textSearch = '';
                axios
                    .get('/insituciones/obtener')
                    .then((response) => {
                        this.instituciones = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            guardarInstitucion() {
                this.$validator.validateAll();
                axios
                    .post('/instituciones/crear', {nombre: this.institucion.nombre})
                    .then((response) => {
                        this.instituciones.push(response.data);
                        this.institucion.nombre = '';
                        $("#exampleInst").modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            editarModal(institucion, index) {
                $("#edicionInst").modal('show');
                this.institucion.index = index;
                this.institucion.id = institucion.id;
                this.institucion.nombre = institucion.nombre;
            },
            editarInstitucion() {
                axios
                    .put('/insituciones/editar', {id: this.institucion.id, nombre: this.institucion.nombre})
                    .then(() => {
                        this.institucion.index = '';
                        this.institucion.id = '';
                        this.institucion.nombre = '';
                        $("#edicionInst").modal('hide');
                        swal({
                            icon: "success",
                            title: "Se ha editado la institución.",
                        });
                        this.getInstituciones();
                    })
                    .catch((err) => console.log(err.data));
            },
            cambioStatus(institucion, accion) {
                var accionReal = (accion === 'des') ? 'desactivar' : 'activar';
                var accionCompletado = (accion === 'des') ? 'desactivado' : 'activado';
                swal({
                    title: "Seguro quiere " + accionReal + " " + institucion.nombre + " ?",
                    text: "De cualquier forma la institución se podrá activar!",
                    icon: "warning",
                    dangerMode: true,
                })
                    .then(willDelete => {
                        if (willDelete) {
                            axios.put(`/instituciones/status/${institucion.id}`)
                                .then(() => {
                                    this.getInstituciones();
                                    swal({
                                        icon: "warning",
                                        title: "Se ha " + accionCompletado + " la institución.",
                                    });
                                })
                                .catch((err) => console.log(err.data));
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>
