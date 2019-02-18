<?php
    session_start();
    $nombre = $_SESSION['nombre']; // para mandar a llamar el nombre del usuario que a entrado al portal
    // Comprobamos existencia de sesión
    if (!isset($_SESSION['nombre']))
        header('location: ../index.php');
    include_once "../bd/conexion.php";
    $conexion=conexion();
    $nombre = $_SESSION['nombre'];

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

/*function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';


}


$navegador = getBrowser($user_agent);
 
echo "El navegador con el que estás visitando esta web es: ".$navegador;
die();*/
?>
<?php include_once'../componentes/cabecera.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-body">
                <div class="col-xs-4">
                    <label>Selecciona un metodo para graficar</label>
                    <select class="form-control" id="inputSelect">
                        <option disabled="" selected="">Escoge una opcion</option>
                        <option value="dia">Dia</option>
                        <option value="semana">Semana</option>
                        <option value="mes">Mes</option>
                    </select>
                </div>
                <br><br><br><br>
                <div class="ocultar" id="dia">
                    <div class="col-xs-3">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group">
                                <label>Escoge el día que deseas graficar</label>
                                <input type="date" name="fecha_dia" id="fecha" class="form-control input-sm">
                            </div>
                            <button type="submit" class="btn btn-success" name="consultar_dia">Consultar</button>
                        </form>
                    </div>
                </div>
                <div class="ocultar" id="semana">
                    <div class="col-xs-4">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group">
                                <label>Escoge la semana que deseas graficar</label>
                                <input type="week" name="fecha_semana" id="fecha" class="form-control input-sm">
                            </div>
                            <button type="submit" class="btn btn-success" name="consultar_semana">Consultar</button>
                        </form>
                    </div>
                </div>
                <div class="ocultar" id="mes">
                    <div class="col-xs-3">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group">
                                <label>Escoge el mes que deseas graficar</label>
                                <input type="month" name="fecha_mes" id="fecha" class="form-control input-sm">
                            </div>
                            <button type="submit" class="btn btn-success" name="consultar_mes">Consultar</button>
                        </form>
                    </div>
                </div>
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
    $(function() 
    {
        $("#inputSelect").on('change', function() 
        {
            var selectValue = $(this).val();
            switch (selectValue) 
            {
                case "dia":
                    $("#dia").show();
                    $("#semana").hide();
                    $("#mes").hide();
                break;
                case "semana":
                    $("#dia").hide();
                    $("#semana").show();
                    $("#mes").hide();
                break;
                case "mes":
                    $("#dia").hide();
                    $("#semana").hide();
                    $("#mes").show();
                break;
            }
        }).change();
    });
</script>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Datos de registro del usuario <?php echo $nombre; ?>'
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
                    if(isset($_POST['consultar_dia']))
                    {
                        $fecha = $_POST['fecha_dia'];
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
                    elseif(isset($_POST['consultar_semana']))
                    {
                        $fecha = $_POST['fecha_semana'];
                        $query = "SELECT FLOOR(AVG(prospecto)) AS prospecto, FLOOR(AVG(llamada)) AS llamada, FLOOR(AVG(cita)) AS cita, FLOOR(AVG(solicitud)) AS solicitud, FLOOR(AVG(solicitudp)) AS solicitudp FROM registro WHERE nombre = '$nombre' AND date_format(fecha, '%Y-W%v') = '$fecha'"; 
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
                    elseif(isset($_POST['consultar_mes']))
                    {
                        $fecha = $_POST['fecha_mes'];
                        $query = "SELECT FLOOR(AVG(prospecto)) AS prospecto, FLOOR(AVG(llamada)) AS llamada, FLOOR(AVG(cita)) AS cita, FLOOR(AVG(solicitud)) AS solicitud, FLOOR(AVG(solicitudp)) AS solicitudp FROM registro WHERE nombre = '$nombre' AND date_format(fecha, '%Y-%m') = '$fecha'"; 
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
