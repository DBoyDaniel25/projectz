<?php
    include "vendor/autoload.php";
    session_start();
    if (isset($_POST["submit"])) {
        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            if($_POST["username"] === "daniel.prince" && $_POST["password"] === "zipporah.mylove"){
                $_SESSION["user"] = "prince";
                header("Location: cms/poem.php");
            }
        }
    }
?>
    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8"/>
            <title>Dashboard I Admin Panel</title>

            <link rel="stylesheet" href="cms/css/layout.css" type="text/css" media="screen"/>
            <!--[if lt IE 9]>
            <link rel="stylesheet" href="cms/css/ie.css" type="text/css" media="screen"/>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <script src="cms/js/vendors/jquery-1.5.2.min.js" type="text/javascript"></script>
            <script src="cms/js/vendors/hideshow.js" type="text/javascript"></script>
            <style>
                body {
                    background-color : #DEDEE1;
                }

                .login-form {
                    position  : absolute;
                    top       : 30%;
                    left      : 50%;
                    transform : translate(-50%, -50%);
                }

                #main {
                    width            : 100% !important;
                    height           : 100% !important;
                    background-color : #DEDEE1;
                }

                label {
                    width : 100% !important;
                }

                input[type="text"] {
                    width : 230px !important;
                }

                .width_half {
                    float     : none;
                    position  : relative;
                    left      : 50%;
                    transform : translateX(-50%);
                }

                form > fieldset {
                    text-align : center;
                }

                form fieldset label {
                    text-align : left;
                }
            </style>

            <link rel="stylesheet" href="cms/css/general.css">


        </head>


        <body>


            <header id="header" style="text-align: center">
                <hgroup>
                    <h2 style="width: 100%" class="section_title">My Love</h2>

                    <div class="clear"></div>
                </hgroup>
            </header> <!-- end of header bar -->

            <section id="main" class="column">


                <div class="login-form">
                    <article class="module" style="margin: 0">
                        <header><h3>Sign In</h3></header>
                        <div class="module_content">
                            <form action="index.php" method="post">
                                <fieldset class="width_half">
                                    <label>Username</label>
                                    <input type="text" name="username">
                                </fieldset>
                                <fieldset class="width_half">
                                    <label>Password</label>
                                    <input name="password" type="password">
                                </fieldset>
                                <div class="clear"></div>
                                <input value="Sign in" name="submit" class="alt_btn width_half" type="submit">
                            </form>
                        </div>
                    </article>
                    <div class="clear"></div>
                </div>


            </section>

        </body>

    </html>
