<?php
    session_start();
    include_once "../bd/conexion.php";
    $conexion=conexion();
    $sql="SELECT id,nombre,prospecto,cita,llamada,solicitd,solicitudp FROM registro";
    $result=mysqli_query($conexion,$sql);
?>
<div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-5">
        <label>Buscador </label>
        <select id="buscadorvivo" class="form-control input-sm">
        <option value='0'>Selecciona  uno</option>
            <?php
                while($ver=mysqli_fetch_row($result)):
            ?>
            <option >value="<?php echo $ver[0] ?>">
                <?php echo $ver[1]."".$ver[2] ?>
            </option>
            <?php  endwhile; ?>
        </select>
   </div>
</div>
<script typer="text/javascript">
    $(document).ready(function(){
        $('#buscadorvivo').select2();
        $('#buscadorvivo').change(function(){
            $.ajax({
                type:"post",
                data:'valor=' + $('#buscadorvivo').val(),
                url:'',
                success:function(r){
                    $('#tabla').load('../componentes/tabla.php');
                }
            });
        });
    });
</script>
