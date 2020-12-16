<?php

require_once("config.php");

class User
{
    public $customerId;
    public $firstName;
    public $lastName;
    public $email;
    public $company;
    public $address;
    public $city;
    public $state;
    public $country;
    public $postalCode;
    public $phone;
    public $fax;


    function C_login($email, $password)
    {
        global $pdo;
        session_start();

$query = <<<'SQL'
    SELECT customerId, password, email, FirstName, LastName, Company, Address, City, State, Country, PostalCode, Phone, Fax FROM customer WHERE email = ?;
SQL;


        $stmnt = $pdo->prepare($query);
        $stmnt->execute(array($email));
        if($stmnt->rowCount() <1) {
            return false;
        }

        $customer = $stmnt->fetch();

        $verify = password_verify($password, $customer["password"]);
        if ($verify) {

$query = <<<'SQL'
    SELECT password FROM admin;
SQL;


            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $stmnt = $pdo->prepare($query);
            $stmnt->execute(array($passHash));
            $admin = $stmnt->fetch();

            $this->customerId = $customer["CustomerId"];
            $this->firstName = $customer["FirstName"];
            $this->lastName = $customer["LastName"];
            $this->email = $email;
            $this->company = $customer["Company"];
            $this->address = $customer["Address"];
            $this->city = $customer["City"];
            $this->state = $customer["State"];
            $this->country = $customer["Country"];
            $this->postalCode = $customer["PostalCode"];
            $this->phone = $customer["Phone"];
            $this->fax = $customer["Fax"];


            if (password_verify($password, $admin[0])) {
                $admin = "true";
            } else {
                $admin = "false";
            }
            return [password_verify($password, $customer["password"]), $admin];
        }
        return [password_verify($password, $customer["password"])];
    }
}
?>