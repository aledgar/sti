<template>
    <div>
        <!--<input v-validate="'required|email'" class="form-control"  name="email" type="text">-->
        <!--<div class="valid-feedback">Looks good!</div>-->
        <!--<div class="invalid-feedback">{{ errors.first("email") }}</div>-->
        <form @submit.prevent="$emit('guardar')" action="post">
            <div class="row">
                <div class="col-md-12">
                    <label for="institucion">Nombre de la institución:</label>
                    <input type="text" name="institucion" v-model="institucion.nombre" v-validate="'required|alpha_spaces|min:5'" placeholder="Institución:"
                           class="form-control">
                    <div class="valid-feedback">Se ve bien!</div>
                    <div class="invalid-feedback">{{ errors.first("institucion") }}</div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" :disabled="errors.any() || !institucion.nombre" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CrearInstitucion",
        props:{
            institucion:{
                type:Object,
                required:true
            }
        },
        data(){
            return{
                disabled:true,
            }
        },
        methods:{
        }
    }
</script>

<style scoped>

</style>
