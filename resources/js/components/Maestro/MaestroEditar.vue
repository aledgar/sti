<template>
    <form @submit.prevent="updateMaestro" enctype="multipart/form-data">
        <div>
            <div class="row" v-if="errores.length">
                <div class="col-md-12">
                    <div class="alert alert-danger" style="text-align: justify !important;">
                        <h4>Error(es)!</h4>
                        <ul>
                            <li v-for="error in errores">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Nombre(s):</label>
                    <input type="text" v-model="maestro.nombre" class="form-control" placeholder="Nombre(s)">
                </div>
                <div class="col-md-6">
                    <label for="">Apellido(s):</label>
                    <input type="text" v-model="maestro.apellido" class="form-control" placeholder="Apellido(s)">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Email:</label>
                    <input type="email" v-model="maestro.email"  class="form-control" placeholder="Eg, email@mail.mx">
                </div>
                <div class="col-md-4">
                    <label for="">Contraseña:</label>
                    <input type="password" v-model="maestro.contra" class="form-control" placeholder="Contraseña">
                </div>
                <div class="col-md-4">
                    <label for="">Teléfono:</label>
                    <input type="text" v-model="maestro.telefono" class="form-control" placeholder="Teléfono">
                </div>
            </div>
            <br>
            <div v-if="mostrarDivFoto">
                <div class="row">
                    <div class="float-left">
                        <div class="col-md-2">
                            <img :src="'/images/maestros/'+maestro.image" :alt="maestro.name" class="foto_perfil">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="!subirFoto">
                <div class="float-left">
                    <button class="btn btn-link" @click="agregarImg">Agregar foto +</button>
                </div>
            </div>
            <div class="row" v-else>
                <div class="float-left">
                    <label for="">Agregue una foto:</label>
                    <input type="file" @change="onImageChange">
                </div>
                <button class="btn btn-link" @click="noAgregarImg" style="color:red !important;">Cancelar</button>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <button class="float-right btn btn-success" type="submit">Editar</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "MaestroEditar",
        data() {
            return {
                subirFoto: false,
                mostrarDivFoto:false,
                maestro:{
                    id_user:'',
                    id_maestro:'',
                    nombre:'',
                    apellido:'',
                    email:'',
                    contra:'',
                    telefono:'',
                    image:''
                },
                errores:[]
            }
        },
        props:{
            maestro_editar:{
                type:Object,
                required: true
            }
        },
        mounted() {
            this.setMaestroData();
        },
        methods:{
            setMaestroData(){
                this.maestro.nombre = this.maestro_editar.name;
                this.maestro.apellido = this.maestro_editar.lastname;
                this.maestro.email = this.maestro_editar.email;
                this.maestro.contra = 'contraseña_no_editar';
                this.maestro.id_user = this.maestro_editar.id_user;
                this.maestro.id_maestro = this.maestro_editar.id_maestro;
                this.maestro.telefono = this.maestro_editar.telefono;
                this.maestro.image = this.maestro_editar.foto;
                if(this.maestro.image !== null && this.maestro.image !== undefined && this.maestro.image !== ''){
                    this.mostrarDivFoto=true;
                }
            },
            agregarImg() {
                this.subirFoto = true;
            },
            noAgregarImg() {
                this.subirFoto = false;
            },
            updateMaestro(e){
                e.preventDefault();
                this.errores = [];
                const config = {
                    headers:{'Content-Type':'multipart/form-data'}
                };
                let formData = new FormData();
                console.log(this.maestro.nombre);
                if(this.maestro.image!==this.maestro_editar.foto){
                    formData.append('image',this.maestro.image);
                }
                formData.append('nombre',this.maestro.nombre);
                formData.append('apellido',this.maestro.apellido);
                formData.append('email',this.maestro.email);
                formData.append('telefono',this.maestro.telefono);
                formData.append('contra',this.maestro.contra);
                formData.append('id_user',this.maestro.id_user);
                formData.append('id_maestro',this.maestro.id_maestro);

                axios.post('/maestros/editar',formData,config)
                    .then((response)=>{
                        console.log('entra');
                        console.log(response.data.errors);

                        if(response.data.exito !== undefined){
                            // this.maestro.image='';
                            // this.maestro.nombre='';
                            // this.maestro.apellido='';
                            // this.maestro.email='';
                            // this.maestro.telefono='';
                            // this.maestro.contra='';
                            $("#edicionInst").modal('hide');
                            swal({
                                icon: "success",
                                title: "Se ha editado el maestro.",
                            }).then((ok)=>{
                                if(ok){
                                    window.location = '/maestros';
                                }
                            });
                        }

                        if(response.data.errors!==undefined){
                            this.errores = response.data.errors;
                        }
                    })
                    .catch((err)=>{
                        console.log(err.data)
                    })
            }
        }
    }
</script>

<style scoped>
    .foto_perfil{
        height: 70px;
        widows: 70px;
        border-radius: 100%;
    }
</style>
