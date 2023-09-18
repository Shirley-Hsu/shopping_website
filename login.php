<?php
    session_start();
    include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $sql="SELECT * FROM member where account = '".$_POST['username']."';";
        $i=0;
        //資料庫查詢(送出查詢的SQL指令)
        if ($result = mysqli_query($link, $sql)) {
            while($row = mysqli_fetch_assoc($result))
            {
                $i++;
                if($_POST['password']!=$row['password'])
                    echo '<script language="JavaScript">;alert("密碼錯誤");location.href="login.php";</script>;';
                else 
                {
                    $cart = "SELECT * FROM cart where username = '".$_POST['username']."'";
                    if($result2 = mysqli_query($link, $cart))
                    {
                        $_SESSION['cart'] = Array();
                        while($row1 = mysqli_fetch_assoc($result2))
                        {
                            $_SESSION['cart'][]=$row1['product_no'];//加入陣列
                            $_SESSION['cart'][]=$row1['kind'];//加入陣列
                            $_SESSION['cart'][]=$row1['count'];//加入陣列
                        }
                        mysqli_free_result($result); // 釋放佔用的記憶體
                    }
                    $_SESSION['name']=$_POST['username'];
                    $_SESSION['level']=$row['level'];
                    echo '<script language="JavaScript">;alert("歡迎光臨!!");location.href="index.php";</script>;';
                }
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
        }

        if($i==0)
        {
            echo '<script language="JavaScript">;alert("查無此帳號");location.href="login.php";</script>;';
            
        }
    }

    mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html class="html" lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title>登入 &#8211; 狗物網</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js"></script>
    <script src="//jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!--additional method - for checkbox .. ,require_from_group method ...-->
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <?php include("link.php");?>
    <script>
        $(document).ready(function($) {

            $("#form1").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    username: {
                        required: "請輸入帳號",
                    },
                    password: {
                        required: "請輸入密碼",
                    }
                }
            });
        });
    </script>
    <style type="text/css">
        .error {
            color: #D82424;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }
    </style>
    
</head>

<body class="page-template-default page page-id-360 wp-embed-responsive theme-oceanwp no-isotope no-lightbox no-fitvids no-scroll-top no-sidr no-carousel no-matchheight woocommerce-account woocommerce-page woocommerce-no-js oceanwp-theme dropdown-mobile no-header-border default-breakpoint content-full-width content-max-width page-with-background-title has-breadcrumbs has-blog-grid has-grid-list account-original-style elementor-default elementor-kit-598"
    itemscope="itemscope" itemtype="https://schema.org/WebPage">


    
    <div id="outer-wrap" class="site clr">

        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>


        <div id="wrap" class="clr">



            <?php include("header.php")?>
            <!-- #site-header -->



            <main id="main" class="site-main clr" role="main">



                <header class="page-header background-image-page-header">


                    <div class="container clr page-header-inner">


                        <h1 class="page-header-title clr" itemprop="headline">我的帳號</h1>



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="2" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span
                                        class="breadcrumb-sep">></span>
                                        <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="login.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">我的帳號</span></a>
                                    <meta content="2" itemprop="position" />
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- .page-header-inner -->

                    <span class="background-image-page-header-overlay"></span>

                </header>
                <!-- .page-header -->



                <div id="content-wrap" class="container clr">


                    <div id="primary" class="content-area clr">


                        <div id="content" class="site-content clr">



                            <article class="single-page-article clr">


                                <div class="entry clr" itemprop="text">


                                    <div class="woocommerce">
                                        <div class="woocommerce-notices-wrapper"></div>
                                        <div class="oceanwp-loginform-wrap">
                                            <ul class="owp-account-links registration-disabled">
                                                <li class="login"><span class="owp-account-link current">登入</span></li>
                                            </ul>

                                            <h2>登入</h2>

                                            <form class="woocommerce-form woocommerce-form-login login" name="form1" id="form1" method="POST">


                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="username">帳號&nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="" /> 
                                                    <label for="username" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="password">密碼&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                                                    <label for="password" class="error">
                                                </p>


                                                <p class="form-row">
                                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>記住我</span>
                                                    </label>
                                                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="登入">登入</button>
                                                </p>
                                                <p class="woocommerce-LostPassword lost_password">
                                                    <a href="lost-password.php">忘記您的密碼？</a>
                                                </p>
                                                <p class="woocommerce-LostPassword lost_password">
                                                    <a href="sign_up.php">還不是會員？註冊一個吧~</a>
                                                </p>


                                            </form>


                                        </div>
                                    </div>


                                </div>

                            </article>


                        </div>
                        <!-- #content -->


                    </div>
                    <!-- #primary -->


                </div>
                <!-- #content-wrap -->



            </main>
            <!-- #main -->





            <?php include("footer.php") ?>
            <!-- #footer -->



        </div>
        <!-- #wrap -->


    </div>
    <!-- #outer-wrap -->



    <a id="scroll-top" class="scroll-top-left" href="#"><span class="fa fa-chevron-up" aria-label="Scroll to the top of the page"></span></a>




    <?php include('link2.php'); ?>
</body>

</html>