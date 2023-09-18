<?php
    session_start();
    include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $sql="SELECT * FROM product order by sales desc";
    $state="";
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
    
    $user = "";
        $pass = "";
        $mail = "";
        $id_num = "";
        $sex = '';
    if(isset($_POST['account'])) 
    {
        $state="我的帳號";
        $user = $_POST['account'];
        $pass = $_POST['password'];
        $mail = $_POST['email'];
        $id_num = $_POST['id_number'];
        $sex = $_POST['gender'];
        $sql="SELECT * FROM member where account ='".$_SESSION['name']."'";
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {
                if($user=="") $user=$row['account'];
                if($pass=="") $passs=$row['password'];
                if($mail=="") $mail=$row['email'];
                if($id_num=="") $id_num=$row['id_number'];
                if($sex=="") $sex=$row['gender'];
            }     
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        if($user != $_SESSION['name'])
        {
            $sql="UPDATE cart SET username='".$user."' WHERE username='".$_SESSION['name']."'";
            $update = mysqli_query($link, $sql) or die("error");
            $sql="UPDATE userorder SET username='".$user."' WHERE username='".$_SESSION['name']."'";
            $update = mysqli_query($link, $sql) or die("error");
        }
                $sql="UPDATE member SET account='".$user."', password='".$pass."',email='".$mail."',id_number='".$id_num."',gender='".$sex."' WHERE account='".$_SESSION['name']."'";
                $_SESSION['name']=$user;
                $update = mysqli_query($link, $sql) or die("error");

    } 
    else if(!isset($_GET['page']))
    {
        $sql="SELECT * FROM userorder ";
        $state="訂單管理";
    }  
    else if($_GET['page']=="訂單管理")
    {
        $sql="SELECT * FROM userorder ";
        $state="訂單管理";
        if(isset($_GET['cancel']))
        {
            $sql ='DELETE FROM userorder WHERE order_no ="'.$_GET["cancel"].'"';
            $clear = mysqli_query($link, $sql) or die("error");
        }
        if(isset($_GET['send_order']))
        {
            $sql ='UPDATE userorder SET state=2 WHERE order_no="'.$_GET["send_order"].'"';
            $send = mysqli_query($link, $sql) or die("error");
        }
    }
    else if($_GET['page']=="帳號管理")
    {
        $sql="SELECT * FROM member where level ='2'";
        $state="帳號管理";
        if(isset($_GET['delete_user']))
        {
            $sql ='DELETE FROM userorder WHERE username ="'.$_GET["delete_user"].'"';
            $clear = mysqli_query($link, $sql) or die("error");
            $sql ='DELETE FROM cart WHERE username ="'.$_GET["delete_user"].'"';
            $clear = mysqli_query($link, $sql) or die("error");
            $sql ='DELETE FROM member WHERE account ="'.$_GET["delete_user"].'"';
            $clear = mysqli_query($link, $sql) or die("error");
        }
        if(isset($_POST['newaccount']))
        {
            $sql="SELECT * FROM member where level ='2'";
            $n=0;
            if ($result = mysqli_query($link, $sql)) {

                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['account']==$_POST['newaccount'])
                        $n++;
                }     
            
                mysqli_free_result($result); // 釋放佔用的記憶體
            }
            if($n==0)
            {
                $sql ='INSERT INTO member(account, password, level) VALUES ("'.$_POST["newaccount"].'","'.$_POST["newpassword"].'","2")';
                $update = mysqli_query($link, $sql) or die("error");
            }
        }
    }
    else if($_GET['page']=="產品管理") 
    {
        $sql="SELECT * FROM product";
        $state="產品管理";
        if(isset($_POST['newname']))
        {
            $sql="SELECT * FROM product";
            $n=0;
            if ($result = mysqli_query($link, $sql)) {

                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['name']==$_POST['newname'])
                        $n++;
                }     
            
                mysqli_free_result($result); // 釋放佔用的記憶體
            }
            if($n==0)
            {
                $sql ='INSERT INTO product(number, name, price, classify, kind1, kind2, image, picture1, picture2, picture3, picture4, picture5, sales) VALUES ("'.$_POST['newnum'].'","'.$_POST['newname'].'","'.$_POST['newprice'].'","'.$_POST['newclassify'].'","'.$_POST['newkind1'].'","'.$_POST['newkind2'].'","doggy'.$_POST['newnum'].'.jpg","doggy'.$_POST['newnum'].'-1.jpg","doggy'.$_POST['newnum'].'-2.jpg","doggy'.$_POST['newnum'].'-3.jpg","doggy'.$_POST['newnum'].'-4.jpg","doggy'.$_POST['newnum'].'-5.jpg","0")';
                $update = mysqli_query($link, $sql) or die("error");
            }
        }
        if(isset($_POST['1_name']))
        {
            $sql="SELECT * FROM product";
            if ($result = mysqli_query($link, $sql)) {
                while($row = mysqli_fetch_assoc($result))
                {
                    $sql ='UPDATE product SET name="'.$_POST[$row["number"]."_name"].'",price="'.$_POST[$row["number"]."_price"].'",classify="'.$_POST[$row["number"]."_classify"].'" WHERE number = "'.$row["number"].'"';
                    $update = mysqli_query($link, $sql) or die("error");
                }     
            
                mysqli_free_result($result); // 釋放佔用的記憶體
            }
        }
        if(isset($_GET['delete_product']))
        {
            $sql ='DELETE FROM product WHERE number ="'.$_GET['delete_product'].'"';
            $clear = mysqli_query($link, $sql) or die("error");
        }
    } 
    $rows="";
    if($state=="訂單管理")
    {
        $sql="SELECT * FROM userorder ";
        $rows.='<thead><tr><th class="product-name">訂單內容</th><th class="product-price">總價格</th><th class="product-quantity">出貨狀態</th><th class="product-subtotal">會員</th><th class="product-subtotal"></th></tr></thead><tbody>';
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {

                if($row['state']==1)
                {
                    $s="尚未寄出";
                    $cancel = '<a href="manager.php?page=訂單管理&cancel='.$row["order_no"].'" class="checkout-button button alt wc-forward">刪除訂單</a><a href="manager.php?page=訂單管理&send_order='.$row["order_no"].'" class="checkout-button button alt wc-forward">寄出訂單</a>';
                }
                else 
                {
                    $s="訂單已寄出";
                    $cancel = '';
                }
                $rows.='<tr class="woocommerce-cart-form__cart-item cart_item"><td class="product-name" data-title="商品">'.$row['buy'].'</><td class="product-price" data-title="價格"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["total"].'</bdi></span></td><td class="product-name" data-title="狀態">'.$s.'</><td class="user-name" data-title="會員" style="text-transform:lowercase;">'.$row['username'].'</><td class="product-name" data-title="取消">'.$cancel.'</></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $rows.='</tbody>'; 
    }
    else if($state=="帳號管理")
    {
        $sql="SELECT * FROM member where level ='2'";
        $rows.='<thead><tr><th class="product-name">帳號</th><th class="product-price">密碼</th><th class="product-subtotal"></th></tr></thead><tbody>';
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {
                $rows.='<tr><td style="text-transform:lowercase;">'.$row['account'].'</td><td style="text-transform:lowercase;">'.$row['password'].'</td><td><a href="manager.php?page=帳號管理&delete_user='.$row["account"].'" class="checkout-button button alt wc-forward">刪除用戶</a></td></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $rows.='<tr><td ><input type="text" name="newaccount" id="newaccount" value=""></td><td><input type="text" name="newpassword" id="newpassword" value=""></td><td><button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="check" value="新增用戶">新增用戶</button></td></tr>';
        $rows.='</tbody>';
        

    }
    else if($state=="產品管理")
    {
        $no=0;
        $sql="SELECT * FROM product ";
        $rows.='<thead><tr><th class="product-thumbnail">&nbsp;</th><th class="product-name">名稱</th><th class="product-price">價格</th><th class="product-quantity">款式</th><th class="product-subtotal">分類</th><th class="product-subtotal">貨號</th><th class="product-remove">&nbsp;</th></tr></thead><tbody>';
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {
                $no=$row['number'];
                $kind = $row['kind1']."/".$row['kind2'];
                $rows.='<tr><td class="product-thumbnail"><img width="150" height="150" src="images/'.$row["image"].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></td><td class="product-name" data-title="商品"><input type="text" name="'.$row['number'].'_name" id="'.$row['number'].'_name" value="'.$row['name'].'"></td><td class="product-price" data-title="價格"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span><input type="text" name="'.$row['number'].'_price" id="'.$row['number'].'_price" value="'.$row['price'].'"></bdi></span></td><td class="product-quantity" data-title="款式">'.$kind.'</td><td><input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="清潔用品" ';
                if($row['classify']=="清潔用品") $rows.='checked';
                $rows.='>清潔用品<input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="生活用品" ';
                if($row['classify']=="生活用品") $rows.='checked';
                $rows.='>生活用品<input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="外出用具" ';
                if($row['classify']=="外出用具") $rows.='checked';
                $rows.='>外出用具<input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="食物" ';
                if($row['classify']=="食物") $rows.='checked';
                $rows.='>食物<input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="衣服" ';
                if($row['classify']=="衣服") $rows.='checked';
                $rows.='>衣服<input type="radio" class="radio-inline" id="'.$row['number'].'_classify" name="'.$row['number'].'_classify" value="玩具" ';
                if($row['classify']=="玩具") $rows.='checked';
                $rows.='>玩具</><td class="product-quantity" data-title="貨號">'.$row['number'].'</td><td><a href="manager.php?page=產品管理&&delete_product='.$row["number"].'" class="checkout-button button alt wc-forward">移除產品</a></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $no++;
        $rows.='<tr><td><button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="check" value="儲存修改">儲存修改</button></></tr></tbody></table></form>';
        $rows.='<form class="woocommerce-cart-form" action="manager.php?page='.$state.'" method="POST" id="form2" name="form2"><table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0"><tr><td>名稱</td><td>價格</td><td>款式</td><td>分類</td></tr>';
        $rows.='<tr><td><input type="text" name="newname" id="newname" value=""></td><td><input type="text" name="newprice" id="newprice" value=""></td><td><input type="text" name="newkind1" id="newkind1" value=""><input type="text" name="newkind2" id="newkind2" value=""></td><td ><input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="清潔用品">清潔用品<input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="生活用品">生活用品<input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="外出用具">外出用具<input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="食物">食物<input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="衣服">衣服<input type="radio" class="radio-inline" id="newclassify" name="newclassify" value="玩具">玩具</td><td><input type="hidden" name="newnum" id="newnum" value="'.$no.'">'.$no.'</td><td><button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="check" value="新增產品">新增產品</button></td></tr>';

    }


    mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html class="html" lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title><?php echo $state;?> &#8211; 狗物網</title>
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
                            管理員頁面 </div>
                        <!-- .page-subheading -->



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="manager.php"" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">管理者頁面</span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="2" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="manager.php?page=<?php echo $state; ?>" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo $state; ?></span></a>
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
                                
                                <ul class="products oceanwp-row clr grid">
                                <form class="woocommerce-cart-form" action="manager.php?page=<?php echo $state;?>" method="POST" id="form1" name="form1">

                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                        
                                    
                                            <?php echo $rows;?>
                                                   

                                        
                                    </table>
                                </form>

                                    
                                </ul>
                               

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
                                    <li class="cat-item cat-item-31 <?php if($state=="訂單管理")echo 'current-cat';?>"><a href="manager.php?page=<?php echo "訂單管理"; ?>">訂單管理</a></li>
                                    <li class="cat-item cat-item-35 <?php if($state=="帳號管理")echo 'current-cat';?>"><a href="manager.php?page=<?php echo "帳號管理"; ?>">帳號管理</a></li>
                                    <li class="cat-item cat-item-30 <?php if($state=="產品管理")echo 'current-cat';?>"><a href="manager.php?page=<?php echo "產品管理"; ?>">產品管理</a></li>
                                    <li class="cat-item cat-item-30 "><a href="member.php"">會員模擬頁面</a></li>
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