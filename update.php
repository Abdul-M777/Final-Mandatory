<?php

    if(!isset($_SESSION)){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/update_script.js"></script>
    <title>Update profile</title>
</head>
<body>
<?php 
if(!$_SESSION["admin"]){
    header("Location: index.php");
}

include_once("header.php");

if(isset($_POST['firstName'])){
      $_SESSION['FirstName'] = $_POST['FirstName'];
      $_SESSION['lastName'] = $_POST['lastName'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['company'] = $_POST['company'];
      $_SESSION['address'] = $_POST['address'];
      $_SESSION['city'] = $_POST['city'];
      $_SESSION['state'] = $_POST['state'];
      $_SESSION['country'] = $_POST['country'];
      $_SESSION['postalCode'] = $_POST['postalCode'];
      $_SESSION['phone'] = $_POST['phoneNumber'];
      $_SESSION['fax'] = $_POST['fax'];

    
  ?>
  <div id="updateSuccess">
    <p>User information has been updated successfully!</p>
  </div>

  <?php } ?>
  <div id="updateDiv" class="userDiv">
    <form action="update.php" id="updateInfoForm" method="POST">
      <fieldset>
        <legend>Update info</legend>
        <input type="text" placeholder="First Name" value="<?php echo $_SESSION['firstName'];?>" name="firstName" id="firstName" required>
        <input type="text" placeholder="Last Name" value="<?php echo $_SESSION['lastName'];?>" name="lastName" id="lastName" required>
        <input type="text" placeholder="Company" value="<?php echo $_SESSION['company'];?>"  name="company" id="company">
        <input type="text" placeholder="Address" value="<?php echo $_SESSION['address'];?>" name="address" id="address">
        <input type="text" placeholder="City" value="<?php echo $_SESSION['city'];?>" name="city" id="city">
        <input type="text" placeholder="State" value="<?php echo $_SESSION['state'];?>" name="state" id="state">
        <input type="text" placeholder="Country" value="<?php echo $_SESSION['country'];?>" name="country" id="country">
        <input type="text" placeholder="Postal Code" value="<?php echo $_SESSION['postalCode'];?>" name="postalCode" id="postalCode">
        <input type="text" placeholder="Phone number" value="<?php echo $_SESSION['phone'];?>" name="phoneNumber" id="phoneNumber">
        <input type="text" placeholder="Fax" value="<?php echo $_SESSION['fax'];?>" name="fax" id="fax">
        <input type="email" placeholder="Email" value="<?php echo $_SESSION['email'];?>" name="email" id="email" required>
        <input type="hidden" name="customerId" id="customerId" value=<?php echo $_SESSION['customerId'];?>>
        <input type="submit" id="updateInfo" value="Update">
      </fieldset>
    </form>

    <form action="update.php" id="updatePasswordForm" method="POST">
      <fieldset>
        <legend>Update password</legend>
        <input type="password" placeholder="Password" name="password" id="password" required>
        <input type="password" placeholder="Repeat Password" name="passwordRepeat" id="passwordRepeat" required>
        <input type="submit" id="updatePassword" value="Update">
      </fieldset>
    </form>
  </div>

  <?php include_once('footer.php') ?>
</body>
</html>