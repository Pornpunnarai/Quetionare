<?php session_start();
    if($_SESSION['mfirstname'] == ""){
        echo "<script type='text/javascript'>alert('email and password incorrect!')</script>";
        exit();
    }
    include 'connect-mysql.php';

    $strSQL = "SELECT * FROM manager WHERE 
              memail = '".$_SESSION['memail']."'";
    $strSQL2 = "SELECT tname FROM team WHERE tid = '".$_SESSION['tid']."'";

    $objQuery = mysqli_query($objCon, $strSQL);
    $objQuery2 = mysqli_query($objCon, $strSQL2);

    $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
    $objResult2 = mysqli_fetch_array($objQuery2, MYSQLI_ASSOC);
?>

    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Questionare</title>

        <!-- Bootstrap core CSS -->
        <link href="/questionare/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="sticky-footer-navbar.css" rel="stylesheet">
    </head>

    <body>

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link disabled" href="#">Hello, <?php echo $objResult["mfirstname"];?> <?php echo $objResult["mlastname"];?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Manager Id: <?php echo $objResult["mid"];?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">TEAM: <?php echo $objResult2["tname"];?> </a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <a class="btn btn-outline-success my-2 my-sm-0" href="homepage.php">View Data</a>
                    <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
                </form>
            </div>
        </nav>

        </div>

    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
        <div class="mt-3">
            <br>
            <h3 style="text-align: center">แบบสอบถาม</h3>
            <h4 style="text-align: center">โครงการสำรวจพฤติกรรมการเดินทางของประชาชนในกลุ่มภาคเหนือตอนบน 4 จังหวัด</h4>
            <h4 style="text-align: center">(เชียงใหม่ ลำพูน ลำปาง แม่ฮ่อนสอน)</h4><hr>
            <p style="text-align: center">ศูนย์ความเป็นเลิศด้านการศึกษาเรื่องเมืองและนโยบายสาธารณะ มหาวิทยาลัยเชียงใหม่<br>Excellence Center for Urban Planning and Development (ECUP)</p> <hr>
        </div>

        <form id="contact-form" method="post" action="check_survay.php" role="form">
            <input type="hidden" name="mid" value="<?php echo $objResult["mid"];?>">
            <div class="row">
                <div class="col-md-12">
                    <label for="form_areacode"><b>Area Code *</b></label>

                    <select class="form-control" name="areaid" required="required" data-error="Area code is required.">
                        <option value="">Please Select Area</option>
                        <?php
                        $sqlarea = "SELECT * FROM Area ORDER BY areaId ASC";
                        $objQueryArea = mysqli_query($objCon, $sqlarea);
                        while($objResultArea = mysqli_fetch_array($objQueryArea,MYSQLI_ASSOC))
                        {
                            ?>
                            <option value="<?php echo $objResultArea["areaId"];?>">
                                <?php echo $objResultArea["areaId"]." - ".$objResultArea["areaName"];?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br><label><u><b>ส่วนที่ 1 ข้อมูลพื้นฐานของผู้ตอบแบบสอบถาม</b></u></label><br><br>
            <!-- name -->
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="txtfirstname"><b>1.1 ชื่อ *</b></label>
                    <input type="text" name="txtfirstname" class="form-control" placeholder="Please enter your firstname" required="required" data-error="Firstname is required.">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-6">
                    <label for="txtlastname"><b>1.2 นามสกุล *</b></label>
                    <input type="text" name="txtlastname" class="form-control" placeholder="Please enter your lastname" required="required" data-error="Lastname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="txtage"><b>1.3 อายุ *</b></label>
                    <input type="text" name="txtage" class="form-control" placeholder="Please enter your age" required="required" data-error="Age is required.">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-md-4">
                    <label for="txtphone"><b>1.4 เบอร์โทร *</b></label>
                    <input type="tel" name="txtphone" class="form-control" placeholder="Please enter your telephone" minlength="10" maxlength="10" required="required" data-error="Telephone is required.">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-md-4">
                    <p><b>1.5 เพศ *</b></p>
                    <label for="gender" class="radio-inline">
                        <input type="radio" name="gender" value="ชาย" required="required"> ชาย
                    </label>
                    <label for="gender" class="radio-inline">
                        <input type="radio" name="gender" value="หญิง"> หญิง
                    </label>
                    <label for="gender" class="radio-inline">
                        <input type="radio" name="gender" value=""> อื่นๆ <input type="text" name="gentertxt"/>
                    </label>
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-6">
                    <label for="txtemail"><b>1.6 อีเมล์ *</b></label>
                    <input type="email" name="txtemail" placeholder="Please enter your email" class="form-control" required="required" data-error="Email is required.">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-md-6">
                    <label for="txtmember"><b>1.7 จำนวนสมาชิกในครัวเรือน (รวมตัวท่านเอง) *</b></label>
                    <input type="text" name="txtmember" class="form-control" placeholder="Please enter a number of member" required="required" data-error="Number of member is required.">
                    <div class="help-block with-errors"></div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>1.8 ระดับการศึกษาของผู้ตอบแบบสอบถาม *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="ประถมศึกษา" required="required"> ประถมศึกษา
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="มัธยมศึกษาตอนต้น"> มัธยมศึกษาตอนต้น
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="ปวช"> ปวช.
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="มัธยมศึกษาตอนปลาย"> มัธยมศึกษาตอนปลาย
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name=educationLevel value="ปวส"> ปวส.
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="ปริญญาตรี"> ปริญญาตรี
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value="สูงกว่าปริญญาตรี"> สูงกว่าปริญญาตรี
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="educationLevel" class="radio-inline">
                                <input type="radio" name="educationLevel" value=""> อื่นๆ<input type="text" name="educationLeveltxt"/>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- occupation -->
            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>1.9 อาชีพหลักของผู้ตอบแบบสอบถาม *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="รับราชการ/พนักงานของรัฐ" required="required"> รับราชการ/พนักงานของรัฐ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="รัฐวิสาหกิจ"> รัฐวิสาหกิจ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="ธุรกิจส่วนตัว"> ธุรกิจส่วนตัว
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="พนักงานบริษัท"> พนักงานบริษัท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name=occupation value="นักเรียน/นักศึกษา"> นักเรียน/นักศึกษา
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="รับจ้างทั่วไป"> รับจ้างทั่วไป
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="เกษตรกร"> เกษตรกร
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="แม่บ้าน/พ่อบ้าน/เกษียณ"> แม่บ้าน/พ่อบ้าน/เกษียณ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value="่างงาน/ไม่ประกอบอาชีพ"> ว่างงาน/ไม่ประกอบอาชีพ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="radio-inline">
                                <input type="radio" name="occupation" value=""> อื่นๆ<input type="text" name="occupationtxt"/>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="parttimetxt"><b>1.10 อาชีพเสริม</b></label>
                    <input type="text" name="parttimetxt" class="form-control" placeholder="Enter your parttime" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="salarytxt"><b>1.11 รายได้(อาชีพเสริม)</b></label>
                    <input type="text" name="salaryparttimetxt" class="form-control" placeholder="Enter your salary">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label><b>1.12 ภูมิลำเนาเดิมของท่าน *</b></label>
                    <div class="row">

                        <div class="col-md-12">
                            <label for="hometown" class="radio-inline">
                                <input type="radio" name="hometown" value="ในพื้นที่(เกิดและเติบโตในพื้นที่)" required="required"> ในพื้นที่(เกิดและเติบโตในพื้นที่)
                            </label>
                        </div>

                        <div class="col-md-12">
                            <label for="hometown" class="radio-inline">
                                <input type="radio" name="hometown" value=""> ย้ายมาจากพื้นที่อื่น  คือพื้นที่ <input type="text" name="hometowntxt"/>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <label for="numberOfLivetxt"><b>1.13 ระยะเวลาที่อยู่ในพื้นที่(ปี) *</b></label>
                    <input type="number" name="numberOfLivetxt" class="form-control" required="required" data-error="Enter a time to live">
                    <div class="help-block with-errors"></div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="messagetxt"><b>1.14 Message *</b></label>
                    <textarea name="messagetxt" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <hr><label><u><b>ส่วนที่ 2 ข้อมูลด้านเศรษฐกิจ</b></u></label><br><br>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>2.1 รายได้ต่อเดือน *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="saralytxt" class="radio-inline">
                                <input type="radio" name="saralytxt" value="ไม่มีรายได้" required="required"> 1) ไม่มีรายได้
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="น้อยกว่า 2,000 บาท">  2) น้อยกว่า 2,000 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="2,000 - 4,999 บาท"> 3) 2,000 - 4,999 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="5,000 - 9,999 บาท"> 4) 5,000 - 9,999 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name=saralytxt value="10,000 - 14,999 บาท"> 5) 10,000 - 14,999 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="15,000 - 19,999 บาท"> 6) 15,000 - 19,999 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="20,000 - 29,999 บาท"> 7) 20,000 - 29,999 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="saraly" class="radio-inline">
                                <input type="radio" name="saralytxt" value="มากกว่า 30,000 บาท"> 8) มากกว่า 30,000 บาท
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>2.2 ค่าใช้จ่ายเกี่ยวกับการเดินทาง</b></label>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="carlonetxt" class="radio-inline">
                                1)	ค่าผ่อนรถ  <input type="text" name="carlonetxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="gasolinetxt" class="radio-inline">
                                2)	ค่าน้ำมันรถ  <input type="text" name="gasolinetxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="bustxt" class="radio-inline">
                                3)	ค่ารถเดือน/รถประจำ  <input type="text" name="bustxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="fixcartxt" class="radio-inline">
                                4)	ค่าซ่อมรถ/รถบำรุงรักษารถ  <input type="text" name="fixcartxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="carparkingtxt" class="radio-inline">
                                5)	ค่าที่จอดรถ  <input type="text" name="carparkingtxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="taxtxt" class="radio-inline">
                                6)	ค่าภาษี/ค่าทะเบียน  <input type="text" name="taxtxt"/> บาทต่อเดือน
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label for="carinsurancetxt" class="radio-inline">
                                7)	ค่าประกันภัยรถยนต์  <input type="text" name="carinsurancetxt"/> บาทต่อเดือน
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>2.3 ค่าใช้จ่ายที่ใช้เกี่ยวกับการเดินทางต่อวันโดยเฉลี่ย (รวมค่าน้ำมัน ค่าโดยสาร ค่าที่จอดรถ) *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="expensesoftravelperdaytxt" class="radio-inline">
                                <input type="radio" name="expensesoftravelperdaytxt" value="0 - 25 บาท" required="required"> 1) 0 - 25 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftravelperdaytxt" class="radio-inline">
                                <input type="radio" name="expensesoftravelperdaytxt" value="25 - 49 บาท"> 2) 25 - 49 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftravelperdaytxt" class="radio-inline">
                                <input type="radio" name="expensesoftravelperdaytxt" value="50 - 74 บาท"> 3) 50 - 74 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftravelperdaytxt" class="radio-inline">
                                <input type="radio" name="expensesoftravelperdaytxt" value="75 - 100 บาท"> 4) 75 - 100 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftravelperdaytxt" class="radio-inline">
                                <input type="radio" name="expensesoftravelperdaytxt" value="เกิน 100 บาท"> 5) เกิน 100 บาท
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <hr><label><u><b>ส่วน 3 ข้อมูลด้านระบบขนส่งและการเดินทาง</b></u></label><br><br>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.1	ในครัวเรือนมีรถทั้งหมด <input type="text" name="amountofcarperfamily" required="required"> คัน *</b></label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="amountofcar" class="radio-inline">
                                1) รถเก๋ง จำนวน
                                <input type="text" name="amountofcartxt"> คัน
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="amountofmotorcycletxt" class="radio-inline">
                                2) รถจักรยานยนต์ จำนวน
                                <input type="text" name="amountofmotorcycletxt"> คัน
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="amountofbicycle" class="radio-inline">
                                3) รถจักรยาน จำนวน
                                <input type="text" name="amountofbicycletxt"> คัน
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="amountofpickup" class="radio-inline">
                                4) รถยนต์ปิ๊กอัพ จำนวน
                                <input type="text" name="amountofpickuptxt"> คัน
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="amountofothervehicles" class="radio-inline">
                                5) อื่นๆ จำนวน
                                <input type="text" name="amountofothervehiclestxt"> คัน
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.2	ยานพาหนะที่เลือกใช้ในการเดินทางเป็นประจำ *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value="รถเก๋ง" required="required"> รถเก๋ง
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value="รถปิคอัพ"> รถปิคอัพ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value="รถตู้"> รถตู้
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value="รถจักรยานยนต์"> รถจักรยานยนต์
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value="รถสาธารณะ"> รถสาธารณะ
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="travelvehicle" class="radio-inline">
                                <input type="radio" name="travelvehicle" value=""> อื่นๆ ระบุ
                                <input type="text" name="travelvehicletxt">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="estimatetimetotravel" class="radio-inline">
                        <b>3.3	ท่านใช้เวลาในการเดินทางโดยรวมเฉลี่ยวันละกี่นาที *</b>
                        <input type="text" name="estimatetimetotravel" required="required"> <b>นาที</b>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.4	ท่านพึงพอใจกับคุณภาพในรูปแบบการเดินทางของท่านในปัจจุบันหรือไม่ *</b></label>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="hometown" class="radio-inline">
                                <input type="radio" name="satisfiedofyourtravel" value="พึงพอใจ" required="required"> 1) พึงพอใจ
                            </label>
                        </div>

                        <div class="col-md-12">
                            <label for="hometown" class="radio-inline">
                                <input type="radio" name="satisfiedofyourtravel" value=""> 2) ไม่พึงพอใจ เพราะ
                                <input type="text" name="satisfiedofyourtraveltxt"/>
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.5	ค่าใช้จ่ายในการเดินทางต่อวันที่ท่านยอมรับได้ (รวมค่าน้ำมัน ค่าโดยสาร ค่าที่จอดรถ) *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="expensesoftraveltxt" class="radio-inline">
                                <input type="radio" name="expensesoftraveltxt" value="0 - 24 บาท" required="required"> 1) 0 - 24 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftraveltxt" class="radio-inline">
                                <input type="radio" name="expensesoftraveltxt" value="25 - 49 บาท"> 2) 25 - 49 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftraveltxt" class="radio-inline">
                                <input type="radio" name="expensesoftraveltxt" value="50 - 74 บาท"> 3) 50 - 74 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftraveltxt" class="radio-inline">
                                <input type="radio" name="expensesoftraveltxt" value="75 - 100 บาท"> 4) 75 - 100 บาท
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="expensesoftraveltxt" class="radio-inline">
                                <input type="radio" name="expensesoftraveltxt" value="เกิน 100 บาท"> 5) เกิน 100 บาท
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="from-group row">
                <div class="col-md-12">

                </div>
            </div>

            <div class="from-group row">
                <div class="col-md-12">
                    <label for="form_areacode"><b>3.6 ลักษณะการเดินทาง 3 อันดับแรก  (เรียงจาก 1 ถึง 3 โดย 1=ไปบ่อยที่สุด , 3= ไปน้อยที่สุด) *</b></label>
                    <div class="row col-md-12">
                        1)
                        <div class="col-md-6">
                            <input class="form-control" list="typeoftravel" name="typeoftravelone" required="required" placeholder="การเดินทางระหว่างบ้านไปยังสถานที่อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        2)
                        <div class="col-md-6">
                            <input class="form-control" list="typeoftravel" name="typeoftraveltwo" required="required" placeholder="การเดินทางระหว่างบ้านไปยังสถานที่อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        3)
                        <div class="col-md-6">
                            <input class="form-control" list="typeoftravel" name="typeoftravelthree" required="required" placeholder="การเดินทางระหว่างบ้านไปยังสถานที่อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <datalist id="typeoftravel">
                        <option value="การเดินทางระหว่างบ้านกับที่ทำงาน"> การเดินทางระหว่างบ้านกับที่ทำงาน
                        <option value="การเดินทางระหว่างบ้านกับสถานศึกษา"> การเดินทางระหว่างบ้านกับสถานศึกษา
                        <option value="การเดินทางระหว่างบ้านกับรับ-ส่งบุตรหลานสถานศึกษา"> การเดินทางระหว่างบ้านกับรับ-ส่งบุตรหลานสถานศึกษา
                        <option value="การเดินทางระหว่างบ้านกับห้างสรรพสินค้า"> การเดินทางระหว่างบ้านกับห้างสรรพสินค้า
                        <option value="การเดินทางระหว่างบ้านกับตลาด"> การเดินทางระหว่างบ้านกับตลาด
                    </datalist>

                </div>
            </div>
            <br>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.7	ลักษณะการใช้ยานพาหนะ</b></label>
                    <div class="row">

                        <div class="col-md-12">
                            <label for="timetotravelofdayperkilo" class="radio-inline">
                                1) ระยะทางเดินทางต่อวัน ประมาณ
                                <input type="text" name="timetotravelofdayperkilo"/> กิโลเมตร
                            </label>
                        </div>

                        <div class="col-md-12">
                            <label for="usedvihicleadayperweek" class="radio-inline">
                                2) ความถี่ในการใช้งานประมาณ
                                <input type="text" name="usedvihicleadayperweek"/> วัน/สัปดาห์
                            </label>
                        </div>

                        <div class="col-md-12">
                            <label for="addgasolinebathpertime" class="radio-inline">
                                3) เติมน้ำมันครั้งละประมาณ
                                <input type="text" name="addgasolinebathpertime"/> บาท ทุกระยะเวลา
                            </label>
                        </div>

                        <div class="col-md-12">
                            <label for="amountofpassengerpercar" class="radio-inline">
                                4) จำนวนผู้โดยสารโดยเฉลี่ยรวมคนขับ
                                <input type="text" name="amountofpassengerpercar"/> คน
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.8	ระบบขนส่งสาธารณะที่ใช้บริการบ่อยที่สุด *</b></label>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="รถโดยสารประจำทาง" required="required"> 1) รถโดยสารประจำทาง
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="ตุ๊กตุ๊ก"> 2) ตุ๊กตุ๊ก
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="แท๊กซี่"> 3) แท๊กซี่
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="รถสองแถว"> 4) รถสองแถว
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="เครื่องบิน"> 5) เครื่องบิน
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="typeoftransportation" class="radio-inline">
                                <input type="radio" name="typeoftransportation" value="รถไฟ"> 6) รถไฟ
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label><b>3.9	ความถี่การใช้บริการระบบขนส่งสาธารณะต่อเดือน *</b></label>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="freusedservice" class="radio-inline">
                                <input type="radio" name="freusedservice" value="น้อยกว่า 5 ครั้ง" required="required"> 1) น้อยกว่า 5 ครั้ง
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label for="freusedservice" class="radio-inline">
                                <input type="radio" name="freusedservice" value="5 - 10 ครั้ง"> 2) 5 - 10 ครั้ง
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label for="freusedservice" class="radio-inline">
                                <input type="radio" name="freusedservice" value="11 - 20 ครั้ง"> 3) 11 - 20 ครั้ง
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label for="freusedservice" class="radio-inline">
                                <input type="radio" name="freusedservice" value="มากกว่า 20 ครั้ง"> 4) มากกว่า 20 ครั้ง
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="from-group row">
                <div class="col-md-12">
                    <label><b>3.10 ปัจจัยที่ทำให้ท่านเลือกใช้ระบบขนส่งสาธารณะ 5 อันดับแรก  (เรียงจาก 1 ถึง 5 โดย 1=สำคัญมากที่สุด, 5= สำคัญน้อยที่สุด) *</b></label>
                    <div class="row col-md-12">
                        1)
                        <div class="col-md-6">
                            <input class="form-control" list="factortousetrasportation" name="factortoftranone" required="required" placeholder="อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        2)
                        <div class="col-md-6">
                            <input class="form-control" list="factortousetrasportation" name="factortoftrantwo" required="required" placeholder="อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        3)
                        <div class="col-md-6">
                            <input class="form-control" list="factortousetrasportation" name="factortoftranthree" required="required" placeholder="อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        4)
                        <div class="col-md-6">
                            <input class="form-control" list="factortousetrasportation" name="factortoftranfour" required="required" placeholder="อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        5)
                        <div class="col-md-6">
                            <input class="form-control" list="factortousetrasportation" name="factortoftranfive" required="required" placeholder="อื่นๆ ระบุ"/></p>
                        </div>
                    </div>
                    <datalist id="factortousetrasportation">
                        <option value="ระบบมีความน่าเชื่อถือ ตรงเวลา">
                        <option value="ระบบมีความปลอดภัย">
                        <option value="ประหยัดค่าใช้จ่าย">
                        <option value="มีตารางเวลาแจ้งชัดเจน">
                        <option value="ระยะเวลารอรถสั้น">
                        <option value="ใช้เวลาในการเดินทางรวดเร็ว">
                        <option value="มีบริการในช่วงเวลาที่เหมาะสม">
                        <option value="จุดรับบริการอยู่ใกล้บ้าน/ที่ทำงาน/ห้างสรรพสินค้า">
                    </datalist>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-send" value="Send Survay">
                </div>

                <div class="col-md-12">
                    <p class="text-muted">
                        <strong>*</strong> These fields are required.</p>
                </div>

        </form>
    </main>

    <br>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">
                Copyright (c) 2017, Urban Questionare
            </span>
        </div>
    </footer>


                <!-- Bootstrap core JavaScript
                ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/questionare/js/vendor/popper.min.js"></script>
    <script src="/questionare/js/bootstrap.min.js"></script>
    </body>
    </html>

<?php
mysqli_close($objCon);
?>