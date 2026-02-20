// Iván Ponti Rubio
// 2º DAW

function asteriscos(){
    // Obtener el valor del input
    let input = document.querySelector('.inputEj').value.trim();
    let count = 0;

    // Array completo de vocales incluyendo variantes acentuadas, diéresis y mayúsculas
    let vocales = ['a', 'e', 'i', 'o', 'u', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'A', 'E', 'I', 'O', 'U', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü'];

    // Contar espacios en blanco para validar longitud de la frase
    for (let letter of input) {
        if (letter === ' ') {
            count += 1
        }
    }

    // Validación: la frase debe tener al menos 4 espacios (5 palabras)
    if(count < 4){
        console.log("Introduzca una frase con al menos 5 palabras")
    } else {
        // Procesar frase: reemplazar vocales por asteriscos
        let nuevoInput = '';
        for(let letter of input){
            if(vocales.includes(letter)){
                nuevoInput += '*'  // Reemplazar vocal por asterisco
            } else {
                nuevoInput += letter  // Mantener carácter original
            }
        }
        console.log("Frase con vocales reemplazadas:", nuevoInput)
    }
}

function guionBajo(){
    // Obtener y limpiar el valor del input
    let input = document.querySelector('.inputEj').value.trim();
    let count = 0;

    // Contar espacios en blanco para validar longitud de la frase
    for (let letter of input) {
        if (letter === ' ') {
            count += 1
        }
    }

    // Validación: la frase debe tener al menos 4 espacios (5 palabras)
    if(count < 4){
        console.log("Introduzca una frase con al menos 5 palabras")
    } else {
        let nuevoInput = '';
        let count = 0;  // Contador de caracteres no-espacio

        // Procesar cada carácter de la frase
        for(let letter of input){
            // Incrementar contador solo si no es espacio
            if(letter !== " "){
                count += 1;
            }

            // Reemplazar cada segundo carácter no-espacio por guión bajo
            if(count % 2 === 0 && letter !== " "){
                nuevoInput += '_'  // Reemplazar segundo carácter por _
            } else {
                nuevoInput += letter  // Mantener carácter original
            }
        }
        console.log("Frase con caracteres reemplazados:", nuevoInput)
    }
}let palabrasGlobales = [];

function ordenar(){
    // Obtener palabras del input correcto
    let input = document.querySelector('.inputPalabras').value.trim();
    palabrasGlobales = input.split(" ").filter(palabra => palabra.length > 0);

    // Filtrar palabras > 4 caracteres
    let listaordenada = palabrasGlobales.filter(palabra => palabra.length > 4);

    // Ordenar y mostrar
    listaordenada.sort();

    // Crear HTML correctamente
    let html = listaordenada.map(palabra => `<p>${palabra}</p>`).join('');
    document.querySelector('.listaordenada').innerHTML = html;
}

function buscar(){
    let inputbuscar = document.querySelector('.inputbusqueda').value.trim().toLowerCase();

    if(!inputbuscar) return; // No hacer nada si está vacío

    // Verificar si la palabra ya existe
    if(palabrasGlobales.includes(inputbuscar)){
        alert("Palabra ya añadida");
    } else {
        // Añadir nueva palabra
        palabrasGlobales.push(inputbuscar);

        // Filtrar palabras > 4 caracteres
        let listaordenada = palabrasGlobales.filter(palabra => palabra.length > 4);

        // Ordenar y mostrar
        listaordenada.sort();

        // Actualizar ambos displays
        let html = listaordenada.map(palabra => `<p>${palabra}</p>`).join('');
        document.querySelector('.nuevoOrdenado').innerHTML = html;
        document.querySelector('.listaordenada').innerHTML = html;

        // Limpiar input de búsqueda
        document.querySelector('.inputbusqueda').value = '';
    }
}

// Ejercicio 3
// Convertir array a Map
let alumnos = new Map([
    ['Ivan', 7.64],
    ['Aaron', 6.94],
    ['Ander', 8.74],
    ['Eduardo', 4.18]
]);

// Usar for...of con Map (forma correcta)
let html = '';
for(let [nombre, nota] of alumnos) {
    html += `<p>Nombre: ${nombre}. Nota: ${nota}</p>`;
}
document.querySelector('.info').innerHTML = html;

function vernota(){
    let inputalumno = document.querySelector('.input3').value.trim();
    let html2 = '';

    if (Array.from(alumnos.keys()).includes(inputalumno)) {
        html2 += `<p>Nota de ${inputalumno}: ${alumnos.get(inputalumno)}</p>`;
        document.querySelector('.nota_input3').innerHTML = html2;
    } else {
        alert("Alumno no registrado")
        let valido = false;
        while(valido === false){
            let notaNueva = parseFloat(prompt("Introduzca la nota"));
            if(notaNueva >= 0 && notaNueva <= 10){
                alert("Nota valida");
                valido = true;
                alumnos.set(inputalumno, notaNueva);
            } else {
                alert("Nota no valida");
                valido = false;
            }
        }
    }

    let html3 = '';

    // 1. ORDENAR los nombres alfabéticamente
    let alumnosOrdenados = Array.from(alumnos.entries()).sort((a, b) =>
        a[0].localeCompare(b[0])
    );

    // 2. Mostrar nombres ordenados - CORRECCIÓN: agregar el título como string
    html3 += `<h5>Orden Alfabético</h5>`;  // ✅ Correcto

    for(let [nombre, nota] of alumnosOrdenados) {
        html3 += `<p>${nombre}</p>`;
    }

    // 3. CALCULAR la media
    let suma = 0;
    let contador = 0;

    for(let nota of alumnos.values()) {
        suma += nota;
        contador++;
    }

    // 4. Evitar división por cero
    if (contador > 0) {
        html3 += `<p><strong>Nota media: ${(suma / contador).toFixed(2)}</strong></p>`;
    }

    // 5. Mostrar todo
    document.querySelector('.nombreOrdenados').innerHTML = html3;
}

// Ej 4
// Multiplos de 2
let de2 = [];
for (let i = 0; i <= 30; i++) {
    if (i % 2 === 0) {
        de2.push(i);
    }
}

// Multiplos de 3
let de3 = [];
for (let i = 0; i <= 30; i++) {
    if (i % 3 === 0) {
        de3.push(i);
    }
}

// Unión - juntar todos sin repetir
let union = [];
for (let i = 0; i < de2.length; i++) {
    union.push(de2[i]);
}
for (let i = 0; i < de3.length; i++) {
    if (!union.includes(de3[i])) {
        union.push(de3[i]);
    }
}
union.sort(function(a, b) { return a - b; });

// Intersección - los que están en los dos
let interseccion = [];
for (let i = 0; i < de2.length; i++) {
    if (de3.includes(de2[i])) {
        interseccion.push(de2[i]);
    }
}

// Diferencia de2 - de3
let diff1 = [];
for (let i = 0; i < de2.length; i++) {
    if (!de3.includes(de2[i])) {
        diff1.push(de2[i]);
    }
}

// Diferencia de3 - de2
let diff2 = [];
for (let i = 0; i < de3.length; i++) {
    if (!de2.includes(de3[i])) {
        diff2.push(de3[i]);
    }
}

// Exclusión - los que no están en los dos
let exclusion = [];
for (let i = 0; i < diff1.length; i++) {
    exclusion.push(diff1[i]);
}
for (let i = 0; i < diff2.length; i++) {
    exclusion.push(diff2[i]);
}
exclusion.sort(function(a, b) { return a - b; });

// Mostrar con colores
console.log("%c" + union.join(', '), "color: green");
console.log("%c" + interseccion.join(', '), "color: blue");
console.log("%c" + diff1.join(', '), "color: orange");
console.log("%c" + diff2.join(', '), "color: purple");
console.log("%c" + exclusion.join(', '), "color: red");

//Ej 5
function pedirNumeros() {
    // Obtener y limpiar números del input
    let input = document.querySelector('.input4').value.trim();
    let numeros = input.split(',')
        .map(num => parseFloat(num.trim()))
        .filter(num => !isNaN(num));

    // Encontrar números únicos
    const contador = {};
    numeros.forEach(num => contador[num] = (contador[num] || 0) + 1);
    let numerosUnicos = numeros.filter(num => contador[num] === 1);

    // Calcular media
    let media = numeros.length > 0 ?
        numeros.reduce((sum, num) => sum + num, 0) / numeros.length : 0;

    // Mostrar resultados
    document.querySelector('.numerosUnicos').innerHTML =
        numerosUnicos.length > 0 ?
            `<b>Números únicos:</b> [${numerosUnicos.join(', ')}]` :
            `<b>No hay números únicos</b>`;

    document.querySelector('.numeroMedia b').textContent =
        `Media: ${media.toFixed(2)}`;
}

//Ej 6
function verificarPalindromo() {
    let frase = document.querySelector('.input5').value.trim();
    let resultadoElement = document.querySelector('.verificarPalindromo');

    if (!frase) {
        resultadoElement.innerHTML = 'Por favor, introduce una frase o palabra.';
        return;
    }

    // Normalizar y verificar
    const fraseLimpia = frase
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-zñ]/g, '');

    if (!fraseLimpia) {
        resultadoElement.innerHTML = 'No se encontraron caracteres alfabéticos válidos.';
        return;
    }

    const esPalindromo = fraseLimpia === fraseLimpia.split('').reverse().join('');

    if (esPalindromo) {
        resultadoElement.innerHTML = `"${frase}" SÍ es un palíndromo`;
    } else {
        resultadoElement.innerHTML = `"${frase}" NO es un palíndromo`;
    }
}

