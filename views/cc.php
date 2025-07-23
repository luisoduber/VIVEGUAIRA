<?php session_start(); ?>
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
		<link href="../dist/css/style.css" rel="stylesheet" type="text/css">
		<link href="../css/usuarios.css" rel="stylesheet" type="text/css">
        <link href="../css/top-menu.css" rel="stylesheet" type="text/css">
		<link href="../css/generales.css" rel="stylesheet" type="text/css">
        <link href="../css/jquery/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

<?php 
	require 'preloader.html';
	require 'top-menu.php';
	require 'left-menu.php';
?>		
<body>
<partial name="/Views/Shared/_left-menu.cshtml"></partial> 
<partial name="/Views/Shared/_top-menu.cshtml"></partial> 

<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		    </div>
			    <?php require 'compartido/Ruta/Rt-cc.html'; ?>
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
                                                <h5 class="modal-title fw-bold">Modificar Respuesta Seguridad</h5>
                                            </div>
                                            <div class="modal-body">
												<form action="" id="basic-form" method="post">

                                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
														<label for="txtClavAct" class="fw-bold">Clave Actual</label>
                                                        <input type="password" id="txtClavAct" name="txtClavAct" 
                                                        class="form-control" placeholder="Clave Actual">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
														<label for="txtClavNew" class="fw-bold">Clave Nueva</label>
                                                        <input type="password" id="txtClavNew" name="txtClavNew" 
                                                        class="form-control" placeholder="Clave Nueva">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
														<label for="txtRepClave" class="fw-bold">Repetir Clave</label>
                                                        <input type="password" id="txtRepClave" name="txtRepClave" 
                                                        class="form-control" placeholder="Repetir Clave">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default fw-bold" data-dismiss="modal">CERRAR</button>
                                                        <button type="submit" id="btnGrdMod"  class="btn btn-danger fw-bold">REGISTRAR</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button id="btnReg" data-toggle="modal" data-target="#responsive-modal" class="btn btn-danger">CAMBIAR CLAVE</button>
                                <!-- Button trigger modal -->
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /Row -->
            
            <div class="row"><?php require 'compartido/DataTables/Dt-cc.html'; ?></div>
            <?php require 'footer.html'; ?>		
				
	    </div><!-- /Main Content -->
	</div><!-- /#wrapper -->
</body>
</html>

<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/cc.js"></script>
<script src="../js/modal-data.js"></script>
<script src="../dist/js/jquery.slimscroll.js"></script>
<script src="../dist/js/init.js"></script>
<script src="../js/sweetalert2.js"></script>