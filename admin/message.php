
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
                <?php include('include/menubar.php'); ?>
          
  <div class="content-wrapper wrapper">

  <?php
        if(isset($_SESSION['error'])){
          echo"
              <script type='text/javascript'>
              toastr.error('".$_SESSION['error']."', 'Error')
              toastr.options.timeOut = 3000;
              </script>
              
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
           
          <script type='text/javascript'>
          toastr.success('".$_SESSION['success']."', 'Success')
          toastr.options.timeOut = 3000;
          </script>
          ";
          unset($_SESSION['success']);
        }
      ?>



    <section class="users">
      <header>
        <div class="content">
          <img src="../images/<?php echo $user['photo']; ?>" alt="">
          <div class="details">
              <span><?php echo $user['admin_firstname'].' '. $user['admin_lastname']?></span>
            <p><?php echo $user['chat_status']; ?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Select an Patient or Doctor to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>
  </div>

  <script src="javascript/users.js"></script>

<?php include 'include/footer.php'; ?>


</body>
</html>
