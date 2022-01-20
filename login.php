<?php
    $conn = mysqli_connect('localhost', 'Ian', 'mathematics100', 'bank');//localhost, user name, password, database
    //checking if the connection was successful
    if(!$conn){
        echo 'Connection Error: '.mysqli_connect_error();
    }
    $session=FALSE;

    //getting all data from the database
    $sql = 'SELECT accNo FROM users';
    //select query and get the results
    $result = mysqli_query($conn, $sql);
    //fetch the resulting rows
    $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $error=$name=$accNo=$password='';
    if(isset($_POST['Submit'])){
        $name=$_POST['name'];
        $accNo = $_POST['accountNo'];
        $password = $_POST['password'];
        //checking if the account number exists
        $available = FALSE;
        foreach($accounts as $account){
            if($account['accNo']==$_POST['accountNo']){
                $available=TRUE;
                echo 'available';
            }
        }
        //if the account number is available
        if($available){
            $accno = $_POST['accountNo'];
            $sql = "SELECT name, email, amount, password FROM users WHERE accNo=$accno";
            $result = mysqli_query($conn, $sql);
            $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if($_POST['name']==$accounts[0]['name'] && $_POST['password']==$accounts[0]['password']){
                session_start();
                $_SESSION['logged_in']=TRUE;
                $_SESSION['accNo'] = $accno;
                $_SESSION['Name'] = $_POST['name'];
                $_SESSION['amount'] = $accounts[0]['amount'];
                $_SESSION['flashed_message']='Login Succcessful';
                header('Location: personal.php');
            }
            else{
                $error='Invalid login Details';
            }
        }
        else{
            $error = 'Invalid Account Number';
        }
    }

?>
<DOCTYPE html>
<html>
    <?php include "header.php"?>
    <?php if(!empty($error)){ ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $error ?>
        </div>
    <?php }?>
    <br>
    <br>
    <div class = 'login-container'>
        <form method='POST' class = 'login-container'>
            <div style="order: 1;"><h2 style="color: #40ff00; font-size: 3em;" >G7 BANK</h2></div>
            <div style="order: 2;"><img src="static/g7.png" class='logo'></div>
            <div style="order: 3"><label class='labels'>User Name</label></div>
            <div style="order: 5"><input type='text' name = 'name' class='forms' placeholder='User Name' value="<?php echo $name ?>"></div>
            <div style="order: 6"><label class='labels'>Account Number</label></div>
            <div style="order: 7"><input type='text' name = 'accountNo' class='forms' placeholder='account Number' value="<?php echo $accNo ?>"></div>
            <div style="order: 8"><label class='labels'>Password</label></div>
            <div style="order: 9"><input  type='password' name= 'password' class='forms' placeholder='Password' value="<?php echo $password ?>"></div>
            <div style="order: 10"><input type='submit' name='Submit' value='Login' class='submit'></div>
        </form>
    </div>
</body>
</html>