<?php
    include("link_sql.php");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    if(!empty($_POST['username']))
    {
        $sql="SELECT * FROM member where account = '".$_POST['username']."';";
        $i=0;
        //資料庫查詢(送出查詢的SQL指令)
        if ($result = mysqli_query($link, $sql)) {
            while($row = mysqli_fetch_assoc($result))
                $i++; 
            mysqli_free_result($result); // 釋放佔用的記憶體    
        }

        if($i==0)
        {
            $sql="INSERT INTO member(account, password, level, email, id_number, gender) VALUES ('".$_POST['username']."','".$_POST['password']."','2','".$_POST['email']."','".$_POST['id_number']."','".$_POST['gender']."')";
            $update = mysqli_query($link, $sql) or die("error");
            echo '<script language="JavaScript">;alert("註冊成功，前去登入吧");location.href="login.php";</script>;';
            
        }
        else{
 
            echo '<script language="JavaScript">;alert("這個名字已經有人使用了，換一個吧");location.href="sign_up.php";</script>;';
             
        }
    }
    
    mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html class="html" lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title>註冊會員 &#8211; 狗物網</title>
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
                        minlength: 4,
                        maxlength: 10
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 12
                    },
                    password2: {
                        required: true,
                        equalTo: "#password"
                    },
                    id_number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    gender: {
                        required: true
                    },
                    agree: {
                        required: true
                    },
                    //checkbox若使用相同名稱
                    //"hobby[]": {
                    //required: true,
                    //minlength: 2,
                    // maxlength: 3
                    //},
                    hobby_1: {
                        require_from_group: [1, ".hobby_group"]
                    },
                    hobby_2: {
                        require_from_group: [1, ".hobby_group"]
                    },
                    hobby_3: {
                        require_from_group: [1, ".hobby_group"]
                    },
                    hobby_4: {
                        require_from_group: [1, ".hobby_group"]
                    },
                    hobby_5: {
                        require_from_group: [1, ".hobby_group"]
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
                    password2: {
                        required: "此為必填項目",
                        equalTo: "兩次密碼不相符"
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
                    },
                    hobby_1: {
                        require_from_group: ""
                    },
                    hobby_2: {
                        require_from_group: ""
                    },
                    hobby_3: {
                        require_from_group: ""
                    },
                    hobby_4: {
                        require_from_group: ""
                    },
                    hobby_5: {
                        require_from_group: "請至少選擇1項偏好"
                    },
                    agree: {
                        required: "請勾選同意"
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


                        <h1 class="page-header-title clr" itemprop="headline">註冊會員</h1>



                        <nav aria-label="Breadcrumbs" class="site-breadcrumbs clr position-" itemprop="breadcrumb">
                            <ol class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3" />
                                <meta name="itemListOrder" content="Ascending" />
                                <li class="trail-item trail-begin" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="index.php" rel="home" aria-label="首頁" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name"><span class="icon-home" aria-hidden="true"></span><span class="breadcrumb-home has-icon">首頁</span></span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="1" itemprop="position" />
                                </li>
                                <li class="trail-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="login.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">我的帳號</span></a>
                                    <span class="breadcrumb-sep">></span>
                                    <meta content="2" itemprop="position" />
                                </li>
                                <li class="trail-item trail-end" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="sign_up.php" itemtype="https://schema.org/Thing" itemprop="item"><span itemprop="name">註冊會員</span></a>
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


                        <div id="content" class="site-content clr">



                            <article class="single-page-article clr">


                                <div class="entry clr" itemprop="text">


                                    <div class="woocommerce">
                                        <div class="woocommerce-notices-wrapper"></div>
                                        <div class="oceanwp-loginform-wrap">
                                            <ul class="owp-account-links registration-disabled">
                                                <li class="login"><span class="owp-account-link current">註冊會員</span></li>
                                            </ul>
                                            <h2>註冊會員</h2>
                                            <form class="woocommerce-form woocommerce-form-login login" name="form1" id="form1" antion="sign_up.php" method="POST">


                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="username">使用者名稱 &nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="" placeholder="限4-10個字" /> 
                                                    <label for="username" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="password">密碼&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="限6-12個字" />
                                                    <label for="password" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="password2">密碼確認&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password2" id="password2" autocomplete="current-password" />
                                                    <label for="password2" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="email">電子郵件 &nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="email" autocomplete="email" value="" /> 
                                                    <label for="email" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="id_number">身分證字號 &nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="id_number" id="id_number" autocomplete="id_number" value="" /> 
                                                    <label for="id_number" class="error">
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="gender">性別 &nbsp;<span class="required">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" class="radio-inline" id="gender1" name="gender" value="男">男
                                                        <input type="radio" class="radio-inline" id="gender2" name="gender" value="女">女
                                                        <label for="gender" class="error"></label>
                                                    </div>
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="hobby">偏好 &nbsp;<span class="required">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_1">生活用品
                                                        <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_2">外出用具
                                                        <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_3">食物
                                                        <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_4">衣服
                                                        <input type="checkbox" class="checkbox-inline hobby_group" name="hobby_5">玩具
                                                        <label for="hobby_5" class="error">
				                                    </div>			
                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <div class="col-sm-8">
                                                        <input type="radio" class="radio-inline" id="agree" name="agree">我已閱讀並同意  
                                                        <a href="buyrule.php">購物須知</a> 及 <a href="secretrule.php">隱私權政策</a>
                                                        <label for="agree" class="error"></label>
                                                    </div>
                                                </p>
                                                <p class="form-row">
                                                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="check" value="確認">確認</button>
                                                </p>
                                                <p class="form-row">
                                                    <button type="reset" class="woocommerce-button button woocommerce-form-login__submit" name="reset" value="重填">重填</button>
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




    <script src="https://ecc.tw/wp-admin/admin-ajax.php?action=mercator-sso-js&#038;host=ada531th.com&#038;back=https%3A%2F%2Fada531th.com%2Fmy-account%3Fv%3D669b91705b38&#038;site=343&#038;nonce=b2c746d944"></script>
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
    <script type="text/javascript">
        (function() {
            var c = document.body.className;
            c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
            document.body.className = c;
        })()
    </script>
    <!-- <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/wp-ultimo//inc/setup/js/jquery.blockUI.js?ver=1.10.13' id='jquery-blockui-js'></script> -->
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
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.6' id='selectWoo-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=7.4.4' id='wp-polyfill-js'></script>
    <script type='text/javascript' id='wp-polyfill-js-after'>
        ('fetch' in window) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-fetch.min.js?ver=3.0.0"></scr' + 'ipt>');
        (document.contains) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-node-contains.min.js?ver=3.42.0"></scr' + 'ipt>');
        (window.DOMRect) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-dom-rect.min.js?ver=3.42.0"></scr' + 'ipt>');
        (window.URL && window.URL.prototype && window.URLSearchParams) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-url.min.js?ver=3.6.4"></scr' + 'ipt>');
        (window.FormData && window.FormData.prototype.keys) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-formdata.min.js?ver=3.0.12"></scr' + 'ipt>');
        (Element.prototype.matches && Element.prototype.closest) || document.write('<script src="https://ada531th.com/wp-includes/js/dist/vendor/wp-polyfill-element-closest.min.js?ver=2.0.2"></scr' + 'ipt>');
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/dist/i18n.min.js?ver=772b1b30d38ec9ba77ae8ae1a39b232a' id='wp-i18n-js'></script>
    <script type='text/javascript' id='password-strength-meter-js-extra'>
        /* <![CDATA[ */
        var pwsL10n = {
            "unknown": "\u5bc6\u78bc\u5f37\u5ea6\u672a\u77e5",
            "short": "\u975e\u5e38\u4f4e",
            "bad": "\u4f4e",
            "good": "\u4e2d",
            "strong": "\u9ad8",
            "mismatch": "\u4e0d\u76f8\u7b26"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' id='password-strength-meter-js-translations'>
        (function(domain, translations) {
            var localeData = translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2021-05-13 03:12:15+0000",
            "generator": "GlotPress\/3.0.0-alpha.2",
            "domain": "messages",
            "locale_data": {
                "messages": {
                    "": {
                        "domain": "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        "lang": "zh_TW"
                    },
                    "%1$s is deprecated since version %2$s! Use %3$s instead. Please consider writing more inclusive code.": ["\u5f9e %2$s \u7248\u958b\u59cb\uff0c%1$s \u5df2\u6dd8\u6c70\u4e0d\u7528\uff0c\u8acb\u6539\u7528 %3$s\u3002\u5efa\u8b70\u64b0\u5beb\u66f4\u5177\u5305\u5bb9\u6027\u7684\u7a0b\u5f0f\u78bc\u3002"]
                }
            },
            "comment": {
                "reference": "wp-admin\/js\/password-strength-meter.js"
            }
        });
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-admin/js/password-strength-meter.min.js?ver=5.5.5' id='password-strength-meter-js'></script>
    <script type='text/javascript' id='wc-password-strength-meter-js-extra'>
        /* <![CDATA[ */
        var wc_password_strength_meter_params = {
            "min_password_strength": "3",
            "stop_checkout": "",
            "i18n_password_error": "\u8acb\u8f38\u5165\u4e00\u500b\u8907\u96dc\u4e00\u9ede\u7684\u5bc6\u78bc",
            "i18n_password_hint": "\u63d0\u793a: \u5efa\u8b70\u5bc6\u78bc\u61c9\u8a72\u81f3\u5c11\u8981\u6709 12 \u500b\u5b57\u5143\uff0c\u4e26\u5728\u5bc6\u78bc\u4e2d\u540c\u6642\u4f7f\u7528\u5927\u5c0f\u5beb\u5b57\u6bcd\u3001\u6578\u5b57\u53ca <code>! \" ? $ % ^ & )<\/code> \u7b49\u7279\u6b8a\u7b26\u865f\uff0c\u4fbf\u80fd\u8b93\u5bc6\u78bc\u66f4\u5b89\u5168\u3002"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/frontend/password-strength-meter.min.js?ver=4.6.2' id='wc-password-strength-meter-js'></script>
    <script type='text/javascript' id='wc-geolocation-js-extra'>
        /* <![CDATA[ */
        var wc_geolocation_params = {
            "wc_ajax_url": "\/ada\/?wc-ajax=%%endpoint%%",
            "home_url": "https:\/\/ada531th.com",
            "is_available": "0",
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
    <!-- <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-quick-view.min.js?ver=1.0' id='oceanwp-woo-quick-view-js'></script> -->
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
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/woocommerce/assets/js/flexslider/jquery.flexslider.min.js?ver=2.7.2' id='flexslider-js'></script>
    <!-- <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-mini-cart.min.js?ver=1.0' id='oceanwp-woo-mini-cart-js'></script> -->
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/imagesloaded.min.js?ver=4.1.4' id='imagesloaded-js'></script>
    <!-- <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/woo/woo-scripts.min.js?ver=1.0' id='oceanwp-woocommerce-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/magnific-popup.min.js?ver=1.0' id='magnific-popup-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/lightbox.min.js?ver=1.0' id='oceanwp-lightbox-js'></script> -->
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
    <!-- <script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/main.min.js?ver=1.0' id='oceanwp-main-js'></script>
    <script type='text/javascript' src='https://ada531th.com/wp-content/plugins/ocean-sticky-header/assets/js/main.min.js' id='osh-js-scripts-js'></script> -->
    <script type='text/javascript' src='https://ada531th.com/wp-includes/js/wp-embed.min.js?ver=5.5.5' id='wp-embed-js'></script>
    <!--[if lt IE 9]>
<script type='text/javascript' src='https://ada531th.com/wp-content/themes/oceanwp/assets/js/third/html5.min.js?ver=1.0' id='html5shiv-js'></script>
<![endif]-->
</body>

</html>