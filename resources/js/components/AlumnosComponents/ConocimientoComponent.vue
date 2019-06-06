<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow" style="overflow-y: scroll">
                    <div class="card-header">
                        <h4>Test de Conocimiento</h4>
                    </div>
                    <div class="card-body">
                        <!--                        <div class="text-center">-->
                        <p v-html="preguntas[countPreg]"></p>
                        <div style="text-align: justify">
                            <div>
                                <input type="radio" v-model="selecUsr[countPreg]" value="1">
                                <p style="display: inline-block" v-html="respuestas[countPreg][0]">
                                </p>
                            </div>
                            <div>
                                <input type="radio" v-model="selecUsr[countPreg]" value="2">
                                <p style="display: inline-block" v-html="respuestas[countPreg][1]"></p>
                            </div>
                            <div>
                                <input type="radio" v-model="selecUsr[countPreg]" value="3">
                                <p style="display: inline-block" v-html="respuestas[countPreg][2]">
                                </p>
                            </div>
                            <div>
                                <input type="radio" v-model="selecUsr[countPreg]" value="4">
                                <p style="display: inline-block" v-html="respuestas[countPreg][3]">
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="display: flex; justify-content: space-between">
                            <button v-if="countPreg > 0" class="btn btn-success" @click="anterior()">
                                Anterior
                            </button>
                            <button v-if="countPreg < preguntas.length-1" class="btn btn-success"
                                    @click="siguiente()">
                                Siguiente
                            </button>
                            <button :disabled="validate()" v-if="countPreg === preguntas.length-1 && cargando === false"
                                    @click="guardar()"
                                    class="btn btn-dark">
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
                        <div v-for="(v,index) in selecUsr">
                            <div @click="seleccionar(index)"
                                 :class="['pregunta',selecUsr[index]===0 ? 'rojo' : 'verde']"
                                 style="padding: 5px;  margin-right:1.5px; margin-bottom: 1.5px;">{{index+1}}
                            </div>
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
        name: "ConocimientoComponent",
        props: ['id_alumno'],
        data: () => ({
            countPreg: 0,
            selecUsr: new Array(26).fill(0),
            cargando: false,
            preguntas: ['<p style="text-align: center; font-weight: bold">¿Qué es un algoritmo?</p>', '<p style="text-align: center; font-weight: bold">¿Qué es un pseudocódigo?</p>',
                '<p style="text-align: center; font-weight: bold">¿Qué es un diagrama de flujo?</p>', '<p style="text-align: center; font-weight: bold">¿Qué es un lenguaje de programación?</p>',
                '<p style="text-align: center; font-weight: bold">¿Cuál es la diferencia entre variables tipo float e int?</p>',
                '<p style="text-align: center; font-weight: bold">¿Qué es una variable en programación?</p>', '<p style="text-align: center; font-weight: bold">¿Qué es un condicional?</p>',
                '<p style="text-align: center; font-weight: bold">¿Cuál de las siguientes es la estructura correcta de un if?</p>',
                '<p style="text-align: center; font-weight: bold">¿Cuál de las siguientes es la estructura correcta de un switch?</p>',
                '<p style="text-align: center; font-weight: bold">¿Qué es un ciclo en programación?</p>',
                '<p style="text-align: center; font-weight: bold">¿Hace lo mismo el código fuente Uno y el código fuente Dos? </p> ' +
                '<div style="text-align: center; display: flex; justify-content: space-between; padding-left: 40px; padding-right: 40px;">' +
                '<div style="text-align: justify; background: black;  color:#1cc88a; padding: 10px;"><br> <h5>Codigo 1:</h5>int x = 0; <br> do { <br> ' +
                '<p style="margin-left: 10px">System.out.println(x);</p> ' +
                ' <p style="margin-left: 10px">x++;</p> }while(x<10);</div><div style="text-align: justify; padding: 10px; background: black; color:#1cc88a"><br> <h5>Codigo 2:</h5>' +
                'int y = 0; <br> while(y<10) { <br> <p style="margin-left: 10px">System.out.println(y);</p>  <p style="margin-left: 10px">' +
                'y++;</p>}</div></div>',
                '<p style="text-align: center; font-weight: bold">¿Qué se imprime en pantalla el siguiente código?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:250px; padding:10px; color:#1cc88a">' +
                '<div style="text-align: justify"><p>int total = 10;</p><p>int contador =4</p><p>total -= --contador;</p>' +
                '<p>System.out.println(total);</p></div></div>',
                '<p style="text-align: center; font-weight: bold">¿Qué hace el siguiente código fuente?</p><div  class="shadow" style="margin: auto;  background: black; width:250px; padding:10px; color:#1cc88a">' +
                '<p>int suma = 0;</p><p>for (int x=1;x<=100;x++) {</p><p>if (x%2!=0) suma+=x; </p><p>}</p></div>',
                '<p style="text-align: center; font-weight: bold">¿Cuál es el valor que se muestra por pantalla?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:250px; padding:10px; color:#1cc88a">' +
                '<p>int x=10;</p><p>int y=0;</p><p>while (y<span><</span>x) {</p><p>y += x;</p><p>}</p></div>',
                '<p style="text-align: center; font-weight: bold">¿Qué hace la siguiente línea de código?</p>' +
                '<div class="shadow" style="margin: auto;  background: black; width:250px; padding:10px; color:#1cc88a">' +
                '<p>z = x++ + y;</p></div>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué hace el siguiente código fuente?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:250px; padding:10px; color:#1cc88a">' +
                '<p>int suma = 0;</p><p>int y = 1;</p><p>int x=0;</p><p>while(x<span><</span>100){</p><p>if(y%2!=0){</p>' +
                '<p>suma += y;</p><p>x++;</p><p>}</p><p>}</p> y++; }' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué hace el siguiente código fuente?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:290px; padding:10px; color:#1cc88a">' +
                '<p>int i=1;</p><p>int j=2;</p><p>System.out.println ((i <span>></span> 1) && (j <span>></span> 4));</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Cómo puedo elevar un número a una potencia? </p>',
                '<p style="text-align: center; font-weight: bold">¿Qué tipo de estructura representa el siguiente código?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:400px; padding:10px; color:#1cc88a">' +
                '<p>while (contador <span><</span> 20) {</p><p>System.out.println("Número de línea " + contador);</p><p>contador++;</p><p>}</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué se muestra por pantalla?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:400px; padding:10px; color:#1cc88a">' +
                '<p>for(int x=0;x<10;x++)</p><p style="margin-left: 10px">System.out.println(x);</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Cómo se debe llamar el fichero java con el código fuente de esta clase?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>public class MiClase {</p><p style="margin-left: 10px;">public static void main(String[] args) {</p>' +
                '<p style="margin-left:20px">System.out.println("Esta es mi clase");</p>' +
                '<p style="margin-left: 10px">}</p><p>}</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué hace el siguiente código fuente?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>int x=0;</p><p>boolean flag = false;</p><p>while ((x<10) && !flag) </p><p style="margin-left:10px;">System.out.println(x);</p><p style="margin-left: 10px">x++;</p><p>}</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Cuál es el valor que se muestra por pantalla?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>int x = 5;</p><p>int y = 5;</p><p>y *= x++;</p><p>System.out.println(y);</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué realiza el siguiente código?</p>' +
                '<div  class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>contador += x;</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold"> ¿Qué se imprime por pantalla?</p>' +
                '<div class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>int x = 10;</p><p>int y = 3;</p><p>System.out.println(x%y);</p>' +
                '</div>',
                '<p style="text-align: center; font-weight: bold">¿Qué muestra el siguiente código fuente por pantalla?</p>' +
                '<div class="shadow" style="margin: auto;  background: black; width:350px; padding:10px; color:#1cc88a">' +
                '<p>int x=1;</p><p>switch (x) {</p><p style="margin-left:10px">case 1:</p><p style="margin-left: 20px">System.out.println("Uno");</p>' +
                '<p style="margin-left:10px">case 2:</p><p style="margin-left: 20px">System.out.println("Dos");</p>' +
                '<p style="margin-left:10px">case 3:</p><p style="margin-left: 20px">System.out.println("Tres");</p>' +
                '<p style="margin-left:10px">default:</p><p style="margin-left: 20px">System.out.println("Otro número");</p>' +
                '</div>'],
            respuestas: [
                ['Es una secuencia de pasos lógicos necesarios para llevar a cabo una tarea específica, como la solución de un problema.', 'Es una técnica de inteligencia artificial muy utilizada en los métodos de aprendizaje adaptativo.',
                    'Son instancias de una clase', 'Son las librerías que encontramos en los lenguajes de programación'], ['Es un código que se basa en el sistema binario con el objetivo de facilitar la interpretación a la máquina.', 'Son códigos que pretenden simular las capacidades de los seres humanos para resolver problemas.',
                    'Se basa en un lenguaje de programación real, donde se permite expresar las instrucciones en un lenguaje común para facilitar la escritura y lectura.', 'Es un código que solo encontramos en Java'],
                ['Son símbolos que representan el lenguaje binario', 'Son estructuras computacionales', 'Es una representación gráfica que muestra la distribución de los elementos de un programa estructurado', 'Es una representación gráfica que describe un proceso, sistema o algoritmo informático'],
                ['Es el lenguaje que usamos lo seres humanos', 'Es un lenguaje diseñado para describir el conjunto de acciones que un equipo debe ejecutar', 'Es un lenguaje parecido a ingles', 'Son librerías que permiten ejecutar código'],
                ['No hay ninguna diferencia', 'Float es de tipo entero es decir que no acepta puntos decimales e int es un tipo decimal', 'Int es un tipo entero es decir que no acepta puntos decimales y float si acepta puntos decimales.', 'Ambos son del tipo entero, pero, float acepta números del doble del tamaño que int'],
                ['Son símbolos que dictan la estructura de un programa', 'Es un espacio de memoria reservado para almacenar un valor determinado', 'Son librerías que permiten ejecutar código', 'Es una representación gráfica que muestra el diseño de un programa estructurado'],
                ['Es una sentencia que evalúa una determinada condición y con base en ello ejecuta una sección de código', 'Es una sentencia que ejecuta repetidas veces un trozo de código, hasta que la condición asignada a dicho bucle deja de cumplirse.', 'Es un espacio de memoria reservado para almacenar un valor determinado.',
                    'Es un software que se encarga de traducir el programa hecho en lenguaje de programación, a un lenguaje de máquina que pueda ser comprendido por el equipo'],
                ['<p>Sí {condicion}(</p><p style="margin-left: 10px">Codigo;</p><p>)</p>', '<p>ff(condicion){</p><p style="margin-left: 10px">Codigo;</p><p>}</p>', '<p>Switch(condicion){</p><p style="margin-left: 10px">Codigo;</p><p>}</p>', '<p>For(condicion){</p><p style="margin-left: 10px">Codigo;</p><p>}</p>'],
                ['<p>switch(condicion){</p><p style="margin-left: 10px">condicion;</p><p>}</p>', '<p>switch(variable){</p><p style="margin-left: 10px">condicion;</p><p>}</p>', '<p>switch(variable){</p><p style="margin-left: 10px">case 1:</p><p style="margin-left: 20px">còdigo;</p><p style="margin-left: 20px">break;</p><p style="margin-left: 10px">case 2:</p><p style="margin-left: 20px">còdigo;</p><p style="margin-left: 20px">break;</p><p style="margin-left: 10px">case 3:</p><p style="margin-left: 20px">còdigo;</p><p style="margin-left: 20px">break;</p>',
                    '<p>if(variable){</p><p style="margin-left: 10px">case 1:</p><p style="margin-left: 20px">codigo;</p><p style="margin-left: 20px">break;</p><p style="margin-left: 10px">case 2:</p><p style="margin-left: 20px">codigo;</p><p style="margin-left: 20px">break;</p><p style="margin-left: 10px">case 3:</p><p style="margin-left: 20px">codigo;</p><p style="margin-left: 20px">break;</p>'],
                ['Es una sentencia que suma números', 'Es una sentencia que multiplica números', 'Es una sentencia para poner condicionales', 'Es una sentencia que ejecuta repetidas veces un trozo de código, hasta que la condición asignada a dicho bucle deja de cumplirse'],
                ['No, el primero muestra del 1 al 10 y el segundo del 0 al 9', 'Sí, los dos muestran del 0 al 9', 'No, el primero muestra del 0 al 9 y el segundo del 1 al 10', 'Sí, los dos muestran del 1 al 10'],
                ['10', '7', '6', '4'], ['Suma los 100 primeros números', 'Suma los 100 primeros números impares', 'Suma los 100 primeros números pares', 'Ninguna de las anteriores'],
                ['0', '1', '10', 'Ninguno, entra en bucle infinito'], ['No es correcta, no compila', 'Suma el valor de X+Y, lo asigna a z y luego incrementa en uno la X', 'Incrementa en uno el valor de la X y lo suma a Y para asignárselo a Z', 'Suma uno a X y se lo asigna a Z, luego suma y a Z'],
                ['Suma los 100 primeros números impares', 'Suma del 1 al 100 los números que sean impares', 'Suma los 100 primeros números pares', 'Ninguna de las anteriores respuestas es válida'],
                ['true', 'false', 'undefined', 'No compila el còdigo'], ['Math.poten', 'Operador **', 'Math.pow', 'Operador ^'],
                ['Estructura Secuencial', 'Estructura Repetitiva', 'Estructura Selectiva', 'Ninguna de las tres anteriores'],
                ['Los números del 1 al 9', 'Los números del 0 al 9', 'Los números del 1 al 10', 'El programa no compila'],
                ['Como queramos', 'MICLASE.java', 'MiClase.java', 'MiClase.class'], ['Muestra los números del 0 al 9', 'Muestra los números del 1 al 10', 'Muestra un 10', 'Se queda en un bucle infinito'],
                ['25', '30', '6', '35'], ['Suma el valor de x a contador', 'Asigna x al valor de contador', 'Suma uno al valor de x y se lo asigna al contador', 'Ninguna de las tres anteriores es correcta'],
                ['3', '2', '1', '0'], ['Uno', 'Dos', 'Otro nùmero', 'Uno Dos Tres Otro nùmero']
            ]
        }),
        mounted() {
            // this.selecUsr = new Array(44).fill(0);
            // console.log(this.selecUsr.indexOf(0))
            swal('Advertencia','Si ya contestate este test y lo vuelves a contestar, se borrarán tus respuestas anteriores 😉','warning');
        },
        methods: {
            anterior() {
                this.countPreg--;
            },
            siguiente() {
                this.countPreg++;
            },
            guardar() {
                this.cargando = true;
                axios
                    .post('/alumno/guardar/test-conocimiento',{respuestas: this.selecUsr,id_alumno: this.id_alumno})
                    .then(response => {
                        // console.log(response.data.success);
                        if(response.data.success===true){
                            swal('Éxito','Se han guardado tus respuestas! recuerda que puedes contestar este test cuantas veces quieras! 😄','success');
                            this.selecUsr = new Array(26).fill(0);
                            this.countPreg = 0;
                            this.cargando = false;
                        }
                    })
                    .catch(err => console.log(err))
            },
            seleccionar(index) {
                this.countPreg = index;
            },
            validate() {
                var arr = this.selecUsr.filter(u => u === 0);
                if (arr.length > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>

<style scoped>
    .preguntas {
        display: flex;
        flex-flow: row wrap;
        /*justify-content: space-around;*/
    }

    .pregunta {
        align-self: flex-start;
    }

    .pregunta:hover {
        align-self: flex-start;
        cursor: pointer;
    }

    .rojo {
        background: #EF442C;
        color: #fff;
    }

    .verde {
        background: #1cc88a;
        color: #fff;
    }

    .pregunta-arr {
        text-align: center;
        font-weight: bold;
    }
</style>
