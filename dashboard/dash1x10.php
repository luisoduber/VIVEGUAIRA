<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) { header('location:/login.php'); return;}
if ($_SESSION["modDash1x10"]==true) {$_SESSION["ultUrl"]=$_SERVER['REQUEST_URI'];}
else if ($_SESSION["modDash1x10"]==false) { header('location:'.$_SESSION["ultUrl"]);  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DASHBOARD 1 x 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/spinners-loading.css" rel="stylesheet" type="text/css">
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
					    <a href="index.php" class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-home"></i></span><span class="pcoded-mtext">General</span>
                        </a>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="dashInst.php" target="_blank" class="nav-link "><span class="pcoded-micon">
                            <i class="feather icon-layout"></i></span><span class="pcoded-mtext">Institución</span>
                        </a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						<img src="../imagenes/logo.png" alt="" class="logo-thumb">
						<img src="../imagenes/logo-thumb.png" alt="" class="logo">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
		
					<ul class="navbar-nav ml-auto">
						<li>
							<div class="dropdown drp-user">
								<a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../imagenes/usuario.png" class="img-radius wid-40" alt="User-Profile-Image">
                                </a>
								<div class="dropdown-menu dropdown-menu-right profile-notification">
									<div class="pro-head">
										<img src="../imagenes/usuario.png" class="img-radius" alt="User-Profile-Image">
										<span><?=strtoupper($_SESSION["usuario"]);?></span>
										<a href="auth-signin.html" class="dud-logout" title="Logout">
											<i class="feather icon-log-out"></i>
										</a>
									</div>
									<ul class="pro-body">
										<li >
                                            <a href="#" class="dropdown-item" >
                                            <i class="feather icon-user"></i><?=strtoupper($_SESSION["nombUsu"]);?></a>
                                        </li>
										<li>
                                            <a href="#" class="dropdown-item">
                                            <i class="feather icon-mail"></i><?=strtoupper($_SESSION["usuario"]);?></a>
                                        </li>
										<li >
                                            <a href="../controller/cerrSess.php?prmOp=salir" class="dropdown-item">
                                            <i class="feather icon-lock"></i><span>SALIR</span> </a>
                                        </li>
                                           
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>	
</header>
<div class="pcoded-main-container pt-5">
    <div class="pcoded-content ">
        <div class="row center-dual-ring"><!-- Row Snippers-->
            <div id="spinner-loading" class="lds-dual-ring"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                        <div class="card bg-c-red order-card">
                            <div class="card-body">
                                <h2 class="text-center text-white"><span id="titEv"></span></h2>
                            </div>
                        </div>
                    </div>
            <div class="panel-body">
            <h4><label id="nomb_evento" class="fw-bold nombEvII"></label></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body bg-patern">
                                <div class="row">
                                    <div class="col-auto">
                                <span><strong id="nombEst"></strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <h2 class="mb-0" id="cantPartEst"></h2>
                                        <span class="text-c-green" id="porcPartEst"><i class="feather icon-trending-up ml-1"></i></span>
                                    </div>
                                </div>
                                <div id="customer-chart"></div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h3 class="m-0" id="cantVotEst"><i class="fas fa-circle f-10 m-r-5 text-success"></i></h3>
                                        <span class="ml-3">Votos</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-0" id="cantFaltEst"><i class="fas fa-circle text-primary f-10 m-r-5"></i></h3>
                                        <span class="ml-3">Por Votar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="col-sm-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body bg-patern-white">
                                <div class="row">
                                    <div class="col-auto">
                                        <span><strong id="nombInst"></strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <h2 class="mb-0 text-white" id="cantPartInst"></h2>
                                        <span class="text-white" id="porcPartInst"><i class="feather icon-trending-up ml-1"></i></span>
                                    </div>
                                </div>
                                <div id="customer-chart1"></div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h3 class="m-0 text-white" id="cantVotInst"><i class="fas fa-circle f-10 m-r-5 text-success"></i></h3>
                                        <span class="ml-3"><strong>Votos</strong></span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-0 text-white" id="cantFaltInst"><i class="fas fa-circle f-10 m-r-5 text-white"></i></h3>
                                        <span class="ml-3"><strong>Por Votar</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
  
        <div class="row" id="cardUni">
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
     <script src="js/vendor-all.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pcoded.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/dashboard-main.js"></script>
    <script src="js/dash1x10.js"></script>

</body>
</html>


