<?php
    session_start();
    include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $sql="SELECT * FROM product order by sales desc";
    // // 資料庫查詢(送出查詢的SQL指令)
    if ($result = mysqli_query($link, $sql)) {
        $hot="";
        for($i=0;$i<5;$i++)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['number']==$_GET['number'])
                $row = mysqli_fetch_assoc($result);
            $hot .='<li><a href="product.php?number='.$row["number"].'"><img width="300" height="300" src="images/'.$row["picture1"].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> <span class="product-title">'.$row["name"].'</span></a><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></li>';
        }

        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    
        
    $sql="SELECT * FROM product where number = ".$_GET['number'];
    if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);    
    
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html class="html" lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title><?php echo $row['name']; ?> &#8211; 狗物網</title>
    
    <?php include("link.php");?>
</head>

<body class="product-template-default single single-product postid-2654 wp-embed-responsive theme-oceanwp no-isotope no-lightbox no-fitvids no-scroll-top no-sidr no-carousel no-matchheight woocommerce woocommerce-page woocommerce-no-js oceanwp-theme dropdown-mobile no-header-border default-breakpoint has-sidebar content-left-sidebar page-with-background-title has-breadcrumbs has-blog-grid has-grid-list account-original-style elementor-default elementor-kit-598"
    itemscope="itemscope" itemtype="https://schema.org/WebPage">


    <div id="outer-wrap" class="site clr">

        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>


        <div id="wrap" class="clr">



            <?php include('header.php');?>
            <!-- #site-header -->



            <div class="owp-floating-bar">
                <div class="container clr">
                    <div class="left">
                        <p class="selected">已選擇：</p>
                        <h2 class="entry-title" itemprop="name"><?php echo $row['name'];?></h2>
                    </div>
                    <div class="right">
                        <div class="product_price">
                            <p class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span><?php echo $row['price']; ?></bdi>
                                </span>
                            </p>
                        </div>
                        
                        <form action="cart.php" class="cart" method="GET" enctype="multipart/form-data">
                            <div class="quantity">
                                <label class="screen-reader-text" for="quantity_60c040dc3e928"><?php echo $row['name']; ?>  數量</label>
                                <input type="number" id="quantity_60c040dc3e928" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="數量" size="4" placeholder="" inputmode="numeric" />
                            </div>
                            <button type="submit" name="id" value="<?php echo $row['number']; ?>" class=" button alt">加入購物車</button>
                        </form>
                    </div>
                </div>
            </div>


            <main id="main" class="site-main clr" role="main">



                <header class="page-header background-image-page-header">


                    <div class="container clr page-header-inner">


                        <h1 class="page-header-title clr" itemprop="headline"><?php echo $row['name']; ?></h1>



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="shop.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">全部商品</span></a><span class="breadcrumb-sep">></span>
                                    <meta content="2" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="product.php?number=<?php echo $row['number']; ?>" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo $row['name']; ?></span></a>
                                    <meta content="3" itemprop="position" />
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


                        <div id="content" class="clr site-content">


                            <article class="entry-content entry clr">


                                <div class="woocommerce-notices-wrapper"></div>
                                <div id="product-2654" class="entry has-media owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal has-product-nav product type-product post-2654 status-publish first instock product_cat-29 has-post-thumbnail shipping-taxable purchasable product-type-simple">


                                    <div class="owp-product-nav-wrap clr">
                                        <ul class="owp-product-nav">

                                        </ul>
                                    </div>

                                    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                        <figure class="woocommerce-product-gallery__wrapper">
                                            <div data-thumb="images/<?php echo $row['image']; ?>" data-thumb-alt=""><img width="400" height="400" src="images/<?php echo $row['image']; ?>" class="wp-post-image" alt="" loading="lazy" title="Doggy1" data-caption="" srcset="" sizes="(max-width: 400px) 100vw, 400px" /></div>
                                        </figure>
                                    </div>

                                    <div class="summary entry-summary">

                                        <h2 class="single-post-title product_title entry-title" itemprop="name"><?php echo $row['name']; ?></h2>
                                        <p class="price"> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span><?php echo $row['price']; ?></bdi></span></ins></p>

                                        <form class="variations_form cart" action="cart.php" method="GET" enctype='multipart/form-data' data-product_id="1865" data-product_variations="false">

                                            <table class="variations" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="label"><label for="kind">款式</label></td>
                                                        <td class="value">
                                                            <select id="kind" class="" name="kind" data-attribute_name="attribute_%e6%ac%be%e5%bc%8f" data-show_option_none="yes"><option value="">隨機</option><option value="<?php echo $row['kind1']; ?>" ><?php echo $row['kind1']; ?></option><option value="<?php echo $row['kind2']; ?>" ><?php echo $row['kind2']; ?></option></select>
                                                            <a class="reset_variations" href="#">清除</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="single_variation_wrap">
                                                <div class="wcpa_timer_var"></div>
                                                <div class="woocommerce-variation single_variation"></div>
                                                <div class="woocommerce-variation-add-to-cart variations_button">

                                                    <div class="quantity">
                                                        <label class="screen-reader-text" for="quantity_6071be82b0a4f"><?php echo $row['name']; ?> 數量</label>
                                                        <input type="number" id="quantity_6071be82b0a4f" class="input-text qty text" step="1" min="1" max="" name="quantity" id="quantity" value="1" title="數量" size="4" placeholder="" inputmode="numeric" />
                                                    </div>

                                                    <button type="submit" name="id" value="<?php echo $row['number']; ?>" class=" button alt">加入購物車</button>


                                                </div>
                                            </div>

                                        </form>

                                        <div class="product_meta">



                                            <span class="sku_wrapper">貨號: <span class="sku"><?php echo $row['number']; ?></span></span>
                                            <span class="posted_in">分類: <a href="shop.php?classify=<?php echo $row['classify']; ?>" rel="tag"><?php echo $row['classify']; ?></a></span>


                                        </div>
                                    </div>

                                    <div class="clear-after-summary clr"></div>
                                    <div class="woocommerce-tabs wc-tabs-wrapper">
                                        <ul class="tabs wc-tabs" role="tablist">
                                            <li class="description_tab" id="tab-title-description" role="tab" aria-controls="tab-description">
                                                <a href="#tab-description">產品資訊</a>
                                            </li>
                                        </ul>
                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">

                                            <h2>產品資訊</h2>

                                            <p><span data-ccp-props="{}"> <img loading="lazy" class="alignnone wp-image-1866 size-full" src="images/<?php echo $row['picture1']; ?>" alt="" width="712" height="960" srcset="" sizes="(max-width: 712px) 100vw, 712px" /></span></p>
                                            <p><span data-ccp-props="{}"> <img loading="lazy" class="alignnone wp-image-1866 size-full" src="images/<?php echo $row['picture2']; ?>" alt="" width="712" height="960" srcset="" sizes="(max-width: 712px) 100vw, 712px" /></span></p>
                                            <p><span data-ccp-props="{}"> <img loading="lazy" class="alignnone wp-image-1866 size-full" src="images/<?php echo $row['picture3']; ?>" alt="" width="712" height="960" srcset="" sizes="(max-width: 712px) 100vw, 712px" /></span></p>
                                            <p><span data-ccp-props="{}"> <img loading="lazy" class="alignnone wp-image-1866 size-full" src="images/<?php echo $row['picture4']; ?>" alt="" width="712" height="960" srcset="" sizes="(max-width: 712px) 100vw, 712px" /></span></p>
                                            <p><span data-ccp-props="{}"> <img loading="lazy" class="alignnone wp-image-1866 size-full" src="images/<?php echo $row['picture5']; ?>" alt="" width="712" height="960" srcset="" sizes="(max-width: 712px) 100vw, 712px" /></span></p>


                                            <p>&nbsp;</p>
                                            <p><span style="color: #ff0000"><strong>※拍攝燈光光纖明亮和顯示器不同，可能會與圖色有所區別，請以實物為準，如不同意請勿購買。</strong></span></p>
                                            <p>下單前須確實詳讀<strong><span style="color: #0000ff"><a style="color: #0000ff" href="buyrule.php">購買須知<span style="color: #000000">。</span></a></span></strong></p>
                                            <p><span style="color: #000080"><strong>[以上皆同意再行下訂單]</strong></span></p>
                                        </div>

                                    </div>

                                </div>




                            </article>
                            <!-- #post -->


                        </div>
                        <!-- #content -->


                    </div>
                    <!-- #primary -->



                    <aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar" role="complementary" aria-label="Primary Sidebar">


                        <div id="right-sidebar-inner" class="clr">

                            <div id="woocommerce_product_search-2" class="sidebar-box woocommerce widget_product_search clr">
                                <form role="search" method="get" class="woocommerce-product-search" action="index.php">
                                    <label class="screen-reader-text" for="woocommerce-product-search-field-0">搜尋關鍵字:</label>
                                    <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="搜尋商品&hellip;" value="" name="s" />
                                    <button type="submit" value="搜尋">搜尋</button>
                                    <input type="hidden" name="post_type" value="product" />
                                </form>
                            </div>
                            <div id="woocommerce_product_categories-2" class="sidebar-box woocommerce widget_product_categories clr">
                                <h4 class="widget-title">商品分類</h4>
                                <ul class="product-categories">
                                    <li class="cat-item cat-item-31 <?php if($row['classify']=="全部商品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "全部商品"; ?>">全部</a></li>
                                    <li class="cat-item cat-item-35 <?php if($row['classify']=="清潔用品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "清潔用品"; ?>">清潔用品</a></li>
                                    <li class="cat-item cat-item-30 <?php if($row['classify']=="生活用品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "生活用品"; ?>">生活用品</a></li>
                                    <li class="cat-item cat-item-29 <?php if($row['classify']=="外出用具")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "外出用具"; ?>">外出用具</a></li>
                                    <li class="cat-item cat-item-28 <?php if($row['classify']=="食物")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "食物"; ?>">食物</a></li>
                                    <li class="cat-item cat-item-33 <?php if($row['classify']=="衣服")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "衣服"; ?>">衣服</a></li>
                                    <li class="cat-item cat-item-32 <?php if($row['classify']=="玩具")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "玩具"; ?>">玩具</a></li>
                                </ul>
                            </div>
                            <div id="woocommerce_top_rated_products-2" class="sidebar-box woocommerce widget_top_rated_products clr">
                                <h4 class="widget-title">好評商品</h4>
                                <ul class="product_list_widget">
                                    <?php echo $hot;?>
                                </ul>
                            </div>
                        </div>
                        <!-- #sidebar-inner -->


                    </aside>
                    <!-- #right-sidebar -->


                </div>
                <!-- #content-wrap -->




            </main>
            <!-- #main -->





            <?php include('footer.php'); ?>
            <!-- #footer -->



        </div>
        <!-- #wrap -->


    </div>
    <!-- #outer-wrap -->



    <a id="scroll-top" class="scroll-top-left" href="#"><span class="fa fa-chevron-up" aria-label="Scroll to the top of the page"></span></a>




    <script src="https://ecc.tw/wp-admin/admin-ajax.php?action=mercator-sso-js&#038;host=ada531th.com&#038;back=https%3A%2F%2Fada531th.com%2Fshop%2F%25e6%259c%2580%25e6%2596%25b0%25e7%258e%25a9%25e5%2591%25bd%25e9%2597%259c%25e9%25a0%25ad9%25e5%25bc%2595%25e6%2593%258e%25e7%2588%2586%25e7%25b1%25b3%25e8%258a%25b1%25e6%25a1%25b6%25e5%25bf%25ab%25e9%2596%2583%25e5%259c%2598%3Fv%3D669b91705b38&#038;site=343&#038;nonce=89c26e15f4"></script>
    <script type="text/javascript">
        /* <![CDATA[ */
        if ('function' === typeof MercatorSSO) {
            document.cookie = "wordpress_test_cookie=WP Cookie check; path=/";
            if (document.cookie.match(/(;|^)\s*wordpress_test_cookie\=/)) {
                MercatorSSO();
            }
        }
        /* ]]> */
    </script>

    <div id="owp-qv-wrap">
        <div class="owp-qv-container">
            <div class="owp-qv-content-wrap">
                <div class="owp-qv-content-inner">
                    <a href="#" class="owp-qv-close" aria-label="Close quick preview">×</a>
                    <div id="owp-qv-content" class="woocommerce single-product"></div>
                </div>
            </div>
        </div>
        <div class="owp-qv-overlay"></div>
    </div>
    <div id="oceanwp-cart-sidebar-wrap">
        <div class="oceanwp-cart-sidebar"><a href="#" class="oceanwp-cart-close">×</a>
            <p class="owp-cart-title">購物車</p>
            <div class="divider"></div>
            <div class="owp-mini-cart">
                <div class="widget woocommerce widget_shopping_cart">
                    <div class="widget_shopping_cart_content"></div>
                </div>
            </div>
        </div>
        <div class="oceanwp-cart-sidebar-overlay"></div>
    </div>
    <script type="application/ld+json">
        {
            "@context": "https:\/\/schema.org\/",
            "@type": "Product",
            "@id": "https:\/\/ada531th.com\/shop\/%e6%9c%80%e6%96%b0%e7%8e%a9%e5%91%bd%e9%97%9c%e9%a0%ad9%e5%bc%95%e6%93%8e%e7%88%86%e7%b1%b3%e8%8a%b1%e6%a1%b6%e5%bf%ab%e9%96%83%e5%9c%98#product",
            "name": "\u6700\u65b0!\u73a9\u547d\u95dc\u982d9\u5f15\u64ce\u7206\u7c73\u82b1\u6876(\u5feb\u9583\u5718)\u00a0",
            "url": "https:\/\/ada531th.com\/shop\/%e6%9c%80%e6%96%b0%e7%8e%a9%e5%91%bd%e9%97%9c%e9%a0%ad9%e5%bc%95%e6%93%8e%e7%88%86%e7%b1%b3%e8%8a%b1%e6%a1%b6%e5%bf%ab%e9%96%83%e5%9c%98",
            "description": "\u00a0\u771f\u662f\u6cf0\ud83c\uddf9\ud83c\udded\u8a87\u5f35\u6628\u5929\u624d\u525b\u4e0a\u67b6\u00a0\r\n\r\n\u4eca\u5929\u676f\u5b50\u5c31\u8ce3\u5149\u5149\ud83d\udd25\u00a0\r\n\r\n\u7206\u7c73\u82b1\u6876\u4e5f\u53ea\u526920\u500b\u3002\u3002\u3002\u00a0\r\n\r\n\u60f3\u8cb7\u9084\u5f97\u624b\u901f\u5920\u5feb\u2757\ufe0f\u00a0\u2757\ufe0f\u00a0\u2757\ufe0f\u00a0\r\n\r\n\u5f71\u8ff7\u5011\u4e00\u5b9a\u8981\u8cb7\u8d77\u4f86\ud83d\udc4d\ud83c\udffb\u00a0\r\n\r\nAda\u4e5f\u76e1\u91cf\u5e6b\u5927\u5bb6\u6436\u5230\ud83d\ude06\u00a0\r\n\r\n \r\n\r\n\u5f15\u64ce\u7206\u7c73\u82b1\u6876\u00a0\r\n\r\n\u5bb9\u91cf:100oz\u00a0\r\n\r\n\u6709\u84cb\u5b50\u53ef\u9694\u7d55\u7070\u5875\u00a0\r\n\r\n\u26a0\u51b7\u98f2\u676f\u5df2\u8ce3\u5b8c\r\n\r\n\ud83d\udd25\u96a8\u6642\u6c92\u8ca8\uff0c\u6240\u4ee5\u4eca\u59296\/3\u665a\u4e0a6\u9ede\u6e96\u6642\u7d50\u55ae\ud83d\udd25\r\n\r\n((\u5982\u771f\u7684\u8ce3\u5b8c\u6c92\u6709\u8ca8\u6703\u7528\u9000\u6b3e\u7684\u65b9\u5f0f\u8655\u7406))\r\n\r\n\u26a0\ufe0f\u56e0\u70ba\u8ca8\u904b\u6703\u7d93\u904e\u591a\u6b21\u642c\u904b\u591a\u5c11\u90fd\u6703\u649e\u64ca\u64e6\u50b7\uff0c\u9664\u975e\u6709\u6f0f\u9001\u6216\u662f\u6709\u4f8b\u5982\u7f3a\u89d2\u4e0d\u7136\u4e00\u5f8b\u4e0d\u9000\u6b3e\u5594!\u00a0\r\n\r\n\ud83d\ude0aAda\u6703\u8acb\u8ca8\u904b\u7279\u5225\u5c0f\u5fc3\u5305\u597d\ud83d\ude0a\u00a0\r\n\r\n\u26a0\ufe0f\u9ebb\u7169\u62c6\u8ca8\u6642\u4e00\u5b9a\u8981\u9304\u5f71\u5b58\u8b49\uff0c\u5982\u771f\u6709\u4ee5\u4e0a\u6240\u8ff0\u72c0\u6cc1\u6703\u99ac\u4e0a\u8655\u7406\u00a0\r\n\r\n\u203b\u5c3a\u5bf8\u5927\u5c0f\u6b63\u8ca0\u4e09\u516c\u5206\u70ba\u6b63\u5e38\u7bc4\u570d\uff0c\u62cd\u651d\u71c8\u5149\u5149\u7e96\u660e\u4eae\u548c\u986f\u793a\u5668\u4e0d\u540c\uff0c\u53ef\u80fd\u6703\u8207\u5716\u8272\u6709\u6240\u5340\u5225\uff0c\u8acb\u4ee5\u5be6\u7269\u70ba\u6e96\uff0c\u5982\u4e0d\u540c\u610f\u8acb\u52ff\u8cfc\u8cb7\u3002\r\n\r\n\u4e0b\u55ae\u524d\u9808\u78ba\u5be6\u8a73\u8b80\u8cfc\u8cb7\u9808\u77e5\u3002\r\n\r\n[\u4ee5\u4e0a\u7686\u540c\u610f\u518d\u884c\u4e0b\u8a02\u55ae]",
            "image": "https:\/\/ada531th.com\/wp-content\/uploads\/sites\/343\/2021\/06\/\u6cf0\u570b\u7522\u54c14_210603_2.jpg",
            "sku": 2654,
            "offers": [{
                "@type": "Offer",
                "price": "1100",
                "priceValidUntil": "2022-12-31",
                "priceSpecification": {
                    "price": "1100",
                    "priceCurrency": "TWD",
                    "valueAddedTaxIncluded": "false"
                },
                "priceCurrency": "TWD",
                "availability": "http:\/\/schema.org\/InStock",
                "url": "https:\/\/ada531th.com\/shop\/%e6%9c%80%e6%96%b0%e7%8e%a9%e5%91%bd%e9%97%9c%e9%a0%ad9%e5%bc%95%e6%93%8e%e7%88%86%e7%b1%b3%e8%8a%b1%e6%a1%b6%e5%bf%ab%e9%96%83%e5%9c%98",
                "seller": {
                    "@type": "Organization",
                    "name": "\u6cf0\u570b\u4ee3\u8cfc\u6cf0\u597d\u8cb7ADA",
                    "url": "https:\/\/ada531th.com"
                }
            }]
        }
    </script>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" aria-label="關閉 (Esc)"></button>
                    <button class="pswp__button pswp__button--share" aria-label="分享"></button>
                    <button class="pswp__button pswp__button--fs" aria-label="切換為全螢幕"></button>
                    <button class="pswp__button pswp__button--zoom" aria-label="放大/縮小"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" aria-label="上一步 (向左箭頭)"></button>
                <button class="pswp__button pswp__button--arrow--right" aria-label="下一步 (向右箭頭)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function() {
            var c = document.body.className;
            c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
            document.body.className = c;
        })()
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/wp-ultimo//inc/setup/js/jquery.blockUI.js?ver=1.10.13' id='jquery-blockui-js'></script>
    <script type='text/javascript' id='wc-add-to-cart-js-extra'>
        /* <![CDATA[ */
        var wc_add_to_cart_params = {
            "ajax_url": "\/ada\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%",
            "i18n_view_cart": "\u67e5\u770b\u8cfc\u7269\u8eca",
            "cart_url": "https:\/\/ada531th.com\/cart",
            "is_cart": "",
            "cart_redirect_after_add": "no"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=4.6.2' id='wc-add-to-cart-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/zoom/jquery.zoom.min.js?ver=1.7.21' id='zoom-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/flexslider/jquery.flexslider.min.js?ver=2.7.2' id='flexslider-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min.js?ver=4.1.1' id='photoswipe-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js?ver=4.1.1' id='photoswipe-ui-default-js'></script>
    <script type='text/javascript' id='wc-single-product-js-extra'>
        /* <![CDATA[ */
        var wc_single_product_params = {
            "i18n_required_rating_text": "\u8acb\u9078\u64c7\u8a55\u5206",
            "review_rating_required": "yes",
            "flexslider": {
                "rtl": false,
                "animation": "slide",
                "smoothHeight": true,
                "directionNav": false,
                "controlNav": "thumbnails",
                "slideshow": false,
                "animationSpeed": 500,
                "animationLoop": false,
                "allowOneSlide": false
            },
            "zoom_enabled": "1",
            "zoom_options": [],
            "photoswipe_enabled": "1",
            "photoswipe_options": {
                "shareEl": false,
                "closeOnScroll": false,
                "history": false,
                "hideAnimationDuration": 0,
                "showAnimationDuration": 0
            },
            "flexslider_enabled": "1"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js?ver=4.6.2' id='wc-single-product-js'></script>
    <script type='text/javascript' id='wc-geolocation-js-extra'>
        /* <![CDATA[ */
        var wc_geolocation_params = {
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%",
            "home_url": "https:\/\/ada531th.com",
            "is_available": "1",
            "hash": "669b91705b38"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/geolocation.min.js?ver=4.6.2' id='wc-geolocation-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4' id='js-cookie-js'></script>
    <script type='text/javascript' id='woocommerce-js-extra'>
        /* <![CDATA[ */
        var woocommerce_params = {
            "ajax_url": "\/ada\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=4.6.2' id='woocommerce-js'></script>
    <script type='text/javascript' id='wc-cart-fragments-js-extra'>
        /* <![CDATA[ */
        var wc_cart_fragments_params = {
            "ajax_url": "\/ada\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%",
            "cart_hash_key": "wc_cart_hash_e49d31a6e52ae5eeaa700bbdadb8337d",
            "fragment_name": "wc_fragments_e49d31a6e52ae5eeaa700bbdadb8337d",
            "request_timeout": "5000"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=4.6.2' id='wc-cart-fragments-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-quick-view.min.js?ver=1.0' id='oceanwp-woo-quick-view-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/underscore.min.js?ver=1.8.3' id='underscore-js'></script>
    <script type='text/javascript' id='wp-util-js-extra'>
        /* <![CDATA[ */
        var _wpUtilSettings = {
            "ajax": {
                "url": "\/ada\/wp-admin\/admin-ajax.php"
            }
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/wp-util.min.js?ver=5.5.5' id='wp-util-js'></script>
    <script type='text/javascript' id='wc-add-to-cart-variation-js-extra'>
        /* <![CDATA[ */
        var wc_add_to_cart_variation_params = {
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%",
            "i18n_no_matching_variations_text": "\u5f88\u62b1\u6b49\uff0c\u6c92\u6709\u5546\u54c1\u7b26\u5408\u60a8\u7684\u9078\u64c7\uff0c\u8acb\u91cd\u65b0\u9078\u64c7\u5176\u4ed6\u7d44\u5408\u3002",
            "i18n_make_a_selection_text": "\u8acb\u5148\u9078\u53d6\u4efb\u4e00\u5546\u54c1\u9805\u9078\u518d\u52a0\u5546\u54c1\u9032\u8cfc\u7269\u8eca",
            "i18n_unavailable_text": "\u62b1\u6b49\uff0c\u6b64\u5546\u54c1\u5df2\u4e0b\u67b6\uff0c\u8acb\u9078\u64c7\u4e0d\u540c\u7684\u7d44\u5408"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js?ver=4.6.2' id='wc-add-to-cart-variation-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-floating-bar.min.js?ver=1.0' id='oceanwp-woo-floating-bar-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-mini-cart.min.js?ver=1.0' id='oceanwp-woo-mini-cart-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/imagesloaded.min.js?ver=4.1.4' id='imagesloaded-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-scripts.min.js?ver=1.0' id='oceanwp-woocommerce-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/magnific-popup.min.js?ver=1.0' id='magnific-popup-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/lightbox.min.js?ver=1.0' id='oceanwp-lightbox-js'></script>
    <script type='text/javascript' id='oceanwp-main-js-extra'>
        /* <![CDATA[ */
        var oceanwpLocalize = {
            "isRTL": "",
            "menuSearchStyle": "drop_down",
            "sidrSource": null,
            "sidrDisplace": "1",
            "sidrSide": "left",
            "sidrDropdownTarget": "link",
            "verticalHeaderTarget": "link",
            "customSelects": ".woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, .single-product .variations_form .variations select",
            "wooCartStyle": "drop_down",
            "ajax_url": "https:\/\/ada531th.com\/wp-admin\/admin-ajax.php",
            "cart_url": "https:\/\/ada531th.com\/cart",
            "cart_redirect_after_add": "no",
            "view_cart": "View cart",
            "floating_bar": "on",
            "grouped_text": "View products",
            "multistep_checkout_error": "Some required fields are empty. Please fill the required fields to go to the next step.",
            "stickyChoose": "auto",
            "stickyStyle": "shrink",
            "shrinkLogoHeight": "50",
            "stickyEffect": "none",
            "hasStickyTopBar": "",
            "hasStickyMobile": "1"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/main.min.js?ver=1.0' id='oceanwp-main-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/ocean-sticky-header/assets/js/main.min.js' id='osh-js-scripts-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/wp-embed.min.js?ver=5.5.5' id='wp-embed-js'></script>
    <!--[if lt IE 9]>
<script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/html5.min.js?ver=1.0' id='html5shiv-js'></script>
<![endif]-->
</body>

</html>