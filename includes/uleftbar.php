<div class="left-sidebar bg-black-300 box-shadow ">
    			    <div class="sidebar-content">
                            <div class="user-info closed">
                                <img src="http://placehold.it/90/c2c2c2?text=User" alt="User" class="img-circle profile-img">
                                <h6 class="title">User</h6>
                                <small class="info"></small>
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Главна категория</span>
                                    </li>
                                    <li>
                                        <a href="udashboard.php"><i class="fa fa-dashboard"></i> <span>Основен панел</span> </a>
                                     
                                    </li>

                                    <li class="nav-header">
                                        <span class="">Изглед</span>
                                    </li>



                                    
  <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Виж активни предмети</span> <i class="fa fa-angle-right arrow"></i></a>
					<ul class="child-nav">




<?php $sql = "SELECT tblclasses.ClassName,tblclasses.Section,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status 
from tblsubjectcombination join tblclasses on tblclasses.id=tblsubjectcombination.ClassId
join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId where tblsubjectcombination.status=1";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
		
			<li> <a href="#"><i class="fa fa-file-text"></i><?php echo htmlentities($result->SubjectName) ?></span></a></li>

<?php }} ?>

                                        
                                        </ul>
                                    </li>

   <li class="has-children">
                                        <a href="#"><i class="fa fa-users"></i> <span>Тестове</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                        <li><a href="subjectlist.php"><i class="fa fa-bars"></i> <span>Предмети</span></a></li>
                                        
                                        </ul>
                                    </li>


<li class="has-children">
                                    <a href="#"><i class="fa fa-file-text"></i> <span>Качени файлове</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                        <li><a href="uread-files.php"><i class="fa fa-bars"></i> <span>Файлове</span></a></li>
                                        </ul>
                                    



<li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Резултати</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            <li><a href="find-result.php"><i class="fa fa-bars"></i> <span>Проверка на резултати</span></a></li>
                                        </ul>
                                    </li>


                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>