

<?php 
include 'conn.php';
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
                      <input id="frist_name" type="text" class="form-control" name="exmne_fullname" autofocus required>
                    </div>
                  </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="middle_name">Birth Date</label>
                    <input id="bdate" type="date" class="form-control" name="exmne_birthdate" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group col-6">
                      <label>Gender</label>
                      <select class="form-control" name="exmne_gender" id="exmne_gender">
              <option value="0">Select gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
                </div>
            </div>
                <div class="row">
                  <div class="form-group col-6">
                   <label>Preferred Track</label>
            <select class="form-control" name="exmne_course" id="exmne_course">
              <option value="0">Select Preferred Track</option>
              <?php 
                $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                <?php }
               ?>
            </select>
           </div>
                  <div class="form-group col-6">
                     <label>Year Level</label>
            <select class="form-control" name="exmne_year_level" id="exmne_year_level">
              <option value="0">Select year level</option>
              <option value="first year">First Year</option>
              <option value="second year">Second Year</option>
              <option value="third year">Third Year</option>
              <option value="fourth year">Fourth Year</option>
            </select>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="exmne_email" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="password">Password</label>
                      <input id="password" type="password" class="form-control" name="exmne_password" autofocus required>
                    </div>
                </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
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