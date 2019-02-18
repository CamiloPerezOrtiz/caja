<?php
    session_start();
    $nombre = $_SESSION['nombre']; // para mandar a llamar el nombre del usuario que a entrado al portal
    // Comprobamos existencia de sesión
    if (!isset($_SESSION['nombre']))
        header('location: ../index.php');
    include_once "../bd/conexion.php";
    $conexion=conexion();
    $nombre = $_SESSION['nombre'];
?>
<?php include_once'../componentes/cabecera.php'; ?>
<div class="container">
    <div class="row">
        <div class="panel-body">
            <h2> Registros </h2>
            <caption>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalnuevo">
                    Agregar Datos
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </caption>
            <br><br>
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover text-center small" id="dataTables-example">
                    <thead>
                        <tr>
                            <td>Fecha</td>
                            <td>Prospecto</td>
                            <td>Cita</td>
                            <td>Llamada</td>
                            <td>Solicitud</td>
                            <td>Solicitud de Pago</td>                               
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query ="SELECT id, fecha, nombre, prospecto, llamada, cita, solicitud, solicitudp FROM registro WHERE nombre = '$nombre'";
                            $resultado = $conexion->query($query);
                            while ($row=$resultado->fetch_assoc()) 
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['fecha']; ?></td>
                            <td><?php echo $row['prospecto']; ?></td>
                            <td><?php echo $row['llamada']; ?></td>
                            <td><?php echo $row['cita']; ?></td>
                            <td><?php echo $row['solicitud']; ?></td>
                            <td><?php echo $row['solicitudp']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalnuevo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registro</h4>
            </div>
            <form method="post" action="agregardatos.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha </label>
                        <input type="date" name="fecha" id="fecha" class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label>Prospecto</label>
                        <select class="form-control" name="prospecto" id="prospecto" required>
                            <?php for ($i=0; $i<51; $i++)
                                {
                            ?> 
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Citas</label>
                        <select class="form-control" name="cita" id="cita" required>
                            <?php for ($i=0;$i<51;$i++)
                                {
                            ?>  
                            <option value="<?php echo $i?>"><?php echo $i ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Llamadas</label>
                        <select class="form-control" name="llamada" id="llamada" required>
                            <?php for ($i=0;$i<51;$i++)
                                {
                            ?>
                            <option value="<?php echo $i?>"><?php echo $i ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Solicitud</label>
                        <select class="form-control" name="solicitud" id="solicitud" required>
                            <?php for ($i=0;$i<51;$i++)
                                {
                            ?>
                            <option value="<?php echo $i?>"><?php echo $i ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Solicitud de Pago</label>
                        <select class="form-control" name="solicitudp" id="solicitudp" required>
                            <?php for ($i=0;$i<51;$i++)
                                {
                            ?>
                            <option value="<?php echo $i?>"><?php echo $i ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
                        Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once'../componentes/pie.php'; ?>
<script src="../librerias/datatables/jquery.dataTables.min.js"></script>
<script src="../librerias/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTables-example').DataTable({
            responsive: true,
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
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
    function agregardatos(fecha,prospecto,cita,llamada,solicitud,solicitudp)
    {
        cadena="fecha=" + fecha +
            "&prospecto=" + prospecto +
            "&cita=" + cita +
            "&llamada=" + llamada +
            "&solicitud=" + solicitud +
            "&solicitudp=" + solicitudp ;
        $.ajax(
        {
            type:'post',
            url:"agregardatos.php",
            data:cadena,
            //para que nos diga que nos regreso
            success:function(r)
            {
                // 
                if(r==0)
                {
                    alertify.success("agregado con exito");
                    setTimeout('document.location.reload()',1000);
                }
                else
                    alertify.error("Fallo el servidor");
            }
        });
    }
</script>
</body>
</html>
