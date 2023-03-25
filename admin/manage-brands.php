<?php
session_start();
error_reporting(0);
require("../controller/connection.php");
if(!isset($_COOKIE['maxwheelsu']))

{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from brands  WHERE id=:id";
$query = $connecting->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated  successfully";
}
$date = date("Y-m-d h:i:sa");
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

<h2 class="page-title">Manage Brands <?php echo"<h1>$date</h1>"; ?></h2>

<!-- Zero Configuration Table -->
<div class="panel panel-default">
<div class="panel-heading">Listed  Brands</div>
<div class="panel-body">
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>
<tr>
<th>#</th>
<th>Brand Name</th>
<th>Creation Date</th>
<th>Updation date</th>

<th>Action</th>
</tr>
</thead>
<tbody>

<?php $sql = "SELECT * from  brands ";
$query = $connecting -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
<tr>
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($result->name);?></td>
<td><?php echo htmlentities($result->creation_date);?></td>
<td><?php echo htmlentities($result->updating_date);?></td>
<td><a href="edit-brand.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-brands.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
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
