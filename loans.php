<?php
    $logged_in=TRUE;
    session_start();
    if(empty($_SESSION['logged_in'])){
        header('Location: login.php');
        exit;
    }
    $accno = $_SESSION['accNo'];
    $conn = mysqli_connect('localhost', 'Ian', 'mathematics100', 'bank');
    $sql = "SELECT amount, loanAmount  FROM users WHERE accNo=$accno";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $balance = $info[0]['amount'];
    $loanAmount = $info[0]['loanAmount'];

    $message = '';
    $error = FALSE;

    //if the user borrows
    if(isset($_POST['submit1'])){
        if($loanAmount==0){
            $loanAmount+=$_POST['borrow'];
            $balance+=$_POST['borrow'];
            $sql = "UPDATE users SET loanAmount=$loanAmount WHERE accNo=$accno";
            if (mysqli_query($conn, $sql)) {
                $message = 'You have successfully borrowed '.$_POST['borrow'].' Please confirm that the money has been depositd in your bank account';
                $error=FALSE;
                $_SESSION['amount'] = $balance;
              } else {
                $message = "Sorry, An Error occured";
                $error=TRUE;
              }
            $sql = "UPDATE users SET amount=$balance WHERE accNo=$accno";
            if (mysqli_query($conn, $sql)) {
                $message = 'You have successfully borrowed '.$_POST['borrow'].' Please confirm that the money has been depositd in your bank account';
                $error=FALSE;
                $_SESSION['amount'] = $balance;
              } else {
                $message = "Sorry, An Error occured";
                $error=TRUE;
              }
        }
        else{
            $message = "You have an outstanding loan balance of $loanAmount that has to be repaid";
            $error=TRUE;
        }
    }

    //repayment
    if(isset($_POST['submit2'])){
        if($loanAmount>=0){
            if($_POST['repay']<=$balance){
                if($loanAmount<=$_POST['repay']){
                    $loanAmount_store=$loanAmount;
                    $loanAmount = 0;
                    $balance -=$loanAmount_store;
                }else{
                    $loanAmount-=$_POST['repay'];
                    $balance -=$_POST['repay'];
                }
                $sql = "UPDATE users SET loanAmount=$loanAmount WHERE accNo=$accno";
                if (mysqli_query($conn, $sql)) {
                    $message = 'You have successfully repaid '.$_POST['repay'].' Your outstanding loan balance is '.$loanAmount;
                    $error=FALSE;
                    $_SESSION['amount'] = $balance;
                } else {
                    $message = "Sorry, an Error occured";
                    $error=TRUE;
                }
                $sql = "UPDATE users SET amount=$balance WHERE accNo=$accno";
                if (mysqli_query($conn, $sql)) {
                    $message = 'You have successfully repaid '.$_POST['repay'].' Your outstanding loan balance is '.$loanAmount;
                    $error=FALSE;
                    $_SESSION['amount'] = $balance;
                } else {
                    $message = "Sorry, an Error occured";
                    $error=TRUE;
                }

            }else{
                $message = 'You have insufficient balance in your bank account to repay this amount. Please deposit the required amount to repay';
                $error=TRUE;
            }
        }else{
            $message = 'You have no outstanding loan balance';
            $error=TRUE;
        }
    }
?>
<DOCTYPE html>
<html>
    <?php include "header.php"?>
    <?php if(!empty($message)){ ?>
        <div class="alert" <?php if($error){ ?> style="background: red" <?php } ?>>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $message ?>
        </div>
    <?php }?>
    <div class='personal-page'>
        <div style="order: 1; flex-basis:30%;" class='personal-details'>
            <div style='order: 1'><h3 style="color: blue; font-size: 2em;">Loans Details</h3></div>
            <div style="order: 2"><h3><b class='labels'>Account Name:</b> <i class='details'><?php echo $_SESSION['Name']?></i></h3></div>
            <div style="order: 3"><h3><b class='labels'>Account Number</b>: <i class='details'><?php echo $_SESSION['accNo']?></i></h3></div>
            <div style="order: 4"><h3><b class='labels'>Loan Balance:</b> <i class=details><?php echo $loanAmount?></i></h3></div>
            <div style="order: 6"><h3><b class='labels'>Date:</b> <i class='details'><?php echo date('d-m-y'); ?></i></h3></div>
        </div>
        <div style="order:2; flex-basis: 60%;" class='actions'>
            <div>
                <form method='POST'>
                    <div style='order: 1; align-items: centre;'><h3 style="color: blue; font-size: 2em;"><sup>Borrow </sup> <sub><img src="static/borrow.png" style="width:60px; border-radius: 43px;"></sub></h3> </div>
                    <div style='order: 2'><input type='number' name='borrow' placeholder='Borrow Amount' class='actions-forms' min='1'> <input type='submit' name='submit1' value='borrow' class='actions-submit'></div>

                </form>
            </div>
            <div>
                <form method='POST'>
                    <div style='order: 4'><h3 style="color: blue; font-size: 2em;"><sup>Repay </sup><img src="static/repay.jpg" style="width:100px; border-radius: 60px;"></h3></div>
                    <div style='order: 5'><input type='number' name='repay' placeholder='Repay Amount' class='actions-forms' min='1'>  <input type='submit' name='submit2' value='repay' class='actions-submit'></div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>