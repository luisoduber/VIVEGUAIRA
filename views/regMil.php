<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) { header('location:/login.php'); return;}
if ($_SESSION["modRegMil"]==true) {$_SESSION["ultUrl"]=$_SERVER['REQUEST_URI'];}
else if ($_SESSION["modRegMil"]==false) { header('location:'.$_SESSION["ultUrl"]);  }
$prmIdjef=$_GET["a"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>ESCRITORIO</title>
		<meta name="description" content="Magilla is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, web app, application" />
		<meta name="author" content="hencework"/>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="icon" href="../favicon.ico" type="image/x-icon">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
		<link href="../css/usu.css" rel="stylesheet" type="text/css">
        <link href="../css/top-menu.css" rel="stylesheet" type="text/css">
		<link href="../css/generales.css" rel="stylesheet" type="text/css">
        <link href="../css/jquery/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

<?php 
	require 'top-menu.php';
	require 'left-menu.php';
?>		
<body>

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		    </div>
			    <?php require 'compartido/Ruta/Rt-mil.html'; ?>
		</div>

            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                               
                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
                                aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
                                                <h5 class="modal-title fw-bold">Registrar / Modificar Militante </h5>
                                            </div>
                                            <div class="modal-body">
												<form action="" id="basic-form" method="post">
                                            
                                                    <div class="form-group col-lg-2 col-md-2 col-xs-2">
                                                        <label for="cboLetRif" class="fw-bold">Letra </label>
                                                        <select name="cboLetRif" id="cboLetRif" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-4 col-md-4 col-xs-4 hidden">
                                                        <input type="hidden" id="txtIdJef" name="txtIdJef" value="<?=$prmIdjef?>" 
                                                        class="form-control">
                                                    </div>

                                                    <div class="form-group col-lg-4 col-md-4 col-xs-4 hidden">
                                                        <input type="hidden" id="txtIdMil" name="txtIdMil" class="form-control">
                                                    </div>

													<div class="form-group col-lg-4 col-md-4 col-xs-4">
													<label for="txtCed" class="fw-bold">Nro. Cedula</label>
                                                        <input type="text" id="txtCed" name="txtCed" class="form-control" 
														placeholder="Ingrese Nro. Cedula" maxlength="8" 
                                                        onKeyPress="return solNum(event)"  onblur="return busXced(event)"  required>
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtRs" class="fw-bold">Nombre y Apellido</label>
                                                        <input type="text" id="txtRs" name="txtRs" class="form-control" 
														placeholder="Ingrese nombre y apellido">
                                                    </div>

													<div class="form-group col-lg-3 col-md-3 col-xs-3">
														<label for="cboCodTelf" class="fw-bold">Codigo</label>
                                                        <select name="cboCodTelf" id="cboCodTelf" class="form-control"></select>
                                                    </div>

													<div class="form-group col-lg-3 col-md-3 col-xs-3">
														<label for="txtNroTelf" class="fw-bold">Telefono</label>
                                                        <input type="text" id="txtNroTelf" name="txtNroTelf" class="form-control" 
														placeholder="Ingrese Telef." maxlength="7" onKeyPress="return solNum(event)">
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboParr" class="fw-bold">Parroquia</label>
                                                        <select name="cboParr" id="cboParr" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
														<label for="cboCentVot" class="fw-bold">Centro Electoral</label>
                                                        <select name="cboCentVot" id="cboCentVot" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboCom" class="fw-bold">Comunidad</label>
                                                        <select name="cboCom" id="cboCom" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtDirec" class="fw-bold">Direcciòn</label>
                                                        <input type="text" id="txtDirec"  name="txtDirec"  class="form-control" 
														placeholder="Ingrese Direccion">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtEmail" class="fw-bold">Email</label>
                                                        <input type="text" id="txtEmail"  name="txtEmail"  class="form-control" 
														placeholder="Ingrese Email">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboStat" class="fw-bold">Status</label>
                                                        <select name="cboStat" id="cboStat" class="form-control"></select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
                                                        <button type="submit" id="btnGrdMod"  class="btn btn-danger">REGISTRAR</button>
                                                    </div>

                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-2 col-md-6 col-xs-12">
                                    <button id="btnReg" data-toggle="modal" data-target="#responsive-modal" class="btn btn-danger">REGISTRAR</button>
                                </div>

                                <div class="form-group col-lg-2 col-md-6 col-xs-12">
                                    <a  href="../rpt/rptMil1x10.php?a=<?=$prmIdjef?>" target="_blank"><button id="btnReg" class="btn btn-success">REPORTE 1 x 10</button></a> 
                                </div>

                                <?php
                                    if ($_SESSION["idPerf"]==1)
                                    {
                                        echo '
                                        <div class="form-group col-lg-2 col-md-6 col-xs-12">
                                        <a  href="../excel/exMilTod.php" target="_blank"><button id="btnReg" class="btn btn-success">REPORTE TODOS</button></a>
                                        </div>';
                                    }
                                ?>

                                <!-- Button trigger modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /Row -->
            <div class="row"><?php require 'compartido/DataTables/Dt-regMil.html'; ?></div>
            <?php //require 'footer.html'; ?>		
				
	    </div><!-- /Main Content -->
	</div><!-- /#wrapper -->
</body>
</html>

<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/regMil.js"></script>
<script src="../js/modal-data.js"></script>
<script src="../js/jquery/jquery.slimscroll.js"></script>
<script src="../js/init.js"></script>
<script src="../js/sweetalert2.js"></script>
