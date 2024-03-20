
<?php include_once "php/session.php"; ?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          
          <img src="images/<?php echo $user['patient_photo']; ?>" alt="">
          <div class="details">
              <span><?php echo $user['patient_first_name'].' '. $user['patient_last_name'];?></span>
            <p><?php echo $user['chat_status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $user['patient_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an Doctor to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
