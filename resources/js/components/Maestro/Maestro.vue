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
                            <td>op</td>
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
    </div>
</template>

<script>
    export default {
        name: "Maestro",
        data() {
            return {
                maestros: [],
                textSearch: ''
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
                    console.log(img);
                    return '/images/maestros/nofoto.png';
                }else{
                    return '/images/maestros/'+img;
                }
            }
        }
    }
</script>

<style scoped>

</style>
