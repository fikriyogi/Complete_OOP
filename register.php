<?php 
    error_reporting(0);
	include('class/db.class.php');
	$database = new database();

    if(isset($_SESSION['is_login']))
    {
        header('location:home.php');
    }

	if(isset($_POST['register']))
	{
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
        $gender = $_POST['gender'];

		$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $m = $_POST['month'];
        $d = $_POST['day'];
        $y = $_POST['year'];
        $dob = $y.'-'.$m.'-'.$d;

        $lolos = date('Y') - $y;

		$token      	= md5(unixtojd(rand()));
		// $hashing      	= md5( rand(0,1000) );
		$hashing		= gen_uuid(); 
		if (empty($email) || empty($username) || empty($f_name)) {
			$_SESSION['message'] = 'Formulir harus diisi lengkap';
		}
		elseif ($_POST['day']==0 or $_POST['month']==0 or $_POST['year']==0){
            $_SESSION['message'] = "Please Complete the Birthday Selection";
        }
		elseif ($lolos < 18)
        {
            echo 'Must 18 Years old';
        }
		else {
			$database->register($f_name,$l_name,$email,$username,$gender,$password,$dob,$token,$hashing);
		}
	}

?>
<!doctype html>
<html lang="en" class="h-100">
	<head>
        <title>Register Form</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo CSS ?>style.css" />
        <link rel="stylesheet" href="<?php echo CSS ?>bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo CSS ?>select2.min.css"  />
        <script src="<?php echo JS ?>jquery.min.js"></script>
        <script src="<?php echo JS ?>popper.min.js"></script>
        <script src="<?php echo JS ?>bootstrap.min.js"></script>
        <script src="<?php echo JS ?>select2.min.js"></script>
<!--        <link href="https://www.wrappixel.com/demos/admin-templates/elegant-admin/assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />-->


    </head>
<body class="d-flex flex-column h-100">

<?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
	<div class="success-message" id="box-pesan"><?php echo $_SESSION['message']; ?></div>
	<?php
	unset($_SESSION['message']);
	}
?> 


    

		<!-- Begin page content -->
