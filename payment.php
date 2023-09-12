<? session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php/get_info.php');


if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
    $carts = array_unique($_SESSION['cart']);

    // Получаем количество каждого элемента в $_SESSION['cart']
    $counts = array_count_values($_SESSION['cart']);
    $sum = 0;
    foreach ($carts as $cart_el) {
        $product = get_info_product_by_name($cart_el);
        $price1 = $product['price'];
        $count1 = $counts[$cart_el];
        $sum1 +=  $price1 * $count1;
    }
}

?>
<!doctype html>
<html dir="ltr" style="background-color: rgb(255, 255, 255);">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, user-scalable=0">
    <meta name="referrer" content="origin">
    <link href="https://cdn.shopify.com/shopifycloud/checkout-web/assets/185.latest.de.732f7b974901dd81c606.css" crossorigin="anonymous" rel="stylesheet">
    <link href="https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.latest.de.e05b480d590740181b2d.css" crossorigin="anonymous" rel="stylesheet">
    <link href="https://cdn.shopify.com/shopifycloud/checkout-web/assets/739.latest.de.869d896703321d964e3f.css" crossorigin="anonymous" rel="stylesheet">

    <title data-react-html="true">Information – Neness – Checkout</title>
    <style>
        html {
            font-size: 62.5%;
        }

        body {
            background-color: #ffffff;
        }


        .Loading {
            overflow-y: scroll;
        }

        .Loading #app {
            opacity: 0;
        }

        #app {
            opacity: 1;
            transition: opacity 100ms ease-in-out;
        }

        .Loading .SpinnerWrapper {
            opacity: 1;
        }

        .SpinnerWrapper {
            font-size: 1.4rem;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transition: opacity 100ms ease-in-out;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 4.571428571428571em;
            height: 4.571428571428571em;
            color: #111111;
            pointer-events: none;
        }


        .Spinner {
            opacity: 0;
            -webkit-animation: fade-in 200ms ease-in-out 200ms forwards, rotate 500ms linear 5;
            animation: fade-in 200ms ease-in-out 200ms forwards, rotate 500ms linear 5;
        }

        .SpinnerSVG {
            display: block;
            fill: currentColor;
            max-height: 100%;
            max-width: 100%;
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        .Loading .Spinner {
            -webkit-animation: fade-in 200ms ease-in-out 300ms forwards, rotate 500ms linear infinite;
            animation: fade-in 200ms ease-in-out 300ms forwards, rotate 500ms linear infinite;
        }

        @-webkit-keyframes rotate {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes rotate {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <style type="text/css">
        .gpay-button {
            background-origin: content-box;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: contain;
            border: 0px;
            border-radius: 4px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 1px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            cursor: pointer;
            height: 40px;
            min-height: 40px;
            padding: 12px 24px 10px;
            width: 240px;
        }

        .gpay-button.black {
            background-color: #000;
            box-shadow: none;
        }

        .gpay-button.white {
            background-color: #fff;
        }

        .gpay-button.short,
        .gpay-button.plain {
            min-width: 90px;
            width: 160px;
        }

        .gpay-button.black.short,
        .gpay-button.black.plain {
            background-image: url(https://www.gstatic.com/instantbuy/svg/dark_gpay.svg);
        }

        .gpay-button.black.short.new_style,
        .gpay-button.black.plain.new_style {
            background-image: url(https://www.gstatic.com/instantbuy/svg/refreshedgraphicaldesign/dark_gpay.svg);
            min-width: 160px;
            background-size: contain;
        }

        .gpay-button.white.short,
        .gpay-button.white.plain {
            background-image: url(https://www.gstatic.com/instantbuy/svg/light_gpay.svg);
        }

        .gpay-button.black.active {
            background-color: #5f6368;
        }

        .gpay-button.black.hover {
            background-color: #3c4043;
        }

        .gpay-button.white.active {
            background-color: #fff;
        }

        .gpay-button.white.focus {
            box-shadow: #e8e8e8 0 1px 1px 0, #e8e8e8 0 1px 3px;
        }

        .gpay-button.white.hover {
            background-color: #f8f8f8;
        }

        .gpay-button-fill,
        .gpay-button-fill>.gpay-button.white,
        .gpay-button-fill>.gpay-button.black {
            width: 100%;
            height: inherit;
        }

        .gpay-button-fill-new-style,
        .gpay-button-fill-new-style>.gpay-button.black {
            width: 100%;
            height: inherit;
            background-size: contain;
        }

        .gpay-button-fill>.gpay-button.white,
        .gpay-button-fill>.gpay-button.black {
            padding: 12px 15% 10px;
        }

        .gpay-button.donate,
        .gpay-button.book,
        .gpay-button.checkout,
        .gpay-button.subscribe,
        .gpay-button.pay,
        .gpay-button.order {
            padding: 9px 24px;
        }

        .gpay-button-fill>.gpay-button.donate,
        .gpay-button-fill>.gpay-button.book,
        .gpay-button-fill>.gpay-button.checkout,
        .gpay-button-fill>.gpay-button.order,
        .gpay-button-fill>.gpay-button.pay,
        .gpay-button-fill>.gpay-button.subscribe {
            padding: 9px 15%;
        }

        .gpay-button-fill-new-style>.gpay-button.donate,
        .gpay-button-fill-new-style>.gpay-button.book,
        .gpay-button-fill-new-style>.gpay-button.checkout,
        .gpay-button-fill-new-style>.gpay-button.order,
        .gpay-button-fill-new-style>.gpay-button.pay,
        .gpay-button-fill-new-style>.gpay-button.subscribe {
            padding: 12px 15%;
            background-size: contain;
        }
    </style>
    <style type="text/css">
        .gpay-button.new_style {
            background-size: auto;
            border-radius: 100vh;
            padding: 11px 24px;
            box-sizing: border-box;
            border: 1px solid #747775;
            min-height: 48px;
            font-size: 20px;
            width: auto;
        }
    </style>

</head>

<body class="" style="background-color: rgb(255, 255, 255);">
    <div id="app">
        <div style="--x-color-canvas-accent: rgb(17,17,17); --x-color-canvas-background: rgb(255,255,255); --x-color-canvas-background-subdued: rgb(246,246,246); --x-color-canvas-background-subdued-alpha: rgba(0,0,0,0.045); --x-color-canvas-border: rgb(223,223,223); --x-color-canvas-text: rgb(0,0,0); --x-color-canvas-text-subdued: rgb(112,112,112); --x-color-color1-accent: rgb(17,17,17); --x-color-color1-background: rgb(255,255,255); --x-color-color1-background-subdued: rgb(246,246,246); --x-color-color1-background-subdued-alpha: rgba(0,0,0,0.045); --x-color-color1-border: rgb(223,223,223); --x-color-color1-text: rgb(0,0,0); --x-color-color1-text-subdued: rgb(112,112,112); --x-color-color2-accent: rgb(17,17,17); --x-color-color2-background: rgb(250,250,250); --x-color-color2-background-subdued: rgb(241,241,241); --x-color-color2-background-subdued-alpha: rgba(0,0,0,0.045); --x-color-color2-border: rgb(218,218,218); --x-color-color2-text: rgb(0,0,0); --x-color-color2-text-subdued: rgb(108,108,108); --x-color-interactive-foreground-as-subdued-background: rgb(246,246,246); --x-color-interactive-on-text: rgb(255,255,255); --x-color-interactive-text: rgb(17,17,17); --x-color-interactive-text-hovered: rgb(38,38,38); --x-color-interactive-text-subdued-on-foreground-as-subdued-background: rgb(104,104,104); --swn0j0: rgb(17,17,17); --swn0j1: rgb(38,38,38); --swn0j2: rgb(255,255,255); --swn0j3: rgb(246,246,246); --swn0j5: rgb(104,104,104); --x-color-global-brand: rgb(255,174,38); --swn0j7: rgb(221,149,0); --swn0j6: rgb(221,149,0); --swn0j8: rgb(23,12,0); --swn0j9: rgb(23,12,0); --x-color-global-critical: rgb(255,109,109); --swn0ja: rgb(255,244,244); --swn0jb: rgb(255,236,236); --swn0jc: rgb(255,218,218); --swn0jd: rgb(239,0,0); --x-color-global-critical-on-text: rgb(255,255,255); --x-color-global-critical-on-text-subdued: rgb(255,255,255); --x-color-global-critical-subdued: rgb(255,92,92); --swn0je: rgb(65,0,0); --swn0jf: rgb(105,0,0); --swn0j1y: rgb(17,17,17); --swn0j11: rgb(255,255,255); --swn0j13: rgb(223,223,223); --swn0j1z: rgb(17,17,17); --swn0j12: rgb(0,0,0); --swn0j15: rgb(246,246,246); --swn0j16: rgba(0,0,0,0.045); --swn0j18: rgb(112,112,112); --swn0j17: rgb(255,255,255); --swn0j20: rgb(38,38,38); --swn0j21: rgb(255,255,255); --swn0j22: rgb(246,246,246); --swn0j14: rgb(0, 0, 0); --swn0j24: rgb(104,104,104); --swn0j3z: rgb(17,17,17); --swn0j1h: rgb(250,250,250); --swn0j1j: rgb(218,218,218); --swn0j40: rgb(17,17,17); --swn0j1i: rgb(0,0,0); --swn0j1l: rgb(241,241,241); --swn0j1m: rgba(0,0,0,0.045); --swn0j1o: rgb(108,108,108); --swn0j1n: rgb(255,255,255); --swn0j41: rgb(38,38,38); --swn0j42: rgb(255,255,255); --swn0j43: rgb(246,246,246); --swn0j1k: rgb(0, 0, 0); --swn0j45: rgb(104,104,104);">
            <div class="g9gqqf1 _1fragemfk _1fragemm2 _1fragemer _1fragemeu">
                <div class="_1fragemf6 _1frageme0">
                    <div role="region" aria-labelledby="step-section-primary-header">
                        <div class="Yil88 TpQRn ny1C6"><a href="#checkout-main" class="XSnuw">Direkt zum Inhalt</a>
                            <div class="_1fragemf6 _1frageml8 _1frageme0">
                                <h1 class="n8k95w1 _1frageme0 n8k95w2">Information</h1>
                            </div>
                            <div class="I3DjT Bu997 _1fragemer _1fragemeu _1fragemm2" id="payment_1">
                                <div class="RTcqB">
                                    <header role="banner" class="nBWgL">
                                        <div>
                                            <div class="_1fragemf6 _1fragem8c _1fragem9a _1fragema0 _1fragemb6 _1fragem6g _1fragem7e _1fragembw _1fragemd2 _1frageme0">
                                                <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                                    <style>
                                                        .Layout0>.i602M> :nth-child(1) {
                                                            flex: 0 0 100%;
                                                        }

                                                        .Layout0>.i602M {
                                                            flex-wrap: wrap;
                                                        }

                                                        .Layout0>.i602M {
                                                            max-width: 56rem;
                                                        }

                                                        @media all and (min-width: 1000px) {
                                                            .Layout0>.i602M {
                                                                max-width: 100%;
                                                            }
                                                        }
                                                    </style>
                                                    <div class="i602M AHe4G">
                                                        <div>
                                                            <div>
                                                                <div class="_1fragemf6 _1frageme0">
                                                                    <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemg5 _1fragemgm _1fragemh7 _1fragemhb _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 20.7rem); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 20.7rem); --_16s97g71c: minmax(0, 1fr);">
                                                                        <p class="n8k95w1 _1frageme0 n8k95w2"><a href="https://www.neness-shop.de" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi3 _1fragemlc _1fragemlg"><img src="https://cdn.shopify.com/s/files/1/0615/4479/2259/files/Bildschirmfoto_2023-02-22_um_12.38.41_x320.png?v=1677066018" alt="Neness" class="hmHjN" style="max-width: min(100%, 207px);"></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <aside class="_PiNS CiOA7"><button type="button" aria-pressed="false" aria-controls="disclosure_content" aria-expanded="false" class="go8Cy"><span class="iibJ6">
                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                        <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wui a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                <circle cx="3.5" cy="11.9" r="0.3"></circle>
                                                                <circle cx="10.5" cy="11.9" r="0.3"></circle>
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4">
                                                                </path>
                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Bestellübersicht
                                                            anzeigen<div class="_1fragemfa _16s97g78o _16s97g760"></div>
                                                            <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua a8x1wue _1fragemfa a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                    </path>
                                                                </svg></span></span>
                                                    </div>
                                                </div>
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm _1fragemhc">
                                                    <del translate="yes" class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb notranslate _19gi7ytr _1fragemle">59,40
                                                        €</del>
                                                    <p translate="yes" class="_1x52f9s1 _1frageme0 _1x52f9ss _1fragemfm _1x52f9s2 _1x52f9sh notranslate">
                                                        39,60 €</p>
                                                </div>
                                            </span></button>
                                        <div id="disclosure_content" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                            <div></div>
                                        </div>
                                    </aside>
                                    <div class="dh43e">
                                        <div class="_1fragemf6 _1frageme0">
                                            <div class="m2iHS iRYcu LMdfq">
                                                <div class="V7iL9">
                                                    <div>
                                                        <nav aria-label="Breadcrumb" class="_1fragemf6 _1frageme0">
                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                <ol class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemea _1fragemee _1fragemh9">
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="https://www.neness-shop.de/cart" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Warenkorb</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li aria-current="step" class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7yt1">Information</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Versand</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Zahlung</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Überprüfung</span>
                                                                        </li>
                                                                    </div>
                                                                </ol>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="I_61l">
                                                <div class="tAyc6">
                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg0 _1fragemgh">
                                                            <main id="checkout-main">
                                                                <form action="" method="POST" novalidate="" id="Form1" class="_1fragemf7">
                                                                    <div class="_1frageme0">
                                                                        <div>
                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfx _1fragemge">
                                                                                <div class="_1fragemf6 _1frageme0">
                                                                                    <div>
                                                                                        <div class="UxvQ2"><span class="aHlIb"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Express
                                                                                                    Checkout</span></span>
                                                                                        </div>
                                                                                        <div class="lAHfA">
                                                                                            <div id="express-checkout-wallets-wrapper" class="_19K_ A35vI">
                                                                                                <div id="google-pay-button-container" class="EbuOU">
                                                                                                    <div class="gpay-button-fill">
                                                                                                        <button type="button" aria-label="Google Pay" class="gpay-button black plain short ru" style="background: url(assets/img/paypal.svg) no-repeat;background-color:#ffc439;background-position:center"></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <style>
                                                                                                    button.paypal {
                                                                                                        background: url(assets/img/paypal.svg) no-repeat;
                                                                                                    }
                                                                                                </style>
                                                                                                <div id="google-pay-button-container" class="EbuOU">
                                                                                                    <div class="gpay-button-fill">
                                                                                                        <button type="button" aria-label="Google Pay" class="gpay-button black plain short ru"></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="_1fragemf6 _1fragem8g _1fragem8h _1fragemb4 _1fragemb5 _1fragem6k _1fragem6l _1fragemd0 _1fragemd1 _1frageme0">
                                                                                        <div role="separator" class="_1frageme0 mg7oix1 mg7oix5 _1fragemh5 mg7oix8 _1fragemf8 _1fragemec _1frageme8 mg7oixc">
                                                                                            <div class="mg7oixh">
                                                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1frageml9">
                                                                                                    <span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">ODER</span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="VheJw">
                                                                                <div class="s_qAq">
                                                                                    <section aria-label="Kontakt" class="_1fragemf6 _1frageme0">
                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                                                                                                <h2 id="step-section-primary-header" class="n8k95w1 _1frageme0 n8k95w3">
                                                                                                    Kontakt</h2><span class="_19gi7yt0 _19gi7yth _1fragemfk">Hast
                                                                                                    du ein Konto? <a href="https://www.neness-shop.de/account/login?checkout_url=%2Fcheckouts%2Fcn%2Fc1-be028450e6e991d06b85b5bed54bb8fb" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg">Anmelden</a></span>
                                                                                            </div>
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                    <div class="_1frageme0">
                                                                                                        <label id="email-label" for="email" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">E-Mail</span></span></label>
                                                                                                        <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                            <input id="email" name="email" type="email" aria-labelledby="email-label" autocomplete="shipping email" autofocus="true" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u12 _7ozb2u1j">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>
                                                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg0 _1fragemgh">
                                                                                        <section aria-label="Lieferadresse" class="_1fragemf6 _1frageme0">
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                <h2 class="n8k95w1 _1frageme0 n8k95w3">
                                                                                                    Lieferadresse</h2>
                                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                    <div id="shippingAddressForm">
                                                                                                        <div aria-hidden="false" class="pxSEU">
                                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                    <div class="vTXBW _1fragemev _10vrn9p1 _10vrn9p0 _10vrn9p4">
                                                                                                                        <div>
                                                                                                                            <div class="j2JE7 _1fragemev">
                                                                                                                                <label for="Select0" class="QOQ2V NKh24"><span class="KBYKh"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Land
                                                                                                                                            /
                                                                                                                                            Region</span></span></label><select name="countryCode" id="Select0" required="" autocomplete="shipping country" class="_b6uH _1fragemm2 yA4Q8 vYo81 RGaKd">
                                                                                                                                    <option value="DE">
                                                                                                                                        Deutschland
                                                                                                                                    </option>
                                                                                                                                    <option value="AT">
                                                                                                                                        Österreich
                                                                                                                                    </option>
                                                                                                                                </select>
                                                                                                                                <div class="TUEJq">
                                                                                                                                    <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                                                                                            </path>
                                                                                                                                        </svg></span>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                        <div class="_1frageme0">
                                                                                                                            <label id="TextField1-label" for="TextField1" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Vorname</span></span></label>
                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                <input id="TextField1" name="firstName" required="" type="text" aria-required="true" aria-labelledby="TextField1-label" autocomplete="shipping given-name" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                        <div class="_1frageme0">
                                                                                                                            <label id="TextField2-label" for="TextField2" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Nachname</span></span></label>
                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                <input id="TextField2" name="lastName" required="" type="text" aria-required="true" aria-labelledby="TextField2-label" autocomplete="shipping family-name" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                    <div class="Vob8N R5Ptu">
                                                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                                                            <div>
                                                                                                                                <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                    <div class="_1frageme0">
                                                                                                                                        <label id="address1-label" for="address1" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Adresse</span></span></label>
                                                                                                                                        <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                            <input id="address1" name="address1" required="" type="text" aria-autocomplete="list" aria-controls="address1-options" aria-owns="address1-options" aria-expanded="false" aria-required="true" aria-labelledby="address1-label" aria-haspopup="listbox" role="combobox" autocomplete="shipping address-line1" autocorrect="off" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _1fragemhr _1fragemi1 _7ozb2u11 _7ozb2u1j">
                                                                                                                                            <div class="_1frageme0 _1fragemlw _1fragemeh _1fragemf2 _7ozb2u1g">
                                                                                                                                                <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wui a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                        <path stroke-linecap="round" d="M9.16 9.159a4.194 4.194 0 1 0-5.933-5.93 4.194 4.194 0 0 0 5.934 5.93Zm0 0L12.6 12.6">
                                                                                                                                                        </path>
                                                                                                                                                    </svg></span>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                        <div class="_1frageme0">
                                                                                                                            <label id="TextField4-label" for="TextField4" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Wohnung,
                                                                                                                                        Zimmer,
                                                                                                                                        usw.
                                                                                                                                        (optional)</span></span></label>
                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                <input id="TextField4" name="address2" type="text" aria-required="false" aria-labelledby="TextField4-label" autocomplete="shipping address-line2" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                    <div class="ii1aN">
                                                                                                                        <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                            <div class="_1frageme0">
                                                                                                                                <label id="TextField8-label" for="TextField8" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Postleitzahl</span></span></label>
                                                                                                                                <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                    <input id="TextField8" name="postalCode" required="" type="text" inputmode="numeric" aria-required="true" aria-labelledby="TextField8-label" autocomplete="shipping postal-code" autocapitalize="characters" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j">
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                        <div class="_1frageme0">
                                                                                                                            <label id="TextField9-label" for="TextField9" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Stadt</span></span></label>
                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                                                                <input id="TextField9" name="city" required="" type="text" aria-required="true" aria-labelledby="TextField9-label" autocomplete="shipping address-level2" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                                                                <input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_firstName" name="firstName" autocomplete="shipping given-name"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_lastName" name="lastName" autocomplete="shipping family-name"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address1" name="address1" autocomplete="shipping address-line1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address2" name="address2" autocomplete="shipping address-line2"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_city" name="city" autocomplete="shipping address-level2"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_country" name="country" autocomplete="shipping country"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_zone" name="zone" autocomplete="shipping address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address_level1" name="address-level1" autocomplete="shipping address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_province" name="province" autocomplete="shipping address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_postalCode" name="postalCode" autocomplete="shipping postal-code">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <div class="_1frageme0 _1fragemf8">
                                                                                                            <div class="_1mmswk95 _1frageme0">
                                                                                                                <input type="checkbox" id="save_shipping_information" name="save_shipping_information" class="_1mmswk97 _1fragemhj _1fragemhh _1fragemhl _1fragemhf _1fragemid _1fragemia _1fragemig _1fragemi7 _1fragem4g _1fragem3w _1fragem50 _1fragem3c _1fragemf4 _1fragemf6 _1fragemh5 _1fragem1w _1fragemll _1fragemlf _1fragemlr _1fragemev _1fragemm2">
                                                                                                                <div class="_1mmswk9l _1frageml7 _1fragemkq _1fragemds _1fragemlf _1fragemlu _1fragemll">
                                                                                                                    <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.1 2.8-5.877 8.843a.35.35 0 0 1-.54.054L1.4 7.4">
                                                                                                                            </path>
                                                                                                                        </svg></span>
                                                                                                                </div>
                                                                                                            </div><label for="save_shipping_information" class="_1mmswk9h _1fragemf6 _1fragemd8 _1fragemf4 _1fragembs">Meine
                                                                                                                Informationen
                                                                                                                speichern
                                                                                                                und
                                                                                                                nächstes
                                                                                                                Mal
                                                                                                                schneller
                                                                                                                bezahlen</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </section>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="oQEAZ WD4IV">
                                                                                    <div><button type="button" id="payment_1_button" class="QT4by _1fragemey rqC98 hodFu _7QHNJ VDIfJ j6D1f janiy"><span class="AjwsM">Weiter zum
                                                                                                Versand</span></button>
                                                                                               
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                        <button type="submit" tabindex="-1" aria-hidden="true">Weiter zum
                                                                            Versand</button>
                                                                    </div>
                                                                </form>
                                                            </main>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer role="contentinfo" class="QDqGb">
                                        <div class="HgABA">
                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemea _1fragemee _1fragemfr _1fragemgc _1fragemh9">
                                                    <button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Widerrufsbelehrung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Versandinformationen</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Datenschutzerklärung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">AGB</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Impressum</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Kontaktinformationen</span></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <div class="I3DjT Bu997 _1fragemer _1fragemeu _1fragemm2" id="payment_2" style="display:none">
                                <div class="RTcqB">
                                    <header role="banner" class="nBWgL">
                                        <div>
                                            <div class="_1fragemf6 _1fragem8c _1fragem9a _1fragema0 _1fragemb6 _1fragem6g _1fragem7e _1fragembw _1fragemd2 _1frageme0">
                                                <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                                    <style>
                                                        .Layout0>.i602M> :nth-child(1) {
                                                            flex: 0 0 100%;
                                                        }

                                                        .Layout0>.i602M {
                                                            flex-wrap: wrap;
                                                        }

                                                        .Layout0>.i602M {
                                                            max-width: 56rem;
                                                        }

                                                        @media all and (min-width: 1000px) {
                                                            .Layout0>.i602M {
                                                                max-width: 100%;
                                                            }
                                                        }
                                                    </style>
                                                    <div class="i602M AHe4G">
                                                        <div>
                                                            <div>
                                                                <div class="_1fragemf6 _1frageme0">
                                                                    <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemg5 _1fragemgm _1fragemh7 _1fragemhb _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 20.7rem); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 20.7rem); --_16s97g71c: minmax(0, 1fr);">
                                                                        <p class="n8k95w1 _1frageme0 n8k95w2"><a href="https://www.neness-shop.de" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi3 _1fragemlc _1fragemlg"><img src="https://cdn.shopify.com/s/files/1/0615/4479/2259/files/Bildschirmfoto_2023-02-22_um_12.38.41_x320.png?v=1677066018" alt="Neness" class="hmHjN" style="max-width: min(100%, 207px);"></a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <aside class="_PiNS CiOA7"><button type="button" aria-pressed="false" aria-controls="disclosure_content" aria-expanded="false" class="go8Cy"><span class="iibJ6">
                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wui a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                <circle cx="3.5" cy="11.9" r="0.3"></circle>
                                                                <circle cx="10.5" cy="11.9" r="0.3"></circle>
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4"></path>
                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Bestellübersicht anzeigen<div class="_1fragemfa _16s97g78o _16s97g760"></div><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua a8x1wue _1fragemfa a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6"></path>
                                                                </svg></span></span></div>
                                                </div>
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm _1fragemhc">
                                                    <p translate="yes" class="_1x52f9s1 _1frageme0 _1x52f9ss _1fragemfm _1x52f9s2 _1x52f9sh notranslate">6,80 €</p>
                                                </div>
                                            </span></button>
                                        <div id="disclosure_content" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                            <div></div>
                                        </div>
                                    </aside>
                                    <div class="dh43e">
                                        <div class="_1fragemf6 _1frageme0">
                                            <div class="m2iHS iRYcu LMdfq">
                                                <div class="V7iL9">
                                                    <div>
                                                        <nav aria-label="Breadcrumb" class="_1fragemf6 _1frageme0">
                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                <ol class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemea _1fragemee _1fragemh9">
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="https://www.neness-shop.de/cart" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Warenkorb</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_2_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Information</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9" aria-current="step"><span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7yt1">Versand</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Zahlung</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Überprüfung</span></li>
                                                                    </div>
                                                                </ol>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="I_61l">
                                                <div class="tAyc6">
                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg0 _1fragemgh">
                                                            <section aria-label="Überprüfung" class="_1fragemf6 _1frageme0">
                                                                <div role="table" aria-label="Überprüfe deine Daten" class="_1fragemev lT5DX">
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Kontakt</span></div>
                                                                            <div role="cell" class="nkp8r"><bdo dir="ltr" class="_19gi7yt0 _19gi7yth _1fragemfk" id="email_input">dadad432@mail.ru</bdo></div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Kontaktdaten ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Liefern an</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                    <address class="_19gi7yt0 _19gi7yth _1fragemfk" id="info">DDR Museum, 423, 10178 Berlin, Deutschland</address>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Lieferadresse ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <main id="checkout-main">
                                                                <form action="" method="POST" novalidate="" id="Form4" class="_1fragemf7">
                                                                    <div class="_1frageme0">
                                                                        <div>
                                                                            <div class="VheJw">
                                                                                <div class="s_qAq">
                                                                                    <section aria-label="Versand" class="_1fragemf6 _1frageme0">
                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                                <h2 id="step-section-primary-header" tabindex="-1" class="n8k95w1 _1frageme0 n8k95w3">Versand</h2>
                                                                                            </div>
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                                <fieldset id="shipping_methods">
                                                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                                                        <legend>Wähle eine Versandart aus</legend>
                                                                                                    </div>
                                                                                                    <div class="Wo4qW ezrb1p3 _1fragemev NDMe9 NdTJE PuVf0">
                                                                                                        <div class="B4zH6 Zb82w ezrb1p9 _1fragemex HKtYc OpmPd">
                                                                                                            <div class="yL8c2 _1fragemew">
                                                                                                                <div class="f5aCe">
                                                                                                                    <div>
                                                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk">Express</p>
                                                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1x52f9si">1 bis 2 Werktage</p>
                                                                                                                    </div>
                                                                                                                    <div><span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7yt1 notranslate">3,90 €</span></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </fieldset>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                                <div class="oQEAZ WD4IV">
                                                                                    <div><button type="button" id="payment_2_button" class="QT4by _1fragemey rqC98 hodFu _7QHNJ VDIfJ j6D1f janiy"><span class="AjwsM">Weiter zur Zahlung</span></button></div>
                                                                                    <div><a href="" id="button_2_back" class="QT4by eVFmT j6D1f janiy adBMs EP07D"><span class="AjwsM">
                                                                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wuh a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                                                                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Zurück zu den Informationen</span></div>
                                                                                                </div>
                                                                                            </span></a></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0"><button type="submit" tabindex="-1" aria-hidden="true">Weiter zur Zahlung</button></div>
                                                                </form>
                                                            </main>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer role="contentinfo" class="QDqGb">
                                        <div class="HgABA">
                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemea _1fragemee _1fragemfr _1fragemgc _1fragemh9"><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Widerrufsbelehrung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Versandinformationen</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Datenschutzerklärung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">AGB</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Impressum</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Kontaktinformationen</span></span></button></div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <div class="I3DjT Bu997 _1fragemer _1fragemeu _1fragemm2" id="payment_3" style="display:none">
                                <div class="RTcqB">
                                    <header role="banner" class="nBWgL">
                                        <div>
                                            <div class="_1fragemf6 _1fragem8c _1fragem9a _1fragema0 _1fragemb6 _1fragem6g _1fragem7e _1fragembw _1fragemd2 _1frageme0">
                                                <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                                    <style>
                                                        .Layout0>.i602M> :nth-child(1) {
                                                            flex: 0 0 100%;
                                                        }

                                                        .Layout0>.i602M {
                                                            flex-wrap: wrap;
                                                        }

                                                        .Layout0>.i602M {
                                                            max-width: 56rem;
                                                        }

                                                        @media all and (min-width: 1000px) {
                                                            .Layout0>.i602M {
                                                                max-width: 100%;
                                                            }
                                                        }
                                                    </style>
                                                    <div class="i602M AHe4G">
                                                        <div>
                                                            <div>
                                                                <div class="_1fragemf6 _1frageme0">
                                                                    <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemg5 _1fragemgm _1fragemh7 _1fragemhb _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 20.7rem); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 20.7rem); --_16s97g71c: minmax(0, 1fr);">
                                                                        <p class="n8k95w1 _1frageme0 n8k95w2"><a href="https://www.neness-shop.de" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi3 _1fragemlc _1fragemlg"><img src="https://cdn.shopify.com/s/files/1/0615/4479/2259/files/Bildschirmfoto_2023-02-22_um_12.38.41_x320.png?v=1677066018" alt="Neness" class="hmHjN" style="max-width: min(100%, 207px);"></a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <aside class="_PiNS CiOA7"><button type="button" aria-pressed="false" aria-controls="disclosure_content" aria-expanded="false" class="go8Cy"><span class="iibJ6">
                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wui a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                <circle cx="3.5" cy="11.9" r="0.3"></circle>
                                                                <circle cx="10.5" cy="11.9" r="0.3"></circle>
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4"></path>
                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Bestellübersicht anzeigen<div class="_1fragemfa _16s97g78o _16s97g760"></div><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua a8x1wue _1fragemfa a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6"></path>
                                                                </svg></span></span></div>
                                                </div>
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm _1fragemhc">
                                                    <p translate="yes" class="_1x52f9s1 _1frageme0 _1x52f9ss _1fragemfm _1x52f9s2 _1x52f9sh notranslate">6,80 €</p>
                                                </div>
                                            </span></button>
                                        <div id="disclosure_content" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                            <div></div>
                                        </div>
                                    </aside>
                                    <div class="dh43e">
                                        <div class="_1fragemf6 _1frageme0">
                                            <div class="m2iHS iRYcu LMdfq">
                                                <div class="V7iL9">
                                                    <div>
                                                        <nav aria-label="Breadcrumb" class="_1fragemf6 _1frageme0">
                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                <ol class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemea _1fragemee _1fragemh9">
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="https://www.neness-shop.de/cart" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Warenkorb</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_2_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Information</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_4_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Versand</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9" aria-current="step"><span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7yt1">Zahlung</span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="https://www.neness-shop.de/checkouts/cn/c1-1f8654944cf1b32302b9f3389065991b/review" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Überprüfung</a></span></li>
                                                                    </div>
                                                                </ol>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="I_61l">
                                                <div class="tAyc6">
                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg0 _1fragemgh">
                                                            <section aria-label="Überprüfung" class="_1fragemf6 _1frageme0">
                                                                <div role="table" aria-label="Überprüfe deine Daten" class="_1fragemev lT5DX">
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Kontakt</span></div>
                                                                            <div role="cell" class="nkp8r"><bdo dir="ltr" class="_19gi7yt0 _19gi7yth _1fragemfk" id="email_input1">dadad432@mail.ru</bdo></div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Kontaktdaten ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Liefern an</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                    <address class="_19gi7yt0 _19gi7yth _1fragemfk" id="info1">DDR Museum, 423, 10178 Berlin, Deutschland</address>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Lieferadresse ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Art</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm">
                                                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm">
                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk">Express · <span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7yt1">3,90 €</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <main id="checkout-main">
                                                                <div>
                                                                    <form action="" method="POST" novalidate="" id="Form11" class="_1fragemf7">
                                                                        <div class="_1frageme0">
                                                                            <div class="VheJw">
                                                                                <div class="s_qAq">
                                                                                    <section aria-label="Zahlung" class="_1fragemf6 _1frageme0">
                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfr _1fragemg8">
                                                                                                <h2 id="step-section-primary-header" tabindex="-1" class="n8k95w1 _1frageme0 n8k95w3">Zahlung</h2>
                                                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1x52f9si">Alle Transaktionen sind sicher und verschlüsselt.</p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                    <fieldset id="basic">
                                                                                                        <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                                                            <legend>Wähle eine Zahlungsmethode aus</legend>
                                                                                                        </div>
                                                                                                        <div class="Wo4qW ezrb1p3 _1fragemev NDMe9 NdTJE PuVf0">
                                                                                                            <div class="B4zH6"><label for="basic-creditCards" class="yL8c2 D1RJr">
                                                                                                                    <div class="hEGyz">
                                                                                                                        <div class="_1frageme0"><input type="radio" id="basic-creditCards" name="basic" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div>
                                                                                                                        <div class="f5aCe">
                                                                                                                            <div><span class="_19gi7yt0 _19gi7yth _1fragemfk">Kreditkarte</span></div>
                                                                                                                            <div>
                                                                                                                                <div class="wAAjh">
                                                                                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                                                        <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfr _1fragemg8 _1frageme8 _1fragemec _1fragemh9"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/0169695890db3db16bfe.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/37fc65d0d7ac30da3b0c.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/ae9ceec48b1dc489596c.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/f11b90c2972f3811f2d5.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/bddb21e40274706727fb.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </label>
                                                                                                                <div id="basic-creditCards-collapsible" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                                                                                                    <div>
                                                                                                                        <div class="b7U_P">
                                                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                                                <div id="directPaymentMethodDetails" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: auto; overflow: visible;">
                                                                                                                                    <div>
                                                                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                                                            <div>
                                                                                                                                                <div class="jNSGe">
                                                                                                                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                                                                        <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                            <div class="_1frageme0"><label id="number-label" for="number" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Kartennummer</span></span></label>
                                                                                                                                                                <div data-protected-input="true" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                    <div id="number" data-card-fields="number" data-card-field-placeholder="Kartennummer" data-card-field-prefix="Rahmen für das Feld:" class="xIN8V F8weU"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-number-af7il6os10000000-scope-www.neness-shop.de" name="card-fields-number-af7il6os10000000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/number?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Kartennummer"></iframe></div>
                                                                                                                                                                    <div class="P7KAT"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wui a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 6.3c0-2.298 1.131-4.9 3.5-4.9 2.369 0 3.5 2.602 3.5 4.9m-8.4.47v5.36c0 .26.21.47.47.47h8.86c.26 0 .47-.21.47-.47V6.77a.47.47 0 0 0-.47-.47H2.57a.47.47 0 0 0-.47.47Z"></path>
                                                                                                                                                                            </svg></span></div>
                                                                                                                                                                    <div class="uG6K1 DOldf">
                                                                                                                                                                        <div class="IesQp"></div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                            <div class="_1frageme0"><label id="name-label" for="name" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Name des Karteninhabers</span></span></label>
                                                                                                                                                                <div data-protected-input="true" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                    <div id="name" data-card-fields="name" data-card-field-placeholder="Name des Karteninhabers" data-card-field-prefix="Rahmen für das Feld:" class="B_pnJ"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-name-li8g8npiut000000-scope-www.neness-shop.de" name="card-fields-name-li8g8npiut000000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/name?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Name des Karteninhabers"></iframe></div>
                                                                                                                                                                    <div class="uG6K1 DOldf">
                                                                                                                                                                        <div class="IesQp"></div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="T50Pa Layout7 PypyI rhUtJ">
                                                                                                                                                            <style>
                                                                                                                                                                .Layout7>.i602M> :nth-child(1) {
                                                                                                                                                                    flex: 0 0 100%;
                                                                                                                                                                }

                                                                                                                                                                .Layout7>.i602M> :nth-child(2) {
                                                                                                                                                                    flex: 0 0 100%;
                                                                                                                                                                }

                                                                                                                                                                .Layout7>.i602M> :nth-child(3) {
                                                                                                                                                                    flex: 0 0 100%;
                                                                                                                                                                }

                                                                                                                                                                .Layout7>.i602M {
                                                                                                                                                                    flex-wrap: wrap;
                                                                                                                                                                }

                                                                                                                                                                @media all and (min-width: 750px) {
                                                                                                                                                                    .Layout7>.i602M> :nth-child(1) {
                                                                                                                                                                        flex: 1 0px;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout7>.i602M> :nth-child(2) {
                                                                                                                                                                        flex: 1 0px;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout7>.i602M> :nth-child(3) {
                                                                                                                                                                        flex: 1 0px;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout7>.i602M {
                                                                                                                                                                        flex-wrap: nowrap;
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            </style>
                                                                                                                                                            <div class="i602M T9faX">
                                                                                                                                                                <div class="qyWc2">
                                                                                                                                                                    <div>
                                                                                                                                                                        <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                                            <div class="_1frageme0"><label id="expiry-label" for="expiry" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Gültig bis (MM/JJ)</span></span></label>
                                                                                                                                                                                <div data-protected-input="true" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                                    <div id="expiry" data-card-fields="expiry" data-card-field-placeholder="Gültig bis (MM/JJ)" data-card-field-prefix="Rahmen für das Feld:" class="xIN8V"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-expiry-05qa532omyn80000-scope-www.neness-shop.de" name="card-fields-expiry-05qa532omyn80000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/expiry?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Gültig bis (MM/JJ)"></iframe></div>
                                                                                                                                                                                    <div class="uG6K1 DOldf">
                                                                                                                                                                                        <div class="IesQp"></div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="qyWc2">
                                                                                                                                                                    <div>
                                                                                                                                                                        <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                                            <div class="_1frageme0"><label id="verification_value-label" for="verification_value" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Sicherheitscode</span></span></label>
                                                                                                                                                                                <div data-protected-input="true" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                                    <div id="verification_value" data-card-fields="verification_value" data-card-field-placeholder="Sicherheitscode" data-card-field-prefix="Rahmen für das Feld:" class="xIN8V F8weU"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-verification_value-0aux709brhl00000-scope-www.neness-shop.de" name="card-fields-verification_value-0aux709brhl00000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/verification_value?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Sicherheitscode"></iframe></div>
                                                                                                                                                                                    <div class="P7KAT"><button type="button" class="_1xqelvi1 _1fragemf4 _1fragemf6 _1frageme0 _1fragemlb _1fragemll _1fragemlg _1fragemlu _1fragemf8 _1fragemef" aria-describedby="Overlay3"><span class="_1xqelvi2"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wui a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-label="Mehr Informationen" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                                                                        <circle cx="7" cy="7" r="5.6"></circle>
                                                                                                                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.6 5.1c.2-1.3 2.6-1.3 2.8 0 .2 1.3-1.45 1.3-1.45 2.35m.055 2.35H7v.005h.005V9.8Z"></path>
                                                                                                                                                                                                        <circle cx="7" cy="9.7" r="0.1"></circle>
                                                                                                                                                                                                    </svg></span></span></button></div>
                                                                                                                                                                                    <div class="uG6K1 DOldf">
                                                                                                                                                                                        <div class="IesQp"></div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                        <div hidden="">
                                                                                                                                                            <div class="T50Pa Layout8 PypyI rhUtJ">
                                                                                                                                                                <style>
                                                                                                                                                                    .Layout8>.i602M> :nth-child(1) {
                                                                                                                                                                        flex: 0 0 100%;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout8>.i602M> :nth-child(2) {
                                                                                                                                                                        flex: 0 0 100%;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout8>.i602M> :nth-child(3) {
                                                                                                                                                                        flex: 0 0 100%;
                                                                                                                                                                    }

                                                                                                                                                                    .Layout8>.i602M {
                                                                                                                                                                        flex-wrap: wrap;
                                                                                                                                                                    }

                                                                                                                                                                    @media all and (min-width: 750px) {
                                                                                                                                                                        .Layout8>.i602M> :nth-child(1) {
                                                                                                                                                                            flex: 1 0px;
                                                                                                                                                                        }

                                                                                                                                                                        .Layout8>.i602M> :nth-child(2) {
                                                                                                                                                                            flex: 1 0px;
                                                                                                                                                                        }

                                                                                                                                                                        .Layout8>.i602M> :nth-child(3) {
                                                                                                                                                                            flex: 1 0px;
                                                                                                                                                                        }

                                                                                                                                                                        .Layout8>.i602M {
                                                                                                                                                                            flex-wrap: nowrap;
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                </style>
                                                                                                                                                                <div class="i602M T9faX">
                                                                                                                                                                    <div class="qyWc2">
                                                                                                                                                                        <div>
                                                                                                                                                                            <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                                                <div class="_1frageme0"><label id="issue_date-label" for="issue_date" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Ausstellungszeitpunkt (MM / JJ)</span></span></label>
                                                                                                                                                                                    <div data-protected-input="true" hidden="" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                                        <div id="issue_date" data-card-fields="issue_date" data-card-field-placeholder="Ausstellungszeitpunkt (MM / JJ)" data-card-field-prefix="Rahmen für das Feld:" class="xIN8V"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-issue_date-vm56190hlv000000-scope-www.neness-shop.de" name="card-fields-issue_date-vm56190hlv000000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/issue_date?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Ausstellungszeitpunkt (MM / JJ)"></iframe></div>
                                                                                                                                                                                        <div class="uG6K1 DOldf">
                                                                                                                                                                                            <div class="IesQp"></div>
                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="qyWc2">
                                                                                                                                                                        <div>
                                                                                                                                                                            <div class="apbd6 _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                                                <div class="_1frageme0"><label id="issue_number-label" for="issue_number" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Nummer</span></span></label>
                                                                                                                                                                                    <div data-protected-input="true" hidden="" class="oT32G B46er _1fragemev Xkh0E IbLRo">
                                                                                                                                                                                        <div id="issue_number" data-card-fields="issue_number" data-card-field-placeholder="Nummer" data-card-field-prefix="Rahmen für das Feld:" class="xIN8V"><iframe class="card-fields-iframe" frameborder="0" id="card-fields-issue_number-s550614elnb00000-scope-www.neness-shop.de" name="card-fields-issue_number-s550614elnb00000-scope-www.neness-shop.de" scrolling="no" src="https://checkout.shopifycs.com/issue_number?identifier=&amp;location=&amp;dir=ltr" title="Rahmen für das Feld: Nummer"></iframe></div>
                                                                                                                                                                                        <div class="uG6K1 DOldf">
                                                                                                                                                                                            <div class="IesQp"></div>
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
                                                                                                            <div class="B4zH6"><label for="basic-PAYPAL_EXPRESS" class="yL8c2 D1RJr">
                                                                                                                    <div class="hEGyz">
                                                                                                                        <div class="_1frageme0"><input type="radio" id="basic-PAYPAL_EXPRESS" name="basic" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div>
                                                                                                                        <div class="f5aCe">
                                                                                                                            <div><span class="_19gi7yt0 _19gi7yth _1fragemfk">PayPal</span></div>
                                                                                                                            <div class="_1fragemf8 _1fragemfe _1fragemh7 _1frageme0">
                                                                                                                                <div class="hwZCn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" preserveAspectRatio="xMidYMid" viewBox="0 0 196 50" role="img" aria-label="PayPal" class="GeSb3">
                                                                                                                                        <g clip-path="url(#paypal-logo_svg__a)">
                                                                                                                                            <path fill="#253B80" fill-rule="evenodd" d="M62.268 11.182h10.816c3.62 0 6.346 1 7.884 2.893 1.4 1.723 1.863 4.183 1.379 7.315-1.074 7.157-5.186 10.769-12.31 10.769h-3.425c-.738 0-1.37.563-1.483 1.33l-1.18 7.837c-.116.767-.745 1.33-1.485 1.33H57.3c-.555 0-.979-.516-.892-1.09l4.375-29.055c.115-.766.745-1.33 1.485-1.33Zm5.634 14.678c2.867 0 5.833 0 6.424-4.066.217-1.428.043-2.462-.525-3.158-.952-1.166-2.794-1.166-4.748-1.166h-.748c-.442 0-.822.338-.89.797L66.27 25.86h1.632ZM100.235 21.664h5.179c.554 0 .976.518.887 1.09l-2.799 18.571c-.117.767-.743 1.33-1.485 1.33h-4.665c-.552 0-.976-.516-.89-1.093l.232-1.507s-2.558 3.106-7.17 3.106c-2.686 0-4.945-.812-6.523-2.76-1.721-2.12-2.425-5.158-1.93-8.336.952-6.37 5.84-10.912 11.564-10.912 2.496 0 4.996.57 6.118 2.275l.362.55.23-1.517a.913.913 0 0 1 .89-.797Zm-7.884 15.74c2.996 0 5.344-2.08 5.844-5.18.226-1.501-.087-2.863-.876-3.839-.788-.966-1.984-1.478-3.454-1.478-2.95 0-5.338 2.15-5.804 5.223-.244 1.507.047 2.86.812 3.812.772.958 1.974 1.463 3.478 1.463Z" clip-rule="evenodd"></path>
                                                                                                                                            <path fill="#253B80" d="M132.999 21.663h-5.204c-.497 0-.963.259-1.245.69l-7.179 11.079-3.042-10.646c-.192-.666-.779-1.123-1.443-1.123h-5.114c-.622 0-1.054.636-.856 1.25l5.733 17.625-5.39 7.97c-.424.629.003 1.492.736 1.492h5.198c.493 0 .955-.252 1.235-.676l17.312-26.178c.414-.626-.011-1.483-.741-1.483Z"></path>
                                                                                                                                            <path fill="#179BD7" fill-rule="evenodd" d="M139.415 11.182h10.818c3.62 0 6.345 1 7.88 2.893 1.4 1.723 1.867 4.183 1.381 7.315-1.075 7.157-5.186 10.769-12.312 10.769h-3.423c-.738 0-1.369.563-1.483 1.33l-1.242 8.237c-.08.537-.521.93-1.037.93h-5.551c-.552 0-.976-.516-.889-1.09l4.375-29.055c.115-.766.744-1.33 1.483-1.33Zm5.642 14.678c2.869 0 5.835 0 6.425-4.066.216-1.428.044-2.462-.524-3.158-.952-1.166-2.796-1.166-4.748-1.166h-.748c-.444 0-.821.338-.889.797l-1.146 7.593h1.63ZM177.383 21.663h5.176c.555 0 .979.52.894 1.09l-2.801 18.572c-.116.767-.745 1.33-1.484 1.33h-4.664c-.555 0-.979-.516-.892-1.093l.231-1.508s-2.557 3.107-7.169 3.107c-2.687 0-4.942-.812-6.524-2.76-1.72-2.12-2.421-5.158-1.928-8.336.953-6.37 5.84-10.912 11.563-10.912 2.496 0 4.995.57 6.116 2.275l.364.55.229-1.518a.91.91 0 0 1 .889-.797Zm-7.881 15.742c2.995 0 5.347-2.081 5.844-5.181.229-1.501-.084-2.863-.877-3.84-.787-.965-1.983-1.477-3.454-1.477-2.949 0-5.334 2.149-5.804 5.222-.24 1.508.048 2.862.813 3.813.772.957 1.977 1.463 3.478 1.463Z" clip-rule="evenodd"></path>
                                                                                                                                            <path fill="#179BD7" d="m188.67 11.979-4.44 29.588c-.087.573.337 1.09.889 1.09h4.463c.742 0 1.371-.563 1.485-1.33l4.378-29.055c.087-.573-.337-1.092-.889-1.092h-4.998c-.441.002-.82.34-.888.799Z"></path>
                                                                                                                                            <path fill="#253B80" d="m11.493 48.304.827-5.504-1.842-.045H1.68L7.794 2.141a.543.543 0 0 1 .17-.318.486.486 0 0 1 .327-.126h14.834c4.925 0 8.324 1.073 10.098 3.193.832.994 1.362 2.032 1.618 3.176.27 1.2.274 2.632.011 4.38l-.019.128v1.12l.832.494c.7.39 1.258.835 1.685 1.345.711.85 1.172 1.93 1.366 3.211.2 1.317.134 2.885-.194 4.66-.38 2.04-.994 3.818-1.822 5.273-.763 1.34-1.734 2.452-2.887 3.314-1.1.818-2.408 1.44-3.887 1.837-1.433.391-3.067.588-4.859.588h-1.154c-.826 0-1.628.312-2.257.87a3.709 3.709 0 0 0-1.177 2.2l-.087.496-1.46 9.7-.067.357c-.018.112-.048.169-.092.207a.238.238 0 0 1-.152.058h-7.128Z"></path>
                                                                                                                                            <path fill="#179BD7" d="M36.451 12.703c-.044.297-.095.6-.152.911-1.956 10.523-8.65 14.158-17.197 14.158h-4.353c-1.045 0-1.926.795-2.089 1.876l-2.228 14.805L9.8 48.65c-.106.709.416 1.349 1.099 1.349h7.72c.913 0 1.69-.696 1.834-1.64l.076-.412 1.453-9.662.094-.53c.142-.948.92-1.644 1.834-1.644h1.155c7.479 0 13.334-3.181 15.045-12.387.715-3.845.345-7.056-1.547-9.314-.572-.681-1.283-1.246-2.113-1.707Z"></path>
                                                                                                                                            <path fill="#222D65" d="M34.4 11.847a14.84 14.84 0 0 0-1.902-.442c-1.173-.199-2.459-.293-3.836-.293H17.034c-.286 0-.558.068-.802.19-.536.27-.934.802-1.03 1.453l-2.475 16.413-.07.479c.162-1.08 1.043-1.876 2.089-1.876h4.352c8.548 0 15.241-3.637 17.197-14.158.059-.311.108-.614.152-.91a10.18 10.18 0 0 0-1.608-.712 15 15 0 0 0-.438-.144Z"></path>
                                                                                                                                            <path fill="#253B80" d="M15.205 12.756a1.93 1.93 0 0 1 1.031-1.451c.245-.123.516-.19.802-.19h11.627c1.378 0 2.663.094 3.837.292a14.91 14.91 0 0 1 2.342.585c.578.2 1.114.438 1.609.711.582-3.889-.005-6.536-2.012-8.934C32.228 1.13 28.235 0 23.125 0H8.29C7.247 0 6.356.795 6.195 1.877L.015 42.91c-.121.812.477 1.544 1.258 1.544h9.159l2.3-15.284 2.473-16.413Z"></path>
                                                                                                                                        </g>
                                                                                                                                        <defs>
                                                                                                                                            <clipPath id="paypal-logo_svg__a">
                                                                                                                                                <path fill="#fff" d="M0 0h195.456v50H0z"></path>
                                                                                                                                            </clipPath>
                                                                                                                                        </defs>
                                                                                                                                    </svg></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </label></div>
                                                                                                            <div class="B4zH6"><label for="basic-KLARNA_PAY_LATER" class="yL8c2 D1RJr">
                                                                                                                    <div class="hEGyz">
                                                                                                                        <div class="_1frageme0"><input type="radio" id="basic-KLARNA_PAY_LATER" name="basic" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div>
                                                                                                                        <div class="f5aCe">
                                                                                                                            <div><span class="_19gi7yt0 _19gi7yth _1fragemfk">Rechnung mit Klarna</span></div>
                                                                                                                            <div>
                                                                                                                                <div class="wAAjh">
                                                                                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                                                        <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfr _1fragemg8 _1frageme8 _1fragemec _1fragemh9"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/a6264debee91f905fee1.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </label>
                                                                                                                <div id="basic-KLARNA_PAY_LATER-collapsible" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                                                                                                    <div></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="B4zH6 Zb82w ezrb1p9 _1fragemex HKtYc OpmPd"><label for="basic-SOFORT" class="yL8c2 _1fragemew D1RJr">
                                                                                                                    <div class="hEGyz">
                                                                                                                        <div class="_1frageme0"><input type="radio" id="basic-SOFORT" name="basic" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div>
                                                                                                                        <div class="f5aCe">
                                                                                                                            <div><span class="_19gi7yt0 _19gi7yth _1fragemfk">Sofortüberweisung</span></div>
                                                                                                                            <div>
                                                                                                                                <div class="wAAjh">
                                                                                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                                                        <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfr _1fragemg8 _1frageme8 _1fragemec _1fragemh9"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/929b3982051cfab3d557.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </label>
                                                                                                                <div id="basic-SOFORT-collapsible" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: auto; overflow: visible;">
                                                                                                                    <div>
                                                                                                                        <div class="b7U_P">
                                                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfx _1fragemge _1fragemhb"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-252.3 356.1 163 80.9" class="eHdoK">
                                                                                                                                    <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" d="M-108.9 404.1v30c0 1.1-.9 2-2 2H-231c-1.1 0-2-.9-2-2v-75c0-1.1.9-2 2-2h120.1c1.1 0 2 .9 2 2v37m-124.1-29h124.1"></path>
                                                                                                                                    <circle cx="-227.8" cy="361.9" r="1.8" fill="currentColor"></circle>
                                                                                                                                    <circle cx="-222.2" cy="361.9" r="1.8" fill="currentColor"></circle>
                                                                                                                                    <circle cx="-216.6" cy="361.9" r="1.8" fill="currentColor"></circle>
                                                                                                                                    <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" d="M-128.7 400.1H-92m-3.6-4.1 4 4.1-4 4.1"></path>
                                                                                                                                </svg>
                                                                                                                                <div class="_1fragemf6 _1frageme0 _16s97g730" style="--_16s97g72w: 35rem;">
                                                                                                                                    <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1frageml9">Nachdem du “Bestellung überprüfen” geklickt hast, wirst du zu Sofortüberweisung weitergeleitet, um deinen Einkauf sicher abzuschließen.</p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </fieldset>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>
                                                                                    <section aria-label="Rechnungsadresse" class="_1fragemf6 _1frageme0">
                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfr _1fragemg8">
                                                                                                <h2 class="n8k95w1 _1frageme0 n8k95w3">Rechnungsadresse</h2>
                                                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1x52f9si">Wähle die mit deiner Karte oder Zahlungsmethode verknüpfte Adresse aus.</p>
                                                                                            </div>
                                                                                            <fieldset id="billing_address_selector">
                                                                                                <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                                                    <legend>Wähle eine Rechnungsadresse aus</legend>
                                                                                                </div>
                                                                                                <div class="Wo4qW ezrb1p3 _1fragemev NDMe9 NdTJE PuVf0">
                                                                                                    <div class="B4zH6"><label for="billing_address_selector-shipping_address" class="yL8c2 D1RJr">
                                                                                                            <div class="hEGyz">
                                                                                                                <div class="_1frageme0"><input type="radio" id="billing_address_selector-shipping_address" name="billing_address_selector" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div><span class="_19gi7yt0 _19gi7yth _1fragemfk">Mit der Lieferadresse identisch</span>
                                                                                                            </div>
                                                                                                        </label></div>
                                                                                                    <div class="B4zH6 Zb82w ezrb1p9 _1fragemex HKtYc OpmPd"><label for="billing_address_selector-custom_billing_address" class="yL8c2 _1fragemew D1RJr">
                                                                                                            <div class="hEGyz">
                                                                                                                <div class="_1frageme0"><input type="radio" id="billing_address_selector-custom_billing_address" name="billing_address_selector" class="_6hzjvo5 _1fragemf4 _1fragemf6 _1fragemll _1fragemlf _1fragemlr _6hzjvof _1fragemev _1fragemm2 _6hzjvoe _6hzjvob"></div><span class="_19gi7yt0 _19gi7yth _1fragemfk">Eine andere Rechnungsadresse verwenden</span>
                                                                                                            </div>
                                                                                                        </label>
                                                                                                        <div id="billing_address_selector-custom_billing_address-collapsible" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: auto; overflow: visible;">
                                                                                                            <div>
                                                                                                                <div class="b7U_P">
                                                                                                                    <div id="billingAddressForm">
                                                                                                                        <div aria-hidden="false" class="pxSEU">
                                                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                                    <div class="vTXBW _1fragemev _10vrn9p1 _10vrn9p0 _10vrn9p4">
                                                                                                                                        <div>
                                                                                                                                            <div class="j2JE7 _1fragemev"><label for="Select7" class="QOQ2V NKh24"><span class="KBYKh"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Land / Region</span></span></label><select name="countryCode" id="Select7" required="" autocomplete="billing country" class="_b6uH _1fragemm2 yA4Q8 vYo81 RGaKd">
                                                                                                                                                    <option value="DE">Deutschland</option>
                                                                                                                                                    <option value="AT">Österreich</option>
                                                                                                                                                    <option value="PL">Polen</option>
                                                                                                                                                    <option value="US">Vereinigte Staaten</option>
                                                                                                                                                    <option disabled="" value="">---</option>
                                                                                                                                                    <option value="EG">Ägypten</option>
                                                                                                                                                    <option value="GQ">Äquatorialguinea</option>
                                                                                                                                                    <option value="ET">Äthiopien</option>
                                                                                                                                                    <option value="AF">Afghanistan</option>
                                                                                                                                                    <option value="AX">Ålandinseln</option>
                                                                                                                                                    <option value="AL">Albanien</option>
                                                                                                                                                    <option value="DZ">Algerien</option>
                                                                                                                                                    <option value="UM">Amerikanische Überseeinseln</option>
                                                                                                                                                    <option value="AD">Andorra</option>
                                                                                                                                                    <option value="AO">Angola</option>
                                                                                                                                                    <option value="AI">Anguilla</option>
                                                                                                                                                    <option value="AG">Antigua und Barbuda</option>
                                                                                                                                                    <option value="AR">Argentinien</option>
                                                                                                                                                    <option value="AM">Armenien</option>
                                                                                                                                                    <option value="AW">Aruba</option>
                                                                                                                                                    <option value="AC">Ascension</option>
                                                                                                                                                    <option value="AZ">Aserbaidschan</option>
                                                                                                                                                    <option value="AU">Australien</option>
                                                                                                                                                    <option value="BS">Bahamas</option>
                                                                                                                                                    <option value="BH">Bahrain</option>
                                                                                                                                                    <option value="BD">Bangladesch</option>
                                                                                                                                                    <option value="BB">Barbados</option>
                                                                                                                                                    <option value="BY">Belarus</option>
                                                                                                                                                    <option value="BE">Belgien</option>
                                                                                                                                                    <option value="BZ">Belize</option>
                                                                                                                                                    <option value="BJ">Benin</option>
                                                                                                                                                    <option value="BM">Bermuda</option>
                                                                                                                                                    <option value="BT">Bhutan</option>
                                                                                                                                                    <option value="BO">Bolivien</option>
                                                                                                                                                    <option value="BA">Bosnien und Herzegowina</option>
                                                                                                                                                    <option value="BW">Botsuana</option>
                                                                                                                                                    <option value="BR">Brasilien</option>
                                                                                                                                                    <option value="VG">Britische Jungferninseln</option>
                                                                                                                                                    <option value="IO">Britisches Territorium im Indischen Ozean</option>
                                                                                                                                                    <option value="BN">Brunei Darussalam</option>
                                                                                                                                                    <option value="BG">Bulgarien</option>
                                                                                                                                                    <option value="BF">Burkina Faso</option>
                                                                                                                                                    <option value="BI">Burundi</option>
                                                                                                                                                    <option value="CV">Cabo Verde</option>
                                                                                                                                                    <option value="CL">Chile</option>
                                                                                                                                                    <option value="CN">China</option>
                                                                                                                                                    <option value="CK">Cookinseln</option>
                                                                                                                                                    <option value="CR">Costa Rica</option>
                                                                                                                                                    <option value="CI">Côte d’Ivoire</option>
                                                                                                                                                    <option value="CW">Curaçao</option>
                                                                                                                                                    <option value="DK">Dänemark</option>
                                                                                                                                                    <option value="DE">Deutschland</option>
                                                                                                                                                    <option value="DM">Dominica</option>
                                                                                                                                                    <option value="DO">Dominikanische Republik</option>
                                                                                                                                                    <option value="DJ">Dschibuti</option>
                                                                                                                                                    <option value="EC">Ecuador</option>
                                                                                                                                                    <option value="SV">El Salvador</option>
                                                                                                                                                    <option value="ER">Eritrea</option>
                                                                                                                                                    <option value="EE">Estland</option>
                                                                                                                                                    <option value="SZ">Eswatini</option>
                                                                                                                                                    <option value="FO">Färöer</option>
                                                                                                                                                    <option value="FK">Falklandinseln</option>
                                                                                                                                                    <option value="FJ">Fidschi</option>
                                                                                                                                                    <option value="FI">Finnland</option>
                                                                                                                                                    <option value="FR">Frankreich</option>
                                                                                                                                                    <option value="GF">Französisch-Guayana</option>
                                                                                                                                                    <option value="PF">Französisch-Polynesien</option>
                                                                                                                                                    <option value="TF">Französische Süd- und Antarktisgebiete</option>
                                                                                                                                                    <option value="GA">Gabun</option>
                                                                                                                                                    <option value="GM">Gambia</option>
                                                                                                                                                    <option value="GE">Georgien</option>
                                                                                                                                                    <option value="GH">Ghana</option>
                                                                                                                                                    <option value="GI">Gibraltar</option>
                                                                                                                                                    <option value="GD">Grenada</option>
                                                                                                                                                    <option value="GR">Griechenland</option>
                                                                                                                                                    <option value="GL">Grönland</option>
                                                                                                                                                    <option value="GP">Guadeloupe</option>
                                                                                                                                                    <option value="GT">Guatemala</option>
                                                                                                                                                    <option value="GG">Guernsey</option>
                                                                                                                                                    <option value="GN">Guinea</option>
                                                                                                                                                    <option value="GW">Guinea-Bissau</option>
                                                                                                                                                    <option value="GY">Guyana</option>
                                                                                                                                                    <option value="HT">Haiti</option>
                                                                                                                                                    <option value="HN">Honduras</option>
                                                                                                                                                    <option value="IN">Indien</option>
                                                                                                                                                    <option value="ID">Indonesien</option>
                                                                                                                                                    <option value="IQ">Irak</option>
                                                                                                                                                    <option value="IE">Irland</option>
                                                                                                                                                    <option value="IS">Island</option>
                                                                                                                                                    <option value="IM">Isle of Man</option>
                                                                                                                                                    <option value="IL">Israel</option>
                                                                                                                                                    <option value="IT">Italien</option>
                                                                                                                                                    <option value="JM">Jamaika</option>
                                                                                                                                                    <option value="JP">Japan</option>
                                                                                                                                                    <option value="YE">Jemen</option>
                                                                                                                                                    <option value="JE">Jersey</option>
                                                                                                                                                    <option value="JO">Jordanien</option>
                                                                                                                                                    <option value="KY">Kaimaninseln</option>
                                                                                                                                                    <option value="KH">Kambodscha</option>
                                                                                                                                                    <option value="CM">Kamerun</option>
                                                                                                                                                    <option value="CA">Kanada</option>
                                                                                                                                                    <option value="BQ">Karibische Niederlande</option>
                                                                                                                                                    <option value="KZ">Kasachstan</option>
                                                                                                                                                    <option value="QA">Katar</option>
                                                                                                                                                    <option value="KE">Kenia</option>
                                                                                                                                                    <option value="KG">Kirgisistan</option>
                                                                                                                                                    <option value="KI">Kiribati</option>
                                                                                                                                                    <option value="CC">Kokosinseln</option>
                                                                                                                                                    <option value="CO">Kolumbien</option>
                                                                                                                                                    <option value="KM">Komoren</option>
                                                                                                                                                    <option value="CG">Kongo-Brazzaville</option>
                                                                                                                                                    <option value="CD">Kongo-Kinshasa</option>
                                                                                                                                                    <option value="XK">Kosovo</option>
                                                                                                                                                    <option value="HR">Kroatien</option>
                                                                                                                                                    <option value="KW">Kuwait</option>
                                                                                                                                                    <option value="LA">Laos</option>
                                                                                                                                                    <option value="LS">Lesotho</option>
                                                                                                                                                    <option value="LV">Lettland</option>
                                                                                                                                                    <option value="LB">Libanon</option>
                                                                                                                                                    <option value="LR">Liberia</option>
                                                                                                                                                    <option value="LY">Libyen</option>
                                                                                                                                                    <option value="LI">Liechtenstein</option>
                                                                                                                                                    <option value="LT">Litauen</option>
                                                                                                                                                    <option value="LU">Luxemburg</option>
                                                                                                                                                    <option value="MG">Madagaskar</option>
                                                                                                                                                    <option value="MW">Malawi</option>
                                                                                                                                                    <option value="MY">Malaysia</option>
                                                                                                                                                    <option value="MV">Malediven</option>
                                                                                                                                                    <option value="ML">Mali</option>
                                                                                                                                                    <option value="MT">Malta</option>
                                                                                                                                                    <option value="MA">Marokko</option>
                                                                                                                                                    <option value="MQ">Martinique</option>
                                                                                                                                                    <option value="MR">Mauretanien</option>
                                                                                                                                                    <option value="MU">Mauritius</option>
                                                                                                                                                    <option value="YT">Mayotte</option>
                                                                                                                                                    <option value="MX">Mexiko</option>
                                                                                                                                                    <option value="MC">Monaco</option>
                                                                                                                                                    <option value="MN">Mongolei</option>
                                                                                                                                                    <option value="ME">Montenegro</option>
                                                                                                                                                    <option value="MS">Montserrat</option>
                                                                                                                                                    <option value="MZ">Mosambik</option>
                                                                                                                                                    <option value="MM">Myanmar</option>
                                                                                                                                                    <option value="NA">Namibia</option>
                                                                                                                                                    <option value="NR">Nauru</option>
                                                                                                                                                    <option value="NP">Nepal</option>
                                                                                                                                                    <option value="NC">Neukaledonien</option>
                                                                                                                                                    <option value="NZ">Neuseeland</option>
                                                                                                                                                    <option value="NI">Nicaragua</option>
                                                                                                                                                    <option value="NL">Niederlande</option>
                                                                                                                                                    <option value="NE">Niger</option>
                                                                                                                                                    <option value="NG">Nigeria</option>
                                                                                                                                                    <option value="NU">Niue</option>
                                                                                                                                                    <option value="MK">Nordmazedonien</option>
                                                                                                                                                    <option value="NF">Norfolkinsel</option>
                                                                                                                                                    <option value="NO">Norwegen</option>
                                                                                                                                                    <option value="AT">Österreich</option>
                                                                                                                                                    <option value="OM">Oman</option>
                                                                                                                                                    <option value="PK">Pakistan</option>
                                                                                                                                                    <option value="PS">Palästinensische Autonomiegebiete</option>
                                                                                                                                                    <option value="PA">Panama</option>
                                                                                                                                                    <option value="PG">Papua-Neuguinea</option>
                                                                                                                                                    <option value="PY">Paraguay</option>
                                                                                                                                                    <option value="PE">Peru</option>
                                                                                                                                                    <option value="PH">Philippinen</option>
                                                                                                                                                    <option value="PN">Pitcairninseln</option>
                                                                                                                                                    <option value="PL">Polen</option>
                                                                                                                                                    <option value="PT">Portugal</option>
                                                                                                                                                    <option value="MD">Republik Moldau</option>
                                                                                                                                                    <option value="RE">Réunion</option>
                                                                                                                                                    <option value="RW">Ruanda</option>
                                                                                                                                                    <option value="RO">Rumänien</option>
                                                                                                                                                    <option value="RU">Russland</option>
                                                                                                                                                    <option value="SB">Salomonen</option>
                                                                                                                                                    <option value="ZM">Sambia</option>
                                                                                                                                                    <option value="WS">Samoa</option>
                                                                                                                                                    <option value="SM">San Marino</option>
                                                                                                                                                    <option value="ST">São Tomé und Príncipe</option>
                                                                                                                                                    <option value="SA">Saudi-Arabien</option>
                                                                                                                                                    <option value="SE">Schweden</option>
                                                                                                                                                    <option value="CH">Schweiz</option>
                                                                                                                                                    <option value="SN">Senegal</option>
                                                                                                                                                    <option value="RS">Serbien</option>
                                                                                                                                                    <option value="SC">Seychellen</option>
                                                                                                                                                    <option value="SL">Sierra Leone</option>
                                                                                                                                                    <option value="ZW">Simbabwe</option>
                                                                                                                                                    <option value="SG">Singapur</option>
                                                                                                                                                    <option value="SX">Sint Maarten</option>
                                                                                                                                                    <option value="SK">Slowakei</option>
                                                                                                                                                    <option value="SI">Slowenien</option>
                                                                                                                                                    <option value="SO">Somalia</option>
                                                                                                                                                    <option value="HK">Sonderverwaltungsregion Hongkong</option>
                                                                                                                                                    <option value="MO">Sonderverwaltungsregion Macau</option>
                                                                                                                                                    <option value="ES">Spanien</option>
                                                                                                                                                    <option value="SJ">Spitzbergen und Jan Mayen</option>
                                                                                                                                                    <option value="LK">Sri Lanka</option>
                                                                                                                                                    <option value="BL">St. Barthélemy</option>
                                                                                                                                                    <option value="SH">St. Helena</option>
                                                                                                                                                    <option value="KN">St. Kitts und Nevis</option>
                                                                                                                                                    <option value="LC">St. Lucia</option>
                                                                                                                                                    <option value="MF">St. Martin</option>
                                                                                                                                                    <option value="PM">St. Pierre und Miquelon</option>
                                                                                                                                                    <option value="VC">St. Vincent und die Grenadinen</option>
                                                                                                                                                    <option value="SD">Sudan</option>
                                                                                                                                                    <option value="ZA">Südafrika</option>
                                                                                                                                                    <option value="GS">Südgeorgien und die Südlichen Sandwichinseln</option>
                                                                                                                                                    <option value="KR">Südkorea</option>
                                                                                                                                                    <option value="SS">Südsudan</option>
                                                                                                                                                    <option value="SR">Suriname</option>
                                                                                                                                                    <option value="TJ">Tadschikistan</option>
                                                                                                                                                    <option value="TW">Taiwan</option>
                                                                                                                                                    <option value="TZ">Tansania</option>
                                                                                                                                                    <option value="TH">Thailand</option>
                                                                                                                                                    <option value="TL">Timor-Leste</option>
                                                                                                                                                    <option value="TG">Togo</option>
                                                                                                                                                    <option value="TK">Tokelau</option>
                                                                                                                                                    <option value="TO">Tonga</option>
                                                                                                                                                    <option value="TT">Trinidad und Tobago</option>
                                                                                                                                                    <option value="TA">Tristan da Cunha</option>
                                                                                                                                                    <option value="TD">Tschad</option>
                                                                                                                                                    <option value="CZ">Tschechien</option>
                                                                                                                                                    <option value="TR">Türkei</option>
                                                                                                                                                    <option value="TN">Tunesien</option>
                                                                                                                                                    <option value="TM">Turkmenistan</option>
                                                                                                                                                    <option value="TC">Turks- und Caicosinseln</option>
                                                                                                                                                    <option value="TV">Tuvalu</option>
                                                                                                                                                    <option value="UG">Uganda</option>
                                                                                                                                                    <option value="UA">Ukraine</option>
                                                                                                                                                    <option value="HU">Ungarn</option>
                                                                                                                                                    <option value="UY">Uruguay</option>
                                                                                                                                                    <option value="UZ">Usbekistan</option>
                                                                                                                                                    <option value="VU">Vanuatu</option>
                                                                                                                                                    <option value="VA">Vatikanstadt</option>
                                                                                                                                                    <option value="VE">Venezuela</option>
                                                                                                                                                    <option value="AE">Vereinigte Arabische Emirate</option>
                                                                                                                                                    <option value="US">Vereinigte Staaten</option>
                                                                                                                                                    <option value="GB">Vereinigtes Königreich</option>
                                                                                                                                                    <option value="VN">Vietnam</option>
                                                                                                                                                    <option value="WF">Wallis und Futuna</option>
                                                                                                                                                    <option value="CX">Weihnachtsinsel</option>
                                                                                                                                                    <option value="EH">Westsahara</option>
                                                                                                                                                    <option value="CF">Zentralafrikanische Republik</option>
                                                                                                                                                    <option value="CY">Zypern</option>
                                                                                                                                                </select>
                                                                                                                                                <div class="TUEJq"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6"></path>
                                                                                                                                                        </svg></span></div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                        <div class="_1frageme0"><label id="TextField35-label" for="TextField35" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Vorname</span></span></label>
                                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="TextField35" name="firstName" required="" type="text" aria-required="true" aria-labelledby="TextField35-label" autocomplete="billing given-name" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                        <div class="_1frageme0"><label id="TextField36-label" for="TextField36" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Nachname</span></span></label>
                                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="TextField36" name="lastName" required="" type="text" aria-required="true" aria-labelledby="TextField36-label" autocomplete="billing family-name" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                                    <div class="Vob8N R5Ptu">
                                                                                                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                                                                            <div>
                                                                                                                                                <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                                    <div class="_1frageme0"><label id="address1-label" for="address1" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Adresse</span></span></label>
                                                                                                                                                        <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="address1" name="address1" required="" type="text" aria-autocomplete="list" aria-controls="address1-options" aria-owns="address1-options" aria-expanded="false" aria-required="true" aria-labelledby="address1-label" aria-haspopup="listbox" role="combobox" autocomplete="billing address-line1" autocorrect="off" data-protected-input="true" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _1fragemhr _1fragemi1 _7ozb2u11 _7ozb2u1j">
                                                                                                                                                            <div class="_1frageme0 _1fragemlw _1fragemeh _1fragemf2 _7ozb2u1g"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wui a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                                        <path stroke-linecap="round" d="M9.16 9.159a4.194 4.194 0 1 0-5.933-5.93 4.194 4.194 0 0 0 5.934 5.93Zm0 0L12.6 12.6"></path>
                                                                                                                                                                    </svg></span></div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wui a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                                                            <circle cx="7" cy="7" r="5.6"></circle>
                                                                                                                                                            <path stroke-linecap="round" d="M7 10.111V7.1a.1.1 0 0 0-.1-.1h-.678"></path>
                                                                                                                                                            <circle cx="7" cy="4.2" r="0.4"></circle>
                                                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.002 4.198h-.005v.005h.005v-.005Z"></path>
                                                                                                                                                        </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Falls verfügbar, füge eine Hausnummer hinzu.</span></div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                        <div class="_1frageme0"><label id="TextField37-label" for="TextField37" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Wohnung, Zimmer, usw. (optional)</span></span></label>
                                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="TextField37" name="address2" placeholder="Wohnung, Zimmer, usw. (optional)" type="text" aria-required="false" aria-labelledby="TextField37-label" autocomplete="billing address-line2" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2u11 _7ozb2u1j"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemfv _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 1fr); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 1fr); --_16s97g71c: minmax(0, 1fr);">
                                                                                                                                    <div class="ii1aN">
                                                                                                                                        <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                            <div class="_1frageme0"><label id="TextField38-label" for="TextField38" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Postleitzahl</span></span></label>
                                                                                                                                                <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="TextField38" name="postalCode" required="" type="text" inputmode="numeric" aria-required="true" aria-labelledby="TextField38-label" autocomplete="billing postal-code" autocapitalize="characters" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j"></div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                                                                                        <div class="_1frageme0"><label id="TextField39-label" for="TextField39" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu cektnc6 _1frageml2"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Stadt</span></span></label>
                                                                                                                                            <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh"><input id="TextField39" name="city" required="" type="text" aria-required="true" aria-labelledby="TextField39-label" autocomplete="billing address-level2" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2uv _1fragemll _1fragemlg _1fragemlu _7ozb2u11 _7ozb2u1j"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="_1fragemf6 _1frageml8 _1frageme0"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_firstName" name="firstName" autocomplete="billing given-name"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_lastName" name="lastName" autocomplete="billing family-name"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address1" name="address1" autocomplete="billing address-line1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address2" name="address2" autocomplete="billing address-line2"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_city" name="city" autocomplete="billing address-level2"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_country" name="country" autocomplete="billing country"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_zone" name="zone" autocomplete="billing address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_address_level1" name="address-level1" autocomplete="billing address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_province" name="province" autocomplete="billing address-level1"><input tabindex="-1" label="" aria-hidden="true" aria-label="no-label" type="text" id="autofill_postalCode" name="postalCode" autocomplete="billing postal-code"></div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </fieldset>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                                <div class="oQEAZ WD4IV">
                                                                                    <div><button type="button" id="payment_3_button" class="QT4by _1fragemey rqC98 hodFu _7QHNJ VDIfJ j6D1f janiy"><span class="AjwsM">Bestellung überprüfen</span></button>
                                                                                        <div class="_1fragemf7 _123qrzt2 _123qrzt3">
                                                                                            <div class="_16s97g748"></div>
                                                                                            <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1frageml9 _1x52f9si">Dir wird noch nichts berechnet</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div><a href="" id="button_4_back" class="QT4by eVFmT j6D1f janiy adBMs EP07D"><span class="AjwsM">
                                                                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wuh a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                                                                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Zurück zum Versand</span></div>
                                                                                                </div>
                                                                                            </span></a></div>
                                                                                </div>
                                                                                <div class="_1fragemf7 _123qrzt1">
                                                                                    <div class="_16s97g748"></div>
                                                                                    <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1fragemla _1x52f9si">Dir wird noch nichts berechnet</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragemf6 _1frageml8 _1frageme0"><button type="submit" tabindex="-1" aria-hidden="true">Kaufen</button></div>
                                                                    </form>
                                                                </div>
                                                            </main>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer role="contentinfo" class="QDqGb">
                                        <div class="HgABA">
                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemea _1fragemee _1fragemfr _1fragemgc _1fragemh9"><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Widerrufsbelehrung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Versandinformationen</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Datenschutzerklärung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">AGB</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Impressum</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Kontaktinformationen</span></span></button></div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <div class="I3DjT Bu997 _1fragemer _1fragemeu _1fragemm2" id="payment_4" style="display:none">
                                <div class="RTcqB">
                                    <header role="banner" class="nBWgL">
                                        <div>
                                            <div class="_1fragemf6 _1fragem8c _1fragem9a _1fragema0 _1fragemb6 _1fragem6g _1fragem7e _1fragembw _1fragemd2 _1frageme0">
                                                <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                                    <style>
                                                        .Layout0>.i602M> :nth-child(1) {
                                                            flex: 0 0 100%;
                                                        }

                                                        .Layout0>.i602M {
                                                            flex-wrap: wrap;
                                                        }

                                                        .Layout0>.i602M {
                                                            max-width: 56rem;
                                                        }

                                                        @media all and (min-width: 1000px) {
                                                            .Layout0>.i602M {
                                                                max-width: 100%;
                                                            }
                                                        }
                                                    </style>
                                                    <div class="i602M AHe4G">
                                                        <div>
                                                            <div>
                                                                <div class="_1fragemf6 _1frageme0">
                                                                    <div class="_1frageme0 _1fragemfc _1mrl40q3 _1fragemg5 _1fragemgm _1fragemh7 _1fragemhb _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: minmax(0, 20.7rem); --_16s97g7g: minmax(0, 1fr); --_16s97g714: minmax(0, 20.7rem); --_16s97g71c: minmax(0, 1fr);">
                                                                        <p class="n8k95w1 _1frageme0 n8k95w2"><a href="https://www.neness-shop.de" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi3 _1fragemlc _1fragemlg"><img src="https://cdn.shopify.com/s/files/1/0615/4479/2259/files/Bildschirmfoto_2023-02-22_um_12.38.41_x320.png?v=1677066018" alt="Neness" class="hmHjN" style="max-width: min(100%, 207px);"></a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <aside class="_PiNS CiOA7"><button type="button" aria-pressed="false" aria-controls="disclosure_content" aria-expanded="false" class="go8Cy"><span class="iibJ6">
                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wui a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                <circle cx="3.5" cy="11.9" r="0.3"></circle>
                                                                <circle cx="10.5" cy="11.9" r="0.3"></circle>
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4"></path>
                                                            </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Bestellübersicht anzeigen<div class="_1fragemfa _16s97g78o _16s97g760"></div><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua a8x1wue _1fragemfa a8x1wug a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6"></path>
                                                                </svg></span></span></div>
                                                </div>
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm _1fragemhc">
                                                    <p translate="yes" class="_1x52f9s1 _1frageme0 _1x52f9ss _1fragemfm _1x52f9s2 _1x52f9sh notranslate">6,80 €</p>
                                                </div>
                                            </span></button>
                                        <div id="disclosure_content" hidden="" class="_94sxtb1 _1fragemkn _1fragemkp _1frageme0 _1fragemln _1fragemlh _1fragemlr" style="height: 0px;">
                                            <div></div>
                                        </div>
                                    </aside>
                                    <div class="dh43e">
                                        <div class="_1fragemf6 _1frageme0">
                                            <div class="m2iHS iRYcu LMdfq">
                                                <div class="V7iL9">
                                                    <div>
                                                        <nav aria-label="Breadcrumb" class="_1fragemf6 _1frageme0">
                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                <ol class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemea _1fragemee _1fragemh9">
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="https://www.neness-shop.de/cart" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Warenkorb</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_2_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Information</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_4_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Versand</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7ytf _1fragemfj"><a href="" id="button_3_back" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemlc _1fragemlg">Zahlung</a></span><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wug a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.6 2.1 4.652 4.652a.35.35 0 0 1 0 .495L5.6 11.9"></path>
                                                                                </svg></span></li>
                                                                    </div>
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <li class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9" aria-current="step"><span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7yt1">Überprüfung</span></li>
                                                                    </div>
                                                                </ol>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="I_61l">
                                                <div class="tAyc6">
                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg0 _1fragemgh">
                                                            <section aria-label="Bestellung überprüfen" class="_1fragemf6 _1frageme0">
                                                                <h2 id="step-section-primary-header" tabindex="-1" class="n8k95w1 _1frageme0 n8k95w3">Bestellung überprüfen</h2>
                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk"><span>Ich erkläre mich mit den <span id="replacement-review.review_notice_html-0"><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM">AGB</span></button></span> einverstanden und habe die <span id="replacement-review.review_notice_html-1"><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM">Widerrufsbelehrung</span></button></span> zur Kenntnis genommen.</span></p>
                                                                <div class="_16s97g74o"></div>
                                                                <div role="table" aria-label="Überprüfe deine Daten" class="_1fragemev lT5DX">
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Kontakt</span></div>
                                                                            <div role="cell" class="nkp8r"><bdo dir="ltr" class="_19gi7yt0 _19gi7yth _1fragemfk" id="email_input3">dadad432@mail.ru</bdo></div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Kontaktdaten ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Liefern an</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga">
                                                                                    <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk">
                                                                                    <address class="_19gi7yt0 _19gi7yth _1fragemfk" id="info3">dada da<br>DDR Museum<br>423<br>10178 Berlin<br>Deutschland</address>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_2_back" aria-label="Lieferadresse ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Art</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm">
                                                                                    <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemg5 _1fragemgm">
                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk">Express · <span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7yt1">3,90 €</span></p>
                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1x52f9si">Keine anderen Methoden verfügbar</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div role="row" class="NSCO_">
                                                                        <div class="Qk5zF">
                                                                            <div role="cell" class="w3cHO"><span class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7ytb">Zahlung</span></div>
                                                                            <div role="cell" class="nkp8r">
                                                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfv _1fragemgc _1fragemea _1fragemee _1fragemh9"><img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/929b3982051cfab3d557.svg" role="img" width="38" height="24" class="_1tgdqw61 _1fragemll _1fragemlg _1fragemlu _1fragemh4">
                                                                                        <div class="_1fragemf6 _1frageml8 _1frageme0">SOFORT</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="_16s97g740"></div>
                                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1x52f9si">DDR Museum, 10178 Berlin, Deutschland</p>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell"><a href="" id="button_3_back" aria-label="Zahlungsmethode ändern" class="s2kwpi1 _1frageme0 _1fragemll _1fragemlu s2kwpi2 _1fragemld _1fragemlg"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Ändern</span></a></div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <main id="checkout-main">
                                                                <div>
                                                                    <div class="VheJw">
                                                                        <div class="s_qAq USpd3">
                                                                            <section class="_1fragemf6 _1fragemho _1fragemht _1fragemi3 _1fragemhy _1fragem2s _1fragem2g _1fragem34 _1fragem24 _1fragem84 _1fragema0 _1fragem68 _1fragembw _1fragemmi _1frageme0">
                                                                                <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                                    <h2 id="MoneyLine-Heading1" class="n8k95w1 _1frageme0 n8k95w3">Kostenüberblick</h2>
                                                                                </div>
                                                                                <div role="table" aria-labelledby="MoneyLine-Heading1" class="nfgb6p0">
                                                                                    <div role="row" class="_1qy6ue61 _1fragemfc _1qy6ue65">
                                                                                        <div role="cell" class="_1qy6ue67"><span class="_19gi7yt0 _19gi7yth _1fragemfk">Zwischensumme</span></div>
                                                                                        <div role="cell" class="_1qy6ue68"><span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7yt1 notranslate"><?php echo $sum1 ?> €</span></div>
                                                                                    </div>
                                                                                    <div role="row" class="_1qy6ue61 _1fragemfc _1qy6ue65">
                                                                                        <div role="cell" class="_1qy6ue67">
                                                                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfr _1fragemg8">
                                                                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfr _1fragemg8 _1frageme8 _1fragemec _1fragemh9"><span class="_19gi7yt0 _19gi7yth _1fragemfk">Versand</span></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div role="cell" class="_1qy6ue68"><span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk notranslate">3,90 €</span></div>
                                                                                    </div>
                                                                                    <div role="row" class="_1x41w3p1 _1fragemfc _1fragemec _1x41w3p5">
                                                                                        <div role="cell" class="_1x41w3p7"><span class="_19gi7yt0 _19gi7ytl _1fragemfm _19gi7yt1">Gesamt</span>
                                                                                            <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1x52f9si">inkl. 1,08 € MwSt</p>
                                                                                        </div>
                                                                                        <div role="cell" class="_1x41w3p8">
                                                                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemeb _1fragemh9"><abbr translate="yes" class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb notranslate _19gi7ytt _1fragemlc">EUR</abbr><strong translate="yes" class="_19gi7yt0 _19gi7ytl _1fragemfm _19gi7yt1 notranslate"><?php echo $sum1 ?> €</strong></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                        </div>
                                                                        <div class="oQEAZ WD4IV">
                                                                            <div>
                                                                                <form action="" method="POST" novalidate="" id="Form6" class="_1fragemf7">
                                                                                    <div class="_1frageme0"><a href="#" type="button" id="payment_4_button" class="QT4by _1fragemey rqC98 hodFu _7QHNJ VDIfJ j6D1f janiy"><span class="AjwsM">Kaufen</span></a></div>
                                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0"><button type="submit" tabindex="-1" aria-hidden="true">Kaufen</button></div>
                                                                                </form>
                                                                            </div>
                                                                            <div><a href="" id="button_3_back" class="QT4by eVFmT j6D1f janiy adBMs EP07D"><span class="AjwsM">
                                                                                        <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                                            <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1frageme8 _1fragemec _1fragemh9"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wuh a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                                                                                                    </svg></span><span class="_19gi7yt0 _19gi7yth _1fragemfk">Zurück zur Zahlung</span></div>
                                                                                        </div>
                                                                                    </span></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </main>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer role="contentinfo" class="QDqGb">
                                        <div class="HgABA">
                                            <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemea _1fragemee _1fragemfr _1fragemgc _1fragemh9"><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Widerrufsbelehrung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Versandinformationen</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Datenschutzerklärung</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">AGB</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Impressum</span></span></button><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_19gi7yt0 _19gi7ytf _1fragemfj">Kontaktinformationen</span></span></button></div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <script>

                            </script>
                            <aside class="I3DjT aADa7 zwoBE _1fragemes _1fragemeu _1fragemm2 WrWRL">
                                <div class="_1frageml8">
                                    <h2 class="n8k95w1 _1frageme0 n8k95w3">Bestellübersicht</h2>
                                </div>
                                <div class="RTcqB">
                                    <div class="I_61l">
                                        <div class="tAyc6">
                                            <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfx _1fragemge">
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfx _1fragemge">
                                                    <section class="_1fragemf6 _1frageme0">
                                                        <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                            <h3 id="ResourceList0" class="n8k95w1 _1frageme0 n8k95w4">
                                                                Warenkorb</h3>
                                                        </div>
                                                        <div role="table" aria-labelledby="ResourceList0" class="_6zbcq55 _1fragemf8 _1fragemfe _6zbcq56">
                                                            <div role="row" class="_6zbcq51d _1fragemf8 _1fragemec _1fragemh5 _6zbcq51b">
                                                                <div role="columnheader" class="_6zbcq51e">
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                        Produktbild</div>
                                                                </div>
                                                                <div role="columnheader" class="_6zbcq51e">
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                                        Beschreibung</div>
                                                                </div>
                                                                <div role="columnheader" class="_6zbcq51e">
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">Anzahl
                                                                    </div>
                                                                </div>
                                                                <div role="columnheader" class="_6zbcq51e">
                                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">Preis
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php

                                                            if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                                                                $carts = array_unique($_SESSION['cart']);

                                                                // Получаем количество каждого элемента в $_SESSION['cart']
                                                                $counts = array_count_values($_SESSION['cart']);
                                                                $sum = 0;
                                                                foreach ($carts as $cart_el) {
                                                                    $product = get_info_product_by_name($cart_el);
                                                            ?>
                                                                    <div role="row" class="_6zbcq524 _1fragemf8 _1fragem1w _6zbcq52b">
                                                                        <div role="cell" class="_6zbcq53s _1fragemf8 _1fragemfe _1fragemh9">
                                                                            <div class="_1fragemf6 _1fragemhp _1fragemhu _1fragemi4 _1fragemhz _1frageme0 _16s97g730 _16s97g738 _16s97g73g TOZIs" style="--_16s97g72w: 6.4rem; --_16s97g734: 6.4rem; --_16s97g73c: 6.4rem;">
                                                                                <div class="_1h3po421 _1h3po423 _1frageme0" style="--_1h3po420: 1;">
                                                                                    <picture>
                                                                                        <source media="(min-width: 0px)" srcset="<?php echo json_decode($product['img'], true)[0]['file_path'] ?>">
                                                                                        <img src="<?php echo json_decode($product['img'], true)[0]['file_path'] ?>" alt="NENESS CODE - 006" class="_1h3po424 _1fragemf6 _1fragemd8 _1fragemhp _1fragemhu _1fragemi4 _1fragemhz _1fragem2s _1fragem2g _1fragem34 _1fragem24 _1fragem4g _1fragem3w _1fragem50 _1fragem3c _1fragemdo">
                                                                                    </picture>
                                                                                </div>
                                                                                <div aria-hidden="true" class="_1fragemf8 _1fragemfe _1fragemhq _1fragemhv _1fragemi5 _1fragemi0 _1fragemec _1fragemh7 _1fragem98 _1fragem9k _1fragem7c _1fragembg _1fragemds _16s97g738 _16s97g73g _16s97g73o _16s97g71w _16s97g724 _16s97g72c _16s97g72k Wbn2T" style="--_16s97g734: 2.1rem; --_16s97g73c: 2.1rem; --_16s97g73k: translateX(calc(25% * var(--x-global-transform-direction-modifier))) translateY(-50%); --_16s97g71s: 0rem; --_16s97g720: auto; --_16s97g728: auto; --_16s97g72g: 0rem;">
                                                                                    <div class="_1fragemf6 _1frageme0">
                                                                                        <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1x52f9s2">
                                                                                            <?php echo $counts[$cart_el] ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell" class="_6zbcq53s _1fragemf8 _1fragemfe _1fragemh7 _1fragemfh">
                                                                            <div class="_1fragemf6 _1frageme0 iZ894">
                                                                                <span class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk _1x52f9s2">
                                                                                    <?php echo $product['title'] ?></span>
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfr _1fragemg8">
                                                                                    <div>
                                                                                        <ul role="list" class="_1bzftbj1 _1fragem98 _1fragemb4 _1fragem7c _1fragemd0 _1fragemfc _1frageme0 _1bzftbj4 _1fragemfr _1fragemg8">
                                                                                            <li class="_1bzftbj7 _1frageme0">
                                                                                                <span class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb">Grundpreis:
                                                                                                    € <?php echo $product['container'] ?> ml</span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div role="cell" class="_6zbcq53s _1fragemf8 _1fragemfe _1fragemh7 _6zbcq53q">
                                                                            <div class="_1fragemf6 _1frageml8 _1frageme0"><span class="_19gi7yt0 _19gi7yth _1fragemfk">4<div aria-hidden="true" class="_1fragemf6 _1frageme0"> x</div>
                                                                                </span></div>
                                                                        </div>
                                                                        <div role="cell" class="_6zbcq53s _1fragemf8 _1fragemfe _1fragemh9">
                                                                            <div class="_1fragemf8 _1fragemfe _1fragemed _1fragemh7 _1frageme0 _16s97g730 _16s97g738 _16s97g73g bua0H" style="--_16s97g72w: 6.4rem; --_16s97g734: 6.4rem; --_16s97g73c: 6.4rem;">
                                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemft _1fragemga _1fragemhc">
                                                                                    <span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk notranslate"><?php echo $product['price'] ?> €</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                    $price1 = $product['price'];
                                                                    $count1 = $counts[$cart_el];
                                                                    $sum1 +=  $price1 * $count1;
                                                                }
                                                            } ?>
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfx _1fragemge">
                                                    <section aria-label="Rabattcode" class="_1fragemf6 _1frageme0">
                                                        <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfv _1fragemgc">
                                                            <form action="" method="POST" novalidate="" id="Form0" class="_1fragemf7">
                                                                <div class="_1frageme0">
                                                                    <div class="_1frageme0 _1fragemfc _1mrl40q2 _1fragemfr _1fragemgc _16s97g7c _16s97g7k _16s97g718 _16s97g71g" style="--_16s97g78: 1fr; --_16s97g7g: minmax(auto, max-content); --_16s97g714: minmax(0, 1fr) minmax(auto, max-content); --_16s97g71c: minmax(auto, max-content);">
                                                                        <div class="_7ozb2u2 _1fragemfr _1fragemg8 _1frageme0 _1fragemfc _10vrn9p1 _10vrn9p0 _10vrn9p4 _1fragemev">
                                                                            <div class="_1frageme0"><label id="TextField0-label" for="TextField0" class="cektnc3 _1fragemds _1frageml7 _1fragemkq _1fragemlw _1fragemll _1fragemlg _1fragemlu"><span class="cektnc9"><span class="rermvf1 _1fragemkn _1fragemkp _1fragemf6">Rabattcode</span></span></label>
                                                                                <div class="_7ozb2u6 _1frageme0 _1fragemfc _1fragemf5 _1fragemll _1fragemlg _1fragemlu _1fragemlv _1fragemev _1fragemm2 _7ozb2ul _7ozb2uh">
                                                                                    <input id="TextField0" name="reductions" placeholder="Rabattcode" type="text" aria-labelledby="TextField0-label" class="_7ozb2uq _1frageme0 _1fragemlw _1fragemh5 _1frageml6 _7ozb2ur _7ozb2u11 _7ozb2u1j">
                                                                                </div>
                                                                            </div>
                                                                        </div><button type="submit" disabled="" aria-label="Rabattcode nutzen" class="QT4by rqC98 EbLsk _7QHNJ VDIfJ janiy Fox6W hlBcn"><span class="AjwsM">
                                                                                <div class="_1fragemf7 _123qrzt1">
                                                                                    Anwenden</div>
                                                                                <div class="_1fragemf7 _123qrzt2 _123qrzt3">
                                                                                    <span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wua _1fragemf6 a8x1wui a8x1wuf a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M1.4 7h11.2m0 0L7.7 2.1M12.6 7l-4.9 4.9">
                                                                                            </path>
                                                                                        </svg></span>
                                                                                </div>
                                                                            </span></button>
                                                                    </div>
                                                                </div>
                                                                <div class="_1fragemf6 _1frageml8 _1frageme0"><button type="submit" tabindex="-1" aria-hidden="true">Absenden</button></div>
                                                            </form>
                                                        </div>
                                                    </section>
                                                </div>
                                                <section class="_1fragemf6 _1frageme0">
                                                    <div class="_1fragemf6 _1frageml8 _1frageme0">
                                                        <h3 id="MoneyLine-Heading0" class="n8k95w1 _1frageme0 n8k95w4">
                                                            Kostenüberblick</h3>
                                                    </div>
                                                    <div role="table" aria-labelledby="MoneyLine-Heading0" class="nfgb6p0">
                                                        <div role="row" class="_1qy6ue61 _1fragemfc _1qy6ue65">
                                                            <div role="cell" class="_1qy6ue67"><span class="_19gi7yt0 _19gi7yth _1fragemfk">Zwischensumme</span>
                                                            </div>
                                                            <div role="cell" class="_1qy6ue68"><span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk _19gi7yt1 notranslate"><?php echo $sum1 ?> €</span></div>
                                                        </div>
                                                        <div role="row" class="_1qy6ue61 _1fragemfc _1qy6ue65">
                                                            <div role="cell" class="_1qy6ue67">
                                                                <div class="_1ip0g651 _1fragemfc _1frageme0 _1fragemfr _1fragemg8">
                                                                    <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                        <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemfr _1fragemg8 _1frageme8 _1fragemec _1fragemh9">
                                                                            <span class="_19gi7yt0 _19gi7yth _1fragemfk">Versand</span><button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x EP07D"><span class="AjwsM"><span class="_1fragemh5 _1fragem1w _1fragemd8 _1fragemd4 a8x1wu3 _1fragemf6 a8x1wuh a8x1wum"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" class="a8x1wuo _1fragemf6 _1fragemh5 _1fragemd8 _1fragemd4">
                                                                                            <circle cx="7" cy="7" r="5.6"></circle>
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.6 5.1c.2-1.3 2.6-1.3 2.8 0 .2 1.3-1.45 1.3-1.45 2.35m.055 2.35H7v.005h.005V9.8Z">
                                                                                            </path>
                                                                                            <circle cx="7" cy="9.7" r="0.1"></circle>
                                                                                        </svg></span></span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="cell" class="_1qy6ue68"><span translate="yes" class="_19gi7yt0 _19gi7yth _1fragemfk notranslate">Kostenlos</span>
                                                            </div>
                                                        </div>
                                                        <div role="row" class="_1x41w3p1 _1fragemfc _1fragemec _1x41w3p5">
                                                            <div role="cell" class="_1x41w3p7"><span class="_19gi7yt0 _19gi7ytl _1fragemfm _19gi7yt1">Summe</span>
                                                                <p class="_1x52f9s1 _1frageme0 _1x52f9sm _1fragemfj _1x52f9si">
                                                                    inkl. 6,32 € MwSt</p>
                                                            </div>
                                                            <div role="cell" class="_1x41w3p8">
                                                                <div class="_1fragemf8 _1frageme0 _1fragemh9">
                                                                    <div class="_5uqybw2 _1fragemf8 _1fragemdc _1fragemft _1fragemga _1fragemeb _1fragemh9">
                                                                        <abbr translate="yes" class="_19gi7yt0 _19gi7ytf _1fragemfj _19gi7ytb notranslate _19gi7ytt _1fragemlc">EUR</abbr><strong translate="yes" class="_19gi7yt0 _19gi7ytl _1fragemfm _19gi7yt1 notranslate"><?php echo $sum1 ?>€</strong>
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
                            </aside>
                            <div class="_1fragemf6 _1frageml8 _1frageme0">
                                <div role="status" class="_1frageml8">
                                    <p class="_1x52f9s1 _1frageme0 _1x52f9so _1fragemfk">Neuer Gesamtpreis: 39,60 € EUR
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="PortalHost"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="SandboxContainer"><iframe id="sandbox-validation" src="https://checkout.shopify.com/61544792259/sandbox/checkout_one_web_autocomplete" sandbox="allow-scripts allow-same-origin" tabindex="-1" aria-hidden="true" style="display:none; height:0; width:0; visibility: hidden;"></iframe><iframe id="sandbox-Autocomplete-IFrame0" src="https://checkout.shopify.com/61544792259/sandbox/checkout_one_web_autocomplete" sandbox="allow-scripts allow-same-origin" tabindex="-1" aria-hidden="true" style="display:none; height:0; width:0; visibility: hidden;"></iframe></div>

    <div class="SpinnerWrapper">
        <div class="Spinner">
            <svg class="SpinnerSVG" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" focusable="false">
                <path d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0v2C8.268 2 2 8.268 2 16s6.268 14 14 14 14-6.268 14-14h2z">
                </path>
            </svg>
        </div>
    </div>






    <script async="true" src="https://cdn.shopify.com/b1f402832w5a42f512p4c77d00dm4ddfef98m.js"></script>
    <script src="https://www.paypal.com/sdk/js?commit=false&amp;currency=EUR&amp;components=buttons&amp;client-id=AfUEYT7nO4BwZQERn9Vym5TbHAG08ptiKa9gm8OARBYgoqiAJIjllRjeIMI4g294KAH1JdTnkzubt1fr&amp;merchant-id=UNCYX3LKKXWFE&amp;enable-funding=venmo" data-namespace="UNCYX3LKKXWFE::EUR" data-uid-auto="uid_nqmlzgqccgyptpdrtaaeiaijrscrhw"></script>
    <div id="WebPixelsManagerSandboxContainer"><iframe src="https://www.neness-shop.de/wpm@1f402832w5a42f512p4c77d00dm4ddfef98/web-pixel-shopify-custom-pixel@0560/sandbox/modern/checkouts/cn/c1-be028450e6e991d06b85b5bed54bb8fb/information" id="web-pixel-sandbox-CUSTOM-shopify-custom-pixel-LAX-1f402832w5a42f512p4c77d00dm4ddfef98" name="web-pixel-sandbox-CUSTOM-shopify-custom-pixel-LAX-1f402832w5a42f512p4c77d00dm4ddfef98" sandbox="allow-scripts allow-forms" tabindex="-1" aria-hidden="true" style="display:none; height:0; width:0; visibility: hidden;"></iframe></div>
    <script src="https://pay.google.com/gp/p/js/pay.js"></script><iframe src="https://pay.google.com/gp/p/ui/payframe?origin=https%3A%2F%2Fwww.neness-shop.de&amp;mid=" height="0" width="0" allowpaymentrequest="true" style="display: none; visibility: hidden;"></iframe>
    <script src="https://www.googletagmanager.com/gtag/js?id=G-8M6TG84LCB" async=""></script>
</body><iframe id="__JSBridgeIframe_1.0__" title="jsbridge___JSBridgeIframe_1.0__" style="display: none;"></iframe><iframe id="__JSBridgeIframe_SetResult_1.0__" title="jsbridge___JSBridgeIframe_SetResult_1.0__" style="display: none;"></iframe><iframe id="__JSBridgeIframe__" title="jsbridge___JSBridgeIframe__" style="display: none;"></iframe><iframe id="__JSBridgeIframe_SetResult__" title="jsbridge___JSBridgeIframe_SetResult__" style="display: none;"></iframe>
<script>
                                                                                                    document.getElementById("payment_1_button").addEventListener("click", function() {
                                                                                                        //Подставь значение email во все полям email_input
                                                                                                        document.getElementById("email_input").innerText = document.getElementById("email").value;
                                                                                                        document.getElementById("email_input").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("email_input1").innerText = document.getElementById("email").value;
                                                                                                        document.getElementById("email_input1").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("email_input3").innerText = document.getElementById("email").value;
                                                                                                        document.getElementById("email_input3").dispatchEvent(new Event('input'));
                                                                                                        //Сделай сбор данных и подставление в info
                                                                                                        document.getElementById("info").innerText = document.getElementById("TextField1").value + "," + document.getElementById("TextField2").value + "," + document.getElementById("address1").value + "," + document.getElementById("TextField4").value + "," + document.getElementById("TextField9").value + "," + document.getElementById("Select0").value + "," + document.getElementById("address1").value;
                                                                                                        document.getElementById("info1").innerText = document.getElementById("TextField1").value + "," + document.getElementById("TextField2").value + "," + document.getElementById("address1").value + "," + document.getElementById("TextField4").value + "," + document.getElementById("TextField9").value + "," + document.getElementById("Select0").value + "," + document.getElementById("address1").value;
                                                                                                        document.getElementById("info3").innerHTML = document.getElementById("TextField1").value + "</br>" + document.getElementById("TextField2").value + "<br>" + document.getElementById("address1").value + "<br>" + document.getElementById("TextField4").value + "<br>" + document.getElementById("TextField9").value + "<br>" + document.getElementById("Select0").value + "<br>" + document.getElementById("address1").value;
                                                                                                        document.getElementById("payment_1").style.display = "none";
                                                                                                        document.getElementById("payment_2").style.display = "flex";
                                                                                                        //подставь все данные с полей в следующие формы
                                                                                                        document.getElementById("autofill_firstName").value = document.getElementById("TextField1").value;
                                                                                                        document.getElementById("autofill_lastName").value = document.getElementById("TextField2").value;
                                                                                                        document.getElementById("autofill_address1").value = document.getElementById("address1").value;
                                                                                                        document.getElementById("autofill_address2").value = document.getElementById("TextField4").value;
                                                                                                        document.getElementById("autofill_city").value = document.getElementById("TextField9").value;
                                                                                                        document.getElementById("autofill_country").value = document.getElementById("Select0").value;
                                                                                                        document.getElementById("autofill_zone").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_address_level1").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_province").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_postalCode").value = document.getElementById("TextField8").value;
                                                                                                        document.getElementById("autofill_phone").value = document.getElementById("TextField7").value;
                                                                                                        document.getElementById("autofill_email").value = document.getElementById("TextField6").value;
                                                                                                        document.getElementById("autofill_shipping_firstName").value = document.getElementById("TextField1").value;
                                                                                                        document.getElementById("autofill_shipping_lastName").value = document.getElementById("TextField2").value;
                                                                                                        document.getElementById("autofill_shipping_address1").value = document.getElementById("address1").value;
                                                                                                        document.getElementById("autofill_shipping_address2").value = document.getElementById("TextField4").value;
                                                                                                        document.getElementById("autofill_shipping_city").value = document.getElementById("TextField9").value;
                                                                                                        document.getElementById("autofill_shipping_country").value = document.getElementById("Select0").value;
                                                                                                        document.getElementById("autofill_shipping_zone").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_shipping_address_level1").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_shipping_province").value = document.getElementById("Select1").value;
                                                                                                        document.getElementById("autofill_shipping_postalCode").value = document.getElementById("TextField8").value;
                                                                                                        document.getElementById("autofill_shipping_phone").value = document.getElementById("TextField7").value;
                                                                                                        document.getElementById("autofill_shipping_email").value = document.getElementById("TextField6").value;

                                                                                                        document.getElementById("autofill_shipping_firstName").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_lastName").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_address1").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_address2").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_city").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_country").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_zone").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_address_level1").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_province").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_postalCode").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_phone").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_shipping_email").dispatchEvent(new Event('input'));


                                                                                                    });
                                                                                                    document.getElementById("payment_2_button").addEventListener("click", function() {
                                                                                                        document.getElementById("payment_2").style.display = "none";
                                                                                                        document.getElementById("payment_3").style.display = "flex";
                                                                                                        //подставь все данные с полей в следующие формы
                                                                                                        document.getElementById("autofill_cardNumber").value = document.getElementById("TextField10").value;
                                                                                                        document.getElementById("autofill_cardExpiry").value = document.getElementById("TextField11").value;
                                                                                                        document.getElementById("autofill_cardCvv").value = document.getElementById("TextField12").value;
                                                                                                        document.getElementById("autofill_cardName").value = document.getElementById("TextField13").value;
                                                                                                        document.getElementById("autofill_cardNumber").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_cardExpiry").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_cardCvv").dispatchEvent(new Event('input'));

                                                                                                    });
                                                                                                    document.getElementById("payment_3_button").addEventListener("click", function() {
                                                                                                        document.getElementById("payment_3").style.display = "none";
                                                                                                        document.getElementById("payment_4").style.display = "flex";
                                                                                                        //подставь все данные с полей в следующие формы
                                                                                                        document.getElementById("autofill_cardNumber").value = document.getElementById("TextField10").value;
                                                                                                        document.getElementById("autofill_cardExpiry").value = document.getElementById("TextField11").value;
                                                                                                        document.getElementById("autofill_cardCvv").value = document.getElementById("TextField12").value;
                                                                                                        document.getElementById("autofill_cardName").value = document.getElementById("TextField13").value;
                                                                                                        document.getElementById("autofill_cardNumber").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_cardExpiry").dispatchEvent(new Event('input'));
                                                                                                        document.getElementById("autofill_cardCvv").dispatchEvent(new Event('input'));

                                                                                                    });
                                                                                                    //СДелай возвращения с id button_3_back
                                                                                                    document.getElementById("button_3_back").addEventListener("click", function() {
                                                                                                        document.getElementById("payment_3").style.display = "none";
                                                                                                        document.getElementById("payment_2").style.display = "flex";
                                                                                                    });
                                                                                                    document.getElementById("button_4_back").addEventListener("click", function() {
                                                                                                        document.getElementById("payment_4").style.display = "none";
                                                                                                        document.getElementById("payment_3").style.display = "flex";
                                                                                                    });
                                                                                                    document.getElementById("button_2_back").addEventListener("click", function() {
                                                                                                        document.getElementById("payment_2").style.display = "none";
                                                                                                        document.getElementById("payment_1").style.display = "flex";
                                                                                                    });


                                                                                                </script>
</html>