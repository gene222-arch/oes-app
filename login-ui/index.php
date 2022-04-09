
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>BMMIS &rsaquo; Login &mdash;</title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="dist/css/demo.css">
  <link rel="stylesheet" href="dist/css/style.css">

  <style>
    .box-container {
      background-color: white; 
      font-size: 0.85rem; 
      color: black; 
      padding: 0.25rem 0;
      border-radius: 0.25rem;
      border-bottom: .25rem solid #574B90;
	    margin: 0;
    }
    .login-brand 
    {
      border-top: .25rem solid #574B90;
      background-color: white; 
      font-size: 1.25rem; 
      color: black; 
      padding: 1rem;
      border-radius: 0.25rem;
	  margin: 0;
    }

    .container {
      background: url('./images/kapayapaan.jpg') no-repeat center center;
      width: 100%;
      height: 100%;
      background-size: cover;
    }
  </style>
</head>
<body>
  <div id="app" class="container">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <strong>Login as Examinee</strong>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <?php if (isset($_SESSION['error'])) { ?>
                  <div class="alert alert-warning text-center">
                    <?php echo $_SESSION['error']; ?>
                  </div>
                  <?php }
                  unset($_SESSION['error']);
                  ?>

                <?php if (isset($_SESSION['success'])) { ?>
                  <div class="alert alert-success text-center">
                    <?php echo $_SESSION['success']; ?>
                  </div>
                  <?php }
                  unset($_SESSION['success']);
                  ?> 
                <form method="post" id="examineeLoginFrm" class="login100-form validate-form">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="d-block">Password
                      
                    </label>
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" autofocus required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
            
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                   <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"  tabindex="4">
                      Login
                    </button>
                  </div>
				  <div class="box-container">
              <div class="mt-4 text-muted text-center">
                Don't have an account? <a href="register.php">Create One</a>
              </div>
              <div class="mt-1 text-muted text-center">
                <a href="adminpanel/admin/index.php">Login as admin</a>
              </div>
            </div>
                </form>
              </div>
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