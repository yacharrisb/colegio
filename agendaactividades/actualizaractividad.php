<?php
include_once("../login/check.php");
if(isset($_POST)){
extract($_POST);
//print_r($_POST);
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;
$Nivel=$_SESSION['Nivel'];
$valores=array("FechaActividad"=>"'".fecha2Str($FechaActividad,0)."'",
				"HoraInicio"=>"'$HoraInicio'",
				"HoraFin"=>"'$HoraFin'",
				"Prioridad"=>"'$Prioridad'",
				"Estado"=>"'$Estado'",
				"Detalle"=>"'$Detalle'",
				"Usuarios"=>"'$Nivel'",
	);
if($agendaactividades->actualizarActividad($valores,$CodAgendaActividades)){
?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $idioma['DatosGuardadosCorrectamente']?>
</div>
<script language="javascript">
mostrarActividades();
$("#vaciar").click();
$("#Guardar").val("<?php echo $idioma['GuardarActividad']?>");
$("form.formulario").attr("action","guardaractividad.php");
$("#CodAgendaActividades").val("");
$('html, body').animate({scrollTop:$("#listadoactividades").position().top-50},300);</script>
<?php	
}else{
?>
<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $idioma['DatosGuardadosError']?>
</div>
<script language="javascript">mostrarActividades();</script>
<?php
}
}
?>