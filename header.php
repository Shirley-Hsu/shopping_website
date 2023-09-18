
    <header id="site-header" class="minimal-header has-social has-header-media center-logo effect-seven clr fixed-scroll shrink-header has-sticky-mobile" data-height="54" itemscope="itemscope" itemtype="https://schema.org/WPHeader" role="banner">



    <div id="site-header-inner" class="clr container">

        <div class="oceanwp-mobile-menu-icon clr woo-menu-icon mobile-left">
            <a href="<?php if (isset($_SESSION['name'])) {echo 'cart.php';} else {echo 'login.php';}?>" class="wcmenucart">
                <span class="wcmenucart-count"><i class="icon-handbag" aria-hidden="true"></i><span class="wcmenucart-details count"><?php  if (isset($_SESSION['cart'])) $cnt = count($_SESSION['cart'])/3; else $cnt=0; echo $cnt; ?></span></span>
            </a>

        </div>


        <div id="site-logo" class="clr" itemscope itemtype="https://schema.org/Brand">


            <div id="site-logo-inner" class="clr">

                <a href="index.php" rel="home" class="site-title site-logo-text">狗物網</a>

            </div>
            <!-- #site-logo-inner -->



        </div>
        <!-- #site-logo -->





        <div id="site-navigation-wrap" class="clr">



            <nav id="site-navigation" class="navigation main-navigation clr" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" role="navigation">

                <ul id="menu-main-menu" class="main-menu dropdown-menu sf-menu">
                    <li id="menu-item-282" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-6 current_page_item menu-item-282"><a href="index.php" class="menu-link"><span class="text-wrap">首頁</span></a></li>
                    <li id="menu-item-766" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-766"><a href="index.php" class="menu-link"><span class="text-wrap">關於我們</span></a></li>
                    <li id="menu-item-355" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-355"><a href="shop.php" class="menu-link"><span class="text-wrap">全部商品</span></a></li>
                    <li id="menu-item-671" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="buyrule.php" class="menu-link"><span class="text-wrap">購買須知</span></a></li>
                    <li id="menu-item-767" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-767"><a href="index.php" class="menu-link"><span class="text-wrap">聯絡我們</span></a></li>
                    <?php 
                        $who="";
                        $page="";
                        if(isset($_SESSION['level']))
                            if($_SESSION['level']==1)
                            {
                                $who="管理頁面";
                                $page="manager.php";
                            }
                            else if($_SESSION['level']==2)
                            {
                                $who="會員管理";
                                $page="member.php";
                            }
                        if(isset($_SESSION['name'])){echo'<li id="menu-item-671" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="'.$page.'" class="menu-link"><span class="text-wrap">'.$who.'</span></a></li>';}
                    ?>                    
                    <li id="menu-item-672" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-672"><a href="<?php if (isset($_SESSION['name'])) {echo 'logout.php';} else {echo 'login.php';}?>" class="menu-link"><span class="text-wrap"><?php if (isset($_SESSION['name'])) { echo '<li role="presentation"><a href="logout.php">登出(' . $_SESSION['name'] . ')</a></li>';} else {echo '<li role="presentation"><a href="login.php">登入</a></li>';}?></span></a></li>
                    <li class="woo-menu-icon wcmenucart-toggle-drop_down toggle-cart-widget">

                        <a href="<?php if (isset($_SESSION['name'])) {echo 'cart.php';} else {echo 'login.php';}?>" class="wcmenucart">
                            <span class="wcmenucart-count"><i class="icon-handbag" aria-hidden="true"></i><span class="wcmenucart-details count"><?php  if (isset($_SESSION['cart'])) $cnt = count($_SESSION['cart'])/3; else $cnt=0; echo $cnt; ?></span></span>
                        </a>

                        <div class="current-shop-items-dropdown owp-mini-cart clr">
                            <div class="current-shop-items-inner clr">
                                <div class="widget woocommerce widget_shopping_cart">
                                    <div class="widget_shopping_cart_content"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="search-toggle-li"><a href="javascript:void(0)" class="site-search-toggle search-dropdown-toggle" aria-label="Search website"><span class="icon-magnifier" aria-hidden="true"></span></a></li>
                </ul>
                <div id="searchform-dropdown" class="header-searchform-wrap clr">

                    <form role="search" method="get" class="searchform" action="search.php">
                        <label for="ocean-search-form-1">
                            <span class="screen-reader-text">Search for:</span>
                            <input type="search" id="ocean-search-form-1" class="field" autocomplete="off" placeholder="搜尋" name="text">
                        </label>
                    </form>
                </div>
                <!-- #searchform-dropdown -->

            </nav>
            <!-- #site-navigation -->



        </div>
        <!-- #site-navigation-wrap -->




        <div class="oceanwp-mobile-menu-icon clr mobile-right">




            <a href="javascript:void(0)" class="mobile-menu" aria-label="手機選單">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <span class="oceanwp-text">選單</span>
                <span class="oceanwp-close-text">關閉</span>
            </a>




        </div>
        <!-- #oceanwp-mobile-menu-navbar -->


    </div>
    <!-- #site-header-inner -->


    <div id="mobile-dropdown" class="clr">

        <nav class="clr has-social" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">


            <div id="mobile-nav" class="navigation clr">

                <ul id="menu-main-menu-1" class="menu">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-6 current_page_item menu-item-282"><a href="index.php" aria-current="page">首頁</a></li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-766"><a href="index.php">關於我們</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-355"><a href="shop.php">全部商品</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="buyrule.php">購買須知</a></li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-767"><a href="index.php">聯絡我們</a></li>
                    <?php if(isset($_SESSION['name'])){echo'<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="'.$page.'">'.$who.'</a></li>';} ?>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-672"><a href="<?php if (isset($_SESSION['name'])) {echo 'logout.php';} else {echo 'login.php';}?>"><?php if (isset($_SESSION['name'])) { echo '<li role="presentation"><a href="logout.php">登出(' . $_SESSION['name'] . ')</a></li>';} else {echo '<li role="presentation"><a href="login.php">登入</a></li>';}?></a></li>
                </ul>
            </div>






            <div id="mobile-menu-search" class="clr">
                <form method="get" action="search.php" class="mobile-searchform" role="search" aria-label="Search for:">
                    <label for="ocean-mobile-search2">
                        <input type="search" name="text" autocomplete="off" placeholder="搜尋" />
                        <button type="submit" class="searchform-submit" aria-label="Submit search">
                        <i class="icon-magnifier" aria-hidden="true"></i>
                        </button>
                    </label>
                </form>
            </div>
            <!-- .mobile-menu-search -->

        </nav>

    </div>



    <div class="overlay-header-media"></div>


</header>
