<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if(empty($_SESSION['logged_in'])){
        header('Location: login.php');
        exit;
    }
    $logged_in=TRUE;

    //$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');//boolean variable to check if the page is refreshed
    $message ='';
    $error = FALSE;

    $accno = $_SESSION['accNo'];

    //getting the user's bank balance
    $conn = mysqli_connect('localhost', 'Ian', 'mathematics100', 'bank');
    $sql = "SELECT amount FROM users WHERE accNo=$accno";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $balance = $info[0]['amount'];

    //withdrawals
    if(isset($_POST['submit1'])){

        //checking if the user's withdrawal request is less or equal to the bank balance
        if($_POST['withdrawalAmount']<=$balance){
            $balance-=$_POST['withdrawalAmount'];
            $sql = "UPDATE users SET amount=$balance WHERE accNo=$accno";
            if (mysqli_query($conn, $sql)) {
                $message = "Withdrawal of ".$_POST['withdrawalAmount']." was successful";
                $error=FALSE;
                $_SESSION['amount'] = $balance;
              } else {
                $message = "Sorry, An Error occured";
                $error=TRUE;
              }
        }
        else{
            $message = "Insufficient balance in your bank account";
            $error=TRUE;
        }
    }

    //deposits
    if(isset($_POST['submit2'])){
        $balance+=$_POST['depositAmount'];
        $sql = "UPDATE users SET amount=$balance WHERE accNo=$accno";
        if (mysqli_query($conn, $sql)) {
            $message = 'You have successfully deposited '.$_POST['depositAmount'];
            $error=FALSE;
            $_SESSION['amount'] = $balance;
          }else {
            $message = 'Sorry, an error occurred';
            $error=TRUE;
        }
    }

    //transfers
    if(isset($_POST['submit3'])){
        if($_POST['transferAmount']<=$balance){
            //querying the accounts data to check if the receiver ID exists
            $receiver_id = $_POST['receiver'];
            if($receiver_id!=$accno){
                $sql = "SELECT amount FROM users WHERE accNo=$receiver_id";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $receiver_balance = $accounts[0]['amount'];
                    $balance -= $_POST['transferAmount'];
                    $receiver_balance += $_POST['transferAmount'];
                    $sql = "UPDATE users SET amount=$balance WHERE accNo=$accno";//updating the user's balance
                    //check if the user's balance is updated successfully
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['amount'] = $balance;
                    }
                    
                    //updating the receiver's balance
                    $sql = "UPDATE users SET amount=$receiver_balance WHERE accNo=$receiver_id";
                    //check if the receiver's balance is updated successfully
                    if (mysqli_query($conn, $sql)) {
                        $message = 'You have successfully transferred '.$_POST['transferAmount'].' to '.$receiver_id;
                    }else {
                        $message = "An error just occurred";
                        $error=TRUE;
                    }
                }
                else{
                    $message = 'The receiver ID does not exist. Please check to confirm that you have entered the correct details';
                    $error=TRUE;
                }
            }else{
                $message = "You can not transfer money to your own account";
                $error=TRUE;
            }
        }
        else{
            $message="Insuficient balance to make this transaction";
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
    <?php if(isset($_SESSION['flashed_message'])){ ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $_SESSION['flashed_message']; unset($_SESSION['flashed_message']) ?>
        </div>
    <?php }?>

    <div class='personal-page'>
        <div style="order: 1; flex-basis:30%;" class='personal-details'>
            <div style='order: 1'><h3 style="color: blue; font-size: 2em;">Personal Details</h3></div>
            <div style="order: 2"><h3><b class='labels'>Account Name:</b> <i class='details'><?php echo $_SESSION['Name']?></i></h3></div>
            <div style="order: 3"><h3><b class='labels'>Account Number:</b> <i class='details'><?php echo $_SESSION['accNo']?></i></h3></div>
            <div style="order: 4"><h3><b class='labels'>Balance:</b> <i class=details><?php echo $_SESSION['amount']?></i></h3></div>
            <div style="order: 5"><h3><b class='labels'>Date:</b> <i class='details'><?php echo date('d-m-y'); ?></i></h3></div>
        </div>
        <div style="order:2; flex-basis: 60%;" class='actions'>
            <div>
                <form method='POST' action="personal.php">
                    <div style='order: 1'><h3 style="color: blue; font-size: 1.5em;">Withdraw</h3></div>
                    <div style='order: 2'><input type="number" class="actions-forms" name="withdrawalAmount" placeholder="Withdrawal Amount" min=1> <input type ="submit" class="actions-submit" name="submit1" value="withdrawal"></div>

                </form>
            </div>
            <div>
                <form method='POST' action="personal.php">
                    <div style='order: 4'><h3 style="color: blue; font-size: 1.5em;">Deposit</h3></div>
                    <div style='order: 2'><input type="number" class="actions-forms" name="depositAmount" placeholder="Deposit Amount"> <input type ="submit" class="actions-submit" name="submit2" value="deposit"></div>
                </form>
            </div>
            <div>
                <form method='POST' action="personal.php">
                <div style='order: 7'><h3 style="color: blue; font-size: 1.5em;">Transfer</h3></div>
                <div style='order: 2'><input type="text" class="actions-forms" name="transferAmount" placeholder="Transfer Amount"> <input type ="submit" class="actions-submit" name="submit3" value="transfer"></div>
                <div style='order: 2'><input type="text" class="actions-forms" name="receiver" placeholder="Reciever ID"></div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>