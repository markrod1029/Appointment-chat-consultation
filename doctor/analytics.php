<?php include('include/session.php');?>

<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>


                <?php include('include/header.php');?>
                <?php include('include/sidebar.php');?>
                <?php include('include/menubar.php');
                
                ?>

          
  <div class="content-wrapper">

  <section class="content-header">
  <h1 class="h3  text-gray">Data Analytics</h1>


        </section>



        <div class="row mx-auto">
          <!-- small box -->


 <div class="info-box col-lg-2 col-xs-6 ml-3" style="background-color:#1E90FF;  color:white;">
  <div class="info-box-content">


    <span class="info-box-text text-center">Asthma</span>

    <?php

$sql = "SELECT * FROM appointment_table WHERE status = 'Completed'";
$tquery = $conn->query($sql);


                $sql = "SELECT * FROM appointment_table WHERE status = 'Completed' AND disease = 'Asthma'";
                $query = $conn->query($sql);
                $total = $query->num_rows/$tquery->num_rows*100;
              ?>

    <span class="info-box-number text-center"><?php echo $query->num_rows?></span>
    <div class="progress">
      <div class="progress-bar" style="width:<?php echo $total?>%"></div>
    </div>
    <span class="progress-description text-center">
    <?php echo $total?>%
    </span>
  </div>
</div>
          

        



<div class="info-box col-lg-2 col-xs-6 ml-3" style="background-color:#DC143C; color:white;">
  <div class="info-box-content">


    <span class="info-box-text text-center">Hypertension</span>

    <?php

$sql = "SELECT * FROM appointment_table WHERE status = 'Completed'";
$tquery = $conn->query($sql);


                $sql = "SELECT * FROM appointment_table WHERE status = 'Completed' AND disease = 'Hypertension'";
                $query = $conn->query($sql);
                $total = $query->num_rows/$tquery->num_rows*100;

              ?>

    <span class="info-box-number text-center"><?php echo $query->num_rows?></span>
    <div class="progress">
      <div class="progress-bar" style="width:<?php echo $total?>%"></div>
    </div>
    <span class="progress-description text-center">
    <?php echo $total?>%
    </span>
  </div>
</div>
          





<div class="info-box col-lg-2 col-xs-6 ml-3" style="background-color:#218838; color:white;">
  <div class="info-box-content">


    <span class="info-box-text text-center">Diabetes</span>

    <?php

$sql = "SELECT * FROM appointment_table WHERE status = 'Completed'";
$tquery = $conn->query($sql);


                $sql = "SELECT * FROM appointment_table WHERE status = 'Completed' AND disease = 'Diabetes'";
                $query = $conn->query($sql);
                $total = $query->num_rows/$tquery->num_rows*100;

              ?>

    <span class="info-box-number text-center"><?php echo $query->num_rows?></span>
    <div class="progress">
      <div class="progress-bar" style="width:<?php echo $total?>%"></div>
    </div>
    <span class="progress-description text-center">
    <?php echo $total?>%
    </span>
  </div>
</div>






<div class="info-box col-lg-2 col-xs-6 ml-3" style="background-color:#FF4500; color:white;">
  <div class="info-box-content">


    <span class="info-box-text text-center">Dengue</span>

    <?php

$sql = "SELECT * FROM appointment_table WHERE status = 'Completed'";
$tquery = $conn->query($sql);


                $sql = "SELECT * FROM appointment_table WHERE status = 'Completed' AND disease = 'Dengue'";
                $query = $conn->query($sql);
                $total = $query->num_rows/$tquery->num_rows*100;

              ?>

    <span class="info-box-number text-center"><?php echo $query->num_rows?></span>
    <div class="progress">
      <div class="progress-bar" style="width:<?php echo $total?>%"></div>
    </div>
    <span class="progress-description text-center">
    <?php echo $total?>%
    </span>
  </div>
</div>




<div class="info-box col-lg-2 col-xs-6 ml-3" style="background-color:#aaaa; color:white;">
  <div class="info-box-content">


    <span class="info-box-text text-center">Others</span>

    <?php

$sql = "SELECT * FROM appointment_table WHERE status = 'Completed'";
$tquery = $conn->query($sql);


                $sql = "SELECT * FROM appointment_table WHERE status = 'Completed' AND disease = 'Others'";
                $query = $conn->query($sql);
                $total = $query->num_rows/$tquery->num_rows*100;

              ?>

    <span class="info-box-number text-center"><?php echo $query->num_rows?></span>
    <div class="progress">
      <div class="progress-bar" style="width:<?php echo $total?>%"></div>
    </div>
    <span class="progress-description text-center">
    <?php echo $total?>%
    </span>
  </div>
