<template>
    <form @submit.prevent="agregarMaestro">
        <div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre(s)">
                    </div>
                    <div class="col-md-6">
                        <label for="apellido">Apellido(s):</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido(s)">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Eg, email@mail.mx">
                    </div>
                    <div class="col-md-4">
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" name="contraseña" class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="col-md-4">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
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
                        <label for="foto">Agregue una foto:</label>
                        <input type="file" name="foto">
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
                subirFoto: false
            }
        },
        methods: {
            agregarImg() {
                this.subirFoto = true;
            },
            noAgregarImg() {
                this.subirFoto = false;
            },
            agregarMaestro(){
                alert('agregar');
            }
        }
    }
</script>

<style scoped>

</style>
