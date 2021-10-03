<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['ulogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Управление на студентите</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/utopbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/uleftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Тестове</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="udashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Преглед</li>
            							<li class="active">Решаване на тест</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Активни тестове</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Браво!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Грешка!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">


<?php

/*
echo '<pre>';
print_r($_REQUEST);
print_r($_SESSION);
echo '</pre>';
*/
$testid = intval($_REQUEST['TestId']);
$ulogin=$_SESSION[('ulogin')];
$qid = intval($_REQUEST['qid']);

$sql="SELECT * from tblquestions WHERE TestId=$testid";
$query = $dbh->prepare($sql);
$query->execute();
$i=0; 

    if (isset ($_REQUEST['answer'])){
    $poznati =0;
    while ($row = $query->fetch()) {
        $qa = $_REQUEST['answer'][$row['qid']];
        // echo "<br>Отговор на въпрос номер ".$row['qid']." е ".$qa;
        if ($row['true_ans']==$qa){

           //echo "<br> Вярно!";
            $total==$poznati++;
        }
    }


    echo "<br>$poznati верни отговора!<br>";
    echo "<br>";
    echo '<a href=subjectlist.php><button>Предмети</button></a>';

$sql="INSERT INTO tbluseranswer (sessid, testid, true_ans) VALUES ('$ulogin', $testid,'$poznati')" or die(mysql_error());
$query = $dbh->prepare($sql);
$query->execute();

}

else{
    echo "<form name=\"myfm\" method=\"post\" action=''>";
    echo "<input type=\"hidden\" name=\"TestId\" value=\"$testid\"></input>";
    while ($row = $query->fetch()) {
        $question = $row["question"];
        $ans1=$row["ans1"];
        $ans2=$row["ans2"];
        $ans3=$row["ans3"];
        $ans4=$row["ans4"];
        echo '<h3>'. $question .'</h3>';
        echo '<ol>';

        echo '<li><input type="radio" name="answer['.$row['qid'].']" value="1" checked="">'.$ans1.'</input></li>';
        echo '<li><input type="radio" name="answer['.$row['qid'].']" value="2" checked="">'.$ans2.'</input></li>';
        echo '<li><input type="radio" name="answer['.$row['qid'].']" value="3" checked="">'.$ans3.'</input></li>';
        echo '<li><input type="radio" name="answer['.$row['qid'].']" value="4" checked="">'.$ans4.'</input></li>';
        echo '</ol>';
    }
        echo '<button type="submit" name="submit" id="submit" class="btn btn-primary">'.Submit.'</button>';
    // еcho "<input type=\"submit\" name=\"submit\" value=\"submit\">";
    echo '</form>';
}




?>

                                                       
                                            
                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>