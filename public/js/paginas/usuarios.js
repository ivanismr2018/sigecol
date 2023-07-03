$(document).ready(function(){
    mostrarDatos();
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token,
    }
})

function showModalNuevo(){
    document.getElementById("frmNuevo").setAttribute('onsubmit', 'return nuevo()');
    document.getElementById("titulo-usuario").innerHTML = "Agregar Usuario";
    document.getElementById("btnGuardar").setAttribute('class', 'btn btn-primary');
    document.getElementById("btnGuardar").innerHTML = "<i class='fa fa-save'></i> Agregar Datos";
    document.getElementById("frmNuevo").reset();
    document.querySelector('#password').required = true;
    $('#usuarioModal').modal('show');
    vaciarModal();
}

function vaciarModal(){
    $('#jefe_id').val('').change();
    $('#rol').val('').change();
    $('#estado').val('').change();
    document.getElementById("frmNuevo").reset();
}


function nuevo() {
    var datosact = $('#frmNuevo').serialize();
    $.ajax({
        method: "POST",
        data: datosact,
        url: baseurl+"administrador/usuarios/agregar",
        success:function(data){
          if (data == 1) {
                SwalCorto('Información Guardada','success');
                setTimeout(refrescar('tabla'), 1500);
                document.getElementById("frmNuevo").reset();
                $('#usuarioModal').modal('hide');
          } else {
                SwalLargo('ERROR','error','ALgo salio mal en el servidor, espere unos minutos y reintentalo, si persiste el error contacte con el informático');

          }
        }
    });
    return false;
};

function cargarDatos(id){
    document.getElementById("frmNuevo").setAttribute('onsubmit', 'return actualizar()');
    document.getElementById("titulo-usuario").innerHTML = "Actualizar Usuario";
    document.getElementById("btnGuardar").setAttribute('class', 'btn btn-warning text-white');
    document.getElementById("btnGuardar").innerHTML = "<i class='fa fa-save'></i> Actualizar Datos";
    document.querySelector('#password').required = false;
    SwalCorto('Cargando Datos', 'info', '1000');
    $.ajax({
        "type":"POST",
        "data":{'id':id},
        "url": baseurl+'administrador/usuarios/cargarDatos',
        success:function(value){
          var response = JSON.parse(value);
          $.each(response, function (key, value) {
            $('#id').val(id);
            $('#name').val(response['name']);
            $('#email').val(response['email']);
            $('#ci').val(response['ci']);
            $('#cargo').val(response['cargo']);
            $('#jefe_id').val(response['jefe_id']).trigger('change.select2');
            $('#rol').val(response['rol']).trigger('change.select2');
            $('#estado').val(response['estado']).trigger('change.select2');
        });
        }
    });

    $('#usuarioModal').modal('show');
}

function actualizar() {
    var datosact = $('#frmNuevo').serialize();
    $.ajax({
        method: "POST",
        data: datosact,
        url: baseurl+"administrador/usuarios/actualizar",
        success:function(data){
          if (data == 1) {
                SwalCorto('Información Actualizada','success');
                setTimeout(refrescar('tabla'), 1500);
                document.getElementById("frmNuevo").reset();
                $('#usuarioModal').modal('hide');
          } else {
                SwalLargo('ERROR','error','ALgo salio mal en el servidor, espere unos minutos y reintentalo, si persiste el error contacte con el informático');
          }
        }
    });
    return false;
};

function deshabilitarUsuario(id){
    Swal.fire({
        title: 'Desea Eliminar el Registro?',
        text: "Si Elima el Registro no se podrá recuperar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar Registro!'
    }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            type:"POST",
            data: {'id': id},
            url:baseurl+"administrador/usuarios/eliminar",
            success:function(r){
                if (r==1){
                    SwalCorto("Registro Eliminado","success");
                    setTimeout(refrescar('tabla'), 1500);
                } else {
                    SwalCorto("Error del Servidor","error");
                }
            }
        });
        }else{
        Swal.fire(
            'No Eliminado!',
            'Operación Cancelada por el Usuario',
            'info'
        )
        }
    })
}

function habilitarUsuario(id){
    Swal.fire({
        title: 'Desea Habilitar el Usuario?',
        text: "Actualmente este usuario no cuenta con acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Habilitar Usuario!'
    }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            type:"POST",
            data: {'id': id},
            url:baseurl+"administrador/usuarios/habilitar",
            success:function(r){
                if (r==1){
                    SwalCorto("Usuario Habilitado","success");
                    setTimeout(refrescar('tabla'), 1500);
                } else {
                    SwalCorto("Error del Servidor","error");
                }
            }
        });
        }else{
        Swal.fire(
            'No Habilitado!',
            'Operación Cancelada por el Usuario',
            'info'
        )
        }
    })
}

function deshabilitarUsuario(id){
    Swal.fire({
        title: 'Desea Deshabilitar el Usuario?',
        text: "El usuario no podra acceder al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Deshabilitar Usuario!'
    }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            type:"POST",
            data: {'id': id},
            url:baseurl+"administrador/usuarios/deshabilitar",
            success:function(r){
                if (r==1){
                    SwalCorto("Registro Eliminado","success");
                    setTimeout(refrescar('tabla'), 1500);
                } else {
                    SwalCorto("Error del Servidor","error");
                }
            }
        });
        }else{
        Swal.fire(
            'No Habilitado!',
            'Operación Cancelada por el Usuario',
            'info'
        )
        }
    })
}

function mostrarDatos() {
    $('#tabla').DataTable({
    "responsive": true,
    "autoWidth": false,
    "lengthChange": false,
    "dom": 'Bfrtip',
    "buttons": ["copy", {
                    "extend": 'pdf',
                    "exportOptions": {
                        "columns": ':not(.notexport)'
                    }
                }, {
                    "extend": 'excel',
                    "exportOptions": {
                        "columns": ':not(.notexport)'
                    }
                }, {
                    "extend": 'csv',
                    "exportOptions": {
                        "columns": ':not(.notexport)'
                    }
                }, {
                    "extend": 'print',
                    "exportOptions": {
                        "columns": ':not(.notexport)'
                    }
                }, "colvis"],
    "ajax": {
            "url": baseurl+"administrador/usuarios/listar",
            "type": "POST",
            dataSrc: ''
            },
    "columns": [
        { data: 'name' },
        { data: 'email' },
        { data: 'entidad' },
        { data: 'estado',
            render: function ( data, type, row ) {
                if (data==1) {
                    return "<button onclick='deshabilitarUsuario("+row.id+")' type='button' class='btn btn-outline-danger'><i class='fa fa-times'></i></button>";
                }else{
                    return "<button onclick='habilitarUsuario("+row.id+")' type='button' class='btn btn-outline-success'><i class='fa fa-check'></i></button>";
                }
            }
        },
        { data: 'id',
            render: function ( data, type, row ) {
                return "<button onclick='cargarDatos("+data+")' type='button' class='btn btn-outline-warning'><i class='fa fa-edit'></i></button>"+
                " "+
                "<button onclick='eliminar("+data+")' type='button' class='btn btn-outline-danger'><i class='fa fa-trash'></i></button>"
            }
        }
    ],
    "language": { "url": baseurl+"plantilla/plugins/datatables/Spanish.json" },
    }).buttons().container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
}
