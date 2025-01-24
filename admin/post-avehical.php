<?php
	session_start();
	error_reporting(0);
	require("../controller/connection.php");
	if(!isset($_COOKIE['maxwheelsu']))
	{	
		header('location:index.php');
	}
	else{ 
		$error = $msg ="" ;
		if(isset($_POST['submit']))
		{
			//defined variables
			$vehicletitle=$_POST['vehicletitle'];
			$brand=$_POST['name'];
			$miles=$_POST['miles'];
			$vehicleoverview=$_POST['vehicalorcview'];
			$Price=$_POST['Price'];
			$fueltype=$_POST['fueltype'];
			$model=$_POST['model'];
			$seatingcapacity=$_POST['seatingcapacity'];
			$vimage1=$_FILES["img1"]["name"];
			$vimage2=$_FILES["img2"]["name"];
			$vimage3=$_FILES["img3"]["name"];
			$vimage4=$_FILES["img4"]["name"];
			$vimage5=$_FILES["img5"]["name"];
			$vimage6=$_FILES["img6"]["name"];
			$airconditioner=$_POST['airconditioner'];
			$powerdoorlocks=$_POST['powerdoorlocks'];
			$antilockbrakingsys=$_POST['antilockbrakingsys'];
			$brakeassist=$_POST['brakeassist'];
			$powersteering=$_POST['powersteering'];
			$driverairbag=$_POST['driverairbag'];
			$passengerairbag=$_POST['passengerairbag'];
			$powerwindow=$_POST['powerwindow'];
			$cdplayer=$_POST['cdplayer'];
			$centrallocking=$_POST['centrallocking'];
			$crashcensor=$_POST['crashcensor'];
			$leatherseats=$_POST['leatherseats'];

			//uploading files
			move_uploaded_file($_FILES["img1"]["tmp_name"],"../image/vehicleimages/".$_FILES["img1"]["name"]);
			move_uploaded_file($_FILES["img2"]["tmp_name"],"../image/vehicleimages/".$_FILES["img2"]["name"]);
			move_uploaded_file($_FILES["img3"]["tmp_name"],"../image/vehicleimages/".$_FILES["img3"]["name"]);
			move_uploaded_file($_FILES["img4"]["tmp_name"],"../image/vehicleimages/".$_FILES["img4"]["name"]);
			move_uploaded_file($_FILES["img5"]["tmp_name"],"../image/vehicleimages/".$_FILES["img5"]["name"]);
			move_uploaded_file($_FILES["img6"]["tmp_name"],"../image/vehicleimages/".$_FILES["img6"]["name"]);

			$date = date("Y-m-d h:i:sa");

			$sql="INSERT INTO vechiles(Vtitle,overview,model,Vbrand,miles,FuelType,Price,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,Vimage6,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats,RegDate,UpdatingDate) VALUES(:vehicletitle,:vehicleoverview,:model,:brand,:miles,:fueltype,:Price,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:vimage6,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats,:date,:update)";
			$query = $connecting->prepare($sql);
			$query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
			$query->bindParam(':brand',$brand,PDO::PARAM_STR);
			$query->bindParam(':miles',$miles,PDO::PARAM_STR);
			$query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
			$query->bindParam(':Price',$Price,PDO::PARAM_STR);
			$query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
			$query->bindParam(':model',$model,PDO::PARAM_STR);
			$query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
			$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
			$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
			$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
			$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
			$query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
			$query->bindParam(':vimage6',$vimage6,PDO::PARAM_STR);
			$query->bindParam(':airconditioner',$airconditioner,PDO::PARAM_STR);
			$query->bindParam(':powerdoorlocks',$powerdoorlocks,PDO::PARAM_STR);
			$query->bindParam(':antilockbrakingsys',$antilockbrakingsys,PDO::PARAM_STR);
			$query->bindParam(':brakeassist',$brakeassist,PDO::PARAM_STR);
			$query->bindParam(':powersteering',$powersteering,PDO::PARAM_STR);
			$query->bindParam(':driverairbag',$driverairbag,PDO::PARAM_STR);
			$query->bindParam(':passengerairbag',$passengerairbag,PDO::PARAM_STR);
			$query->bindParam(':powerwindow',$powerwindow,PDO::PARAM_STR);
			$query->bindParam(':cdplayer',$cdplayer,PDO::PARAM_STR);
			$query->bindParam(':centrallocking',$centrallocking,PDO::PARAM_STR);
			$query->bindParam(':crashcensor',$crashcensor,PDO::PARAM_STR);
			$query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
			$query->bindParam(':date',$date,PDO::PARAM_STR);
			$query->bindParam(':update',$date,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $connecting->lastInsertId();
			if($lastInsertId)
			{
				$msg="Vehicle posted successfully";
			}
			else 
			{
				$error="Something went wrong. Please try again";
			}

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
							<h2 class="page-title">Post A Vehicle</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
											<?php if($error){?>
												<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?></div>
												<?php } 
													else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?></div><?php }?>
														<div class="panel-body">
																<form method="post" class="form-horizontal" enctype="multipart/form-data">
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="vehicletitle" class="form-control" required>
																		</div>
																		<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<select class="selectpicker" name="name" required>
																				<option value=""> Select </option>
																				<?php $ret="SELECT id,name FROM brands";
																				$query= $connecting -> prepare($ret);
																				$query-> execute();
																				$results = $query -> fetchAll(PDO::FETCH_OBJ);
																				if($query -> rowCount() > 0)
																				{
																					foreach($results as $result)
																					{
																				?>
																				<option value="<?php echo htmlentities($result->id);;?>"><?php echo htmlentities($result->name);?></option>
																				<?php }} ?>
																			</select>
																		</div>
																	</div>
																	<div class="hr-dashed"></div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Vehical Overview<span style="color:red">*</span></label>
																		<div class="col-sm-10">
																			<textarea class="form-control" name="vehicalorcview" rows="3" required></textarea>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Price(in USD)<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="Price" class="form-control" required>
																		</div>
																		<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<select class="selectpicker" name="fueltype" required>
																				<option value=""> Select </option>
																				<option value="Petrol">Petrol</option>
																				<option value="Diesel">Diesel</option>
																				<option value="CNG">CNG</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="model" class="form-control" required>
																		</div>
																		<label class="col-sm-2 control-label">Miles such as KM/M<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="miles" class="form-control" required>
																		</div>
																		<br>
																		<br>
																		<br>
																		<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="seatingcapacity" class="form-control" required>
																		</div>
																	</div>
																	<div class="hr-dashed"></div>
																	<div class="form-group">
																		<div class="col-sm-12">
																			<h4><b>Upload Images</b></h4>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-4">
																			Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
																		</div>
																		<div class="col-sm-4">
																			Image 2<span style="color:red">*</span><input type="file" name="img2" required>
																		</div>
																		<div class="col-sm-4">
																			Image 3<span style="color:red">*</span><input type="file" name="img3" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-4">
																			Image 4<span style="color:red">*</span><input type="file" name="img4" required>
																		</div>
																		<div class="col-sm-4">
																			Image 5<input type="file" name="img5">
																		</div>
																		<div class="col-sm-4">
																			Image 6<input type="file" name="img6">
																		</div>
																	</div>
																	<div class="hr-dashed"></div>									
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="panel panel-default">
																<div class="panel-heading">Accessories</div>
																<div class="panel-body">
																	<div class="form-group">
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="airconditioner" name="airconditioner" value="1">
																				<label for="airconditioner"> Air Conditioner </label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
																				<label for="powerdoorlocks"> Power Door Locks </label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
																				<label for="antilockbrakingsys"> AntiLock Braking System </label>
																			</div>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
																			<label for="brakeassist"> Brake Assist </label>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="powersteering" name="powersteering" value="1">
																				<input type="checkbox" id="powersteering" name="powersteering" value="1">
																				<label for="inlineCheckbox5"> Power Steering </label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="driverairbag" name="driverairbag" value="1">
																				<label for="driverairbag">Driver Airbag</label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
																				<label for="passengerairbag"> Passenger Airbag </label>
																			</div>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="powerwindow" name="powerwindow" value="1">
																			<label for="powerwindow"> Power Windows </label>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="cdplayer" name="cdplayer" value="1">
																				<label for="cdplayer"> CD Player </label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox h checkbox-inline">
																				<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
																				<label for="centrallocking">Central Locking</label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="crashcensor" name="crashcensor" value="1">
																				<label for="crashcensor"> Crash Sensor </label>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="checkbox checkbox-inline">
																				<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
																				<label for="leatherseats"> Leather Seats </label>
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-8 col-sm-offset-2">
																			<button class="btn btn-default" type="reset">Cancel</button>
																			<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
																		</div>
																	</div>
																</form>
															</div>
														</div>
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