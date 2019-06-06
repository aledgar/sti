<template>
    <div>

        <div class="d-flex flex-row-reverse mb-4">
            <button class="btn btn-primary" @click="mostrarModalCrear">Crear</button>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 table-responsive">
                <table class="table text-center table-bordered">
                    <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="(carrera, index) in carreras">
                            <td v-text="index+1"></td>
                            <td v-text="carrera.nombre"></td>
                            <td>
                                <button @click="mostrarModalCrear(carrera.id,carrera.nombre,index)" class="btn btn-primary">
                                    Editar
                                </button>
                                <button v-if="carrera.deleted===0" @click="editarEstado(index,carrera.id,1)" class="btn btn-danger">
                                    Desactivar
                                </button>
                                <button v-else @click="editarEstado(index,carrera.id,0)" class="btn btn-success">
                                    Activar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal" id="modalCrear">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear carrera</h5>
                        <button @click="cerrarModalCrear" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" v-model="carrera.id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Nombre carrera:</label>
                                <input type="text" name="carrera" placeholder="Carrera:" v-model="carrera.carrera" v-validate="'required|alpha_spaces|min:5'" class="form-control">
                                <div class="valid-feedback">Se ve bien!</div>
                                <div class="invalid-feedback">{{ errors.first("carrera") }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" @click="cerrarModalCrear">Cerrar</button>
                        <button v-if="!carrera.id" type="button" :disabled="errors.any() || !carrera.carrera.length" @click="guardarCarrera" class="btn btn-success">Guardar</button>
                        <button v-else type="button" :disabled="errors.any() || !carrera.carrera.length" @click="editarCarrera" class="btn btn-success">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    export default {
        name: "CarrerasComponent",
        data : () => ({
            carrera:{
                id:0,
                carrera:''
            },
            carreras:[],
            indexAux: -1
        }),
        mounted(){
            this.obtenerCarreras();
        },
        methods:{
            mostrarModalCrear(id = 0, carrera = '', index = -1){

                if(id!==0 && carrera!=='' && index!==-1){
                    this.carrera.id = id;
                    this.carrera.carrera = carrera;
                    this.indexAux = index;
                }

                $("#modalCrear").modal("show");
            },
            cerrarModalCrear(){
                this.carrera.carrera = '';
                this.carrera.id = 0;
                $("#modalCrear").modal("hide");
            },
            guardarCarrera(){
                axios.post('/carreras',{nombre:this.carrera.carrera})
                    .then(response => {
                        if(response.data.success===true){
                            this.cerrarModalCrear();
                            swal({
                                icon: "success",
                                title: "Se ha creado la institución.",
                            });
                            // console.log(response.data);
                            this.carreras.push(response.data.carrera);
                        }
                    })
                    .catch(err => console.log(err));
            },
            obtenerCarreras(){
                axios.get('/carreras/obtener')
                    .then(response=>{
                        if(response.data.carreras.length>0){
                            this.carreras = response.data.carreras;
                        }
                    })
                    .catch(err => console.log(err));
            },
            editarCarrera(){
                axios.put(`/carreras/${this.carrera.id}`,{nombre:this.carrera.carrera})
                    .then(response => {
                        if(response.data.success===true){
                            this.cerrarModalCrear();
                            swal({
                                icon: "success",
                                title: "Se ha editado la institución.",
                            });
                            this.carreras[this.indexAux] = response.data.carrera;
                        }
                    })
                    .catch(err => console.log(err));
            },
            editarEstado(index,id,estado){
                axios.post(`/carreras/${id}`,{deleted:estado})
                    .then(response => {
                        if(response.data.success===true){
                            swal({
                                icon: "success",
                                title: "Se ha cambiado el estado de la carrera.",
                            });
                            this.carreras[index].deleted = estado;
                        }
                    })
                    .catch(err => console.log(err));
            }
        }
    }
</script>

<style scoped>

</style>
