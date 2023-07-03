var baseurl = location.protocol+'//'+location.host+'/sigecol/public/';
var token = $('meta[name="csrf-token"]').attr('content');
var ruta = $('meta[name="routeName"]').attr('content');

//Cambiar activo del panel izquierdo
const link = document.querySelectorAll('.lk-'+ruta);
if (link.length==1) {
    link.forEach(element =>{
        element.classList.add('active');
    });
}else if (link.length>1){
    link.forEach((element, index) =>{
        if (index==0) {
            element.classList.add('menu-open');
        }else {
            element.classList.add('active');
        }
    });
}

$('.select2').select2({
    placeholder: 'Seleccionar',
    width: 'resolve',
});
$('[data-mask]').inputmask();

function refrescar(tabla){
    $("#"+tabla+"").dataTable().fnDestroy();
    mostrarDatos();
}

function SwalLargo(t,i,d){
    Swal.fire({
        icon: i,
        title: t,
        text: d,
      })
}

function SwalCorto(t,i,tiempo){

    if(tiempo === undefined || tiempo==""){tiempo=3000}

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: tiempo,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: i,
        title: t
    })
}


(function(window){
	window.htmlentities = {
		decode : function(str) {
			return str.replace(/\&[\w\d\#]{2,5}\;/g, function(match, dec) {
				return String.fromCharCode(dec);
			});
		}
	};
})(window);

function decodeHtml(text) {
    var map = {
        '&amp;': '&',
        '&#038;': "&",
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#039;': "'",
        '&#8217;': "’",
        '&#8216;': "‘",
        '&#8211;': "–",
        '&#8212;': "—",
        '&#8230;': "…",
        '&#8221;': '”'
    };

    return text.replace(/\&[\w\d\#]{2,5}\;/g, function(m) { return map[m]; });
};
