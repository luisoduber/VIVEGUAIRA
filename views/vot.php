<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }
if ($_SESSION["modVot"]==true) {$_SESSION["ultUrl"]=$_SERVER['REQUEST_URI'];}
else if ($_SESSION["modVot"]==false) { header('location:'.$_SESSION["ultUrl"]);  }
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
		<link href="../css/vot.css" rel="stylesheet" type="text/css">
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
			    <?php require 'compartido/Ruta/Rt-vot.html'; ?>
		</div>

     <!-- Row -->
     <div class="row text-center" >
        <div class="col-md-12" >
            <div class="panel panel-default card-view nombEv">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h4><label id="nomb_evento" class="fw-bold nombEvII"></label></h4>
                    </div>
                </div>
            </div>
        </div>
     </div><!-- /Row -->


            <!-- Row -->
            <div class="row" >
                <div class="col-md-12" >
                    <div class="panel panel-default card-view fond-form" >
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body" >
                               
                                            <div class="modal-body">
                                                    <div class="form-group col-lg-2 col-md-2 col-xs-4">
														<label for="cboLetRif" class="fw-bold nombTit"><strong>Letra</strong></label>
                                                        <select name="cboLetRif" id="cboLetRif" class="form-control">  
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-lg-4 col-md-4 col-xs-8">
														<label for="cboLetRif" class="fw-bold nombTit">Cedula</label>
                                                        <input class="form-control" type="text" name="nro_cedula" id="nro_cedula" maxlength="8" 
                                                        placeholder="Ingrese Cedula" 
                                                        onblur="return bus_Xcedula(event)" onkeypress="return soloNumeros(event)" required>
                                                    </div>

													<div class="form-group col-lg-6 col-md-6 col-xs-12">
													<label for="txtRif" class="fw-bold nombTit">Razon Social</label>
                                                    <input class="form-control" type="text" name="razon_social" id="razon_social" 
                                                    placeholder="Razon Social">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-12 hidden">
														<label for="cboLetRif" class="fw-bold nombTit">Centro Electoral </label>
                                                        <input class="form-control" type="text" name="nomb_centro" id="nomb_centro" 
                                                        placeholder="Centro Electoral">
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-xs-12 hidden">
														<label for="cboLetRif" class="fw-bold nombTit">Centro Electoral</label>
                                                        <textarea class="form-control"  name="direccion" id="direccion" style="height:140px; resize: none;" 
                                                        placeholder="Dirección" rows="10" height="500"></textarea>
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
														<label for="cbo_tipo_voto" class="fw-bold nombTit">Voto</label>
                                                        <select name="cbo_tipo_voto" id="cbo_tipo_voto" class="form-control selectpicker">  
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-lg-2 col-md-2 col-xs-2">
                                                        <button class="btn btn-danger btnReg fw-bold" name="btnReg" id="btnReg">
                                                        <i class="fa fa-plus-circle"></i>  <b><strong>Registrar</strong></b></button>
                                                    </div>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /Row -->
  
            <?php //require 'footer.html'; ?>		
				
	    </div><!-- /Main Content -->
	</div><!-- /#wrapper -->
</body>
</html>

<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/vot.js"></script>
<script src="../js/jquery/jquery.slimscroll.js"></script>
<script src="../js/sweetalert2.js"></script>
