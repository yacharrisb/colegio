<?php
include_once("../login/check.php");
if(isset($_POST)){
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;

$Nivel=$_SESSION['Nivel'];
$CodUsuario=$_SESSION['CodUsuarioLog'];
$Fecha=fecha2Str($_POST['Fecha'],0);
$Botones=$_POST['Botones'];
if(!isset($Botones)){$Botones="1";}
$actividades=$agendaactividades->mostrarActividades("Usuarios LIKE '%$Nivel%' and Nivel='$Nivel' and CodUsuario='$CodUsuario' and FechaActividad='$Fecha'");
if(count($actividades)){
$i=0;
?>
<a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-bordered table-striped table-hover">
            	<thead>
                	<tr><th width="20">N</th><th style="width:25px;"><?php echo recortarTexto($idioma["Estado"],3,"")?></th><th width="60" style="max-width:60px;"><?php echo $idioma["Prioridad"]?></th><th style="max-width:75px !important;width:75px"><?php echo $idioma["Fecha"]?></th><th width="80" style="max-width:80px;width:80px"><?php echo $idioma["Hora"]?></th><th><?php echo $idioma["Actividad"]?></th><?php if(($Botones=="1")){?><th width="60"></th><?php }?></tr>
                </thead>
                <?php foreach($actividades as $ac){$i++;
					$acEstado=0;
					if(strtotime(date("Y-m-d H:i"))>=strtotime($ac['FechaActividad']." ".$ac['HoraInicio'])){
						$acEstado=1;
					}
					switch($ac['Prioridad']){
						case -1:{$msgpri="warning";$textoprioridad=$idioma['Bajo'];}break;
						case 0:{$msgpri="success";$textoprioridad=$idioma['Normal'];}break;
						case 1:{$msgpri="important";$textoprioridad=$idioma['Importante'];}break;
					}	
				?>
                <tr class="<?php echo $acEstado?'completado':''?>">
                	<td class="der"><?php echo $i?></td>
                	<td><span class="label label-<?php echo $acEstado?'Inverse':''?>" title="<?php echo $acEstado?$idioma["Completado"]:$idioma["Pendiente"]?>"><?php echo $acEstado?sacarIniciales($idioma["Completado"]):sacarIniciales($idioma["Pendiente"])?></span></td>
                    <td><span class="badge badge-<?php echo $msgpri?>"><?php echo $textoprioridad?></span></td>
                    <td><?php echo fecha2Str($ac['FechaActividad'])?></td>
                    <td class="der"><?php echo hora2Str($ac['HoraInicio'])."-".hora2Str($ac['HoraFin'])?></td>
                    <td><?php echo $ac['Detalle']?></td>
                    <?php if(($Botones=="1")){?><td><button class="btn btn-mini" id="modificar" rel="<?php echo $ac['CodAgendaActividades']?>"><i class="icon-pencil"></i></button> <button class="btn btn-mini" id="eliminar" rel="<?php echo $ac['CodAgendaActividades']?>"><i class="icon-remove"></i></button></td><?php }?>
                </tr>
                <?php }?>
            </table><?php	
}else{
?>
<strong><?php echo $idioma['NoHayActividadesParaLaFechaSeleccionada']?> <?php echo $_POST['Fecha']?></strong>
<?php
}
}
?>