<?php
class Account{

    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con=$con;
    }

    public function updateDetails($fn, $ln, $em, $un){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em,$un);

        if (empty($this->errorArray)){
            $query= $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em
                                            WHERE username=:un");
            $query->bindParam(':un',$un);
            $query->bindParam(':fn',$fn);
            $query->bindParam(':ln',$ln);
            $query->bindParam(':em',$em);

            $query->execute();
        }

        return false;
    }

    public function register($fn, $ln, $un, $em, $emv, $pw, $pwv){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmail($em,$emv);
        $this->validatePassword($pw,$pwv);

        if (empty($this->errorArray)){
            return $this->registerUser($fn,$ln,$un,$em,$pw);
        }

        return false;
    }

    public function login($un,$pw)
    {
        $pw = hash("sha512",$pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");

        $query->bindValue(":un",$un);
        $query->bindValue(":pw",$pw);

        $query->execute();

        if($query->rowCount() == 1){
            return true;
        }

        array_push($this->errorArray, Constants::$loginFail);
        return false;
    }

    private function registerUser($fn,$ln,$un,$em,$pw)
    {
        $pw = hash("sha512",$pw);

        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password) 
                                        VALUES (:fn,:ln,:un,:em,:pw)");
        
        $query->bindValue(":fn",$fn);
        $query->bindValue(":ln",$ln);
        $query->bindValue(":un",$un);
        $query->bindValue(":em",$em);
        $query->bindValue(":pw",$pw);

        return $query->execute();
    }

    private function validateFirstName($fn)
    {
        if(strlen($fn) < 3 || strlen($fn) > 50)
        {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln)
    {
        if(strlen($ln) < 3 || strlen($ln) > 50)
        {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un)
    {
        if(strlen($un) < 3 || strlen($un) > 50)
        {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);

        $query->execute();

        if($query->rowCount() !=0){
            array_push($this->errorArray, Constants::$usernameExists);
        }
    }

    private function validateEmail($em,$emv)
    {
        if($em != $emv){
            array_push($this->errorArray, Constants::$emailCharacters);
            return;
        }

        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailValid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);

        $query->execute();

        if($query->rowCount() !=0){
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validateNewEmail($em,$un)
    {
        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailValid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username!=:username");
        $query->bindValue(":em", $em);
        $query->bindValue(":username", $un);

        $query->execute();

        if($query->rowCount() !=0){
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePassword($pw,$pwv)
    {
        if($pw != $pwv)
        {
            array_push($this->errorArray, Constants::$passwordMatch);
            return;
        }

        if(strlen($pw) < 5 || strlen($pw) > 25)
        {
            array_push($this->errorArray, Constants::$passwordCharacters);
        }
    }

    public function getError($error)
    {
        if(in_array($error,$this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function getFirstErorr(){
        if(!empty($this->errorArray)){
            return $this->errorArray[0];
        }
    }

    public function updatePassword($oldPw, $pw, $pw2, $un){
        $this->validateOldPassword($oldPw,$un);
        $this->validatePassword($pw,$pw2);

        if (empty($this->errorArray)){
            $query= $this->con->prepare("UPDATE users SET password=:pw WHERE username=:un");
            $pw = hash("sha512", $pw);
            $query->bindParam(':un',$un);
            $query->bindParam(':pw',$pw);

            $query->execute();
        }

        return false;
    }

    public function validateOldPassword($oldPw, $un){
        $pw = hash("sha512",$oldPw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");

        $query->bindValue(":un",$un);
        $query->bindValue(":pw",$pw);

        $query->execute();

        if($query->rowCount()==0){
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }

}
?>