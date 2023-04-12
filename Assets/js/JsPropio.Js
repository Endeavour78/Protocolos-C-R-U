function contrasenaOlvidada() {
    Swal.fire({
        title: '¿Contraseña olvidada?',
        text: "Contacta con el administrador para recuperar tus credenciales",
        icon: 'question',
        confirmButtonColor: '#5cb85c'
    })
}

function credenciales() {
    Swal.fire({
        title: 'Estas son las credenciales',
        html: `Name: admin<br>
               Password: admin`,
        icon: 'info',
        confirmButtonText: 'Aceptar'
    });

}

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordToggle = document.getElementById("toggle-password");
    var passwordToggleIcon = passwordToggle.querySelector("i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggleIcon.classList.remove("fa-eye");
        passwordToggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        passwordToggleIcon.classList.remove("fa-eye-slash");
        passwordToggleIcon.classList.add("fa-eye");
    }
}

function handleKeyPress(event) {
    if (event.keyCode === 13) {
        buscarTablero();
    }
}

function limpiarBotones() {
    var botonContainer = document.getElementById('boton-container');
    while (botonContainer.firstChild) {
        botonContainer.removeChild(botonContainer.firstChild);
    }
}

function NuevoRegistro() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear un nuevo registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Obtener los valores de los inputs del formulario
            let codigo = document.getElementById('codigo').value;
            let descripcion = document.getElementById('descripcion').value;
            let referencia = document.getElementById('referencia').value;
            let op = document.getElementById('op').value;

            // Crear un objeto con los datos a enviar
            let datos = {
                codigo: codigo,
                descripcion: descripcion,
                referencia: referencia,
                op: op
            };

            // Enviar los datos al controlador PHP mediante una petición AJAX
            fetch('../Controlador/InsertController.php?action=ControladorInsert', {
                method: 'POST',
                body: JSON.stringify(datos),
                headers: {
                    'Content-Type': 'application/json;charset=UTF-8' // Indicamos el tipo de contenido
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message === "Error al insertar los registros en la base de datos") {
                        alert('Error al insertar los registros en la base de datos');
                        return;
                    }
                    if (data.message === "Datos vacíos") {
                        alert('Datos vacíos');
                        return;
                    }
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        // Si la inserción fue exitosa
                        Swal.fire({
                            title: 'Éxito',
                            text: data.message,
                            icon: 'success'
                        });
                    } else {
                        // Si hubo un error en la inserción
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })

        }
    });
}

function ActualizarRegistro() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres actualizar los registros?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            var filas = document.querySelectorAll('#tabla-resultados tr');
            var datos = [];
            for (var i = 0; i < filas.length; i++) {
                var fila = filas[i];
                var idEquipo = fila.cells[0].textContent;
                var cantidadInstalada = fila.querySelector('input[name="cantidad[]"]').value;
                var observaciones = fila.querySelector('textarea[name="observaciones[]"]').value;
                datos.push({
                    cantidadInstalada: cantidadInstalada,
                    observaciones: observaciones,
                    idEquipo: idEquipo
                });
            }
            // Enviar los datos al servidor usando una petición Ajax
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controlador/UpdateController.php?action=ControladorUpdate');
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8'); // Indicamos el tipo de contenido
            xhr.onload = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var resultados = JSON.parse(this.responseText);
                    // console.log(resultados);
                    if (resultados !== false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Registros guardados correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // console.log(resultados); // Imprimir los datos actualizados en la consola
                    }
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Los registros no se guardaron.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            };
            xhr.send(JSON.stringify(datos));
        }
    });
}

