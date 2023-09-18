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
            $hot .='<li><a href="product.php?number='.$row["number"].'"><img width="300" height="300" src="images/'.$row["picture1"].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> <span class="product-title">'.$row["name"].'</span></a><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></li>';
        }

        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    if(!isset($_GET['classify']))
    {
        $sql="SELECT * FROM product";
        $state="全部商品";
    }
        
    else if($_GET['classify']=="全部商品")
    {
        $sql="SELECT * FROM product";
        $state="全部商品";
    }
        
    else if($_GET['classify']=="清潔用品")
    {
        $sql="SELECT * FROM product where classify = '清潔用品'";
        $state="清潔用品";
    }
        
    else if($_GET['classify']=="生活用品")
    {
        $sql="SELECT * FROM product where classify = '生活用品'";
        $state="生活用品";
    }
        
    else if($_GET['classify']=="外出用具")
    {
        $sql="SELECT * FROM product where classify = '外出用具'";
        $state="外出用具";
    }
        
    else if($_GET['classify']=="食物")
    {
        $sql="SELECT * FROM product where classify = '食物'";
        $state="食物";
    }
        
    else if($_GET['classify']=="衣服")
    {
        $sql="SELECT * FROM product where classify = '衣服'";
        $state="衣服";
    }
        
    else if($_GET['classify']=="玩具")
    {
        $sql="SELECT * FROM product where classify = '玩具'";
        $state="玩具";
    }
        

    if(!isset($_GET['orderby']))
        $sql.="";
    else if($_GET['orderby']=="menu_order")
        $sql.="";
    else if($_GET['orderby']=="popularity")
        $sql.=" order by sales desc";
    else if($_GET['orderby']=="date")
        $sql.=" order by number desc";
    else if($_GET['orderby']=="price")
        $sql.=" order by price";
    else if($_GET['orderby']=="price-desc")
        $sql.=" order by price desc";

    if ($result = mysqli_query($link, $sql)) {
        $rows="";
        $i=0;
        while($row = mysqli_fetch_assoc($result))
        {
            if($i%3==0)
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-370 status-publish first instock product_cat-28 has-post-thumbnail shipping-taxable purchasable product-type-simple"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            else if($i%3==1)
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-1811 status-publish instock product_cat-31 has-post-thumbnail shipping-taxable purchasable product-type-variable"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            else 
                $rows.='<li class="entry has-media has-product-nav col span_1_of_3 owp-content-center owp-thumbs-layout-horizontal owp-btn-normal owp-tabs-layout-horizontal product type-product post-1645 status-publish last instock product_cat-31 has-post-thumbnail shipping-taxable purchasable product-type-variable"><div class="product-inner clr"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /> </div><!-- .woo-entry-image-swap --><ul class="woo-entry-inner clr"><li class="image-wrap"><div class="woo-entry-image-swap woo-entry-image clr"><a href="product.php?number='.$row["number"].'" class="woocommerce-LoopProduct-link"><img width="300" height="300" src="images/'.$row["image"].'" class="woo-entry-image-main" alt='.$row["name"].' loading="lazy" itemprop="image" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></div><!-- .woo-entry-image-swap --></li><li class="category"><a href="" rel="tag">'.$row["classify"].'</a></li><li class="title"><h2><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a></h2></li><li class="price-wrap"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></span></li><li class="rating"></li><li class="btn-wrap clr"><a href="product.php?number='.$row["number"].'" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="2452" data-product_sku="" aria-label="選取「'.$row["name"].'」選項" rel="nofollow">詳細內容</a></li></ul></div><!-- .product-inner .clr --></li>';
            $i++;
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

    <title>全部商品 &#8211; 狗物網</title>
    <?php include("link.php");?>

</head>

<body class="archive post-type-archive post-type-archive-product wp-embed-responsive theme-oceanwp no-isotope no-lightbox no-fitvids no-scroll-top no-sidr no-carousel no-matchheight woocommerce woocommerce-page woocommerce-no-js oceanwp-theme dropdown-mobile no-header-border default-breakpoint has-sidebar content-left-sidebar page-with-background-title has-breadcrumbs has-blog-grid has-grid-list account-original-style elementor-default elementor-kit-598"
    itemscope="itemscope" itemtype="https://schema.org/WebPage">


    <div id="outer-wrap" class="site clr">

        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>


        <div id="wrap" class="clr">



            <?php include("header.php")?>
            <!-- #site-header -->



            <main id="main" class="site-main clr" role="main">



                <header class="page-header background-image-page-header">


                    <div class="container clr page-header-inner">


                        <h1 class="page-header-title clr" itemprop="headline"><?php echo $state; ?></h1>


                        <div class="clr page-subheading">
                            歡迎光臨我的商店 </div>
                        <!-- .page-subheading -->



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="shop.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">全部商品</span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="2" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="shop.php?classify=<?php echo $state; ?>" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo $state; ?></span></a>
                                    <meta content="3" itemprop="position" />

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
                                <header class="woocommerce-products-header">

                                </header>
                                <div class="woocommerce-notices-wrapper"></div>
                                <div class="oceanwp-toolbar clr">
                                    <nav class="oceanwp-grid-list"><a href="#" id="oceanwp-grid" title="網格檢視" class="active grid-btn"><span class="icon-grid" aria-hidden="true"></span></a><a href="#" id="oceanwp-list" title="列表檢視" class="list-btn"><span class="icon-list" aria-hidden="true"></span></a></nav>
                                    <form class="woocommerce-ordering" method="get">
                                        <select name="orderby" class="orderby" aria-label="商店訂單">
												<option value="menu_order"  <?php if(!isset($_GET["orderby"]) || $_GET["orderby"]=='menu_order') echo "selected='selected'";?>>預設排序</option>
												<option value="popularity" <?php if(isset($_GET["orderby"]) && $_GET["orderby"]=='popularity') echo "selected='selected'";?>>依熱銷度</option>
												<option value="date" <?php if(isset($_GET["orderby"]) && $_GET["orderby"]=='date') echo "selected='selected'";?>>依最新項目排序</option>
												<option value="price" <?php if(isset($_GET["orderby"]) && $_GET["orderby"]=='price') echo "selected='selected'";?>>依價格排序:低至高</option>
												<option value="price-desc" <?php if(isset($_GET["orderby"]) && $_GET["orderby"]=='price-desc') echo "selected='selected'";?>>依價格排序:高至低</option>
										</select>
                                        <input type="hidden" name="classify" value="<?php echo $state;?>">
                                    </form>
                                    <!-- <ul class="result-count">
                                        <li class="view-title">查看:</li>
                                        <li><a class="view-first active" href="https://ada531th.com/shop?v=669b91705b38&#038;products-per-page=12">12</a></li>
                                        <li><a class="view-second" href="https://ada531th.com/shop?v=669b91705b38&#038;products-per-page=24">24</a></li>
                                        <li><a class="view-all" href="https://ada531th.com/shop?v=669b91705b38&#038;products-per-page=all">全部</a></li>
                                    </ul> -->
                                </div>
                                <ul class="products oceanwp-row clr grid">
                                    <?php echo $rows; ?>
                                    
                                </ul>
                                <!-- <nav class="woocommerce-pagination">
                                    <ul class='page-numbers'>
                                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                                        <li><a class="page-numbers" href="https://ada531th.com/shop/page/2?v=669b91705b38&#038;products-per-page=12">2</a></li>
                                        <li><a class="page-numbers" href="https://ada531th.com/shop/page/3?v=669b91705b38&#038;products-per-page=12">3</a></li>
                                        <li><a class="next page-numbers" href="https://ada531th.com/shop/page/2?v=669b91705b38&#038;products-per-page=12"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                    </ul>
                                </nav> -->

                            </article>
                            <!-- #post -->


                        </div>
                        <!-- #content -->


                    </div>
                    <!-- #primary -->



                    <aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar" role="complementary" aria-label="Primary Sidebar">


                        <div id="right-sidebar-inner" class="clr">

                            <div id="woocommerce_product_search-2" class="sidebar-box woocommerce widget_product_search clr">
                                <form role="search" method="get" class="woocommerce-product-search" action="search.php">
                                    <label class="screen-reader-text" for="woocommerce-product-search-field-0">搜尋關鍵字:</label>
                                    <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="搜尋商品&hellip;" value="" name="text" />
                                    <button type="submit" value="搜尋">搜尋</button>
                                    <input type="hidden" name="post_type" value="product" />
                                </form>
                            </div>

                            <div id="woocommerce_product_categories-2" class="sidebar-box woocommerce widget_product_categories clr">
                                <h4 class="widget-title">商品分類</h4>
                                <ul class="product-categories">
                                    <li class="cat-item cat-item-31 <?php if($state=="全部商品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "全部商品"; ?>">全部</a></li>
                                    <li class="cat-item cat-item-35 <?php if($state=="清潔用品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "清潔用品"; ?>">清潔用品</a></li>
                                    <li class="cat-item cat-item-30 <?php if($state=="生活用品")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "生活用品"; ?>">生活用品</a></li>
                                    <li class="cat-item cat-item-29 <?php if($state=="外出用具")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "外出用具"; ?>">外出用具</a></li>
                                    <li class="cat-item cat-item-28 <?php if($state=="食物")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "食物"; ?>">食物</a></li>
                                    <li class="cat-item cat-item-33 <?php if($state=="衣服")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "衣服"; ?>">衣服</a></li>
                                    <li class="cat-item cat-item-32 <?php if($state=="玩具")echo 'current-cat';?>"><a href="shop.php?classify=<?php echo "玩具"; ?>">玩具</a></li>
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





            <?php include("footer.php") ?>
            <!-- #footer -->



        </div>
        <!-- #wrap -->


    </div>
    <!-- #outer-wrap -->



    <a id="scroll-top" class="scroll-top-left" href="#"><span class="fa fa-chevron-up" aria-label="Scroll to the top of the page"></span></a>




    <?php include('link2.php');?>
</body>

</html>