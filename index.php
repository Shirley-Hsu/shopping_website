<?php
    session_start();
    $who="";
    $page="";
    if(isset($_SESSION['name']))
    {
        if(intval($_SESSION['level'])==1)
        {
            $who="管理頁面";
            $page="manager.php";
        }
        else if(intval($_SESSION['level'])==2)
        {
            $who="會員管理";
            $page="member.php";
        }
    }
    if (isset($_SESSION['cart'])) {
        $cnt = count($_SESSION['cart'])/3;
    } else {
        $cnt = 0;
    } 

    include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $sql="SELECT * FROM product order by sales desc";
    // // 資料庫查詢(送出查詢的SQL指令)
    if ($result = mysqli_query($link, $sql)) {
        $rows="";
        for($i=0;$i<9;$i++)
        {
            $row = mysqli_fetch_assoc($result);
            if($i%3==0)
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-370 status-publish first instock product_cat-28 has-post-thumbnail shipping-taxable purchasable product-type-simple"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            else if($i%3==1)
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-1811 status-publish instock product_cat-31 has-post-thumbnail shipping-taxable purchasable product-type-variable"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            else 
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-1645 status-publish last instock product_cat-31 has-post-thumbnail shipping-taxable purchasable product-type-variable"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            
        }

        mysqli_free_result($result); // 釋放佔用的記憶體
    }

    mysqli_close($link); // 關閉資料庫連結
?>

<!DOCTYPE html>
<html class="html" lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title>S0854033 &#8211; 狗物網</title>
    <?php include("link.php");?>
</head>

