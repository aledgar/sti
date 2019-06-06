<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Test de Felder</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <p><b>{{preguntas[countPreg]}}</b></p>
                            <p><input type="radio" v-model="selecUsr[countPreg]" value="1"> {{respuestas[countPreg][0]}}</p>
                            <p><input type="radio" v-model="selecUsr[countPreg]" value="2"> {{respuestas[countPreg][1]}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="display: flex; justify-content: space-between">
                            <button v-if="countPreg > 0" class="btn btn-success" @click="anterior()">
                                Anterior
                            </button>
                            <button v-if="countPreg < preguntas.length-1" class="btn btn-success" @click="siguiente()">
                                Siguiente
                            </button>
                            <button :disabled="validate()"  v-if="countPreg === preguntas.length-1 && cargando === false" @click="guardar()" class="btn btn-dark">
                                Guardar
                            </button>
                            <div v-if="cargando">
                                <img src="/images/sistema/loading-test.gif" style="width: 90px; height: 30px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
<!--        <div class="row">-->
            <div class="col-md-4 col-sm-4">
                <div class="card shadow">
                    <div class="card-body">
                        <p>preguntas:</p>
                        <br>
                        <div class="preguntas">
                            <div  v-for="(v,index) in selecUsr">
                                <div @click="seleccionar(index)" :class="['pregunta',selecUsr[index]===0 ? 'rojo' : 'verde']" style="padding: 5px;  margin-right:1.5px; margin-bottom: 1.5px;">{{index+1}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--        </div>-->
    </div>
</template>

<script>
    export default {
        name: "FelderComponent",
        props: ['id_alumno'],
        data: () => ({
            countPreg:0,
            selecUsr: new Array(44).fill(0),
            cargando: false,
            preguntas: ['Entiendo mejor algo:', 'Me considero', 'Cuando pienso acerca de lo que hice ayer, es más probable que lo haga sobre' +
            'la base de:', 'Tengo tendencia a:', 'Cuando estoy aprendiendo algo nuevo, me ayuda:', 'Si yo fuera profesor, yo preferiría dar un curso:',
                'Prefiero obtener información nueva de:', 'Una vez que entiendo:', 'En un grupo de estudio que trabaja con un material difícil, es más probable que:',
                'Es más fácil para mí:', ' En un libro con muchas imágenes y gráficas es más probable que:', 'Cuando resuelvo problemas de matemáticas:',
                '. En las clases a las que he asistido:', 'Cuando leo temas que no son de ficción, prefiero:', 'Me gustan los maestros:', 'Cuando estoy analizando un cuento o una novela:',
                'Cuando comienzo a resolver un problema de tarea, es más probable que:', 'Prefiero la idea de:', 'Recuerdo mejor:', 'Es más importante para mí que un profesor:',
                'Prefiero estudiar:', 'Me considero:', 'Cuando alguien me da direcciones de nuevos lugares, prefiero:', 'Aprendo:', 'Prefiero primero:',
                'Cuando leo por diversión, me gustan los escritores que:', 'Cuando veo un esquema o bosquejo en clase, es más probable que recuerde:',
                'Cuando me enfrento a un cuerpo de información:', 'Recuerdo más fácilmente:', 'Cuando tengo que hacer un trabajo, prefiero:', 'Cuando alguien me enseña datos, prefiero:',
                'Cuando escribo un trabajo, es más probable que:', 'Cuando tengo que trabajar en un proyecto de grupo, primero quiero:', 'Considero que es mejor elogio llamar a alguien:',
                'Cuando conozco gente en una fiesta, es más probable que recuerde:', 'Cuando estoy aprendiendo un tema, prefiero:',
                'Me considero:', ' Prefiero cursos que dan más importancia a:', 'Para divertirme, prefiero:', 'Algunos profesores inician sus clases haciendo un bosquejo de lo que enseñarán. Esos bosquejos son:',
                ' La idea de hacer una tarea en grupo con una sola calificación para todos:','Cuando hago grandes cálculos:', 'Tiendo a recordar lugares en los que he estado:',
                'Cuando resuelvo problemas en grupo, es más probable que yo:'],
            respuestas:[['si lo practico.','si pienso en ello.'],['realista.','innovador'],['una imagen.','palabras.'],['entender los detalles de un tema pero no ver claramente su estructura' +
            'completa.','entender la estructura completa pero no ver claramente los detalles.'],['hablar de ello.','pensar en ello.'],['que trate sobre hechos y situaciones reales de la vida.','que trate con ideas y teorías.'],
            ['imágenes, diagramas, gráficas o mapas.','instrucciones escritas o información verbal.'],['todas las partes, entiendo el total.','el total de algo, entiendo como encajan sus partes.'],
            ['participe y contribuya con ideas.','no participe y solo escuche.'],['aprender hechos.','aprender conceptos.'],['revise cuidadosamente las imágenes y las gráficas.','me concentre en el texto escrito.'],
                ['generalmente trabajo sobre las soluciones con un paso a la vez.','frecuentemente sé cuales son las soluciones, pero luego tengo dificultad' +
                'para imaginarme los pasos para llegar a ellas.'],['he llegado a saber como son muchos de los estudiantes.','raramente he llegado a saber como son muchos estudiantes.'],['algo que me enseñe nuevos hechos o me diga como hacer algo.','algo que me dé nuevas ideas en que pensar.'],
            ['que utilizan muchos esquemas en el pizarrón.','que toman mucho tiempo para explicar.'],[' pienso en los incidentes y trato de acomodarlos para configurar los temas.','me doy cuenta de cuales son los temas cuando termino de leer y luego ' +
                'tengo que regresar y encontrar los incidentes que los demuestran.'],['comience a trabajar en su solución inmediatamente.',' primero trate de entender completamente el problema.'],['certeza.','teoría.'],['lo que veo.','lo que oígo.'],[' exponga el material en pasos secuenciales claros.','me dé un panorama general y relacione el material con otros temas.'],
            ['en un grupo de estudio.','solo.'],['cuidadoso en los detalles de mi trabajo.','creativo en la forma en la que hago mi trabajo.'],['un mapa.','instrucciones escritas.'],['a un paso constante. Si estudio con ahínco consigo lo que deseo.','en inicios y pausas. Me llego a confundir y súbitamente lo entiendo.'],
            ['hacer algo y ver que sucede.', 'pensar como voy a hacer algo.'], ['dicen claramente los que desean dar a entender.', 'dicen las cosas en forma creativa e interesante.'],
            ['la imagen.', 'lo que el profesor dijo acerca de ella.'], ['me concentro en los detalles y pierdo de vista el total de la misma.', 'trato de entender el todo antes de ir a los detalles.'], ['algo que he hecho.', 'algo en lo que he pensado mucho.'], ['dominar una forma de hacerlo.', 'intentar nuevas formas de hacerlo.'],
                ['gráficas.', 'resúmenes con texto.'], ['lo haga (piense o escriba) desde el principio y avance.', 'lo haga (piense o escriba) en diferentes partes y luego las ordene.'], ['realizar una "tormenta de ideas" donde cada uno contribuye con ideas.', 'realizar la "tormenta de ideas" en forma personal y luego juntarme con el grupo para comparar las ideas.'],
            ['sensible.', 'imaginativo'], ['cómo es su apariencia.', 'lo que dicen de sí mismos.'], ['mantenerme concentrado en ese tema, aprendiendo lo más que pueda de él.', 'hacer conexiones entre ese tema y temas relacionados.'], ['abierto.', 'reservado.'], ['material concreto (hechos, datos).', 'material abstracto (conceptos, teorías).'],
                ['ver televisión.', 'leer un libro.'], ['algo útiles para mí.', 'muy útiles para mí.'], ['me parece bien.', 'no me parece bien.'], ['tiendo a repetir todos mis pasos y revisar cuidadosamente mi trabajo.', 'me cansa hacer su revisión y tengo que esforzarme para hacerlo.'],
                ['fácilmente y con bastante exactitud.', 'con dificultad y sin mucho detalle.'], ['piense en los pasos para la solución de los problemas.', 'piense en las posibles consecuencias o aplicaciones de la solución en un amplio rango de campos.']]
        }),
        mounted(){
            // this.selecUsr = new Array(44).fill(0);
            // console.log(this.selecUsr.indexOf(0))

            swal('Advertencia','Si ya contestate este test y lo vuelves a contestar, se borrarán tus respuestas anteriores 😉','warning');
        },
        methods:{
            anterior(){
                this.countPreg--;
            },
            siguiente() {
                this.countPreg++;
            },
            guardar(){
                this.cargando = true;
                axios
                    .post('/alumno/guardar/test-felder',{respuestas: this.selecUsr,id_alumno: this.id_alumno})
                    .then(response => {
                        // console.log(response.data.success);
                        if(response.data.success===true){
                             swal('Éxito','Se han guardado tus respuestas! recuerda que puedes contestar este test cuantas veces quieras! 😄','success');
                             this.selecUsr = new Array(44).fill(0);
                             this.countPreg = 0;
                             this.cargando = false;
                        }
                    })
                    .catch(err => console.log(err))
            },
            seleccionar(index){
                this.countPreg = index;
            },
            validate(){
                var arr = this.selecUsr.filter(u => u === 0);
                if(arr.length>0){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
</script>

<style scoped>
    .preguntas{
        display: flex;
        flex-flow: row wrap;
        /*justify-content: space-around;*/
    }
    .pregunta{
        align-self: flex-start;
    }
    .pregunta:hover{
        align-self: flex-start;
        cursor: pointer;
    }
    .rojo{
        background: #EF442C;
        color: #fff;
    }
    .verde{
        background: #1cc88a;
        color: #fff;
    }
</style>
