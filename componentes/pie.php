<div class="modal fade" id="modalcambiarContrasena" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Actualizar Contraseña</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="nuevacontrasena.php">
                    <label>Nueva Contraseña</label>
                    <input type="password" name="password_uno" id="password_uno" class="form-control input-sm">
                    <label>Confirmar Contraseña</label>
                    <input type="password" name="password_dos" id="password_dos" class="form-control input-sm">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Actualizar Contraseña</button>
            </div>
                </form>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container text-center">
        <span>Software GAM <sup>©</sup> Todos los Derechos Reservados.</span>
    </div>
</footer>
<script src="../librerias/jquery-3.3.1.min.js"></script>
<script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
<script src="../librerias/alertify/alertify.js"></script>