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
    document.getElementById("titulo-misiones").innerHTML = "Agregar Misión";
    document.getElementById("btnGuardar").setAttribute('class', 'btn btn-primary');
    document.getElementById("btnGuardar").innerHTML = "<i class='fa fa-save'></i> Agregar Datos";
    $('#misionModal').modal('show');
    vaciarModal();
}

function vaciarModal(){
    $('#fecha_regreso').val('').change();
    $('#fecha_salida').val('').change();
    $('#pais').val('').change();
    $('#estado').val('').change();
    document.getElementById("frmNuevo").reset();
}

function nuevo() {
    var datosact = $('#frmNuevo').serialize();
    $.ajax({
        method: "POST",
        data: datosact,
        url: baseurl+"colaboradores/mision/agregar",
        success:function(data){
          if (data == 1) {
                SwalCorto('Información Guardada','success');
                setTimeout(refrescar('tabla'), 1500);
                document.getElementById("frmNuevo").reset();
                $('#misionModal').modal('hide');
                vaciarModal();
          } else {
                SwalLargo('ERROR','error','ALgo salio mal en el servidor, espere unos minutos y reintentalo, si persiste el error contacte con el informático');

          }
        }
    });
    return false;
};

function cargarDatos(id){
    document.getElementById("frmNuevo").setAttribute('onsubmit', 'return actualizar()');
    document.getElementById("titulo-misiones").innerHTML = "Actualizar Misión";
    document.getElementById("btnGuardar").setAttribute('class', 'btn btn-warning text-white');
    document.getElementById("btnGuardar").innerHTML = "<i class='fa fa-save'></i> Actualizar Datos";
    SwalCorto('Cargando Datos', 'info', '1000');
    $.ajax({
        "type":"POST",
        "data":{'id':id},
        "url": baseurl+'colaboradores/mision/cargarDatos',
        success:function(value){
          var response = JSON.parse(value);
          $.each(response, function (key, value) {
            $('#id').val(id);
            $('#tipo_mision').val(response['tipo_mision']);
            $('#fecha_salida').val(response['fecha_salida']);
            $('#fecha_regreso').val(response['fecha_regreso']);
            $('#pais').val(response['pais']).trigger('change.select2');
            $('#estado').val(response['estado']).trigger('change.select2');
          });
        }
    });

    $('#misionModal').modal('show');
}

function actualizar() {
    var datosact = $('#frmNuevo').serialize();
    $.ajax({
        method: "POST",
        data: datosact,
        url: baseurl+"colaboradores/mision/actualizar",
        success:function(data){
          if (data == 1) {
                SwalCorto('Información Actualizada','success');
                setTimeout(refrescar('tabla'), 1500);
                document.getElementById("frmNuevo").reset();
                $('#misionModal').modal('hide');
                vaciarModal();
          } else {
                SwalLargo('ERROR','error','ALgo salio mal en el servidor, espere unos minutos y reintentalo, si persiste el error contacte con el informático');
          }
        }
    });
    return false;
};

function eliminar(id){
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
            url:baseurl+"colaboradores/mision/eliminar",
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

function mostrarDatos() {
    var colaborador_id = $("#colaborador").val();
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
            "url": baseurl+"colaboradores/mision/listar",
            "type": "POST",
            "data": {'id':colaborador_id},
            dataSrc: ''
            },
    "columns": [
        { data: 'nombre_pais' },
        { data: 'tipo_mision' },
        { data: 'fecha_salida' },
        { data: 'fecha_regreso' },
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
