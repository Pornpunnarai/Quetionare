<?php include 'connect-mysql.php';
    session_start();
    $mid = $_POST["mid"];
    $areaid = $_POST['areaid'];

    //section one
    $txtfirstname = $_POST['txtfirstname'];
    $txtlastname = $_POST['txtlastname'];
    $txtage = $_POST['txtage'];
    $txtphone = $_POST['txtphone'];
    $gender = $_POST['gender'];
    if($gender == ""){
        $gender = $_POST['gentertxt'];
    }
    $txtemail = $_POST['txtemail'];
    $txtmember = $_POST['txtmember'];
    $educationLevel = $_POST['educationLevel'];
    if($educationLevel == ""){
        $educationLevel = $_POST['educationLeveltxt'];
    }
    $occupation = $_POST['occupation'];
    if($occupation == ""){
        $occupation = $_POST['occupationtxt'];
    }
    $parttimetxt = $_POST['parttimetxt'];
    $salaryparttimetxt = $_POST['salaryparttimetxt'];
    $hometown = $_POST['hometown'];

    if($hometown == ""){
        $hometown = $_POST['hometowntxt'];
    }
    $numberOfLivetxt = $_POST['numberOfLivetxt'];
    $messagetxt = $_POST['messagetxt'];

    //section two
    $saralytxt = $_POST['saralytxt'];
    $carlonetxt = $_POST['carlonetxt'];
    $gasolinetxt = $_POST['gasolinetxt'];
    $bustxt = $_POST['bustxt'];
    $fixcartxt = $_POST['fixcartxt'];
    $carparkingtxt = $_POST['carparkingtxt'];
    $taxtxt = $_POST['taxtxt'];
    $carinsurancetxt = $_POST['carinsurancetxt'];
    $expensesoftravelperdaytxt = $_POST['expensesoftravelperdaytxt'];


    //sectionthree
    $amountofcarperfamily = $_POST['amountofcarperfamily'];
    $amountofcar = $_POST['amountofcartxt'];
    $amountofmotorcycle = $_POST['amountofmotorcycletxt'];
    $amountofbicycle = $_POST['amountofbicycletxt'];
    $amountofpickup = $_POST['amountofpickuptxt'];
    $amountofothervehicles = $_POST['amountofothervehiclestxt'];

    $travelvehicle = $_POST['travelvehicle'];
    if($travelvehicle == ""){
        $travelvehicle = $_POST['travelvehicletxt'];
    }

    $estimatetimetotravel = $_POST['estimatetimetotravel'];
    $satisfiedofyourtravel = $_POST['satisfiedofyourtravel'];
    if($satisfiedofyourtravel == ""){
        $satisfiedofyourtravel = $_POST['satisfiedofyourtraveltxt'];
    }

    $expensesoftravel = $_POST['expensesoftraveltxt'];
    $typeoftravelone = $_POST['typeoftravelone'];
    $typeoftraveltwo = $_POST['typeoftraveltwo'];
    $typeoftravelthree = $_POST['typeoftravelthree'];
    $timetotravelofdayperkilo = $_POST['timetotravelofdayperkilo'];
    $usedvihicleadayperweek = $_POST['usedvihicleadayperweek'];
    $addgasolinebathpertime = $_POST['addgasolinebathpertime'];
    $amountofpassengerpercar = $_POST['amountofpassengerpercar'];
    $typeoftransportation = $_POST['typeoftransportation'];
    $freusedservice = $_POST['freusedservice'];

    $factortoftranone = $_POST['factortoftranone'];
    $factortoftrantwo = $_POST['factortoftrantwo'];
    $factortoftranthree = $_POST['factortoftranthree'];
    $factortoftranfour = $_POST['factortoftranfour'];
    $factortoftranfive = $_POST['factortoftranfive'];

    mysqli_set_charset($objCon,"utf8");

    //insert to survaysectionone
    $sql ="INSERT INTO survay (mid, areaid, firstname,lastname,age,gender,email,phone,message,amountOfFamily,educationLevel,mainOccupation,
    parttime,parttimesalary,amountOftimetoLive,hometown) VALUES ('$mid', '$areaid', '$txtfirstname','$txtlastname','$txtage','$gender','$txtemail',
    '$txtphone','$messagetxt','$txtmember','$educationLevel','$occupation',
    '$parttimetxt','$salaryparttimetxt','$numberOfLivetxt','$hometown')";
    $query = mysqli_query($objCon, $sql);

    //insert to survaysectiontwo
    $sqlSurvay = "INSERT INTO survaysectiontwo (survay_id, salary, carlone, gasoline, bus, fixcar, carparking, tax, carinsurance, expensesoftravelperday)
                  VALUES ((SELECT survay_id FROM survay WHERE firstname = '$txtfirstname' and lastname = '$txtlastname' and mid = '$mid' and areaid = '$areaid'),
                  '$saralytxt','$carlonetxt','$gasolinetxt','$bustxt',
                  '$fixcartxt','$carparkingtxt','$taxtxt','$carinsurancetxt','$expensesoftravelperdaytxt')";

    $query = mysqli_query($objCon, $sqlSurvay);

    //insert to survaysectionthree

    $sqlSurvayThree = "INSERT INTO survaysectionthree (survay_id, amountofcarperfamily,amountofcar, amountofpickup,
    amountofbicycle,amountofmotorcycle,amountofothervehicles,travelvehicle,estimatetimetotravel,satisfiedofyourtravel,expensesoftravel,
    typeoftravelone,typeoftraveltwo,typeoftravelthree, timetotravelofdayperkilo,usedvihicleadayperweek,
    addgasolinebathpertime,amountofpassengerpercar,typeoftransportation, frequenceoftransportationpermonth,
    factortousetrasportationone,factortousetrasportationtwo,factortousetrasportationthree,factortousetrasportationfour,factortousetrasportationfive)
    VALUES ((SELECT survay_id FROM survay WHERE firstname = '$txtfirstname' and lastname = '$txtlastname' and mid = '$mid' and areaid = '$areaid'),'$amountofcarperfamily',
    '$amountofcar','$amountofpickup','$amountofbicycle', '$amountofmotorcycle','$amountofothervehicles','$travelvehicle','$estimatetimetotravel',
    '$satisfiedofyourtravel','$expensesoftravel', '$typeoftravelone','$typeoftraveltwo','$typeoftravelthree',
    '$timetotravelofdayperkilo','$usedvihicleadayperweek','$addgasolinebathpertime','$amountofpassengerpercar','$typeoftransportation','$freusedservice',
    '$factortoftranone','$factortoftrantwo','$factortoftranthree','$factortoftranfour','$factortoftranfive')";

    $query = mysqli_query($objCon, $sqlSurvayThree);

    $strSQL = "SELECT * FROM survay WHERE firstname = '$txtfirstname' and lastname = '$txtlastname' and mid = '$mid' and areaid = '$areaid'";
    $objQuery = mysqli_query($objCon, $strSQL);
    $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

    if($query){
        $message = $objResult["survay_id"];
        $name = $objResult["firstname"];
        $lastname = $objResult["lastname"];

        echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
        echo "<script type='text/javascript'>alert('SURVAY ID :' + ' $message ' + ' Firstname ' +' $name'  +' Lastname ' + ' $lastname ')</script>";
        echo '<a class="btn btn-outline-success my-2 my-sm-0" href="user_index.php">GO TO SURVAY</a>';
        echo '<a class="btn btn-outline-success my-2 my-sm-0" href="homepage.php">GO TO SUMMARY</a>';
        //echo "<script>setTimeout(\"location.href = 'homepage.php';\",2000);</script>";
    }

    else{
        echo "<script type='text/javascript'>alert('submitted failed! Please Try Again')</script>";
        echo "<script>setTimeout(\"location.href = 'user_index.php';\",3000);</script>";
    }

    mysqli_close($objCon);
?>