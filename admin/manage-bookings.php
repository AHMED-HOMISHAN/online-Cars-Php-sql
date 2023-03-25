<?php
    session_start();
    error_reporting(0);
    require("../controller/connection.php");
    if(!isset($_COOKIE['maxwheelsu']))

    {	

    header('location:http://localhost/online-Cars-Php-sql-main/');
    }
    else{
    if(isset($_REQUEST['eid']))
    {
    $eid=intval($_GET['eid']);
    $status="2";
    $sql = "UPDATE booking SET Status=:status WHERE  id=:eid";
    $query = $connecting->prepare($sql);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
    $query -> execute();

    $msg="Booking Successfully Cancelled";
    }

    if(isset($_REQUEST['aeid']))
    {
    $aeid=intval($_GET['aeid']);
    $status=1;

    $sql = "UPDATE booking SET Status=:status WHERE  id=:aeid";
    $query = $connecting->prepare($sql);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
    $query -> execute();

    $msg="Booking Successfully Confirmed";
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

        <h2 class="page-title">Manage Bookings</h2>

        <!-- Zero Configuration Table -->
        <div class="panel panel-default">
            <div class="panel-heading">Bookings Info</div>
                <div class="panel-body">
                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Vehicle</th>
                                <th>Brand</th>
                                <th>User Email</th>
                                <th>Posting date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT users.UserName,users.Email,brands.name,vechiles.Vtitle,booking.vechile_id as vid,booking.status,booking.booking_date,booking.id  from booking join vechiles on vechiles.id=booking.vechile_id join users on users.Email=booking.userEmail join brands on vechiles.Vbrand=brands.id  ";
                            $query = $connecting -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            { 
                            $cnt=1;
                            foreach($results as $result)
                            {				?>	
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->UserName);?></td>
                                    <td style="padding:1rem"><a class="scuess" href="edit-vehicle.php?id=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->Vtitle);?></a></td>
                                    <td><?php echo htmlentities($result->name);?></td>
                                    <td><?php echo htmlentities($result->Email);?></td>
                                    <td><?php echo htmlentities($result->booking_date);?></td>
                                    <td>
                                    <?php 
                                    if($result->status==0)
                                    {
                                        echo htmlentities('Not Confirmed yet');
                                    } else if ($result->status==1) {
                                        echo htmlentities('Confirmed');
                                    }
                                    else{
                                        echo htmlentities('Cancelled');
                                    }
                                    ?></td>
                                    <td><a class="btns btns-outline-scuess" href="manage-bookings.php?aeid=<?php echo htmlentities($result->id);;?>" onclick="return confirm('Do you really want to Confirm this booking')"> Confirm</a> 
                                    <a class="btns btns-outline-danger" href="manage-bookings.php?eid=<?php echo htmlentities($result->id);;?>" onclick="return confirm('Do you really want to Cancel this Booking')"> Cancel</a>
                                    </td>
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

<script>

window.onload = function(){

// Line chart from swirlData for dashReport
var ctx = document.getElementById("dashReport").getContext("2d");
window.myLine = new Chart(ctx).Line(swirlData, {
responsive: true,
scaleShowVerticalLines: false,
scaleBeginAtZero : true,
multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
}); 

// Pie Chart from doughutData
var doctx = document.getElementById("chart-area3").getContext("2d");
window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

// Dougnut Chart from doughnutData
var doctx = document.getElementById("chart-area4").getContext("2d");
window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

}
</script>

</body>
</html>
<?php } ?>
