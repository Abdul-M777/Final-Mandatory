<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>
<body class="admin_login_body">
    <div class="admin_div_login">
    <fieldset class="admin_fieldset">
    <legend id="admin_legend">Administration Login</legend>
    <form action="includes/admin.inc.php" method="post" id="admin_login_form">
        <!-- <input type="text" name="admin_mail" id="admin_mail" placeholder="Email..."> -->
        <input type="password" name="admin_pwd" id="admin_pwd" placeholder="Password...">
        <button type="submit" name="admin_login-submit">Login</button>
        </form>
    </fieldset>
    </div>
    



</body>
</html>