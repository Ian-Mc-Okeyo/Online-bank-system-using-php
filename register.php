<?php
    $conn = mysqli_connect('localhost', 'Ian', 'mathematics100', 'bank');//localhost, user name, password, database
    //checking if the connection was successful
    //if(!$conn){
        //echo 'Connection Error: '.mysqli_connect_error();
    //}
    $message = '';
    //getting all data from the database
    $sql = 'SELECT accNo FROM users';
    //select query and get the results
    $result = mysqli_query($conn, $sql);
    //fetch the resulting rows
    $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //ariables to be used within the file
    $name=$email=$password1=$password2='';
    $errors=['name'=>'', 'email'=>'', 'password1'=>'', 'password2'=>''];

    //defining the verification functions
    function verifyPassword($pass1, $pass2){
        global $errors;
        if(empty($pass1)){
            $errors['email']='Please fill out this field';
            return FALSE;
        }
        if(strlen($pass1)<8){
            $errors['password1']='Password length must be 8 or more characters long';
            return FALSE;
        }
        if($pass1!=$pass2){
            $errors['password2']='This field must match the password field';
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function verifyUserName($n){
        global $errors;
        if(empty($n)){
            $errors['name']='Please fill out this field';
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function verifyEmail($email){
        global $errors;
        if(empty($email)){
            $errors['email']='Please fill out this field';
            return FALSE;
        }
        if(!(strpos($email, '@'))){
            $errors['email']='Please enter a valid email';
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    //checking if there was a post request
    if(isset($_POST['Submit'])){
        verifyUserName($_POST['name']);
        $name=$_POST['name'];
        verifyPassword($_POST['password1'], $_POST['password2']);
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        verifyEmail($_POST['email']);
        $email=$_POST['email'];

        //if there are no errors
        if(verifyUserName($_POST['name']) &&  verifyPassword($_POST['password1'], $_POST['password2']) && verifyEmail($_POST['email'])){
            //verifyin to prevent duplicate account numbers just i case
            $accno = random_int(1000000000, 9999999999);
            $available = TRUE;
            while($available){
                global $accounts;
                foreach($accounts as $account){
                    if($account['accNo']==$accno){
                        $available = TRUE;
                        $accno = random_int(1000000000, 9999999999);
                    }
                    else{
                        $available = FALSE;
                    }
                }
            }
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
            $sql = "INSERT INTO users(name, email, password, accNo) VALUES('$name', '$email', '$password1', '$accno')";

            //checking if the operation was successful
            if(mysqli_query($conn, $sql)){
                session_start();
                $_SESSION['logged_in']=TRUE;
                $_SESSION['accNo'] = $accno;
                $_SESSION['Name'] = $name;
                $_SESSION['amount'] = 0;
                $_SESSION['flashed_message']='Registration Succcessful. Please make sure to remember your account number and password.';
                header('Location: personal.php');
            }
            else{
                echo 'query error'.mysqli_error($conn);
            }
        }
        else{
            echo 'FAIL';
        }

    }
?>
<DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <br>
    <br>
        <div class="register-container">
            <form method='POST' class="register-container" style="color:white" action="register.php"> 
            <br>
            <br>
                <div style="order : 1"><b style='font-size: 1.3em; margin:50px;'>REGISTER</b></div>
                <div style="order : 2"><img src="static/g7.png", class='logo'></div>
                <div style="order : 3"><label class="labels">User Name:</lable></div>
                <div style="order : 4"><input type="Text" class="forms" placeholder="User Name" name="name" value="<?php echo htmlspecialchars($name) ?>"></div>
                <div style="order : 5; color: red;"><?php echo $errors['name']; ?></div>
    
                <div style="order : 6"><label class="labels">Email Address:</lable></div>
                <div style="order : 7"><input type="Text" class="forms" placeholder="Email Address" name="email" value="<?php echo htmlspecialchars($email) ?>"></div>
                <div style="order : 8; color: red;"><?php echo $errors['email'] ?></div>
    
                <div style="order : 9"><label class="labels">Passsword:</lable></div>
                <div style="order : 10"><input type="Password" class="forms" placeholder="Password" name="password1" value="<?php echo htmlspecialchars($password1) ?>"></div>
                <div style="order: 11; color: red;"><?php echo $errors['password1'] ?></div>
                <div style="order : 12;"><input type="Password" class="forms" placeholder="Confirm Password" name="password2" value="<?php echo htmlspecialchars($password2) ?>"></div>
                <div style="order : 13; color: red;"><?php echo $errors['password2'] ?></div>
    
                <div style="order : 14"><input type="submit" class="submit" name="Submit" value="Submit"></div>
                <span style="order : 15"><b>Already have an Account? </b> <b class="button" href="login.php"><a href='login.php'>Login</a></b></span>
            </form>
        </div>
</body>
    
</html>
