<template>
    <div>
        <form @submit.prevent="$emit('editar')" action="post">
            <input type="hidden" name="id" v-model="institucion.id">
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
                    <button type="submit" :disabled="errors.any() || !institucion.nombre || !institucion.id"
                            class="btn btn-success">Editar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "EditarInstitucion",
        props: {
            institucion: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
