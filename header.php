<head>
    <link rel="stylesheet" type="text/css" href="bank.css">
</head>
<body>
    <?php if($logged_in){?>
        <nav class="navContainer">
            <div style="font-size: 1.2em;">
                <a href="personal.php"><b><?php echo 'Welcome '.$_SESSION['Name']?></b></a>
            </div>
            <div style="font-size: 1.5em;">
                <b>G7 BANK</b>
            </div>
            <div >

            </div>
            <div >
                <a href="loans.php">My Loans</a>
            </div>
            <div >
                <a href="index.php">Logout</a>
            </div>
    <?php }?>
    <?php if(!$logged_in){ ?>
        <nav class="navContainer">
            <div style="font-size: 1.2em;">
                <a href="index.php"><b>Home Page</b></a>
            </div>
            <div style="font-size: 1.5em;">
                <b>G7 BANK</b>
            </div>
            <div >

            </div>
            <div >
                <a href="forex.php">Forex</a>
            </div>
            <div >
                <a href="login.php">Login</a>
            </div>
            <div >
                <a href="register.php">Register</a>
            </div>
    <?php }?>

    </nav>