</div>
      </div>


      <div class="card shadow mb-4">
                        <div class="card-header ">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="h3 m-0 font-weight-bold text-success">Data Analytics</h6>
                            	</div>
                            	<div class="col" align="right">
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">

                    <!-- table doctor -->



                    <div class="row">
        <div class="col">
          <div class="card">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Appointment</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2022; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height: 165px; width: 522px;"></canvas>

                

              </div>

              
            </div>


                   
                </div>
  




    </div>

    </div>








 
<?php include 'include/footer.php'; ?>
</div>



</body>
</html>
<?php
   $and = 'AND YEAR(date) = '.$year;
   $months = array();
   $Asthma = array();
   $Hypertension = array();
   $Diabetes = array();
   $Dengue = array();
   $Others = array();
   for( $m = 1; $m <= 12; $m++ ) {
 
 
 
     $sql = "SELECT * FROM appointment_table WHERE MONTH(date) = '$m' AND disease = 'Asthma' $and";
     $oquery = $conn->query($sql);
     array_push($Asthma, $oquery->num_rows);
 
     $sql = "SELECT * FROM appointment_table WHERE MONTH(date) = '$m' AND disease = 'Hypertension' $and";
     $pquery = $conn->query($sql);
     array_push($Hypertension, $pquery->num_rows);
 
     
 
     $sql = "SELECT * FROM appointment_table WHERE MONTH(date) = '$m' AND disease = 'Diabetes' $and";
     $bquery = $conn->query($sql);
     array_push($Diabetes, $bquery->num_rows);
 
     $sql = "SELECT * FROM appointment_table WHERE MONTH(date) = '$m' AND disease = 'Dengue' $and";
     $cquery = $conn->query($sql);
     array_push($Dengue, $cquery->num_rows);
 
     $sql = "SELECT * FROM appointment_table WHERE MONTH(date) = '$m' AND disease = 'Others' $and";
     $cquery = $conn->query($sql);
     array_push($Others, $cquery->num_rows);
 
 
  
 
  
 
     $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
     $month =  date('M', mktime(0, 0, 0, $m, 1));
     array_push($months, $month);
   }
   
 
 
   $months = json_encode($months);
   $Asthma = json_encode($Asthma);
   $Hypertension = json_encode($Hypertension);
   $Diabetes = json_encode($Diabetes);
   $Dengue = json_encode($Dengue);
   $Others = json_encode($Others);

 
 
 

?>


<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    
    datasets: [
      {
        label               : 'Asthma ',
        fillColor           : '#1E90FF',
        strokeColor         : '#1E90FF',
        pointColor          : '#1E90FF',
        pointStrokeColor    : '#1E90FF',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: '#1E90FF',
        data                : <?php echo $Asthma;   ?>
      },

      {
        label               : 'Hypertension',
        fillColor           : '#DC143C',
        strokeColor         : '#DC143C',
        pointColor          : '#DC143C',
        pointStrokeColor    : '#DC143C',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: '#DC143C',
        data                : <?php echo $Hypertension; ?>
      },
      {
        label               : 'Diabetes',
        fillColor           : '#218838',
        strokeColor         : '#218838',
        pointColor          : '#218838',
        pointStrokeColor    : '#218838',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: '#218838',
        data                : <?php echo $Diabetes; ?>
      },
      {
        label               : 'Dengue',
        fillColor           : '#FF4500',
        strokeColor         : '#FF4500',
        pointColor          : '#FF4500',
        pointStrokeColor    : '#FF4500',
        pointHighlightFill  : '#fff',
        pointHighlightStroke:  '#FF4500',
        data                : <?php echo $Dengue; ?>
      },

      {
        label               : 'Others',
        fillColor           : '#aaaa',
        strokeColor         : '#aaaa',
        pointColor          : '#aaaa',
        pointStrokeColor    : '#aaaa',
        pointHighlightFill  : '#fff',
        pointHighlightStroke:  '#aaaa',
        data                : <?php echo $Others; ?>
      }
    ]
  }
 
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,0,5)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template

    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

    //Boolean - whether to make the chart responsive
    responsive              : true,

  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
  document.getElementById("chart_image").src = document.getElementById("canvas").toDataURL();
});
</script>

<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'analytics.php?year='+$(this).val();
  });
});
</script>



<style>