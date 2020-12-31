<?php
    require "header.php";
?>


<main>
<h1>Signup</h1>
<form action="includes/signup.inc.php" method="post">
<input type="text" name="f_name" placeholder="FirstName">
<input type="text" name="l_name" placeholder="LastName">
<input type="text" name="company" placeholder="Company">
<input type="text" name="address" placeholder="Address">
<input type="text" name="city" placeholder="City">
<input type="text" name="state" placeholder="State">
<input type="text" name="country" placeholder="Country">
<input type="number" name="postal" placeholder="Postal Code">
<input type="number" name="phone" placeholder="Phone number">
<input type="number" name="fax" placeholder="Fax">
<input type="text" name="mail" placeholder="E-mail">
<input type="password" name="pwd" placeholder="Password">
<input type="password" name="pwd-repeat" placeholder="Repeat Password">
<button type="submit" name="signup-submit">Signup</button>

</form>
</main>


<?php
    require "footer.php";

?>