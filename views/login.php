<!DOCTYPE html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>LOGIN</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="Ing. De sistema. Luis Oduber"/>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="icon" href="../favicon.ico" type="image/x-icon">
		<link href="../vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
		<link href="../dist/css/style.css" rel="stylesheet" type="text/css">
		<link href="../css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body class="fond">

		<div class="wrapper pa-0">
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid fond">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
									<div class="mb-0">
											<h4 class="text-center fw-bold">venezuela nuestra la Guaira</h4>
										</div>
									<div class="mb-10 logo">
											
									</div>	
										<div class="mb-0">
											<h4 class="text-center  mb-10 fw-bold"><span class="subTit">VENEZUELA NUESTRA LA GUAIRA</span></h4>
										</div>	
										<div class="form-wrap">
											<form action="" id="basic-form" method="post">
												<div class="form-group">
													<label class="fw-bold control-label mb-10" for="exampleInputEmail_2">Usuario</label>
													<input type="text" class="form-control"  id="txtUsuario" name="txtUsuario" 
													placeholder="Ingresar usuario">
												</div>
												<div class="form-group">
													<label class="fw-bold control-label mb-10" for="exampleInputpwd_2">Contraseña</label>
													<div class="clearfix"></div>
													<input type="password" class="form-control"  id="txtClave" name="txtClave" 
													placeholder="Ingrese contraseña">
												</div>
												
												<div class="form-group text-center">
													<button type="submit" id="btnLog" class="btn btn-info fw-bold">Iniciar sessión</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		</div>
		<!-- /#wrapper -->
		
		<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		<script src="../js/login.js"></script>
		<script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../dist/js/init.js"></script>
		<script src="../js/sweetalert2.js"></script>
	</body>
</html>
