<template>
    <div>
        <div class="float-right">
            <a href="/maestros/crear" class="btn btn-primary">Crear</a>
        </div>
        <div class="row">
            <div class="col-md-4 mr-0">
                <div class="input-group">
                    <input type="text" v-model="textSearch" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                                <button class="btn btn-dark" @click="">Buscar</button>
                                <button class="btn btn-link"
                                        v-if="textSearch!=='' && textSearch!== undefined && textSearch!==null"
                                        @click="getInstituciones">Reset</button>
                            </span>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 table-responsive" v-if="maestros.length">
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>#</th>
                    <th>Foto *</th>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th> Teléfono</th>
                    <th>Email</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="(maestro,index) in maestros">
                            <td>{{index+1}}</td>
                            <td><img style="height: 50px; width:50px; border-radius: 50%" :src="getImg(maestro.foto)" :alt="'maestro.name'"></td>
                            <td>{{maestro.name}}</td>
                            <td>{{maestro.lastname}}</td>
                            <td>{{maestro.telefono}}</td>
                            <td>{{maestro.email}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" :href="'/maestros/editar/'+maestro.id">Editar</a>
                                        <a class="dropdown-item mostrar-modal-link" style="cursor:pointer" @click="mostrarModal(maestro.id)">Insituciones</a>
                                        <a class="dropdown-item" href="#">Desactivar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12" v-else>
                <div class="alert alert-warning">
                    <h4>No hay maestros registrados</h4>
                </div>
            </div>
        </div>
        <div class="modal" id="modalInstituciones" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Asignación de instituciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" v-if="faltantes.length">
                            <input type="hidden" v-model="idMaestro" name="">
                            <div class="col-md-8">
                                <label for="">Instituciones: </label>
                                <select v-model="idInstitucion" class="form-control">
                                    <option v-for="(faltante,index) in faltantes"
                                            :value="faltante.id"
                                            :key="index"
                                            >
                                        {{faltante.nombre}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-agregar-institucion" @click="agregarMaestroInstitucion()">Agregar</button>
                            </div>
                        </div>
                        <div v-else>
                            <h5>Ya haz agregado todas las insitituciones...</h5>
                        </div>
                        <br>
                        <div class="row" v-if="institucionesAgregadas.length">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th>#</th>
                                    <th>Institución</th>
                                    <th>Opciones</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(institucion,index) in institucionesAgregadas">
                                            <td>{{index+1}}</td>
                                            <td>{{institucion.nombre}}</td>
                                            <td>
                                                <button v-if="institucion.deleted===1 || institucion.deleted===true" class="btn btn-success" @click="cambiarStatusMi(institucion.id_mi,institucion.deleted,index)">Activar</button>
                                                <button v-else class="btn btn-danger" @click="cambiarStatusMi(institucion.id_mi,institucion.deleted,index)">Desactivar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-else>
                            <h4>Aún no tiene agregadas instituciones</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    export default {
        name: "Maestro",
        data() {
            return {
                maestros: [],
                textSearch: '',
                faltantes:[],
                idMaestro:null,
                idInstitucion:null,
                institucionesAgregadas:[]
            }
        },
        mounted() {
            this.getMaestros();
        },
        computed:{

        },
        methods:{
            getMaestros()
            {
                axios.get('/maestros/api')
                    .then((response)=>{
                        this.maestros = response.data;
                    })
                    .catch((err)=>{
                        console.log(err.data);
                    });
            },
            getImg(img){
                if(img==='' || img === undefined || img === null){
                    // console.log(img);
                    return '/images/maestros/nofoto.png';
                }else{
                    return '/images/maestros/'+img;
                }
            },
            mostrarModal(id){
                $("#modalInstituciones").modal('show');
                this.idMaestro = id;
                axios.get(`/maestros/select/${id}`)
                    .then((response)=>{
                        console.log(response.data);
                        if(response.data.faltantes.length>0){
                            this.idInstitucion = response.data.faltantes[0].id;
                            this.faltantes = response.data.faltantes
                        }else{
                            this.faltantes = [];
                        }

                        if(response.data.agregadas.length>0){
                            this.institucionesAgregadas = response.data.agregadas;
                        }else{
                            console.log('entra');
                            this.institucionesAgregadas = [];
                        }

                    })
                    .catch((err)=>{
                        console.log(err.data)
                    });
            },
            agregarMaestroInstitucion(){
                axios.post('/maestros-institucion/guardar',
                    {id_maestro:this.idMaestro,id_institucion:this.idInstitucion})
                    .then((response)=>{
                        if(response.data.exito===true){
                            this.faltantes = this.faltantes
                                .filter(item => item.id !== response.data.maestroInst.id_institucion);

                            const { id_maestro, id_institucion, deleted, id } = response.data.maestroInst;
                            const {nombre} = response.data.institucion[0];

                            const obj = {
                                id_maestro,
                                id_institucion,
                                deleted,
                                id_mi:id,
                                nombre
                            };

                            this.institucionesAgregadas.push(obj);

                            if(this.faltantes.length===0){
                                this.faltantes=[];
                            }else{
                                this.idInstitucion = this.faltantes[0].id;
                            }

                        }else{
                            swal({
                                icon: "error",
                                title: "Algo ha salido mal, intente nuevamente"
                            });
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },
            cambiarStatusMi(id,status,index){
                axios.post('/maestros-institucion/desactivar',{id:id,status:status})
                    .then((res)=>{
                        if(res.data.exito===true){
                            this.institucionesAgregadas[index].deleted = res.data.status;
                        }else{
                            swal({
                                icon: "error",
                                title: "Algo ha salido mal, intente nuevamente"
                            });
                        }
                    })
                    .catch((err)=>{

                    });
            }
        }
    }
</script>

<style scoped>
    .mostrar-modal-link{
        cursor: pointer;
    }
    .mostrar-modal-link:active{
        color: #000000;
        background: #ffffff;
    }
    .btn-agregar-institucion{
        margin-top: 29px;
    }
</style>