// Ej 7
let todoList = []

function renderTodoList() {
    let todoListHTML = ''
    todoList.forEach(function (todoObject, index) {
        const name = todoObject.name
        const date = todoObject.date

        const html = `
                    <div>${name}</div> 
                    <div>${date}</div>
                    <button class="boton" style="background-color:rgb(167, 0, 0)" onclick="
                        todoList.splice(${index}, 1)
                        renderTodoList()
                    ">Eliminar</button>`
        todoListHTML += html
    })

    document.querySelector('.js-todo-list').innerHTML = todoListHTML
}

function addTodo() {
    let inputElement = document.querySelector('.js-input')
    const name = inputElement.value.trim() // agregamos trim() para limpiar espacios

    let dateInputElement = document.querySelector('.js-date-input')
    const date = dateInputElement.value

    // Verificar si la tarea ya existe
    const tareaExiste = todoList.some(todo =>
        todo.name === name && todo.date === date
    )

    if (tareaExiste) {
        alert('⚠️ Esta tarea ya existe con la misma fecha!')
        return // salir de la función sin agregar
    }

    // Verificar si el nombre está vacío
    if (!name) {
        alert('⚠️ Por favor, escribe una tarea')
        return
    }

    todoList.push({
        name: name,
        date: date,
    })

    // Limpiar inputs
    inputElement.value = ''
    dateInputElement.value = ''

    renderTodoList()
}