<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['Update']))
{
$qid=intval($_GET['qid']);
$question=$_POST['question'];
$ans1=$_POST['ans1']; 
$ans2=$_POST['ans2']; 
$ans3=$_POST['ans3']; 
$ans4=$_POST['ans4']; 
$true_ans=$_POST['true_ans']; 
$sql="update  tblquestions set question=:question,ans1=:ans1, ans2=:ans2,ans3=:ans3,ans4=:ans4,true_ans=:true_ans  where qid=:qid";
$query = $dbh->prepare($sql);
$query->bindParam(':question',$question,PDO::PARAM_STR);
$query->bindParam(':ans1',$ans1,PDO::PARAM_STR);
$query->bindParam(':ans2',$ans2,PDO::PARAM_STR);
$query->bindParam(':ans3',$ans3,PDO::PARAM_STR);
$query->bindParam(':ans4',$ans4,PDO::PARAM_STR);
$query->bindParam(':true_ans',$true_ans,PDO::PARAM_STR);
$query->bindParam(':qid',$qid,PDO::PARAM_STR);
$query->execute();
$msg="Въпоросът беше редактиран успешно.";
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin Update Subject </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Редактиране на въпрос</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Въпроси</li>
                                        <li class="active">Редактиране на въпрос</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Редактиране на въпрос</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Браво!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Грешка!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

 <?php
$qid=intval($_GET['qid']);
$sql = "SELECT * from tblquestions where qid=:qid";
$query = $dbh->prepare($sql);
$query->bindParam(':qid',$qid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                               
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Въпрос</label>
                                                        <div class="col-sm-10">
 <input type="text" name="question" value="<?php echo htmlentities($result->question);?>" class="form-control" id="default" placeholder="Въпорос" required="required">
                                                        </div>
                                                    </div>

 
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Отговор 1</label>
                                                        <div class="col-sm-10">
 <input type="text" name="ans1" value="<?php echo htmlentities($result->ans1);?>" class="form-control" id="default" placeholder="Отговор 1" required="required">
                                                        </div>
                                                    </div>

						    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Отговор 2</label>
                                                        <div class="col-sm-10">
 <input type="text" name="ans2" value="<?php echo htmlentities($result->ans2);?>" class="form-control" id="default" placeholder="Отовор 2" required="required">
                                                        </div>
                                                    </div>

 
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Отговор 3</label>
                                                        <div class="col-sm-10">
 <input type="text" name="ans3" value="<?php echo htmlentities($result->ans3);?>" class="form-control" id="default" placeholder="Отговор 3" required="required">
                                                        </div>
                                                    </div>



						    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Отговор 4</label>
                                                        <div class="col-sm-10">
 <input type="text" name="ans4" class="form-control" value="<?php echo htmlentities($result->ans4);?>"  id="default" placeholder="Отговор 4" required="required">
                                                        </div>
                                                    </div>

						    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Верен отговор</label>
                                                        <div class="col-sm-10">
 <input type="text" name="true_ans" class="form-control" value="<?php echo htmlentities($result->true_ans);?>"  id="default" placeholder="Верен отговор" required="required">
                                                        </div>
                                                    </div>
                                                    <?php }} ?>

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="Update" class="btn btn-primary">Редактиране</button>
                                                        </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