<main role="main" class="flex-shrink-0 mb-2" >

	<?php 
    $c = substr(number_format(time() * rand(),0,'',''),0,10);
	echo $c ?>
	<div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <img src="assets/img/login.jpg">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-5 visible-md visible-lg">
                <div class="row sidebar">
                    <div class="col-md-12 sidebar-border">
                        <div class="row">

                            
                            <form method="post" action=""  class="needs-validation" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                                        <p  class="pl-2">It's quick and easy.</p>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" onBlur="checkemailAvailability()" required>
                                                    <span id="email-availability"></span>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">You'll use this when you log in and if you ever need to reset your password.</div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Enter a combination of at least six numbers, letters and punctuation marks (such as ! and &).</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltip01">First name</label>
                                                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First name" required>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">What's your name?</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltip02">Last name</label>
                                                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last name" required>
                                                    <div class="valid-tooltip">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltipUsername">Username</label>
                                                    <div class="input-group">
                <!--                                        <div class="input-group-prepend">-->
                <!--                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>-->
                <!--                                        </div>-->
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" onBlur="checkusernameAvailability()" required>
                                                        <span id="username-availability"></span>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Please choose a unique and valid username.</div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="radiobtn">
                                                        <input type="radio" id="male"
                                                               name="gender" value="Male"  />
                                                        <label for="male">Male</label>
                                                    </div>


                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radiobtn">
                                                        <input type="radio" id="female"
                                                               name="gender" value="Female" />
                                                        <label for="female">Female</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <!-- <label for="validationTooltip03">Day</label> -->
                                                    <select name="day" id="single" class="form-control " required>
                                                        <option value="0">Select Day</option>
                                                        <?php
                                                        for( $a = 1; $a <= 31; $a++ ) {
                                                            ?>
                                                            <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-tooltip">
                                                        Please provide a valid city.
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <!-- <label for="validationTooltip04">Month</label> -->
                                                    <select name="month" id="single1" class="form-control " required>
                                                        <option value="0">Select Month</option>
                                                        <?php
                                                        for( $m = 1; $m <= 12; $m++ ) {
                                                            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                                                            $month =  date("F", mktime(0, 0, 0, $m, 1));
                                                            ?>
                                                            <option value="<?php echo $num; ?>"><?php echo substr($month, 0,3); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-tooltip">
                                                        Please provide a valid state.
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <!-- <label for="validationTooltip05">Years</label> -->
                                                    <select name="year" id="single2" class="form-control " required>
                                                        <option value="0">Select Year</option>
                                                        <?php
                                                        for( $y = 1905; $y <= date(Y); $y++ ) {
                                                            ?>
                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">It looks like you've entered the wrong info. Please make sure that you use your real date of birth.</div>
                                                </div>
                                            </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <small>By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#exampleModal">
                                            Launch demo modal
                                        </button>
                                        <a href="login.php" class="btn btn-success">Login</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            

        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <form method="post" action=""  class="needs-validation" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                        <p  class="pl-2">It's quick and easy.</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationTooltip01">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" onBlur="checkemailAvailability()" required>
                                    <span id="email-availability"></span>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">You'll use this when you log in and if you ever need to reset your password.</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationTooltip01">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Enter a combination of at least six numbers, letters and punctuation marks (such as ! and &).</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip01">First name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First name" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">What's your name?</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip02">Last name</label>
                                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltipUsername">Username</label>
                                    <div class="input-group">
<!--                                        <div class="input-group-prepend">-->
<!--                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>-->
<!--                                        </div>-->
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" onBlur="checkusernameAvailability()" required>
                                        <span id="username-availability"></span>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please choose a unique and valid username.</div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="radiobtn">
                                        <input type="radio" id="male"
                                               name="gender" value="Male"  />
                                        <label for="male">Male</label>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="radiobtn">
                                        <input type="radio" id="female"
                                               name="gender" value="Female" />
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <!-- <label for="validationTooltip03">Day</label> -->
                                    <select name="day" id="single" class="form-control " required>
                                        <option value="0">Select Day</option>
                                        <?php
                                        for( $a = 1; $a <= 31; $a++ ) {
                                            ?>
                                            <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please provide a valid city.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <!-- <label for="validationTooltip04">Month</label> -->
                                    <select name="month" id="single1" class="form-control " required>
                                        <option value="0">Select Month</option>
                                        <?php
                                        for( $m = 1; $m <= 12; $m++ ) {
                                            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                                            $month =  date("F", mktime(0, 0, 0, $m, 1));
                                            ?>
                                            <option value="<?php echo $num; ?>"><?php echo substr($month, 0,3); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <!-- <label for="validationTooltip05">Years</label> -->
                                    <select name="year" id="single2" class="form-control " required>
                                        <option value="0">Select Year</option>
                                        <?php
                                        for( $y = 1905; $y <= date(Y); $y++ ) {
                                            ?>
                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">It looks like you've entered the wrong info. Please make sure that you use your real date of birth.</div>
                                </div>
                            </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <small>By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time.</small>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
	</div>
</main>

<footer class="footer mt-auto py-3">
	<div class="container">
		<span class="text-muted">Warung Belajar@2019</span>
	</div>
</footer>

<!-- Auto Hide -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('box-pesan').style.display='none';", 3000); 
</script>
<!-- <script>
    $("#single").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
    $("#single1").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
    $("#single2").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
    $("#multiple").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
</script> -->
<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script>
    function checkemailAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "fetch/check-username.php",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data){
            $("#email-availability").html(data);
            $("#loaderIcon").hide();
        },
            error:function (){}
        });
    }
    function checkusernameAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "fetch/check-username.php",
            data:'username='+$("#username").val(),
            type: "POST",
            success:function(data){
                $("#username-availability").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
</script>
</body>
</html>