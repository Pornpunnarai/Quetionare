<?php session_start();
include 'connect-mysql.php';

mysqli_set_charset($objCon,"utf8");
$strSQL = "SELECT * FROM manager WHERE 
              memail = '".$_SESSION['memail']."'";
$strSQL2 = "SELECT tname FROM team WHERE tid = '".$_SESSION['tid']."'";

$strSQLSurvay = "SELECT * FROM survay WHERE mid in (SELECT mid FROM manager WHERE 
              memail = '".$_SESSION['memail']."')";

$objQuery = mysqli_query($objCon, $strSQL);
$objQuery2 = mysqli_query($objCon, $strSQL2);
$objQuerySurvay  = mysqli_query($objCon, $strSQLSurvay);

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
                    <a class="btn btn-outline-success my-2 my-sm-0" href="user_index.php">HOME</a>
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
            <h3 style="text-align: center">สรุปแบบสอบถาม</h3>
            <h4 style="text-align: center">โครงการสำรวจพฤติกรรมการเดินทางของประชาชนในกลุ่มภาคเหนือตอนบน 4 จังหวัด</h4>
        </div>
        <hr>

        <br>
        <form action="homepage.php" method="post">
            <div class="row">


            <div class="col-md-2" style="text-align: right">เลือกพื้นที่</div>
            <div class="col-md-8">
            <select class="form-control" name="areaid">
                <option value="0"><---เลือกทุกพื้นที่---></option>
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
            <div class="col-md-1">
                <input name="btnSubmit" class="btn btn-success btn-send" type="submit" value="Submit">
            </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>SurvayId</th>
                <th>AreaId</th>
                <th>First Name</th>
                <th>LastName</th>
                <th>Createdate</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $areaname = $_POST["areaid"];
            $strSQLSurvayByArea = "SELECT * FROM survay WHERE mid in (SELECT mid FROM manager WHERE 
              memail = '".$_SESSION['memail']."' and (areaId = '".$_POST["areaid"]."' or '$areaname' = 0))";
            $objQuerySurvayArea  = mysqli_query($objCon, $strSQLSurvayByArea);
            while ($objResultSurvayArea = mysqli_fetch_array($objQuerySurvayArea, MYSQLI_ASSOC))
            { ?>
                <tr>
                    <td ><?php echo $objResultSurvayArea["survay_id"];?></td>
                    <td><?php echo $objResultSurvayArea["areaid"];?></td>
                    <td><?php echo $objResultSurvayArea["firstname"];?></td>
                    <td><?php echo $objResultSurvayArea["lastname"];?></td>
                    <td><?php echo $objResultSurvayArea["createdate"];?></td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>

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