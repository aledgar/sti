<template>
    <div>
        <div class="container" v-if="instituciones.length">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control" v-model="institucion">
                            <option v-for="institucion in instituciones" :value="institucion.id">
                                {{institucion.nombre}}
                            </option>
                        </select>
                        <span class="input-group-btn">
                                <button class="btn btn-dark" @click="getGrupos">Buscar</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row m-4">
                <div class="col-md-12 table-responsive" v-if="grupos.length>0">
                    <table class="table table-hover">
                        <thead>
                        <th>#</th>
                        <th>Grado</th>
                        <th>Grupo</th>
                        <th>Genearación inicio</th>
                        <th>Generación fin</th>
                        <th>Turno</th>
                        <th>Carrera</th>
                        <th>Opciones</th>
                        </thead>
                        <tbody>
                        <tr v-for="(grupov,index) in grupos" :key="grupov.id">
                            <td>{{index+1}}</td>
                            <td v-text="grupov.grado"></td>
                            <td v-text="grupov.grupo"></td>
                            <td v-text="grupov.generacion_inicio"></td>
                            <td v-text="grupov.generacion_fin"></td>
                            <td v-text="grupov.turno"></td>
                            <td v-text="grupov.carrera"></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a :href="'/maestro/crear-alumno/'+grupov.id" class="dropdown-item link">Agregar alumno</a>
                                        <a class="dropdown-item link" :href="'/maestro/alumnos/'+grupov.id">Ver alumnos</a>
                                        <button class="dropdown-item link" @click="mostrarModal(grupov,index)">Editar
                                            grupo
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="col-md-12">
                    <div class="alert alert-warning">
                        <h4>Esta institución aún no tiene grupos asignados.</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <h4>No tiene instiuciones asociadas.</h4>
                </div>
            </div>
        </div>
        <div class="modal" id="modal_grupos" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar grupo</h5>
                        <button type="button" class="close" @click="cerrarModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="row justicar-lista" v-if="erroresEditarGpo.length">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <div class="row">
                                                    <h4>Error!</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul>
                                                            <li v-for="error in erroresEditarGpo">
                                                                {{error}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Grado:</label>
                                                <input v-model="grupo.grado" type="text" name="grado"
                                                       placeholder="Grado:" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Grupo:</label>
                                                <input v-model="grupo.grupo" type="text" placeholder="Grupo:"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Carrera:</label>
                                            <select v-model="grupo.id_carrera" class="form-control">
                                                <option v-for="carrera in carreras" :value="carrera.id">
                                                    {{carrera.nombre}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fuente-pequeña" for="">Año inicio generación:</label>
                                                <input v-model="grupo.generacion_inicio" type="text"
                                                       placeholder="Eg, 2015" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fuente-pequeña" for="">Año fin generación:</label>
                                                <input type="text" v-model="grupo.generacion_fin" placeholder="2020"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fuente-pequeña" for="">Turno:</label>
                                                <select v-model="grupo.turno" class="form-control">
                                                    <option value="M">M</option>
                                                    <option value="V">V</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="cerrarModal()" class="btn btn btn-dark">Cerrar</button>
                        <input type="submit" class="btn btn-success" @click="editarCarrera()" value="Editar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GrupoComponent",
        props: ['maestro'],
        data() {
            return {
                instituciones: [],
                institucion: '',
                grupos: [],
                erroresEditarGpo: [],
                grupo: {
                    id: '',
                    id_institucion: '',
                    id_maestro: '',
                    id_carrera: '',
                    grado: '',
                    grupo: '',
                    generacion_inicio: '',
                    generacion_fin: '',
                    turno: 'M',
                },
                carreras: [],
                indexAux: null
            }
        },
        mounted() {
            this.getInstituciones();
            this.getCarreras();
        },
        methods: {
            getInstituciones() {
                axios.get('/instituciones/asociadas/tb')
                    .then(response => {
                        this.instituciones = response.data.institucionesMaestro;
                        console.log(this.instituciones.length);
                        if (this.instituciones.length > 0) {
                            console.log('entra');
                            this.institucion = this.instituciones[0].id;
                            this.getGrupos();
                        }
                    })
                    .catch(err => console.log(err));
            },
            getCarreras() {
                axios.get('/instituciones/carreras')
                    .then((response) => {
                        this.carreras = response.data.carreras;
                        console.log(this.carreras);
                    })
                    .catch((err) => console.log(err));
            },
            getGrupos() {
                this.grupos = [];
                axios.get(`/maestro/grupos/${this.institucion}/${this.maestro.id}`)
                    .then(response => {
                        this.grupos = response.data;
                    })
                    .catch(err => console.log(err.data));
            },
            mostrarModal(grupov, index) {
                $("#modal_grupos").modal("show");
                console.log(grupov);
                this.grupo.grado = grupov.grado;
                this.grupo.id = grupov.id;
                this.grupo.id_institucion = grupov.id_institucion;
                this.grupo.id_maestro = grupov.id_maestro;
                this.grupo.id_carrera = grupov.id_carrera;
                this.grupo.grupo = grupov.grupo;
                this.grupo.generacion_inicio = grupov.generacion_inicio;
                this.grupo.generacion_fin = grupov.generacion_inicio;
                this.grupo.turno = grupov.turno;
                this.indexAux = index;
            },
            cerrarModal() {
                $("#modal_grupos").modal("hide");
                this.erroresEditarGpo = [];
            },
            editarCarrera() {
                this.erroresEditarGpo = [];
                console.log(this.grupo);
                axios.put('/instituciones/grupos', this.grupo)
                    .then(response => {
                        if (response.data.success === true) {
                            this.grupos[this.indexAux] = this.grupo;
                            this.grupos[this.indexAux].carrera = response.data.carrera;
                            this.cerrarModal();
                            // console.log(response.data.grupo);
                            swal('Éxito!', 'Se ha editado el grupo', 'success');
                        } else if (response.data.errors !== undefined) {
                            this.erroresEditarGpo = response.data.errors;
                        }
                    })
                    .catch(err => console.log(err));
            }
        }
    }
</script>

<style scoped>
    .link {
        cursor: pointer;
    }

    .link:active {
        color: #000000;
        background: #ffffff;
    }

    .fuente-pequeña {
        font-size: 12px;
    }

    .justicar-lista {
        text-align: justify;
    }
</style>
