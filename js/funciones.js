$(document).ready(function(){
    $('#guardarnuevo').click(function(){
        fecha=$('#fecha').val();
        prospecto=$('#prospecto').val();
        cita=$('#cita').val();
        llamada=$('#llamada').val();
        solicitud=$('#solicitud').val();
        solicitudp=$('#solicitudp').val();
        agregardatos(fecha,prospecto,cita,llamada,solicitud,solicitudp);
    });
});
function agregardatos(fecha, nombre, prospecto, cita, llamada, solicitud, solicitudp){
    cadena="fecha=" + fecha +
    	"&nombre=" + nombre +
        "&prospecto=" + prospecto +
        "&cita=" + cita +
        "&llamada=" + llamada +
        "&solicitud=" + solicitud +
        "&solicitudp=" + solicitudp ;
    $.ajax({
        type:'post',
        url:"agregardatos.php",
        data:cadena,
        //para que nos diga que nos regreso
        success:function(r){
            // 
            if(r==0){
            $('#tabla').load('componentes/tabla.php');
            $('#buscador').load('componentes/buscador.php');
            alertify.success("agregado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}
