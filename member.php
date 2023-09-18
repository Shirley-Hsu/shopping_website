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
    if(isset($_GET['cancel']))
    {
        $sql ='DELETE FROM userorder WHERE order_no ="'.$_GET["cancel"].'"';
        $clear = mysqli_query($link, $sql) or die("error");
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
        $sql="SELECT * FROM userorder where username ='".$_SESSION['name']."'";
        $state="我的訂單";
    }  
    else if($_GET['page']=="我的訂單")
    {
        $sql="SELECT * FROM userorder where username ='".$_SESSION['name']."'";
        $state="我的訂單";
    }
    else if($_GET['page']=="我的帳號")
    {
        $sql="SELECT * FROM member where account ='".$_SESSION['name']."'";
        $state="我的帳號";
    }  
    $rows="";
    if($state=="我的訂單")
    {
        $rows.='<thead><tr><th class="product-name">訂單內容</th><th class="product-price">總價格</th><th class="product-quantity">出貨狀態</th><th class="product-subtotal"></th></tr></thead><tbody>';
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {

                if($row['state']==1)
                {
                    $s="尚未寄出";
                    $cancel = '<a href="member.php?page=我的訂單&&cancel='.$row["order_no"].'" class="checkout-button button alt wc-forward">取消訂單</a>';
                }
                else 
                {
                    $s="訂單已寄出";
                    $cancel = '無法取消，如有疑問請洽服務人員';
                }
                $rows.='<tr class="woocommerce-cart-form__cart-item cart_item"><td class="product-name" data-title="商品">'.$row['buy'].'</><td class="product-price" data-title="價格"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["total"].'</bdi></span></td><td class="product-name" data-title="狀態">'.$s.'</><td class="product-name" data-title="取消">'.$cancel.'</></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $rows.='</tbody>'; 
    }
    else if($state=="我的帳號")
    {
        $sql="SELECT * FROM member where account ='".$_SESSION['name']."'";
        $rows.='<thead><tr><th class="product-name">項目</th><th class="product-price">內容</th></tr></thead><tbody>';
        if ($result = mysqli_query($link, $sql)) {

            while($row = mysqli_fetch_assoc($result))
            {
                $rows.='<tr><td class="product-name">帳號:</td><td><input type="text" name="account" id="account" value="'.$row['account'].'"></td></tr><tr><td class="product-name" >密碼:</td><td><input type="text" name="password" id="password" value="'.$row['password'].'"></td></tr><tr><td class="product-name">電子郵件:</td><td><input type="text" name="email" id="email" value="'.$row['email'].'"></td></tr><tr><td class="product-name">身分證字號:</td><td><input type="text" name="id_number" id="id_number" value="'.$row['id_number'].'"></td></tr><tr><td class="product-name">性別:</td><td><input type="radio" class="radio-inline" id="gender1" name="gender" value="男" ';
                if($row['gender']=="男") $rows.='checked';
                $rows.='>男 <input type="radio" class="radio-inline" id="gender2" name="gender" value="女" ';
                if($row['gender']=="女") $rows.='checked';
                $rows.='>女</td></tr><tr><td><button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="check" value="儲存修改">儲存修改</button></></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        $rows.='</tbody>';
        

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
    <script>
        $(document).ready(function($) {

            $("#form1").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 10
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 12
                    },
                    id_number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true
                    }
                    
                },
                messages: {
                    username: {
                        required: "帳號為必填欄位",
                        minlength: "帳號最少要4個字",
                        maxlength: "帳號最長10個字"
                    },
                    password: {
                        required: "此為必填項目",
                        minlength: "密碼最少要6個字",
                        maxlength: "密碼最長12個字"
                    },
                    id_number: {
                        required: "此為必填項目",
                        minlength: "請輸入正確的身分證字號",
                        maxlength: "請輸入正確的身分證字號"
                    },
                    email: {
                        required: "此為必填項目",
                        email: "必須符合mail的格式"
                    },
                    gender: {
                        required: "此為必填項目"
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
                            會員管理 </div>
                        <!-- .page-subheading -->



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="member.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">會員管理</span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="2" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="member.php?page=<?php echo $state; ?>" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo $state; ?></span></a>
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
                                <form class="woocommerce-cart-form" action="member.php?page=<?php echo $state;?>" method="POST" id="form1" name="form1">

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
                                    <li class="cat-item cat-item-31 <?php if($state=="我的訂單")echo 'current-cat';?>"><a href="member.php?page=<?php echo "我的訂單"; ?>">我的訂單</a></li>
                                    <li class="cat-item cat-item-35 <?php if($state=="我的帳號")echo 'current-cat';?>"><a href="member.php?page=<?php echo "我的帳號"; ?>">我的帳號</a></li>

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