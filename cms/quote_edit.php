<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/3/16
     * Time: 4:58 PM
     */
    include "vendor/autoload.php";
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../index.php");
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="images/favicon_1.ico">

    <title>My Love</title>

    

    


    <!-- Base Css Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Font Icons -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet"/>
    <link href="css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="css/animate.css" rel="stylesheet"/>

    <!-- Waves-effect -->
    <link href="css/waves-effect.css" rel="stylesheet">

    <!-- For notification -->
    <link href="assets/notifications/notification.css" rel="stylesheet"/>

    <!-- Custom Files -->
    <link href="css/helper.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="js/vendor/modernizr.min.js"></script>

    <!-- Daniel's CSS -->
    

    

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="index.php" class="logo"><i class="md md-terrain"></i> <span>My Love </span></a>
            </div>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Daniel Prince<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="md md-settings-power"></i> Logout</a></li>
                    </ul>
                </div>
                <p class="text-muted m-0">Creator</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php" class="waves-effect"><i class="md md-home"></i><span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-heart"></i><span> Poems </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="poem_create.php">Create</a></li>
                        <li><a href="poem_edit.php">Edit</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-heartbeat"></i><span> ILove </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="ilove_create.php">Create</a></li>
                        <li><a href="ilove_edit.php">Edit</a></li>
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-smile-o"></i><span> Reassurance </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="assure_create.php">Create</a></li>
                        <li><a href="assure_edit.php">Edit</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-venus-mars"></i><span> Promise </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="promise_create.php">Create</a></li>
                        <li><a href="promise_edit.php">Edit</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-clock-o"></i><span> Memory </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="memory_create.php">Create</a></li>
                        <li><a href="memory_edit.php">Edit</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-quote-right"></i><span> Quote </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="quote_create.php">Create</a></li>
                        <li><a href="quote_edit.php">Edit</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="fa fa-calendar"></i><span> Special Days </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="specialday_create.php">Create</a></li>
                        <li><a href="specialday_edit.php">Edit</a></li>
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">
                            
    Edit a Quote

                        </h4>
                    </div>
                </div>

                
    
<div class="row form">
    <div id="errorBlk" class="text-danger">

    </div>
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Update
                    
                        <a class="pull-right" id="close" href="#"><i class="ion-close-round"></i></a>
                    
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Quote</label>
                        <div class="col-md-10">
                            <input type="text" id="quote" class="form-control" placeholder="Enter Quote">
                        </div>
                    </div>
                    <input type="submit" id="update" class="btn btn-primary btn-rounded waves-effect waves-light m-b-5 pull-right" value="Update"/>
                </form>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>

    
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <h3>Quote</h3>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="datatable-editable">
                <thead>
                    <tr>
                        <th>Quote</th>
                        <th>Synced</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 1:55 PM
     */

    use Backend\Database\Tables\Quotes;
    use Backend\Helpers\TableBuilder;

    $table   = new Quotes();
    $data    = $table->readAll();
    $builder = new TableBuilder();
    if ($data !== false) {
        for ($i = 0; $i < count($data); $i++) {
            $decoded = clone $data[$i];
            $table->stripAndDecode($decoded);
            $table->strip($data[$i]);

            $current = $data[$i];
            $builder->buildCell($decoded->getQuote())->buildCell($decoded->getSynced());
            $builder->addActionAttrs("quote", $current->getQuote())->addActionAttrs("id", $current->getId());
            $builder->addRowAttr("id", $current->getId());
            echo $builder->buildRow();
        }
    }

?>
                </tbody>
            </table>
        </div>
        <!-- end: page -->
    </div>



            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2015 © My Love.
        </footer>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->



</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/waves.js"></script>
<script src="js/vendor/wow.min.js"></script>
<script src="js/vendor/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/vendor/jquery.scrollTo.min.js"></script>
<script src="assets/jquery-detectmobile/detect.js"></script>
<script src="assets/fastclick/fastclick.js"></script>
<script src="assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/jquery-blockui/jquery.blockUI.js"></script>

<!-- Notifications -->
<script src="assets/notifications/notify.min.js"></script>
<script src="assets/notifications/notify-metro.js"></script>
<script src="assets/notifications/notifications.js"></script>

<!-- CUSTOM JS -->
<script src="js/vendor/jquery.app.js"></script>

<!-- Daniel's Scripts -->
<script src="js/scripts/Notification.js"></script>
<script src="js/scripts/classes/Manager.js"></script>
<script src="js/scripts/classes/Structure.js"></script>
<script src="js/scripts/Ajaxify.js"></script>
<script src="js/scripts/Validate.js"></script>
<script src="js/scripts/Table.js"></script>

    <script src="js/scripts/classes/models/Quote.js"></script>
    <script src="js/scripts/quote/manage.js"></script>
    <script src="js/scripts/general.js"></script>



</body>
</html>