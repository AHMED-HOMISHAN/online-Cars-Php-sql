<?php
	session_start();
	error_reporting(0);
	require("../controller/connection.php");
	if(!isset($_COOKIE['maxwheelsu']))
	{	
		header('location:index.php');
	}
	else{
		if(isset($_REQUEST['del']))
		{
			$delid=intval($_GET['del']);
			$sql = "delete from vechiles WHERE  id=:delid";
			$query = $connecting->prepare($sql);
			$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
			$query -> execute();
			$msg="Vehicle  record deleted successfully";
		}
?>

<!doctype html>
<html lang="en" class="no-js">		
	<?php include("includes/head.php");?>
	<body>
		<?php include('includes/header.php');?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Manage Vehicles</h2>
							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Vehicle Details</div>
								<div class="panel-body">
									<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
										else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Vehicle Title</th>
												<th>Brand </th>
												<th>Price</th>
												<th>Fuel Type</th>
												<th>Model Year</th>
												<th>Overview</th>
												<th>Seating Capacity</th>
												<th>Regestion Date</th>
												<th>Upadating Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $sql = "SELECT vechiles.Vtitle,brands.name,vechiles.Price,vechiles.FuelType,vechiles.model,vechiles.overview,vechiles.SeatingCapacity,vechiles.RegDate,vechiles.UpdatingDate,vechiles.id from vechiles join brands on brands.id = vechiles.Vbrand";
												$query = $connecting -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
													foreach($results as $result)
												{
											?>	
											<tr>
												<td><?php echo htmlentities($cnt);?></td>
												<td><?php echo htmlentities($result->Vtitle);?></td>
												<td><?php echo htmlentities($result->name);?></td>
												<td><?php echo htmlentities($result->Price);?></td>
												<td><?php echo htmlentities($result->FuelType);?></td>
												<td><?php echo htmlentities($result->model);?></td>
												<td><?php echo htmlentities($result->overview);?></td>
												<td><?php echo htmlentities($result->SeatingCapacity);?></td>
												<td><?php echo htmlentities($result->RegDate);?></td>
												<td><?php echo htmlentities($result->UpdatingDate);?></td>
												<td><a href="edit-vehicle.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
												<a href="manage-vehicles.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
											</tr>
											<?php $cnt=$cnt+1; }} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
<?php } ?>
