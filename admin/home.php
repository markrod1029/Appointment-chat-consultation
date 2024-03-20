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
  <h1 class="h3 mb-4 text-gray">Dashboard</h1>

        </section>







        <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="h3 m-0 font-weight-bold text-success">Location: Jesus Hand Healing Hospital</h6>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">

                    <!-- table doctor -->



                    

                <div class="mapouter"><div class="gmap_canvas">
                    <iframe width="1200" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=jesus%20hand%20healing%20hospital&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://putlocker-is.org"></a>
                            <br>
                    

                    
                </div>
                
                </div>
     

                </div>
                        </div>

  




    </div>

    </div>








 
<?php include 'include/footer.php'; ?>
</div>



</body>
</html>



<style>
#gmap_canvas{
    width:100%; 
}
@media (max-width: 667px) {      
#gmap_canvas{
   position:absolute;
   top:450px;
   width:90%; 

left:10px;
  }
          }


  </style>