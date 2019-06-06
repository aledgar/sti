<template>
    <div>
        <div class="row" v-if="institucionesM.length">
            <div class="col-md-12 table-responsive">
                <h5>Todas tus instituciones asociadas: </h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="(institucion, index) in institucionesM">
                            <td>{{index+1}}</td>
                            <td>{{institucion.nombre}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item link" @click="mostrarModalGrupo(institucion.id)">Crear grupos</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    No tiene instituciones asociadas.
                </div>
            </div>
        </div>
        <div class="modal" id="modal_grupos" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear grupo</h5>
                        <button type="button" class="close" @click="cerrarModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="row justicar-lista" v-if="erroresGuardarGpo.length">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <div class="row">
                                                    <h4>Error!</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul>
                                                            <li v-for="error in erroresGuardarGpo">
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
                                                <input v-model="grupo.grado" type="text" name="grado" placeholder="Grado:" class="form-control">
                                                <div class="valid-feedback">Se ve bien!</div>
                                                <div class="invalid-feedback">{{ errors.first("grado") }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Grupo:</label>
                                                <input v-model="grupo.grupo" type="text" placeholder="Grupo:" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Carrera:</label>
                                            <select v-model="grupo.carrera" class="form-control">
                                                <option v-for="carrera in carreras" :value="carrera.id">{{carrera.nombre}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fuente-pequeña" for="">Año inicio generación:</label>
                                                <input v-model="grupo.generacion_inicio" type="text" placeholder="Eg, 2015" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fuente-pequeña" for="">Año fin generación:</label>
                                                <input type="text" v-model="grupo.generacion_fin" placeholder="2020" class="form-control">
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
                        <button type="button" class="btn btn btn-dark" @click="cerrarModal()">Cerrar</button>
                        <input type="submit" class="btn btn-success" @click="guardarGrupo()" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import swal from 'sweetalert';

    export default {
        name: "Instituciones.vue",
        mounted(){
            this.getTableContent();
        },
        data(){
            return {
                institucionesM:[],
                erroresGuardarGpo:[],
                grupo:{
                    id_institucion:'',
                    id_maestro:'',
                    grado:'',
                    grupo:'',
                    generacion_inicio:'',
                    generacion_fin:'',
                    turno:'M',
                    carrera:''
                },
                carreras:[]
            }
        },
        methods:{
            getTableContent(){
                axios.get('/instituciones/asociadas/tb')
                    .then((response)=>{
                        console.log(response.data);
                        this.institucionesM = response.data.institucionesMaestro;
                        this.grupo.id_maestro = response.data.maestroId;
                        this.carreras = response.data.carreras;
                        this.grupo.carrera = this.carreras[0].id;
                    })
                    .catch((err) => console.log(err.data))
            },
            mostrarModalGrupo(id){
                $("#modal_grupos").modal('show');
                if(id === undefined || id === null || id === ''){
                    $("#modal_grupos").modal('hide');
                }else{
                    this.grupo.id_institucion = id;
                }
            },
            cerrarModal(){
                $("#modal_grupos").modal('hide');
                this.grupo.grado='';
                this.grupo.grupo='';
                this.grupo.generacion_inicio='';
                this.grupo.generacion_fin='';
                this.grupo.turno='M';
                this.grupo.id_institucion = '';
                this.erroresGuardarGpo = [];
            },
            guardarGrupo(){
                this.erroresGuardarGpo = [];
                axios.post('/instituciones/asociar-grupo', this.grupo)
                    .then(response =>{
                        if(response.data.errors !== undefined){
                            console.log('entra aquí');
                            this.erroresGuardarGpo = response.data.errors;
                        }else if(response.data.success===true){
                            swal({
                                icon: "success",
                                title: "Se ha creado al grupo"
                            }).then(ok => {
                                if(ok){
                                    this.cerrarModal();
                                }
                            });
                            this.cerrarModal();
                        }
                    })
                    .catch(err => console.log(err));
                // alert('entra');
            }
        }

    }
</script>

<style scoped>
    .link{
        cursor: pointer;
    }
    .link:active{
        color: #000000;
        background: #ffffff;
    }
    .fuente-pequeña{
        font-size: 12px;
    }
    .justicar-lista{
        text-align: justify;
    }
</style>