function buscarLista() {
    var Table = document.getElementById('dropdown-resultados').value;
    var OP = document.getElementById('op').value;
    // console.log(Table);
    // console.log(OP);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resultados = JSON.parse(this.responseText);

            // Limpiar la tabla antes de actualizarla
            document.getElementById('tabla-resultados').innerHTML = '';

            if (resultados === "La OP existe pero el tablero no") {
                // document.getElementById('dropdown-resultados').innerHTML = '';
                document.getElementById('tabla-resultados').innerHTML = '';
                // 
                Swal.fire({
                    title: '¿Desea crear un nuevo protocolo?',
                    text: 'La OP no tiene Codigo, Descripción ni Referencia.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // document.getElementById('dropdown-resultados').innerHTML = '';
                        document.getElementById('tabla-resultados').innerHTML = '';
                        // 

                        // Código para borrar los botones generados anteriormente
                        limpiarBotones();

                        // Crear el botón
                        var boton = document.createElement('button');
                        boton.innerHTML = 'Guardar nuevo';
                        boton.classList.add('btn', 'btn-success'); // Agregar clase de Bootstrap

                        // Agregar evento al botón
                        boton.addEventListener('click', function () {
                            NuevoRegistro();
                        });

                        // Agregar el botón al final del div con id 'boton-container'
                        document.getElementById('boton-container').appendChild(boton);

                        // Crear inputs para cada columna de la tabla
                        var tabla = document.getElementById('tabla-resultados');
                        var row = tabla.insertRow();
                        var codCell = row.insertCell();
                        var descripcionCell = row.insertCell();
                        var referenciaCell = row.insertCell();

                        var codInput = document.createElement('input');
                        codInput.type = 'text';
                        codInput.classList.add('form-control'); // agregar clase bootstrap
                        codInput.id = 'codigo'; // asignar un id al input

                        // Obtener el valor seleccionado del dropdown
                        var selectedOption = document.getElementById('dropdown-resultados').value;

                        // Establecer el valor del input con el valor seleccionado del dropdown
                        codInput.value = selectedOption;
                        codInput.readOnly = true;

                        codCell.appendChild(codInput);

                        var descripcionInput = document.createElement('input');
                        descripcionInput.type = 'text';
                        descripcionInput.classList.add('form-control'); // agregar clase bootstrap
                        descripcionInput.id = 'descripcion'; // asignar un id al input
                        descripcionCell.appendChild(descripcionInput);

                        var referenciaInput = document.createElement('input');
                        referenciaInput.type = 'text';
                        referenciaInput.classList.add('form-control'); // agregar clase bootstrap
                        referenciaInput.id = 'referencia'; // asignar un id al input
                        referenciaCell.appendChild(referenciaInput);

                        return;
                    } else {
                        document.getElementById('dropdown-resultados').innerHTML = '';
                        document.getElementById('tabla-resultados').innerHTML = '';


                        // Código para borrar los botones generados anteriormente
                        limpiarBotones();

                        return
                    }
                });
            }
            if (resultados === "El protocolo existe pero NO es una OP") {
                limpiarBotones();
                document.getElementById('dropdown-resultados').innerHTML = '';
                document.getElementById('tabla-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, el número de OP digitado no es una OP.'
                })
                // alert("El protocolo existe pero NO es una OP");
                return;
            }
            if (resultados === "Error en la consulta de OPS") {
                limpiarBotones();
                document.getElementById('dropdown-resultados').innerHTML = '';
                document.getElementById('tabla-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un problema contacte con un administrador'
                })
                // alert("Paso la consulta de OPS1 pero fallo en la consulta final");
                console.log('Paso la consulta de OPS1 pero fallo en la consulta final');
                return;
            }
            if (resultados === "No se contro la OP en el sistema") {
                limpiarBotones();
                document.getElementById('dropdown-resultados').innerHTML = '';
                document.getElementById('tabla-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Esta OP no existe en el sistema.'
                })
                // alert("Esta OP no existe en el sistema");
                return;
            }
            if (document.getElementById('dropdown-resultados').selectedIndex === 0) {
                limpiarBotones();
                document.getElementById('tabla-resultados').innerHTML = '';

                return; // Si está seleccionada la primera opción, no hacer nada y salir de la función
            }


            // Generar HTML para la tabla
            var tablaHTML = '';
            for (var i = 0; i < resultados.length; i++) {
                tablaHTML += '<tr>';
                tablaHTML += '<td>' + resultados[i].IDEQUIPO + '</td>';
                tablaHTML += '<td>' + (resultados[i].DESCRIPCION ? resultados[i].DESCRIPCION : '') + '</td>';
                tablaHTML += '<td>' + (resultados[i].REFERENCIA ? resultados[i].REFERENCIA : '') + '</td>';
                tablaHTML += '<td><input class="form-control" type="number" name="cantidad[]" value="' + (resultados[i].CANTIDADINSTALADA ? resultados[i].CANTIDADINSTALADA : '') + '"></td>';
                tablaHTML += '<td><textarea class="form-control" name="observaciones[]" rows="4" cols="40">' + (resultados[i].OBSERVACIONES ? resultados[i].OBSERVACIONES : '') + '</textarea></td>';
                tablaHTML += '</tr>';
            }

            // Actualizar el contenido de la tabla
            document.getElementById('tabla-resultados').innerHTML = tablaHTML;
            limpiarBotones();
            // Crear el botón
            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Guardar cambios';
            boton2.className = 'btn btn-success'; // Agregar la clase de Bootstrap

            boton2.addEventListener('click', function () {
                ActualizarRegistro();
            });

            // Agregar el botón al final del div con id 'botones'
            document.getElementById('boton-container').appendChild(boton2);
            // document.getElementById('tabla-resultados').innerHTML = '';
            // limpiarBotones();
        }
    };
    xhttp.open("GET", "../Controlador/TableController.php?action=BuscarInfo&Table=" + Table + "&op=" + OP, true);
    xhttp.send();
}

