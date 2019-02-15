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
        <div class="col-sm-12">
            <div class="panel-body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="form-group">
                        <label>Escoge la fecha para graficar</label>
                        <input type="date" name="fecha" id="fecha" class="form-control input-sm">
                    </div>
                    <button type="submit" class="btn btn-success" name="consultar">Consultar</button>
                </form>
                <div id="container">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'../componentes/pie.php'; ?>
<script src="../librerias/datatables/jquery.dataTables.min.js"></script>
<script src="../graficas/code/highcharts.js"></script>
<script src="../graficas/code/modules/exporting.js"></script>
<script src="../graficas/code/modules/export-data.js"></script>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Datos de registroa del usuario <?php echo $nombre; ?>'
        },
        xAxis: {
            categories: [
                'Prospecto',
                'Llamada',
                'Cita',
                'Solicitud',
                'Solicitud de Pago'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rangos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Real',
            data: [<?php
                    //$fecha = "";
                    if(isset($_POST['consultar']))
                    {
                        $fecha = $_POST['fecha'];
                        $query = "SELECT FLOOR(AVG(prospecto)) AS prospecto, FLOOR(AVG(llamada)) AS llamada, FLOOR(AVG(cita)) AS cita, FLOOR(AVG(solicitud)) AS solicitud, FLOOR(AVG(solicitudp)) AS solicitudp FROM registro WHERE nombre = '$nombre' AND fecha = '$fecha'"; 
                        $resultado = $conexion->query($query);
                        while ($row=$resultado->fetch_assoc()) 
                        {
                    ?>
                        <?php echo $row['prospecto']; ?>, 
                        <?php echo $row['llamada']; ?>, 
                        <?php echo $row['cita']; ?>, 
                        <?php echo $row['solicitud']; ?>, 
                        <?php echo $row['solicitudp']; ?>]
                    <?php
                        }
                    }
                    else
                    {
                        $query = "SELECT FLOOR(AVG(prospecto)) AS prospecto, FLOOR(AVG(llamada)) AS llamada, FLOOR(AVG(cita)) AS cita, FLOOR(AVG(solicitud)) AS solicitud, FLOOR(AVG(solicitudp)) AS solicitudp FROM registro WHERE nombre = '$nombre' AND fecha = CURDATE();"; 
                        $resultado = $conexion->query($query);
                        while ($row=$resultado->fetch_assoc()) 
                        {
                    ?>
                        <?php echo $row['prospecto']; ?>, 
                        <?php echo $row['llamada']; ?>, 
                        <?php echo $row['cita']; ?>, 
                        <?php echo $row['solicitud']; ?>, 
                        <?php echo $row['solicitudp']; ?>]
                    <?php
                        }
                    }
                ?>

        }, {
            name: 'Meta',
            data: [50, 50, 50, 50, 50]

        }]
    });
</script>
</body>
</html>