<body class="home page-template-default page page-id-6 wp-embed-responsive theme-oceanwp no-isotope no-lightbox no-fitvids no-scroll-top no-sidr no-carousel no-matchheight woocommerce-no-js oceanwp-theme dropdown-mobile no-header-border default-breakpoint content-full-screen page-with-background-title page-header-disabled has-breadcrumbs has-blog-grid has-grid-list account-original-style elementor-default elementor-kit-598 elementor-page elementor-page-6"
    itemscope="itemscope" itemtype="https://schema.org/WebPage">



    <div id="outer-wrap" class="site clr">

        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>


        <div id="wrap" class="clr">



            <header id="site-header" class="minimal-header has-social has-header-media center-logo effect-seven clr fixed-scroll shrink-header has-sticky-mobile" data-height="54" itemscope="itemscope" itemtype="https://schema.org/WPHeader" role="banner">



                <div id="site-header-inner" class="clr container">

                    <div class="oceanwp-mobile-menu-icon clr woo-menu-icon mobile-left">
                        <a href="<?php if (isset($_SESSION['name'])) {echo 'cart.php';} else {echo 'login.php';}?>" class="wcmenucart">
                            <span class="wcmenucart-count"><i class="icon-handbag" aria-hidden="true"></i><span class="wcmenucart-details count"><?php echo $cnt; ?></span></span>
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
                                <li id="menu-item-766" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-766"><a href="/#about" class="menu-link"><span class="text-wrap">關於我們</span></a></li>
                                <li id="menu-item-355" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-355"><a href="shop.php" class="menu-link"><span class="text-wrap">全部商品</span></a></li>
                                <li id="menu-item-671" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="buyrule.php" class="menu-link"><span class="text-wrap">購買須知</span></a></li>
                                <li id="menu-item-767" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-767"><a href="/#contact" class="menu-link"><span class="text-wrap">聯絡我們</span></a></li>                                
                                <?php if(isset($_SESSION['name'])) echo'<li id="menu-item-671" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="'.$page.'" class="menu-link"><span class="text-wrap">'.$who.'</span></a></li>';  ?>
                                <li id="menu-item-672" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-672"><a href="<?php if (isset($_SESSION['name'])) {echo 'logout.php';} else {echo 'login.php';}?>" class="menu-link"><span class="text-wrap"><?php if (isset($_SESSION['name'])) { echo '<li role="presentation"><a href="logout.php">登出(' . $_SESSION['name'] . ')</a></li>';} else {echo '<li role="presentation"><a href="login.php">登入</a></li>';}?></span></a></li>
                                <li class="woo-menu-icon wcmenucart-toggle-drop_down toggle-cart-widget">

                                    <a href="<?php if (isset($_SESSION['name'])) {echo 'cart.php';} else {echo 'login.php';}?>" class="wcmenucart">
                                        <span class="wcmenucart-count"><i class="icon-handbag" aria-hidden="true"></i><span class="wcmenucart-details count"><?php echo $cnt; ?></span></span>
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
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-766"><a href="/#about">關於我們</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-355"><a href="shop.php">全部商品</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="buyrule.php">購買須知</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-767"><a href="/#contact">聯絡我們</a></li>                            
                                <?php if(isset($_SESSION['name'])){echo'<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-671"><a href="'.$page.'">'.$who.'</a></li>';}  ?>                            
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-672"><a href="<?php if (isset($_SESSION['name'])) {echo 'logout.php';} else {echo 'login.php';}?>"><?php if (isset($_SESSION['name']))  echo '<li role="presentation"><a href="logout.php">登出(' . $_SESSION['name'] . ')</a></li>'; else echo '<li role="presentation"><a href="login.php">登入</a></li>';?></a></li>
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
            <!-- #site-header -->



            <main id="main" class="site-main clr" role="main">



                <div id="content-wrap" class="container clr">


                    <div id="primary" class="content-area clr">


                        <div id="content" class="site-content clr">



                            <article class="single-page-article clr">


                                <div class="entry clr" itemprop="text">


                                    <div data-elementor-type="wp-post" data-elementor-id="6" class="elementor elementor-6" data-elementor-settings="[]">
                                        <div class="elementor-inner">
                                            <div class="elementor-section-wrap">
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-4b619113 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="4b619113" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-no">
                                                        <div class="elementor-row">
                                                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-54df669e" data-id="54df669e" data-element_type="column">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">
                                                                        <div class="elementor-element elementor-element-45ff217 elementor-skin-carousel elementor-arrows-yes elementor-widget elementor-widget-media-carousel" data-id="45ff217" data-element_type="widget" data-settings="{&quot;skin&quot;:&quot;carousel&quot;,&quot;effect&quot;:&quot;slide&quot;,&quot;show_arrows&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;autoplay&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;loop&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;space_between&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;space_between_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;space_between_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]}}"
                                                                            data-widget_type="media-carousel.default">
                                                                            <div class="elementor-widget-container">
                                                                                <div class="elementor-swiper">
                                                                                    <div class="elementor-main-swiper swiper-container">
                                                                                        <div class="swiper-wrapper">
                                                                                            <div class="swiper-slide">
                                                                                                <div class="elementor-carousel-image" style="background-image: url(images/doggy1-1.jpg)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="elementor-carousel-image" style="background-image: url(images/doggy2-1.jpg)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="elementor-carousel-image" style="background-image: url(images/doggy3-1.jpg)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="elementor-carousel-image" style="background-image: url(images/doggy4-1.jpg)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="elementor-carousel-image" style="background-image: url(images/doggy5-1.jpg)">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="elementor-swiper-button elementor-swiper-button-prev">
                                                                                            <i class="eicon-chevron-left" aria-hidden="true"></i>
                                                                                            <span class="elementor-screen-only">上一篇</span>
                                                                                        </div>
                                                                                        <div class="elementor-swiper-button elementor-swiper-button-next">
                                                                                            <i class="eicon-chevron-right" aria-hidden="true"></i>
                                                                                            <span class="elementor-screen-only">下一篇</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-60bfe53a elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="60bfe53a" data-element_type="section"
                                                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-row">
                                                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-110bfcea" data-id="110bfcea" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">
                                                                        <div class="elementor-element elementor-element-5aa6c5e9 elementor-widget elementor-widget-heading" data-id="5aa6c5e9" data-element_type="widget" data-widget_type="heading.default">
                                                                            <div class="elementor-widget-container">
                                                                                <h1 class="elementor-heading-title elementor-size-default">狗物網</h1>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-2a66cf2 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2a66cf2" data-element_type="section"
                                                    id="about" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                    <div class="elementor-container elementor-column-gap-no">
                                                        <div class="elementor-row">
                                                            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-5fd76ec3 elementor-invisible" data-id="5fd76ec3" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">
                                                                        <div class="elementor-element elementor-element-26b125d6 elementor-widget elementor-widget-heading" data-id="26b125d6" data-element_type="widget" data-widget_type="heading.default">
                                                                            <div class="elementor-widget-container">
                                                                                <h3 class="elementor-heading-title elementor-size-default">關於我們</h3>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-63f0dba8 elementor-invisible" data-id="63f0dba8" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;fadeInDown&quot;}">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">

                                                                        <div class="elementor-element elementor-element-5baeb43 elementor-widget elementor-widget-text-editor" data-id="5baeb43" data-element_type="widget" data-widget_type="text-editor.default">
                                                                            <div class="elementor-widget-container">
                                                                                <div class="elementor-text-editor elementor-clearfix">
                                                                                    <p>狗物網是專為狗建立的網站，主要販賣各種狗狗的周邊產品，包含日常的生活用品、玩具、食物、衣服...等等</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-161cf1f7 elementor-invisible" data-id="161cf1f7" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">

                                                                        <div class="elementor-element elementor-element-5054911 elementor-widget elementor-widget-text-editor" data-id="5054911" data-element_type="widget" data-widget_type="text-editor.default">
                                                                            <div class="elementor-widget-container">
                                                                                <div class="elementor-text-editor elementor-clearfix">
                                                                                    <p>此網站的一切內容皆為學業練習用，不具真實性且不含商業運作</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>

                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-7b8b32c elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7b8b32c" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-row">
                                                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5d4a826" data-id="5d4a826" data-element_type="column">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">
                                                                        <div class="elementor-element elementor-element-f742cc4 elementor-invisible elementor-widget elementor-widget-heading" data-id="f742cc4" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
                                                                            <div class="elementor-widget-container">
                                                                                <h2 class="elementor-heading-title elementor-size-default">熱銷商品</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-element elementor-element-1a45762 elementor-products-columns-3 elementor-products-columns-mobile-1 elementor-products-grid elementor-wc-products elementor-widget elementor-widget-woocommerce-products" data-id="1a45762" data-element_type="widget"
                                                                            data-widget_type="woocommerce-products.default">
                                                                            <div class="elementor-widget-container">
                                                                                <div class="woocommerce columns-3 ">
                                                                                    <ul class="products oceanwp-row clr grid">
                                                                                        <?php echo $rows; ?>
                                                                                        
                                                                                        
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-967e688 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="967e688" data-element_type="section" id="contact">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-row">
                                                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3b62c2a" data-id="3b62c2a" data-element_type="column">
                                                                <div class="elementor-column-wrap elementor-element-populated">
                                                                    <div class="elementor-widget-wrap">
                                                                        <div class="elementor-element elementor-element-3fc928e oew-divider-center oew-divider-center elementor-widget elementor-widget-oew-divider" data-id="3fc928e" data-element_type="widget" data-widget_type="oew-divider.default">
                                                                            <div class="elementor-widget-container">

                                                                                <div class="oew-divider-wrap">
                                                                                    <div class="oew-divider oew-divider-before"></div>
                                                                                    <div class="oew-divider-middle">
                                                                                        <h6 class="oew-divider-text">
                                                                                            狗物網 </h6>
                                                                                    </div>
                                                                                    <div class="oew-divider oew-divider-after"></div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-78a523a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="78a523a" data-element_type="section">
                                                                            <div class="elementor-container elementor-column-gap-default">
                                                                                <div class="elementor-row">
                                                                                    <div class="elementor-column elementor-col-20 elementor-inner-column elementor-element elementor-element-b63997e" data-id="b63997e" data-element_type="column">
                                                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                                                            <div class="elementor-widget-wrap">
                                                                                                <div class="elementor-element elementor-element-4c2e8eb elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="4c2e8eb" data-element_type="widget" data-widget_type="image-box.default">
                                                                                                    <div class="elementor-widget-container">
                                                                                                        <div class="elementor-image-box-wrapper">
                                                                                                            <figure class="elementor-image-box-img"><img width="1080" height="1080" src="images/dog.jpg" class="attachment-full size-full" alt="" loading="lazy" srcset="" sizes="(max-width: 1080px) 100vw, 1080px"
                                                                                                                /></figure>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="elementor-column elementor-col-20 elementor-inner-column elementor-element elementor-element-7fe3ccf" data-id="7fe3ccf" data-element_type="column">
                                                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                                                            <div class="elementor-widget-wrap">
                                                                                                <div class="elementor-element elementor-element-38f2588 elementor-view-stacked elementor-shape-circle elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="38f2588" data-element_type="widget" data-widget_type="icon-box.default">
                                                                                                    <div class="elementor-widget-container">
                                                                                                        <div class="elementor-icon-box-wrapper">
                                                                                                            <div class="elementor-icon-box-icon">
                                                                                                                <a class="elementor-icon elementor-animation-bob" href="mailto:shirley41825@gmail.com">
                                                                                                                    <i aria-hidden="true" class="fas fa-envelope-open-text"></i> </a>
                                                                                                            </div>
                                                                                                            <div class="elementor-icon-box-content">
                                                                                                                <h3 class="elementor-icon-box-title">
                                                                                                                    <a href="mailto:shirley41825@gmail.com">客服Email:<br>shirley41825@gmail.com</a>
                                                                                                                </h3>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
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





            <footer id="footer" class="site-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter" role="contentinfo">


                <div id="footer-inner" class="clr">



                    <div id="footer-bottom" class="clr">


                        <div id="footer-bottom-inner" class="container clr">


                            <div id="footer-bottom-menu" class="navigation clr">

                                <div class="menu-%e9%a0%81%e5%b0%be-container">
                                    <ul id="menu-%e9%a0%81%e5%b0%be" class="menu">
                                        <li id="menu-item-405" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-405"><a href="secretrule.php">隱私權政策</a></li>
                                        <!--<li id="menu-item-661" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-661"><a href="https://ada531th.com/qa">常見問題</a></li>-->
                                        <li id="menu-item-406" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-406"><a href="shop.php">全部商品</a></li>
                                        <li id="menu-item-774" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-774"><a href="/#contact">聯絡我們</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- #footer-bottom-menu -->



                            <div id="copyright" class="clr" role="contentinfo">
                                此網頁純屬學習練習用，不具任何商業用途 </div>
                            <!-- #copyright -->


                        </div>
                        <!-- #footer-bottom-inner -->


                    </div>
                    <!-- #footer-bottom -->


                </div>
                <!-- #footer-inner -->


            </footer>
            <!-- #footer -->



        </div>
        <!-- #wrap -->


    </div>
    <!-- #outer-wrap -->



    <a id="scroll-top" class="scroll-top-left" href="#"><span class="fa fa-chevron-up" aria-label="Scroll to the top of the page"></span></a>



    <!--購物車cookie-->
    <?php include('link2.php');?>
</body>

</html>