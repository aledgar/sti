<template>
    <form @submit.prevent="agregarMaestro" enctype="multipart/form-data">
        <div>
                <div class="row" v-if="errores.length">
                    <div class="col-md-12">
                        <div class="alert alert-danger" style="text-align: justify !important;">
                            <h7>Error(es)!</h7>
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
                        <button class="float-right btn btn-success" type="submit">Guardar</button>
                    </div>
                </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "MaestroCrear",
        data() {
            return {
                subirFoto: false,
                maestro:{
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
        methods: {
            agregarImg() {
                this.subirFoto = true;
            },
            noAgregarImg() {
                this.subirFoto = false;
            },
            agregarMaestro(e){
                e.preventDefault();
                this.errores = [];
                const config = {
                    headers:{'Content-Type':'multipart/form-data'}
                };
                let formData = new FormData();
                formData.append('image',this.maestro.image);
                formData.append('nombre',this.maestro.nombre);
                formData.append('apellido',this.maestro.apellido);
                formData.append('email',this.maestro.email);
                formData.append('telefono',this.maestro.telefono);
                formData.append('contra',this.maestro.contra);

                axios.post('/maestros/crear',formData,config)
                    .then((response)=>{
                        console.log('entra');
                        console.log(response.data.errors);
                        if(response.data.errors!==undefined){
                            this.errores = response.data.errors;
                        }
                    })
                    .catch((err)=>{
                        console.log(err.data)
                    })
            },
            onImageChange(e){
                console.log(e.target.files[0]);
                this.maestro.image = e.target.files[0];
            }
        }
    }
</script>

<style scoped>

</style>
