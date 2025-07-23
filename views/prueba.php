
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
		<link href="../css/usuarios.css" rel="stylesheet" type="text/css">
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
     <div class="row text-center">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h4><label id="nomb_evento" class="fw-bold"></label></h4>
                    </div>
                </div>
            </div>
        </div>
     </div><!-- /Row -->


            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                               
                            
                            <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">.col-md-4</div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">.col-md-4</div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">.col-md-4</div>
                               
                                        
                           
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /Row -->
  
            <?php require 'footer.html'; ?>		
				
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