function buscarTablero() {
    var op = document.getElementById('op').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resultados = JSON.parse(this.responseText);
            // Si no hay resultados, mostrar un alert
            if (resultados === "Fallo en la consulta final 1") {
                limpiarBotones();
                document.getElementById('dropdown-resultados').innerHTML = '';
                document.getElementById('tabla-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, el número de OP digitado no existe.',
                })

            }
            if (resultados === "El numero no es de tipo OP") {
                limpiarBotones();
                document.getElementById('tabla-resultados').innerHTML = '';
                document.getElementById('dropdown-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, el número de OP digitado no es una OP.'
                })
                // alert("El protocolo no es una OP");
                console.log("El protocolo existe pero no es un OP, por tanto no se llena el dropdown");
                return;
            }
            if (resultados === "Fallo en ambas consultas principales") {
                limpiarBotones();
                document.getElementById('tabla-resultados').innerHTML = '';
                document.getElementById('dropdown-resultados').innerHTML = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, el número de OP digitado no existe.'
                })
                return;
            }

            // Si hay resultados, generar HTML para el dropdown
            var dropdownHTML = '';
            dropdownHTML += '<option value="" selected>--Seleccione--</option>';
            if (resultados[0].CANTIDAD) { // Si hay resultados de la primera consulta
                var cantidad = resultados[0].CANTIDAD; // Obtiene el valor del entero
                for (var i = 1; i <= cantidad; i++) {
                    dropdownHTML += '<option value="' + i + '"';
                    if (i === 1) {
                        dropdownHTML += ' selected';
                    }
                    dropdownHTML += '>' + i + '</option>';
                }
            } else if (resultados[0].NRO_TABLEROS) { // Si hay resultados de la segunda consulta
                var cantidad = resultados[0].NRO_TABLEROS; // Obtiene el valor del entero
                for (var i = 1; i <= cantidad; i++) {
                    dropdownHTML += '<option value="' + i + '"';
                    if (i === 1) {
                        dropdownHTML += ' selected';
                    }
                    dropdownHTML += '>' + i + '</option>';
                }
            } else { // Si no hay resultados en ninguna consulta
                document.getElementById('dropdown-resultados').innerHTML = '';
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, la OP digitada no existe'
                })
                return;
            }

            // Actualizar el contenido del dropdown
            document.getElementById('dropdown-resultados').innerHTML = dropdownHTML;
            document.getElementById('dropdown-resultados').selectedIndex = 0;

            if (document.getElementById('dropdown-resultados').selectedIndex === 0) {
                document.getElementById('tabla-resultados').innerHTML = '';

            }

            // Si no está seleccionada la primera opción, ejecutar la consulta que rellena la tabla
            buscarLista();

        }
    };
    xhttp.open("GET", "../Controlador/OPController.php?action=BuscarControlador&op=" + op, true);
    xhttp.send();
}

