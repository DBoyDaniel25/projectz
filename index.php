<?php
    session_start();
    if(isset($_POST["pass"])){
        $pass = $_POST["pass"];
        $user = $_POST["user"];
        if($user === "daniel.prince" && $pass === "mylove"){
            $_SESSION["user_id"] = 1;
            header("Location: cms/index.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="cms/images/favicon_1.ico">

    <title>My Love</title>

    <!-- Base Css Files -->
    <link href="cms/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Font Icons -->
    <link href="cms/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="cms/assets/ionicon/css/ionicons.min.css" rel="stylesheet"/>
    <link href="cms/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="cms/css/animate.css" rel="stylesheet"/>

    <!-- Waves-effect -->
    <link href="cms/css/waves-effect.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="cms/css/helper.css" rel="stylesheet" type="text/css"/>
    <link href="cms/css/style.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="js/modernizr.min.js"></script>

</head>
<body>


<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">
        <div class="panel-heading bg-img">
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white"> Sign In to <strong>My Love</strong></h3>
        </div>


        <div class="panel-body">
            <form class="form-horizontal m-t-20" method="post" action="index.php">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="user" class="form-control input-lg " type="text" required=""
                               placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="pass" class="form-control input-lg" type="password" required=""
                               placeholder="Password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button name="submit" class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="recoverpw.php"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="register.php">Create an account</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<script>
    var resizefunc = [];
</script>
<script src="cms/js/jquery.min.js"></script>
<script src="cms/js/bootstrap.min.js"></script>
<script src="cms/js/waves.js"></script>
<script src="cms/js/wow.min.js"></script>
<script src="cms/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="cms/js/jquery.scrollTo.min.js"></script>
<script src="cms/assets/jquery-detectmobile/detect.js"></script>
<script src="cms/assets/fastclick/fastclick.js"></script>
<script src="cms/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="cms/assets/jquery-blockui/jquery.blockUI.js"></script>


<!-- CUSTOM JS -->
<script src="js/jquery.app.js"></script>

</body>
</html>