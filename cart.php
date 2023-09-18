<?php
session_start();
include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    
if (isset($_SESSION['cart'])) {
    $cnt = count($_SESSION['cart'])/3;
} else 
{
    $cnt = 0;
} 

if(isset($_GET['to_order']))  
{

$buy="";
$total=0;
for($i=0;$i<$cnt;$i++)
{
    $id=intval($_SESSION['cart'][$i*3]);
    $kind = $_SESSION['cart'][$i*3+1];
    if($kind=="")$kind="隨機";
    $quantity=intval($_SESSION['cart'][$i*3+2]);
    $sql="SELECT * FROM product where number = ".$id;
    if ($result = mysqli_query($link, $sql)) {
        while($row = mysqli_fetch_assoc($result))
        {
            $buy.=$row['name']."--".$kind."*".$quantity."<br>";
            $pay=$quantity * $row['price'];
            $total+=$pay;
            $sale=$row['sales']+$quantity;
            $sql="UPDATE product SET sales='".$sale."' WHERE number='".$id."'";
            $update = mysqli_query($link, $sql) or die("error");
        }     
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
} 
$sql="SELECT * FROM userorder order by order_no DESC";
$order_cnt=0;
if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $order_cnt=$row['order_no'];    
mysqli_free_result($result); // 釋放佔用的記憶體
}
$order_cnt++;

$sql="INSERT INTO userorder(username, state, order_no, buy, total) VALUES ('".$_SESSION['name']."','1','".$order_cnt."','".$buy."','".$total."')";
if($cnt!=0) $update = mysqli_query($link, $sql) or die("error");
$sql ='DELETE FROM cart WHERE username ="'.$_SESSION["name"].'"';
$clear = mysqli_query($link, $sql) or die("error");
$_SESSION['cart'] = array();
echo '<script language="JavaScript">;;location.href="member.php?page=我的訂單";</script>;';

}  
if(!isset($_SESSION['name']))
{
    echo '<script language="JavaScript">;location.href="login.php";</script>;';
}
else if(isset($_GET['id']))
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = Array();
    }
    
    $id = $_GET['id'];//商品ID
    if(isset($_GET['kind']))$kind = $_GET['kind'];
    else $kind="隨機";
    $quantity = $_GET['quantity'];

       $_SESSION['cart'][]=$id;//加入陣列
       $_SESSION['cart'][]=$kind;//加入陣列
       $_SESSION['cart'][]=$quantity;//加入陣列
    

    //返回上一頁
    $url = $_SERVER['HTTP_REFERER'];
    echo '<script language="JavaScript">;alert("成功加入購物車");location.href="'.$url.'";</script>;';

}
else{
    
    if(isset($_GET['remove_id']))
    {
        for($i=0;$i<$cnt;$i++)
        {
            if(intval($_SESSION['cart'][$i*3]) == $_GET['remove_id'])
            {
                array_splice($_SESSION['cart'], $i*3, 3);
                $cnt--;
                break;
            }
        }
    }
    $total=0;
    $rows="";
    for($i=0;$i<$cnt;$i++)
    {
        $id=intval($_SESSION['cart'][$i*3]);
        $kind = $_SESSION['cart'][$i*3+1];
        if(isset($_POST[$id.'_quantity'])) $_SESSION['cart'][$i*3+2]=$_POST[$id.'_quantity'];
        $quantity=intval($_SESSION['cart'][$i*3+2]);
        $sql="SELECT * FROM product where number = ".$id;
        if ($result = mysqli_query($link, $sql)) {
            while($row = mysqli_fetch_assoc($result))
            {
                $pay=$quantity * $row['price'];
                $total+=$pay;
                    $rows.='<tr class="woocommerce-cart-form__cart-item cart_item"><td class="product-remove"><a href="cart.php?remove_id='.$id.'" class="remove" aria-label="移除這項商品"  data-product_sku="">&times;</a><td class="product-thumbnail"><a href="product.php?number='.$id.'"><img width="200" height="200" src="images/'.$row["image"].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" srcset="" sizes="(max-width: 300px) 100vw, 300px" /></a></td><td class="product-name" data-title="商品"><a href="product.php?number='.$row["number"].'">'.$row["name"].'</a> </td><td class="product-price" data-title="價格"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$row["price"].'</bdi></span></td><td class="product-quantity" data-title="數量"><div class="quantity"><label class="screen-reader-text" for="quantity_60cf065a94de8">'.$row["name"].' 數量</label><input type="number" id="'.$id.'_quantity" class="input-text qty text" step="1" min="0" max="" name="'.$id.'_quantity" value="'.$quantity.'" title="數量" size="'.$quantity.'" placeholder="" inputmode="numeric" /></div></td><td class="product-subtotal" data-title="小計"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span>'.$pay.'</bdi></span></td></tr>';
            }     
        
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
    }
}


mysqli_close($link); // 關閉資料庫連結
?>
    <!DOCTYPE html>
    <html class="html" lang="zh-TW">

    <head>
        <meta charset="UTF-8">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <title>購物車 &#8211; 狗物網</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='dns-prefetch' href='//ecc.tw' />
        <link rel='dns-prefetch' href='//s.w.org' />
        <?php include("link.php") ?>
        <link rel='stylesheet' id='whole' href='css/whole.css' type='text/css' media='all' />

    </head>

    <body class="page-template-default page page-id-360 wp-embed-responsive theme-oceanwp no-isotope no-lightbox no-fitvids no-scroll-top no-sidr no-carousel no-matchheight woocommerce-account woocommerce-page woocommerce-no-js oceanwp-theme dropdown-mobile no-header-border default-breakpoint content-full-width content-max-width page-with-background-title has-breadcrumbs has-blog-grid has-grid-list account-original-style elementor-default elementor-kit-598"
        itemscope="itemscope" itemtype="https://schema.org/WebPage">




        <div id="outer-wrap" class="site clr">


            <div id="wrap" class="clr">



                <?php include("header.php") ?>
                <!-- #site-header -->





                <main id="main" class="site-main clr" role="main">



                    <header class="page-header background-image-page-header">


                        <div class="container clr page-header-inner">


                            <h1 class="page-header-title clr" itemprop="headline">購物車</h1>



                            <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                                <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                    <meta name="numberOfItems" content="2" />
                                    <meta name="itemListOrder" content="Ascending" />
                                    <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                        <span class="breadcrumb-sep">></span>
                                        <meta content="1" itemprop="position" />
                                    </li>
                                    <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="cart.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">購物車</span></a>
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
                                            <form class="woocommerce-cart-form" action="cart.php" method="POST">

                                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-remove">&nbsp;</th>
                                                            <th class="product-thumbnail">&nbsp;</th>
                                                            <th class="product-name">商品</th>
                                                            <th class="product-price">價格</th>
                                                            <th class="product-quantity">數量</th>
                                                            <th class="product-subtotal">小計</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php echo $rows;?>


                                                        <tr>
                                                            <td colspan="6" class="actions">
                                                                <button type="submit" class="button" name="update_cart" value="更新購物車" >更新購物車</button>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </form>


                                            <div class="cart-collaterals">
                                                <div class="cart_totals ">


                                                    <h2>購物車總計</h2>

                                                    <table cellspacing="0" class="shop_table shop_table_responsive">

                                                        <tr class="order-total">
                                                            <th>總計</th>
                                                            <td data-title="總計"><strong><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#78;&#84;&#36;</span><?php echo $total;?></bdi></span></strong> </td>
                                                        </tr>


                                                    </table>

                                                    <div class="wc-proceed-to-checkout">
                                                        <a href="cart.php?to_order=1" id="btn_order" name="btn_order" class="checkout-button button alt wc-forward">	一鍵下訂</a>
                                                    </div>


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