<template>
    <div>
        <h2>Principal grupos</h2>
    </div>
</template>

<script>
    export default {
        name: "PrincipalGrupo",
        data(){
            return {
                grupos:[],
                grupo:{
                    grado:'',
                    grupo:'',
                    generacion_inicio:'',
                    generacion_fin:'',
                    turno:''
                }
            }
        },
        methods:{
            getGrupos(){

            }
        }
    }
</script>

<style scoped>

</style>
