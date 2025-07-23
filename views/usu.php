<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) { echo "hola"; header('location:/login.php'); return;}
if ($_SESSION["modUsu"]==true) {$_SESSION["ultUrl"]=$_SERVER['REQUEST_URI'];}
else if ($_SESSION["modUsu"]==false) { header('location:'.$_SESSION["ultUrl"]);  }
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
			    <?php require 'compartido/Ruta/Rt-usu.html'; ?>
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
                                                <h5 class="modal-title fw-bold">Registrar / Modificar Usuarios</h5>
                                            </div>
                                            <div class="modal-body">
												<form action="" id="basic-form" method="post">
                                            
                                                    <div class="form-group col-lg-2 col-md-2 col-xs-2">
                                                        <label for="cboLetRif" class="fw-bold">Letra </label>
                                                        <select name="cboLetRif" id="cboLetRif" class="form-control"></select>
                                                    </div>

													<div class="form-group col-lg-4 col-md-4 col-xs-4">
													<label for="txtCed" class="fw-bold">Nro. Cedula</label>
                                                        <input type="text" id="txtCed" name="txtCed" class="form-control" 
														placeholder="Ingrese Nro.Cedula" maxlength="8" 
                                                        onKeyPress="return solNum(event)">
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtRs" class="fw-bold">Rason Social</label>
                                                        <input type="text" id="txtRs" name="txtRs" class="form-control" 
														placeholder="Ingrese razon social">
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
														<label for="txtEmail" class="fw-bold">Email</label>
                                                        <input type="text" id="txtEmail" name="txtEmail" class="form-control" 
														placeholder="Ingrese Email">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtDirec" class="fw-bold">Direcciòn</label>
                                                        <input type="text" id="txtDirec"  name="txtDirec"  class="form-control" 
														placeholder="Ingrese Direccion">
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="txtClave" class="fw-bold">Clave</label>
                                                        <input type="password" id="txtClave" name="txtClave" class="form-control" 
														placeholder="Ingrese Clave">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboEst" class="fw-bold">Estado</label>
                                                        <select name="cboEst" id="cboEst" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboMun" class="fw-bold">Municipio</label>
                                                        <select name="cboMun" id="cboMun" class="form-control"></select>
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboParr" class="fw-bold">Parroquia</label>
                                                        <select name="cboParr" id="cboParr" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboCentVot" class="fw-bold">Centro Electoral</label>
                                                        <select name="cboCentVot" id="cboCentVot" class="form-control"></select>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-6">
														<label for="cboPerf" class="fw-bold">Perfil</label>
                                                        <select name="cboPerf" id="cboPerf" class="form-control"></select>
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
                                <button id="btnReg" data-toggle="modal" data-target="#responsive-modal" class="btn btn-danger">REGISTRAR</button>
                                <!-- Button trigger modal -->
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /Row -->
            
            <div class="row"><?php require 'compartido/DataTables/Dt-usu.html'; ?></div>
            <?php //require 'footer.html'; ?>		
				
	    </div><!-- /Main Content -->
	</div><!-- /#wrapper -->
</body>
</html>

<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/usu.js"></script>
<script src="../js/modal-data.js"></script>
<script src="../js/jquery/jquery.slimscroll.js"></script>
<script src="../js/init.js"></script>
<script src="../js/sweetalert2.js"></script>
