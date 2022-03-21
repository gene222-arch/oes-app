<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>MANAGE EXAMINEE</div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Examinee List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Preferred track</th>
                                <th>Year level</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExmne = $conn->query("SELECT e.*,c.* FROM examinee_tbl as e INNER JOIN course_tbl as c ON e.exmne_course=c.cou_id");
                                if($selExmne->rowCount() > 0)
                               {
                                   
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>

                                        <tr>
                                           <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_gender']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_birthdate']; ?></td>
                                           <td><?php echo $selExmneRow['cou_name']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_year_level']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_status']; ?></td>
                                           <td>
                                               <a rel="facebox" href="facebox_modal/updateExaminee.php?id=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-primary">Update</a>

                                           </td>
                                           <td>
                                                <form action="query/deleteExaminee.php?examineeID=<?= $selExmneRow['exmne_id'] ?>" method="POST">
                                                    <button type="submit" name="deleteExaminee" class="btn btn-danger">Delete</button>
                                                </form>
                                           </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Preferred track Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>
         
