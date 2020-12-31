<?php
include_once("header.php");
?>

<body>

  <div id="updateDiv" class="userDiv">
    <form action="includes/update.inc.php" id="updateInfoForm" method="POST">
      <fieldset>
        <legend>Update info</legend>
        <input type="text" placeholder="First Name" value="<?php echo $_SESSION['f_name'];?>" name="firstName" id="firstName" required>
        <input type="text" placeholder="Last Name" value="<?php echo $_SESSION['l_name'];?>" name="lastName" id="lastName" required>
        <input type="text" placeholder="Company" value="<?php echo $_SESSION['company'];?>"  name="company" id="company">
        <input type="text" placeholder="Address" value="<?php echo $_SESSION['address'];?>" name="address" id="address">
        <input type="text" placeholder="City" value="<?php echo $_SESSION['city'];?>" name="city" id="city">
        <input type="text" placeholder="State" value="<?php echo $_SESSION['state'];?>" name="state" id="state">
        <input type="text" placeholder="Country" value="<?php echo $_SESSION['country'];?>" name="country" id="country">
        <input type="text" placeholder="Postal Code" value="<?php echo $_SESSION['postal'];?>" name="postalCode" id="postalCode">
        <input type="text" placeholder="Phone number" value="<?php echo $_SESSION['phone'];?>" name="phoneNumber" id="phoneNumber">
        <input type="text" placeholder="Fax" value="<?php echo $_SESSION['fax'];?>" name="fax" id="fax">
        <input type="email" placeholder="Email" value="<?php echo $_SESSION['userMail'];?>" name="mail" id="email" required>
        <input type="hidden" name="customerId" id="customerId" value=<?php echo $_SESSION['userId'];?>>
        <input type="submit" id="updateInfo" value="Update" name="submit_update">
      </fieldset>
    </form>

    <form action="includes/update_pwd.inc.php" id="updatePasswordForm" method="POST">
      <fieldset>
        <legend>Update password</legend>
        <input type="password" placeholder="Password" name="password" id="password" required>
        <input type="password" placeholder="Repeat Password" name="passwordRepeat" id="passwordRepeat" required>
        <input type="hidden" name="customerId" id="customerId" value=<?php echo $_SESSION['userId'];?>>
        <input type="submit" id="updatePassword" value="Update" name="submit_update_password">
      </fieldset>
    </form>
  </div>

  <?php include_once('footer.php') ?>
</body>
</html>