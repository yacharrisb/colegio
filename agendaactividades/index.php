<?php
include_once("../login/check.php");
$folder="../";
$titulo="NAgendaActividades";
$prioridadvalor=array("-1"=>$idioma['Bajo'],"0"=>$idioma['Normal'],"1"=>$idioma['Importante']);
$estadovalor=array("0"=>$idioma['Pendiente'],"1"=>$idioma["Completado"]);
?>
<?php include_once("../cabecerahtml.php");?>
<script type="text/javascript" src="../js/agendaactividades/calendario.js"></script>
<?php include_once("../cabecera.php");?>
<div class="span8">
	<div class="box">
        <div class="box-header"><h2><i class="icon-calendar"></i><span class="break"></span><?php echo $idioma['CalendarioActividades']?></h2></div>
        <div class="box-content">
            <div class="calendario" style=""></div>
        </div>
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><i class="icon-tasks"></i><span class="break"></span><?php echo $idioma['Actividad']?></h2></div>
    <div class="box-content">
    	<div id="respuestaformulario"></div>
    	<form action="guardaractividad.php" class="formulario" method="post">
    	<table class="tabla table-hover">
        	<tr>
            	<td><?php echo $idioma['FechaActividad']?></td><td><?php echo campo("FechaActividad","text",date("d-m-Y"),"span12 der",1,"",0,array("readonly"=>"readonly"))?>
                <?php echo campo("CodAgendaActividades","hidden","")?>
                </td>
            </tr>
            <tr>
            	<td><?php echo $idioma['HoraInicio']?></td><td><?php echo campo("HoraInicio","time",date("H:i"),"span12 der",1)?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['HoraFin']?></td><td><?php echo campo("HoraFin","time",date("H:i"),"span12 der",1,"",0,array("min"=>date("H:i")))?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Prioridad']?></td><td><?php echo campo("Prioridad","select",$prioridadvalor,"span12",1,"",0,"",0)?></td>
            </tr>
<!--            <tr>
            	<td><?php echo $idioma['Estado']?></td><td><?php echo campo("Estado","select",$estadovalor,"span12",1,"",0,"",0)?></td>
            </tr>-->
            <tr>
            	<td><?php echo $idioma['Detalle']?></td><td><?php echo campo("Detalle","textarea","","span12",1,$idioma["IngreseSu"].$idioma['Detalle'],0,array("rows"=>3))?></td>
            </tr>
        </table>
        <input type="submit" class="btn btn-success" value="<?php echo $idioma['GuardarActividad']?>" id="Guardar"> <!--<input type="reset" class="btn" value="<?php echo $idioma['Vaciar']?>" id="vaciar">--><a  class="btn" id="vaciar" href="./"><?php echo $idioma['Cancelar']?></a>
        </form>
    </div>
</div>
</div>
<div class="row-fluid">
<div class="box">
    	<div class="box-header"><h2><i class="icon-tasks"></i><span class="break"></span><?php echo $idioma['ListaActividades']?></h2></div>
        <div class="box-content">
            <div id="listadoactividades" style=""></div>
        </div>
    </div>
</div>
<?php include_once("../pie.php");?>