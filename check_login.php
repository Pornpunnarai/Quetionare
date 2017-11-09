    <?php
    session_start();

    $memail = $_POST['txtEmail'];
    $mpassword = $_POST['txtPassword'];

    if($memail == ""){
        echo "Please insert your email";
    }
    elseif ($mpassword == ""){
        echo "Please insert your password";
    }
    else{
        include 'connect-mysql.php';
    }

    $strSQL = "SELECT * FROM manager WHERE 
          memail = '".mysqli_real_escape_string($objCon,$_POST['txtEmail'])."' and 
          mpassword = '".mysqli_real_escape_string($objCon,$_POST['txtPassword'])."'";
    $objQuery = mysqli_query($objCon, $strSQL);
    $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

    if(!$objQuery){
        echo "<script type='text/javascript'>alert('email and password incorrect!')</script>";
        echo "<script>setTimeout(\"location.href = 'index.php';\",3000);</script>";
    }

    else{
        $_SESSION["mfirstname"] = $objResult["mfirstname"];
        $_SESSION["memail"] = $objResult["memail"];
        $_SESSION["tid"] = $objResult["tid"];
        $_SESSION["role"] = $objResult["role"];

        session_write_close();

        if($objResult["role"] == "USER"){
            header("location:user_index.php");
        }
        else{
            echo "<script type='text/javascript'>alert('email and password incorrect!')</script>";
            echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
        }
    }
    mysqli_close($objCon);
    ?>