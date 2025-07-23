
	
<?php 
$modVot="";
$modSist="";
$modVot='<li class="navigation-header">
		<span>Usuarios</span> 
		<i class="zmdi zmdi-more"></i>
	</li>
	<li>
		<a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr">
			<div class="pull-left">
				<i class="zmdi zmdi-landscape mr-20"></i>
				<span class="right-nav-text">Participación</span>
			</div>
				
			<div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i>
			</div>
			<div class="clearfix"></div>	
		</a>
			
		<ul id="dashboard_dr" class="collapse collapse-level-1">
			<li>
				<a href="vot.php">Registrar</a>
			</li>
			<li>
				<a href="seg.php">Seguimiento</a>
			</li>
		</ul>
	</li>
	<hr class="light-grey-hr mb-10"/></li>
';

$modSist='<li class="navigation-header">
		<span>Sistema</span> 
		<i class="zmdi zmdi-more"></i>
	</li>
	<li>
		<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr">
			<div class="pull-left">
				<i class="zmdi zmdi-edit mr-20"></i>
					<span class="right-nav-text">Usuarios</span>
				</div>
				<div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i>
				</div>
			<div class="clearfix"></div>
		</a>
		<ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
			<li>
				<a href="usu.php">Registrar</a>
			</li>
		</ul>
	</li>
	<hr class="light-grey-hr mb-10"/>
';
$modRegJef='<li class="navigation-header">
		<span>1 x 10</span> 
		<i class="zmdi zmdi-more"></i>
	</li>
	<li>
		<a href="javascript:void(0);" data-toggle="collapse" data-target="#maps_dr">
			<div class="pull-left">
				<i class="zmdi zmdi-edit mr-20"></i>
					<span class="right-nav-text">Registrar</span>
				</div>
				<div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i>
				</div>
			<div class="clearfix"></div>
		</a>
		<ul id="maps_dr" class="collapse collapse-level-1 two-col-list">
			<li>
				<a href="regJef.php">Jefe</a>
			</li>
		</ul>
	</li>
	<hr class="light-grey-hr mb-10"/>
';

$modProcGen='<li class="navigation-header">
		<span>Seguimiento</span> 
		<i class="zmdi zmdi-more"></i>
	</li>
		
	<li>
		<a href="javascript:void(0);" data-toggle="collapse" data-target="#icon_dr">
			<div class="pull-left">
				<i class="zmdi zmdi-landscape mr-20"></i>
				<span class="right-nav-text">Dashboard</span>
			</div>
				
			<div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i>
			</div>
			<div class="clearfix"></div>	
		</a>
			
		<ul id="icon_dr" class="collapse collapse-level-1">
			<li>
				<a href="../dashboard/index.php" target="_blank">General</a>
			</li>
		</ul>
	</li>
	<hr class="light-grey-hr mb-10"/></li>
';
?>
<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
	<?php
		if ($_SESSION["idPerf"]==1) { echo $modVot.$modSist.$modRegJef.$modProcGen; }
		else if ($_SESSION["idPerf"]==2) { echo $modVot; }
		else if ($_SESSION["idPerf"]==3) { echo $modRegJef; }
	?>
	</ul>
</div>
