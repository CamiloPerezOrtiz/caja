<?php
	session_start();
	include_once "../bd/conexion.php";
	$conexion=conexion();
    $nombre = $_SESSION['nombre'];
?>

				<script type="text/javascript">
					$(document).ready(function()){
						$('#tabla').DataTable({
							buttons: [
							'copyHtml5',
							'excelHtml5',
							'csvHtml5',
							'pdfHtml5'
							],
							language:{<font></font>
								"sProcessing":     "Procesando...",<font></font>
								"sLengthMenu":     "Mostrar _MENU_ registros",<font></font>
								"sZeroRecords":    "No se encontraron resultados",<font></font>
								"sEmptyTable":     "Ningún dato disponible en esta tabla",<font></font>
								"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",<font></font>
								"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",<font></font>
								"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",<font></font>
								"sInfoPostFix":    "",<font></font>
								"sSearch":         "Buscar:",<font></font>
								"sUrl":            "",<font></font>
								"sInfoThousands":  ",",<font></font>
								"sLoadingRecords": "Cargando...",<font></font>
								"oPaginate": {<font></font>
									"sFirst":    "Primero",<font></font>
									"sLast":     "Último",<font></font>
									"sNext":     "Siguiente",<font></font>
									"sPrevious": "Anterior",<font></font>
								},<font></font>
								"oAria": {<font></font>
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",<font></font>
									"sSortDescending": ": Activar para ordenar la columna de manera descendente",<font></font>
								},<font></font>
							},<font></font>
						});
					}
				</script>