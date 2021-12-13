

<?php 
include 'conn.php';
session_start();
date_default_timezone_set('Asia/Manila');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>&rsaquo; Register &mdash;</title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="dist/css/demo.css">
  <link rel="stylesheet" href="dist/css/style.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
             SIGN UP
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Examinee Registration</h4></div>

              <div class="card-body"> 
                <form action="addExamineeExe.php" method="POST" id="">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="frist_name">Full Name</label>
                      <input 
                          id="frist_name" 
                          type="text" 
                          class="form-control" name="exmne_fullname" autofocus required
                          value="<?= isset($_SESSION['exmne_fullname']) ? $_SESSION['exmne_fullname'] : '' ?>"
                        >
                        </div>
                  </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="middle_name">Birth Date</label>
                      <input id="bdate" type="date" class="form-control <?= isset($_SESSION['exmne_birthdate_error']) ? 'is-invalid' : '' ?>" name="exmne_birthdate"  class="date-input">
                      <div class="invalid-feedback">
                          <?php echo isset($_SESSION['exmne_birthdate_error']) ? $_SESSION['exmne_birthdate_error'] : '' ?>
                        </div>
                  </div>
                  <div class="form-group col-6">
                      <label>Gender</label>
                      <select class="form-control" name="exmne_gender" id="exmne_gender" required>
              <option value="0">Select gender</option>
              <option value="male" <?= isset($_SESSION['exmne_gender']) && $_SESSION['exmne_gender'] === 'male' ? 'selected' : '' ?>>Male</option>
              <option value="female" <?= isset($_SESSION['exmne_gender']) && $_SESSION['exmne_gender'] === 'female' ? 'selected' : '' ?>>Female</option>
            </select>
                </div>
            </div>
                <div class="row">
                  <div class="form-group col-6">
                   <label>Preferred Track</label>
            <select class="form-control" name="exmne_course" id="exmne_course" required>
              <option value="0">Select Preferred Track</option>
              <?php 
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option 
                    value="<?= $selCourseRow['cou_id']; ?>"
                    <?= isset($_SESSION['exmne_course']) && $_SESSION['exmne_course'] === $selCourseRow['cou_name'] ? 'selected' : '' ?>
                  ><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
               ?>
            </select>
           </div>

           <?php $years = ['first year', 'second year', 'third year', 'fourth year'];
           ?>
                  <div class="form-group col-6">
                     <label>Year Level</label>
            <select class="form-control" name="exmne_year_level" id="exmne_year_level" required>
              <option value="0">Select year level</option>
                <?php 

                    foreach ($years as $year) {
                      ?>
                        <option value="<?= $year ?>" 
                        <?= isset($_SESSION['exmne_year_level']) && $_SESSION['exmne_year_level'] === $year ? 'selected' : '' ?>
                        ><?= $year ?></option>
                      <?php 
                    }
              ?>
            </select>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="exmne_email" autofocus  required
                      value="<?= isset($_SESSION['exmne_email']) ? $_SESSION['exmne_email'] : '' ?>"
                      >
                    </div>
                    <div class="form-group col-6">
                      <label for="password">Password</label>
                      <input id="password" type="password" class="form-control" name="exmne_password" autofocus  required
                      value="<?= isset($_SESSION['exmne_password']) ? $_SESSION['exmne_password'] : '' ?>"
                      >
                    </div>
                </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree"  required
                      >
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                      <a href="index.php" style="float: right">LOGIN</a>
                    </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" name="btn_examinee" class="btn btn-primary btn-block">
                      Sign up
                    </button>
                  </div>
                </form>
              </div>  
            </div>
            <div class="simple-footer">
           
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  
  <script src="dist/modules/jquery.min.js"></script>
  <script src="dist/modules/popper.js"></script>
  <script src="dist/modules/tooltip.js"></script>
  <script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="dist/modules/moment.min.js"></script>
  <script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="dist/js/sa-functions.js"></script>
  
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
  <script src="dist/js/demo.js"></script>
</body>
</html>