<?php include_once "php/session.php"; ?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
      <?php 
          $doctor_id = mysqli_real_escape_string($conn, $_GET['doctor_id']);
          $sql = mysqli_query($conn, "SELECT * FROM doctor_table WHERE doctor_id = {$doctor_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="images/<?php echo $user['patient_photo']; ?>" alt="">
        <div class="details">
          <span><?php echo $user['patient_first_name']. ' '. $user['patient_last_name'] ?></span>
          <p><?php echo $user['chat_status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $doctor_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
