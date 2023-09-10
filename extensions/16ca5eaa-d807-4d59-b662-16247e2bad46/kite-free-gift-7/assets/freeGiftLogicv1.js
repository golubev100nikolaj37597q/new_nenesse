

let DEFAULT_addToCartBtnSelectorsApp7Ext = 'input[name="add"], button[name="add"], form[action*="/cart/add"] input[type="submit"], form[action*="/cart/add"] button[type="submit"], form[action*="/cart/add"] button:not([type="button"]), form[action*="/cart/add"] .gfg__add-to-cart';
let DEFAULT_checkoutBtnSelectorsApp7Ext = 'button[name="checkout"], input[name="checkout"], form[action*="/cart"] a[href="/checkout"], a[href="/checkout"], form[action="/cart"] input[type="submit"][name="checkout"], form[action="/cart"] button[type="submit"][name="checkout"]';
let DEFAULT_quantityBtnSelectorsApp7Ext = '.ajaxcart__qty,quantity-input .quantity,.product-form__input, .product-form__quantity ';
let DEFAULT_sideCartSelectorsApp7Ext = '.cart-notification,cart-notification,.cart-notification-wrapper,#cart-notification, #CartDrawer, .drawer, .drawer-cover, .Drawer';
let DEFAULT_buyNowBtnApp7Ext = '.shopify-payment-button__button, .shopify-payment-button__button--unbranded';
let DEFAULT_cartFormApp7Ext = 'form[action="/cart"], form[action="/cart/"], form[action="cart"]';
//for cart integration
let DEFAULT_cartItemSelectorApp7Ext = ".cart-item";
let DEFAULT_cartItemRemoveParentSelectorApp7Ext = "cart-remove-button";
let DEFAULT_cartItemRemoveSelectorApp7Ext = "";
let DEFAULT_cartItemQuantityBtnSelectorsApp7Ext = "";
let CONSTANT_ARROW_SVG_APP7EXT = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">' +
'<path d="M22.6666 18.6667L15.9999 12L9.33325 18.6667" stroke="#3C3C3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
'</svg>';
var gfgUtils = {
    f: {}
}
window.gfgUtils = gfgUtils;
console.log("gfgUtils", gfgUtils);


gfgUtils.f.loadScript = function (a, b) {
    var c = document.createElement("script");
    c.type = "text/javascript";
    c.src = a;
    document.getElementsByTagName("head")[0].appendChild(c)
    c.onload = function () { b() };
};

/*
* we changed loadScript function - if else block for onload is removed as it was not making sense
*fn(param1) =>  
*param1 - represents function that should be executed once jquery is loaded 
*https://www.w3schools.com/jquery/jquery_noconflict.asp
*/
gfgUtils.f.loadJquery = function (b) {
    console.log("does this work");
    let flag = false;
    if("undefined" === typeof jQuery || 3.0 > parseFloat(jQuery.fn.jquery)){
        flag = true;
    }
    if("undefined" != typeof jQuery && jQuery.post == undefined){
        flag = true;
    }

    if(flag){
        gfgUtils.f.loadScript("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", function () {
           gfgJquery = jQuery.noConflict(!0);
            b(gfgJquery)
        })
    }else{
        b(jQuery);
    }
};

var gfg = {
    debug: [],
    version: 1.35,
    state: {
        submitted: "",
        product_added: "",
        page_type: "",
        insertWrapperOnPage: [],
        cartData: undefined,
        isOverWriteBuyNowBtnTriggered: false,
        timer: undefined,
        freeGiftcardPopupModalTriggered: false,
        atleastOneProduct:{},
        checkForFreeGift: false,
        isCheckForFreeGiftTriggered: false,
        gfgFreeGiftMsgRowButton: false,
        CONSTANT_DEBUG_FLAG: true,
        freeGiftsCartDataMap_productId: {},
        freeGiftsCartDataMap_variantId: {},
        freeGiftsCartData: {},
    },
    constants: {
        themesIds: {
            DAWN_THEME: 887,
            VENTURE_THEME: 775,
            EXPRESS_THEME: 885,
            CRAVE_THEME: 1363,
            SENSE_THEME: 1356,
            CRAFT_THEME: 1368,
        }
    },
    settings: {}, //object from function
    selectors: {},
    cartInterval: "",
    productinterval: "",
    f: {
        bootstrap: function (settings) {
            gfg.utility.debugConsole("bootstap?");
            
            gfg.f.initThemeCSS();
            gfg.f.globalListener(settings)

        },
        initThemeCSS: function (){
        },
        getSettings: async function () {
            //promise
            gfg.utility.debugConsole("GET setting of giftboxbuilder ext fired")
            
            return new Promise(function (resolve, reject) {
        
                gfg.utility.debugConsole("fetching from s3")
                gfg.f.getSettingsFromS3().then(
                    success => {
                        resolve(success);
                    }
                ).catch(error => {
                    gfg.utility.debugError("error in s3 fetch. ", error);

            });
        });    
        },
        getSettingsFromS3: async function () {
            //promise
            let shopName = window.Shopify.shop
            gfg.utility.debugConsole("GET setting of giftlab pro fired")
            return new Promise(function (resolve, reject) {
                fetch(`https://free-gift-app7.s3.us-east-2.amazonaws.com/tempCartSettings/${shopName}.json?nocache=${(new Date()).getTime()}`,{
                    method: 'GET',
                    }).then(
                        response => response.json() // if the response is a JSON object
                    ).then(
                        success => {
                            if(success.responseCode == 200){
                                gfg.utility.debugConsole("success-data", success);
                            }
                            resolve(success);
                        }
                    ).catch(error => {
                        gfg.utility.debugConsole(error) // Handle the error response object
                        reject(error)
                        })
                    })
        },

        setSettings: function(tmpCartSettings){
            var cart_settings = {
                SERVER_URL: tmpCartSettings.SERVER_URL,
                app: {
                    disableApp: tmpCartSettings.userData.customSettings.disableApp || false,
                    disableSideCart: tmpCartSettings.userData.customSettings.disableSideCart || false,
                    refreshProductPageOnGiftWrap: tmpCartSettings.userData.customSettings.refreshProductPageOnGiftWrap || false,
                    addToCartBtnSelectors: tmpCartSettings.userData.customSettings.addToCartBtnSelectors || DEFAULT_addToCartBtnSelectorsApp7Ext,
                    checkoutBtnSelectors: tmpCartSettings.userData.customSettings.checkoutBtnSelectors || DEFAULT_checkoutBtnSelectorsApp7Ext,
                    sideCartCheckoutBtnSelectors: tmpCartSettings.userData.customSettings.sideCartCheckoutBtnSelectors || DEFAULT_checkoutBtnSelectorsApp7Ext,
                    overWriteCheckoutBtn: tmpCartSettings.userData.customSettings.overWriteCheckoutBtn || false,
                    quantityBtnSelectors: tmpCartSettings.userData.customSettings.quantityBtnSelectors || DEFAULT_quantityBtnSelectorsApp7Ext,
                    sideCartSelectors: tmpCartSettings.userData.customSettings.sideCartSelectors || DEFAULT_sideCartSelectorsApp7Ext,
                    isCartIntegrationEnabled: tmpCartSettings.userData.customSettings.isCartIntegrationEnabled || false,
                    cartItemSelectors: tmpCartSettings.userData.customSettings.cartItemSelectors || DEFAULT_cartItemSelectorApp7Ext,
                    cartItemRemoveParentSelectors: tmpCartSettings.userData.customSettings.cartItemRemoveParentSelectors || DEFAULT_cartItemRemoveParentSelectorApp7Ext,
                    cartItemRemoveSelectors: tmpCartSettings.userData.customSettings.cartItemRemoveSelectors || DEFAULT_cartItemRemoveSelectorApp7Ext,
                    cartItemQuantityBtnSelectors: tmpCartSettings.userData.customSettings.cartItemQuantityBtnSelectors || DEFAULT_cartItemQuantityBtnSelectorsApp7Ext,
                    customCartIntegrationScript: tmpCartSettings.userData.customSettings.customCartIntegrationScript || null,
                    activeVariantCodes: tmpCartSettings.userData.customSettings.activeVariantCodes || "123456789",
                    showBranding : tmpCartSettings.userData.customSettings.showBranding,
                    buyNowBtn: tmpCartSettings.userData.customSettings.buyNowBtn || DEFAULT_buyNowBtnApp7Ext,
                    customStyle: tmpCartSettings.userData.customSettings.customStyle || null,
                    enablingApiFromSetInterval: tmpCartSettings.userData.customSettings.enablingApiFromSetInterval || false,
                    isMultipleFreeGiftAllowed:  tmpCartSettings.userData.customSettings.isMultipleFreeGiftAllowed || false,
                   },
                merchantInfo: tmpCartSettings.userData,
                languageData: tmpCartSettings.languageData || {},
                freeGifts: tmpCartSettings.promotionCampaigns,
                discounts: tmpCartSettings.discounts,

            }
            // cart_settings.freeGifts[0].configuration.addtionalFields =  {
            //     claimText: "Claim",
            //     claimedText: "Claimed",
            //     addingText:"Adding",
            //     alreadyClaimedText:"Note: Only one gift can be claimed at a time!",
			// 	claimedCartTitle:"Congratulations! Free Gift Won!",
            //     claimedCartSubtitle:"Gift Added to Bag"
            // }
            // let drivedSettings = gfg.f.drivedSettings(tmpCartSettings)
            gfg.settings = cart_settings;
            gfg.utility.debugConsole("settings assigned")
            
        },

        checkIfCartItemIsPartOfValidCollectionList : (cartItem,validCollectionList)=>{
            for(let i=0; i<validCollectionList.length; i++){
                const collection = validCollectionList[i];
                for(let j=0; j<collection.productIds.length; j++){
                    const product = collection.productIds[j];
                    if(product.productId == cartItem.product_id){
                        return true;
                    }
                }
            }
            return false;
        },

        drivedSettings: function(tmpCartSettings){
            let bundleLinkData = tmpCartSettings.bundleLinkData
            let bundleLinkProductIdMap = new Map()
            let bundleLinkProductHandleMap = new Map()
            for(let i=0; i<bundleLinkData.length; i++){
                let bundleLink = bundleLinkData[i]
                if(bundleLink.productsForBundleLink && bundleLink.productsForBundleLink.length && bundleLink.productsForBundleLink.length  > 0){
                    bundleLinkProductIdMap.set(parseInt(bundleLink.productsForBundleLink[0].productId),{productData:bundleLink.productsForBundleLink[0], bundleId: bundleLink.bundleId})
                    bundleLinkProductHandleMap.set(bundleLink.productsForBundleLink[0].handle,{productData:bundleLink.productsForBundleLink[0], bundleId: bundleLink.bundleId})
                }
            }

            return {
                bundleLinkProductIdMap: bundleLinkProductIdMap,
                bundleLinkProductHandleMap: bundleLinkProductHandleMap,

            }
        },
        setSelectors:  function(){
            let settings =  gfg.settings
            gfg.selectors = {
                addToCart: settings.app.addToCartBtnSelectors,
                checkoutBtn : settings.app.checkoutBtnSelectors,
                sideCartCheckoutBtn: settings.app.sideCartCheckoutBtnSelectors,
                sideCartSelectors: settings.app.sideCartSelectors,
                buyNowBtn: settings.app.buyNowBtn,
                cartForm: settings.app.cartForm,
                productPageWrapperV2: '.gfgProductPageWrapperV2',
                cartPageWrapperV2: '.gfgCartPageWrapperV2',
                quantityBtnSelectors : settings.app.quantityBtnSelectors,
                cartItemSelectors : settings.app.cartItemSelectors,
                cartItemRemoveSelectors : settings.app.cartItemRemoveSelectors,
                cartItemRemoveParentSelectors : settings.app.cartItemRemoveParentSelectors,
                customCartIntegrationScript : settings.app.customCartIntegrationScript,
                cartItemQuantityBtnSelectors : settings.app.cartItemQuantityBtnSelectors,
            }
        },
        setCustomStyling: function (){
            let customStyle =  gfg.settings.app.customStyle
            if(customStyle){
                var styleSheet = document.createElement("style")
                styleSheet.innerText = customStyle
                document.body.appendChild(styleSheet)

            }
        },
        getPageType: function () {
            var pageType = "";
            if (window.location.pathname.includes("/cart") && !window.location.pathname.includes("/products")) {
                pageType = "cart";
            } else if (window.location.pathname.includes("/products")) {
                pageType = "product";
            } else if (window.location.pathname.includes("/collections")) {
                pageType = "COLLECTION";
            } else if (window.location.pathname.includes("/")) {
                pageType = "HOME";
            } else if ("undefined" != typeof Shopify && "undefined" != typeof Shopify.Checkout) {
                pageType = "CHECKOUT";
            } else {
                pageType = "PAGE_NOT_FOUND";
            }
            return pageType;
        },
        getProductPageHandle: function () {
            if ("product" === gfg.state.page_type && window.shopifyLiquidValuesApp7Ext && window.shopifyLiquidValuesApp7Ext.product.handle) {
                // let pattern = /(?<=\\/products\\/)((?!\\?|\\$).)+/g
                // if(window && window.location && window.location.href){
                //     return window.location.href.match(pattern)[0]
                // }
                gfg.state.productPageHandle = shopifyLiquidValuesApp7Ext.product.handle
                return shopifyLiquidValuesApp7Ext.product.handle
            }
            return "undefined"
        },
        getProductPageId: function () {
            if (meta && meta.product && meta.product.id) {
                gfg.state.productPageId = meta.product.id
                return meta.product.id
            }
            return "undefined"
        },
        getSelectedVariant: function () {
            if ("product" === gfg.state.page_type) {

                let activeCodes = gfg.settings.app.activeVariantCodes;  
                  
                if(activeCodes.indexOf("1") >= 0){
                    const params = Object.fromEntries(new URLSearchParams(location.search))
                    if(params && params.variant){
                        return params.variant
                    }
                }
               
                if(activeCodes.indexOf("2") >= 0){
                        if (ShopifyAnalytics && ShopifyAnalytics.meta && ShopifyAnalytics.meta.selectedVariantId) {
                        for(let i = 0; i < ShopifyAnalytics.meta.product.variants.length; i++){
                            if(ShopifyAnalytics.meta.product.variants[i].id == ShopifyAnalytics.meta.selectedVariantId){
                                return ShopifyAnalytics.meta.selectedVariantId
                            }
                        }
                    }
                }
                if(activeCodes.indexOf("3") >= 0){
                    if (document.querySelector('[name="id"]') && document.querySelector('[name="id"]').value) {
                        return document.querySelector('[name="id"]').value
                    }
                }
                
                if(activeCodes.indexOf("4") >= 0){
                    if (shopifyLiquidValues.selected_or_first_available_variant) {
                        return shopifyLiquidValues.selected_or_first_available_variant.id
                    }
                }

                return undefined
            }
        },

        getProductQuantity: function () {
            if (document.querySelector('[name="quantity"]') && document.querySelector('[name="quantity"]').value) {
                if(Number(document.querySelector('[name="quantity"]').value)){
                    return Number(document.querySelector('[name="quantity"]').value)
                }else{
                    return 1
                }       
            }else {
                return 1
            }
        },

        getElements: function (settings) {
            return {
                addToCartBtn: gfg.$(document).find(gfg.selectors.addToCart),
                addToCartButtonCloned: undefined,
                checkoutBtn: gfg.$(document).find(gfg.selectors.checkoutBtn),
                cartForm: gfg.$(document).find(gfg.selectors.cartForm),
                productPageWrapperV2: gfg.$(gfg.$.parseHTML('<div class="gfgPageWrapper gfgProductPageWrapperV2"><div class="gftFreeGiftWrapper"></div><div class="gfgVolDiscountWrapper"></div></div>')),
                cartPageWrapperV2:    gfg.$(gfg.$.parseHTML('<div class="gfgPageWrapper gfgCartPageWrapperV2"><div class="gftFreeGiftWrapper"></div><div class="gfgVolDiscountWrapper"></div></div>')),
                buyNowBtn: gfg.$(document).find(gfg.selectors.buyNowBtn)
            }
        },

        initialize: async function (jQuery) {
            //  gfg.$.ajaxSetup({global: true});
            let tmpCartSettings =  await gfg.f.getSettings();
            gfg.f.setSettings(tmpCartSettings)
            gfg.f.setSelectors()
            gfg.f.setCustomStyling()
            gfg.state.page_type = gfg.f.getPageType();
            gfg.elements = gfg.f.getElements(gfg.settings);
            if ("" === gfg.state.page_type) return false;
            gfg.utility.setLanguageLocale();
            return gfg.f.bootstrap(gfg.settings);
        },
        globalListener: function async (settings) {
            let isIntervalActive = false
            //if app is disabled reurn
            try{
                if (settings.app.disableApp) {
                    return
                } else {
                    console.log('inside else of global listener')
                    //setTIMOUT FOR API CALLS
                    // setTimeout(() => {
                        gfg.utility.listenForApiCalls(settings)
                        gfg.utility.listenForAjaxApiCalls(settings)
                        // gfg.utility.listenForXmlHttpApiCalls(settings)
                        // gfg.utility.interceptFetchRequest()
                        // gfg.utility.interceptXMLHttpRequest()
                    // }, 800);
    
                    if ("product" === gfg.state.page_type) {
                        gfg.productPage.init(settings)
                    }
    
                    if (settings.app.disableSideCart) {
                        if ("cart" === gfg.state.page_type) {
                            gfg.cartPage.init(settings)
                        }
                    } else {
                        gfg.cartPage.init(settings)
    
                    }
                }
    
                setInterval(async () => {
                    if (!isIntervalActive) {
                        console.log("gfg-globalListener-active")
    
                        isIntervalActive = true
                        
                        if(settings.app.enablingApiFromSetInterval){
                            // if (url.includes('app=gfgfreegift')) {
                            //     return ;
                            // }
                            // var cartData = undefined;
                            // if (cartData) {
                            //     gfg.state.cartData = cartData;
                            // } else {
                            //     gfg.state.cartData = await gfg.utility.getCart();
                            // }
                            // gfg.gfgFreeGift.f.checkForFreeGift(cartData)
                            await gfg.utility.callchecksAfterApiCalls()
                        }

                        if ("product" === gfg.state.page_type &&
                            gfg.elements.addToCartBtn.length > 0 &&
                            gfg.$(document).find(gfg.selectors.productPageWrapperV2).length == 0) {
                                gfg.utility.debugConsole("productPage-insertWrapperIntoPage1")
                            gfg.productPage.f.insertWrapperIntoPage(settings)
                        }
    
                        let checkoutBtnEle = gfg.$(document).find(gfg.selectors.checkoutBtn)
    
                        // insert cartPage wrapper if cartPage is initialized 
                        if (checkoutBtnEle.length > 0 &&
                            gfg.$(document).find(gfg.selectors.cartPageWrapperV2).length == 0) {
                                gfg.utility.debugConsole("cartPage-insertWrapperIntoPage")
                            gfg.cartPage.f.insertWrapperIntoPage(settings)
                        }

                        
                        let  gfgFreeGiftMsgRowButton = gfg.$(document).find(".gfgFreeGiftMsgRowButton")
                        if(gfgFreeGiftMsgRowButton && gfgFreeGiftMsgRowButton.length == 1 && gfg.state.gfgFreeGiftMsgRowButton == false){
                            gfg.state.gfgFreeGiftMsgRowButton = truncate
                            gfg.utility.debugConsole("gfgFreeGiftMsgRowButton click behavior")
                            gfgFreeGiftMsgRowButton.on('click', function(e) {
                                gfg.utility.debugConsole("button clicked")
                            // let gfgFreeGiftMsg = gfgFreeGiftMsgContainer.querySelector('gfgFreeGiftMsgRow');
                            let gfgFreeGiftMsg  = gfg.$(document).find(".gfgFreeGiftMsgRow")
                            if(gfgFreeGiftMsg && gfgFreeGiftMsg.length >= 1){
                                gfgFreeGiftMsg.style.display = gfgFreeGiftMsg.style.display === "none" ? "block" : "none";
                            }
                           
                             });
                        }
                        

    
    
                        isIntervalActive = false
    
                    }
                }, 1000)
            }catch(error){
                console.error("globalListenerError" , error)
            }
        }
    },
    utility: {
        getLocale: function () {
            if (window.Shopify && window.Shopify.locale) {
                return window.Shopify.locale
            }else{
                return "en"
            } 
        },
        setLanguageLocale: function () {
            let locale = gfg.utility.getLocale()
            
            if(gfg.settings.languageData && gfg.settings.languageData.languageMode == "SINGLE"){
                locale = "en"
            }

            if(!gfg.settings.languageData[locale]){
                locale = "en"
            }
            gfg.settings.languageData = gfg.settings.languageData[locale]
        },
        getDate: function (date) {
            let d = new Date(date);
            let month = "" + (d.getMonth() + 1);
            let day = "" + d.getDate();
            let year = d.getFullYear();

            if (month.length < 2) month = "0" + month;
            if (day.length < 2) day = "0" + day;

            return [year, month, day].join("-");
        },
        addToCart: async function (data) {

            try {
                // if there is nothing to add in cart..just return true
                // if (!data.id) {
                //     return true
                // }
                let result = await gfg.$.ajax({
                    url: "/cart/add.js?app=gfgfreegift",
                    data: data,
                    type: "POST",
                    dataType: "json",
                })
                return true
            } catch (error) {
                gfg.utility.debugError("gfg-utility-addToCart");
                gfg.utility.debugError(error);
                return false
            }
        },
        updateCart: async function (data) {
            try {
                let result = await gfg.$.ajax({
                    type: "POST",
                    url: "/cart/update.js?app=gfgfreegift",
                    data: data,
                    dataType: "json",
                });
                return result
            } catch (error) {
                gfg.utility.debugError("gfg-utility-updateCart");
                gfg.utility.debugError(error);
                return false
            }
        },
        changeCart: async function (data) {
            try {
                let result = await gfg.$.ajax({
                    type: "POST",
                    url: "/cart/change.js?app=gfgfreegift",
                    data: data,
                    dataType: "json",
                });
                return true
            } catch (error) {
                gfg.utility.debugError("gfg-utility-changeCart");
                gfg.utility.debugError(error);
                return false
            }
        },
        getProductDataV2: function (productName) {
            try {
                let languageValue = window?.Shopify?.routes?.root ? window.Shopify.routes.root : "/"
                return new Promise((res, rej) => {
                    gfg.$.getJSON(languageValue +  "products/" + productName + ".js?app=gfgfreegift", function (product) {
                        gfg.utility.debugConsole("success-productName: ", productName)
                        res(product)
                    }).fail(function () { gfg.utility.debugConsole("fail-productName: ", productName); res(false) })
                })
                return result;
            } catch (error) {
                gfg.utility.debugError("gfg-utility-getProductDataV2");
                gfg.utility.debugError(error);
                return false
            }
        },
        addToCartV2: function (data) {
            try {
                return new Promise((res, rej) => {
                    gfg.$.post('/cart/add.js?app=gfgfreegift', data)
                        .done(function () { gfg.utility.debugConsole("success-/cart/add.js': "); res(true) })
                        .fail(function () { gfg.utility.debugConsole("fail-/cart/add.js"); res(false) })
                })
                return result;
            } catch (error) {
                gfg.utility.debugError("gfg-utility-addToCartV2");
                gfg.utility.debugError(error);
                return false
            }
        },
        clearCart: function (data) {
            try {
                return new Promise((res, rej) => {
                    gfg.$.post('/cart/clear.js?app=gfgfreegift', data)
                        .done(function () { gfg.utility.debugConsole("success-/cart/clear.js': "); res(true) })
                        .fail(function () { gfg.utility.debugConsole("fail-/cart/clear.js"); res(false) })
                })
                return result;
            } catch (error) {
                gfg.utility.debugError("gfg-utility-clearCart");
                gfg.utility.debugError(error);
                return false
            }
        },
        getCart: async function (data) {
            try {
                let result = await gfg.$.ajax({
                    type: "GET",
                    url: "/cart.js?app=gfgfreegift",
                    dataType: "json",
                });
                gfg.utility.refreshFreeGiftCartData(result)
                return result
            } catch (error) {
                gfg.utility.debugError("gfg-utility-getCart");
                gfg.utility.debugError(error);
                return false
            }
        },
        
        isCartEmpty: function () {
            if (gfg.state.cartData && gfg.state.cartData.items.length <= 0) {
                return true;
                
            } else {
                return false
            }
        },

        cloneAddToCartBtn: function () {
        },
        renderLanguageValue: function (parent) {
            if (parent){
                return parent.value;
            }
         return;
        },  
        slider: {
            state: {
                slideIndex: 0,
            },
        },
        isMobileView: function () {
            if (window.innerWidth < 768) {
                return true;
            } else {
                return false;
            }
        },
        updateCart: async function (cartData) {
            try {
                let result = await gfg.$.ajax({
                    url: "/cart/update.js?app=gfgfreegift",
                    data: cartData,
                    type: "POST",
                    dataType: "json",
                })
                return true;
            } catch (error) {
                gfg.utility.debugConsole("error in shopifyUtility.updateCart", error)
                // throw error
                return false
            }
        }, 
        getCurrencySymbol: function () {
            if (window && window.Shopify && window.Shopify.currency && window.Shopify.currency.active) {
                let symbol = gfg.settings.merchantInfo.multipleCurrenciesInfo[window.Shopify.currency.active]?.symbol || Shopify.currency.active;
                return symbol;
            }
        },
        getActiveCurrencyRate : function(){
            let currencyRate = 1;
            if(window.Shopify && window.Shopify.currency && window.Shopify.currency.rate){
                currencyRate = window.Shopify.currency.rate;
            }
            return currencyRate;
        },
        getAmountInActiveCurrency: function (amount) {
            if(!amount || amount == "" || amount == null || amount == undefined) {
                return 0;
            }
            if(window && window.Shopify && window.Shopify.currency && window.Shopify.currency.rate) {
                let rate = window.Shopify.currency.rate;
                if(rate == "1.0") {
                    return amount;
                }else{
                    return parseFloat(parseFloat(amount) * parseFloat(rate)).toFixed(2);
                }
            }
        },
        formatPrice: function (price) {
            try {
                if (window && window.Shopify && window.Shopify.currency && window.Shopify.currency.active) {
                    //find the currency symbol from  gfg.settings.merchantInfo.multipleCurrencies[window.Shopify.currency.active] get the symbol
                    let currencySymbol = gfg.utility.getCurrencySymbol();
                    return currencySymbol + "" + parseFloat(price / 100).toFixed(2)
                }
            } catch(err) {
                gfg.utility.debugConsole(err);
            }
        },
        formatPriceWithoutSymbol: function (price) {
            if (window && window.Shopify && window.Shopify.currency && window.Shopify.currency.active) {
                //find the currency symbol from  gbb.settings.merchantInfo.multipleCurrencies[window.Shopify.currency.active] get the symbol
                return parseFloat(price / 100).toFixed(2)
            } else {
                return parseFloat(price / 100).toFixed(2)
            }
        },
        refreshFreeGiftCartData: function (cartData) {
            try {
                // gfg.state.freeGiftsCartData = {...freeGiftsCartData}
                let freeGiftsPresentInCart = [];
                if (cartData && cartData.items && cartData.items.length > 0) {
                    // let freeGifts = gfg.settings.freeGifts;
                    for(let i=0; i<cartData.items.length; i++){
                        // let cartItems = cartData.items;
                        let cartItem = cartData.items[i]
                        if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                            if (cartItem.properties["_free_product"] == "true") {
                                freeGiftsPresentInCart.push(cartItem)
                            }
                        }
                    }
                }
                
                

                gfg.state.freeGiftsCartDataMap_productId = gfg.utility.convertArrayToObject(freeGiftsPresentInCart, "product_id");
                gfg.state.freeGiftsCartDataMap_variantId = gfg.utility.convertArrayToObject(freeGiftsPresentInCart, "variant_id");
                gfg.state.freeGiftsCartData['items'] = freeGiftsPresentInCart;

                // convert
            } catch (error) {
                gfg.utility.debugError("gfg-utility-refreshFreeGiftCartData");
                gfg.utility.debugError(error);
                return false
            }
        },

        convertFromStoreCurrencyToCustomer : function(amount) {
            try {
                let activeCurrencyRate = gfg.utility.getActiveCurrencyRate(); 
                let convertedAmount = parseFloat(amount * activeCurrencyRate).toFixed(2);
                return convertedAmount;
            } catch(err) {
                gfg.utility.debugConsole(err)
            }
        },
        convertArrayToObject : function(array, key) {
            try {
                let obj = {};
                for(let i=0; i<array.length; i++) {
                    obj[array[i][key]] = array[i];
                }
                return obj;
            } catch(err) {
                gfg.utility.debugConsole(err)
            }
        },
        listenForApiCalls: function () {
            // Save a reference to the original fetch function
            const originalFetch = window.fetch;
            // Define a new fetch function that intercepts requests
            window.fetch = function(url, options) {
                // Log the request URL
                gfg.utility.debugConsole("gfg Request URL: " + url);
                
                // Check if the URL contains "/cart"
                if (url.includes('/cart/change') || url.includes('/cart/add') || url.includes('/cart/update') || url.includes('/cart/clear')) {
                    // Call the original fetch function to make the request
                    
                    return originalFetch.apply(this, arguments).then(async (response) => {
                        // Log the response data
                        try {
                          if (typeof response === 'string') {
                            await gfg.utility.callchecksAfterApiCalls(url, undefined);
                          }else{
                            response.clone().text().then(async (data) => {
                              await gfg.utility.callchecksAfterApiCalls(url, data);
                            });
                          }
                         
                          return response;
    
                        } catch (error) {
    
                            gfg.utility.debugError("Error in response data: ", error);
                          return response;
                        }
                       
                    });

                } else {
                    // If the URL doesn't contain "/cart", call the original fetch function directly
                    return originalFetch.apply(this, arguments);
                }
            };

        
          
        },
        listenForAjaxApiCalls: function () {
            
              // Save a reference to the original gfg.$.ajax function
              var originalAjax = gfg.$.ajax;
            
              // Override the gfg.$.ajax function
              gfg.$.ajax = function(reqObj, options) {
                let url = reqObj.url;
                // Log the request URL
                gfg.utility.debugConsole("gfg Request URL: " + url);
            
                
                // Check if the URL contains "/cart"
                if (
                  url.includes('/cart/change') ||
                  url.includes('/cart/add') ||
                  url.includes('/cart/update') ||
                  url.includes('/cart/clear')
                ) {
                  // Call the original gfg.$.ajax function to make the request
                  return originalAjax.apply(this, arguments).then(async function(response) {
                    // Log the response data
                    try {
                      if (typeof response === 'string') {
                        await gfg.utility.callchecksAfterApiCalls(url, undefined);
                      }else{
                        response.clone().text().then(async (data) => {
                          await gfg.utility.callchecksAfterApiCalls(url, data);
                        });
                      }
                      return response;
    
                    } catch (error) {
                        gfg.utility.debugConsole("Error in ajax response data: ", error);
                    }
                  });
                } else {
                  // If the URL doesn't contain "/cart", call the original gfg.$.ajax function directly
                  return originalAjax.apply(this, arguments);
                }
              };
            
            
        },
        listenForXmlHttpApiCalls() {
            // Save a reference to the original XMLHttpRequest constructor
            console.log('inside xml http api call')
            const OriginalXMLHttpRequest = window.XMLHttpRequest;
          
            // Override the XMLHttpRequest constructor
            window.XMLHttpRequest = function() {
              const xhr = new OriginalXMLHttpRequest();
          
              // Save references to the original methods
              const originalOpen = xhr.open;
              const originalSend = xhr.send;
          
              // Override the open method
              xhr.open = function(method, url) {
                // Log the request URL
                gfg.utility.debugConsole("XMLHttpRequest Request URL: " + url);
          
                // Call the original open method
                originalOpen.apply(this, arguments);
              };
          
              // Override the send method
              xhr.send = function(data) {
                // Override the onreadystatechange event handler
                const originalOnReadyStateChange = xhr.onreadystatechange;
                xhr.onreadystatechange = async function() {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Log the response data
                    try {
                      const response = xhr.responseText;
                      gfg.utility.debugConsole("XMLHttpRequest Response Data: " + response);
          
                      // Check if the URL contains "/cart"
                      if (
                        xhr.responseURL.includes('/cart/change') ||
                        xhr.responseURL.includes('/cart/add') ||
                        xhr.responseURL.includes('/cart/update') ||
                        xhr.responseURL.includes('/cart/clear')
                      ) {
                        // Perform your desired actions with the response data
                        if (typeof response === 'string') {
                          await gfg.utility.callchecksAfterApiCalls(xhr.responseURL, undefined);
                        } else {
                          response.clone().text().then(async (data) => {
                            await gfg.utility.callchecksAfterApiCalls(xhr.responseURL, data);
                          });
                        }
                      }
                    } catch (error) {
                        gfg.utility.debugConsole("Error in XMLHttpRequest response data: ", error);
                    }
                  }
          
                  // Call the original onreadystatechange event handler
                  if (typeof originalOnReadyStateChange === 'function') {
                    originalOnReadyStateChange.apply(xhr, arguments);
                  }
                };
          
                // Call the original send method
                originalSend.apply(this, arguments);
              };
          
              return xhr;
            };
        },      
        
        interceptFetchRequest(matches, cb) {
            const originalFetch = fetch
        
            window.fetch = function (input, init) {
            return originalFetch(input, init).then(async (res) => {
                if (input.includes('/cart/change') || input.includes('/cart/add') || input.includes('/cart/update') || input.includes('/cart/clear')) {
                    // Call the original fetch function to make the request
                   await  gfg.utility.callchecksAfterApiCalls(input, res);
                }
                return Promise.resolve(res)
            })
            }
        },
        interceptXMLHttpRequest(matches, cb) {
            const originalOpen = XMLHttpRequest.prototype.open
        
            XMLHttpRequest.prototype.open = function () {
            this.addEventListener('load', async function () {
                if (input.includes('/cart/change') || input.includes('/cart/add') || input.includes('/cart/update') || input.includes('/cart/clear')) {
                    // Call the original fetch function to make the request
                    await gfg.utility.callchecksAfterApiCalls(input, res);
                }
            })
            originalOpen.apply(this, arguments)
            }
        },    
        callchecksAfterApiCalls: async function (url, data) {
            try {
                
                if (url.includes('app=gfgfreegift')) {
                 return data;
                }
                var cartData = undefined;
                if (cartData) {
                    gfg.state.cartData = cartData;
                } else {
                    gfg.state.cartData = await gfg.utility.getCart();
                }
             
              gfg.gfgFreeGift.f.checkForFreeGift(cartData)
            } catch (e) {
              // gfg.utility.debugConsole("gfg Response data: ", data);
            }
          },
          debugConsole: function(...messages){
            try{
                let flag = gfg.state.CONSTANT_DEBUG_FLAG;
                if(flag == false){
                    return;
                }
                if(flag == true){
                    for (let message of messages) {
                        console.log(message);
                    }
                    return;
                }
                let isDebug = localStorage.getItem("debug");
                if (isDebug) {
                    for (let message of messages) {
                        console.log(message);
                    }
                    gfg.state.CONSTANT_DEBUG_FLAG = true

                }else{
                    gfg.state.CONSTANT_DEBUG_FLAG = false
                }
            }catch(err){
                console.error( 'error inside debugConsole ->' , err)
            }
        },
        debugError: function(...messages){
            try{
                let flag = gfg.state.CONSTANT_DEBUG_FLAG;
                if(flag == false){
                    return;
                }
                if(flag == true){
                    for (let message of messages) {
                        console.error(message);
                    }
                    return;
                }
                let isDebug = localStorage.getItem("debug");
                if (isDebug) {
                    gfg.state.CONSTANT_DEBUG_FLAG = true;
                    for (let message of messages) {
                        console.error(message);
                    }

                }else{
                    gfg.state.CONSTANT_DEBUG_FLAG = false
                }
            }catch(err){
                console.error( 'error inside the debugError function ->' , err)
            }
        },
        
    },
    
    productPage: {
        init: async function (settings) {
            gfg.utility.debugConsole("productPage-init")
            gfg.productPage.f.insertWrapperIntoPage(settings)
            gfg.gfgFreeGift.init(settings, "PRODUCT_PAGE")
            gfg.gfgVolDiscount.init(settings, "PRODUCT_PAGE")
        },
        f: {
            insertWrapperIntoPage: function (settings) {

                if ("undefined" != typeof gfg.elements.addToCartBtn) {
                    let addToCartBtnEle = gfg.$(document).find(gfg.elements.addToCartBtn)
                    addToCartBtnEle.each(function (index) {
                        if (gfg.$(this).is(":visible")) {
                            if(gfg.settings.app.addAfterAddTocartBtn){
                                gfg.$(this).after(gfg.elements.productPageWrapperV2);
                            }else{
                                gfg.$(this).before(gfg.elements.productPageWrapperV2);
                            }
                            
                        }

                    });
                }
            },
        },
         
        actions: {
            insertUpsellModal: function () {
                //   Gs.$("body").append(Gs.settings._modalHtml);
                alert("popModal for upsell action")
            },
        },
    },
    cartPage: {
        init: async function (settings) {
            gfg.utility.debugConsole("cartPage-init")
            gfg.cartPage.f.insertWrapperIntoPage(settings)
            gfg.gfgFreeGift.init(settings, "CART_PAGE")
            gfg.gfgVolDiscount.init(settings, "CART_PAGE")


        },
        f: {
            insertWrapperIntoPage: function (settings) {
                return new Promise((res, rej) => {
                    if ("undefined" != typeof gfg.elements.checkoutBtn) {
                        let checkoutBtnEle = gfg.$(document).find(gfg.selectors.checkoutBtn)
                        checkoutBtnEle.each(function (index) {
                            // console.log("index", index)
                            if (gfg.$(this).is(":visible")) {
                                // check if theme ids matches otherwise add element to default position
                                if (window.Shopify && window.Shopify.theme && window.Shopify.theme.theme_store_id && window.Shopify.theme.theme_store_id == gfg.constants.themesIds.DAWN_THEME) {
                                    gfg.$(this).parent().before(gfg.elements.cartPageWrapperV2);
                                } else if(gfg.settings.app.addAftercheckoutBtn) {
                                    gfg.$(this).after(gfg.elements.cartPageWrapperV2);
                                }else{
                                    gfg.$(this).before(gfg.elements.cartPageWrapperV2);
                                }
                            }
                        });

                    }
                    res()
                })
            },
        },
        events: {
            ajaxSuccess: function (cartSettings) {
                gfg.utility.debugConsole("register ajax success event")
                gfg.$(document).ajaxSuccess(function (event, xhr, settings) {
                    gfg.utility.debugConsole("ajaxSuccess", settings.url)
                    if (settings.url == "/change.js?line=1&quantity=0" || settings.url == "change.js?line=1&quantity=0" || settings.url == "change.js" || settings.url == "/change.js" || settings.url == "/cart.js" || settings.url == "cart.js" || settings.url == "cart" || settings.url == "/cart") {
                        setTimeout(function () {
                            gfg.utility.debugConsole("ajaxSuccess")

                        }, 2000);
                    }
                });
            }
        }
    },
    gfgFreeGift: {
        state:{
            freeGiftsData: [],
            superiorTier: undefined,
            prepareUIState: "CONDITION_NOT_MET",
            isCartUpdatedByUs: false,
            isEventListenerRegistered: false,
            isAccordion: true,
            isToastPresent: true,
            CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y: [],
            CURRENT_QTY_BUY_PRODUCT_X: [],
            CURRENT_TOTAL_FOR_SPEND_X_IN_COLLECTION_Y: []
        },
        init: async function (settings, parent) {
            
            await gfg.gfgFreeGift.f.gfgGetAllFreeGiftData()
            gfg.gfgFreeGift.f.checkForFreeGift()
           
        },
        initialize: async function (settings, parent) {
            // let productHandle = gfg.f.getProductPageHandle(settings)

          

        },
        f: {
            checkForFreeGift: async function (apicartData) {

                
                // check if checkForFreeGift is already triggered then return
                if( gfg.state.isCheckForFreeGiftTriggered) {
                    gfg.state.checkForFreeGift = true
                    return
                }

                gfg.state.isCheckForFreeGiftTriggered = true

                // get cart data 
                if(apicartData){
                    gfg.state.cartData = apicartData
                }else{
                    gfg.state.cartData = await gfg.utility.getCart()
                }
                
                await gfg.gfgFreeGift.f.processFreeGift()
                await gfg.gfgVolDiscount.init(gfg.settings ,"CART_PAGE");

                // set to false, so that checkForFreeGift can be triggered again
                gfg.state.isCheckForFreeGiftTriggered = false
                
                // call again if checkForFreeGift is triggered while executing this function
                if( gfg.state.checkForFreeGift) {
                    gfg.state.checkForFreeGift = false
                    gfg.gfgFreeGift.f.checkForFreeGift()
                }
            },
            processFreeGift: async function () {

                // check if freeGifts there is atleast one active freegift
                if(gfg.settings.freeGifts && gfg.settings.freeGifts.length > 0 && gfg.settings.freeGifts[0].rulesList ){
                }else{
                    return
                }

                let isMultipleFreeGiftAllowed = gfg.settings.freeGifts[0].isMultipleFreeGiftAllowed || false

                

            
                // addRuleIds to rules
                gfg.gfgFreeGift.utility.modifySettingsForRuleIds()
                // = gfg.settings.freeGifts[0].rulesList
                // 

                //new flag -> isMultipleFreeGiftAllowed > true || undefined
                    

                try {
                    // gfg.settings.freeGifts[0].isAutoAdd = false
                    let autoAdd = gfg.settings.freeGifts[0].isAutoAdd;
                    if(!isMultipleFreeGiftAllowed){
                        if(autoAdd){
    
                            await gfg.gfgFreeGift.f.gfgHandleAutoAddEnabled()
    
                        }else{
                            await gfg.gfgFreeGift.f.gfgHandleAutoAddDisabled();
                        }
                    }else{
                        if(autoAdd){
    
                            await gfg.gfgFreeGift.f.gfgHandleAutoAddEnabled_multipleFreeGift()
    
                        }else{
                            await gfg.gfgFreeGift.f.gfgHandleAutoAddDisabled_multipleFreeGift();
                        }  
                    }
                    
                } catch (error) {
                    gfg.utility.debugError("processFreeGift", error)
                }
                
            },
            processAddingValidFreeGiftsToCart_multipleFreeGift : async function(validFreeGiftTiers){
               

                let validFreeGiftTiersToBeAddedToCart = JSON.parse(JSON.stringify(validFreeGiftTiers))
               

                let allValidFreeGiftTiers_afterCheckingCart = gfg.gfgFreeGift.f.getAllValidFreeGiftTiers(validFreeGiftTiersToBeAddedToCart)
                // discard the one that is already in cart
                // use gfg.state.freeGiftsCartDataMap_productId

                // now whatever is left we just add the first variant of those many 
                let dataForFirstVariants = await gfg.gfgFreeGift.utility.getFirstVariantSelectedWithProperties(allValidFreeGiftTiers_afterCheckingCart)

                if(dataForFirstVariants.length == 0){
                    return
                }


                let addedToCart = await gfg.utility.addToCartV2({
                    items: dataForFirstVariants
                })

                if(addedToCart){
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = true
                } else {
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = false
                }
                return
            },
            isProductAllowedToBeAddedToCart: function(productId){
                let { validFreeGiftTiers } = gfg.gfgFreeGift.f.gfgFreeGiftAllOfferStatus();

                let productData = gfg.state.freeGiftsCartDataMap_productId[productId];
    
                if (productData) {
                    // If product data exists, update the ruleIdsAlreadyInCart
                    ruleIdsAlreadyInCart.push(productData.properties["_rule_id"]);

                    // Remove any tiers with this rule ID from the valid free gift tiers
                    validFreeGiftTiers = validFreeGiftTiers.filter(tier => {
                        return tier.ruleId !== productData.properties["_rule_id"];
                    });
                    
                    // Since product data exists, this product isn't allowed to be added again
                    return false;
                }else{
                    // check if its sibling is already in cart
                    validFreeGiftTiers = validFreeGiftTiers.filter(tier => {
                        return tier.ruleId !== productData.properties["_rule_id"];
                    });
                }            
            },
            gfgHandleAutoAddEnabled: async function(){
            
                let { validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers } = gfg.gfgFreeGift.f.gfgFreeGiftAllOfferStatus();

                let freeGiftsFromCart = gfg.gfgFreeGift.f.gfgFindAllFreeGiftsFromCart(gfg.state.cartData)

                if(validFreeGiftTiers.length == 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_NOT_MET"
                    if(freeGiftsFromCart.length > 0){
                       await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                    }

                }

                if(validFreeGiftTiers.length > 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"

                    gfg.gfgFreeGift.f.gfgFreeGiftSuperiorTier(validFreeGiftTiers)
                    let superiortierFreeGiftVariantId = gfg.gfgFreeGift.f.getSuperiorTierFreeGift()

                    let  isSuperiorTierFreeGiftAlreadyInCart = gfg.gfgFreeGift.f.checkIfSuperiorTierFreeGiftAlreadyInCart(freeGiftsFromCart, superiortierFreeGiftVariantId)

                    if(isSuperiorTierFreeGiftAlreadyInCart){
                        await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, superiortierFreeGiftVariantId)
                    }else{
                        await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                        await gfg.gfgFreeGift.f.gfgAddSuperiorTierFreeGiftToCart(superiortierFreeGiftVariantId)
                    }   
                }

                let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers );
                gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml)
                gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow();
                gfg.gfgFreeGift.f.registerEvents();
                if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                    await gfg.gfgFreeGift.f.updateCartState()
                }

            },
            gfgHandleAutoAddDisabled: async function(){

                let { validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers } = gfg.gfgFreeGift.f.gfgFreeGiftAllOfferStatus();

                let freeGiftsFromCart = gfg.gfgFreeGift.f.gfgFindAllFreeGiftsFromCart(gfg.state.cartData)

                if(validFreeGiftTiers.length == 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_NOT_MET"
                    if(freeGiftsFromCart.length > 0){
                       await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                    }

                }

                if(validFreeGiftTiers.length > 0){
                    if(freeGiftsFromCart.length > 0){
                        let checkIfValidFreeGiftIsThereInCart = gfg.gfgFreeGift.f.checkIfValidFreeGiftIsThereInCart(freeGiftsFromCart, validFreeGiftTiers)
                        if(checkIfValidFreeGiftIsThereInCart){
                            gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"
                        }else{
                            await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                            gfg.gfgFreeGift.state.prepareUIState = "CONDITION_MET"
                        }

                    }else{
                        gfg.gfgFreeGift.state.prepareUIState = "CONDITION_MET"
                    }

                }

                let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers );
                gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml)
                gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow();
                gfg.gfgFreeGift.f.registerEvents()

                if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                    gfg.gfgFreeGift.f.updateCartState()
                }
            },
            gfgHandleAutoAddEnabled_multipleFreeGift: async function(){
            
                let { validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers } = gfg.gfgFreeGift.f.gfgFreeGiftAllOfferStatus();

                let freeGiftsFromCart = gfg.gfgFreeGift.f.gfgFindAllFreeGiftsFromCart(gfg.state.cartData)


                if(inValidFreeGiftTiers.length > 0){
                    // remove all free gifts which are part of freegift teiers
                    // if present in cart
                    // remove All the invalid free gifts from cart
                    // let cartData JSON.parse JSON.stringify gfg.state.freeGiftsCartData;
                    let freeGiftsToBeRemovedFromCart = gfg.gfgFreeGift.f.freeGiftsToBeRemovedFromCart(inValidFreeGiftTiers)
                    // await gfg.gfgFreeGift.utility.removeCartItemsFromCart(freeGiftsToBeRemovedFromCart)
                    await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsToBeRemovedFromCart, undefined)

                };

                if(validFreeGiftTiers.length == 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_NOT_MET"
                    if(freeGiftsFromCart.length > 0){
                       await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                    }
                }

                if(validFreeGiftTiers.length > 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"
                    await gfg.gfgFreeGift.f.processAddingValidFreeGiftsToCart_multipleFreeGift(validFreeGiftTiers)   
                }

                let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers );
                gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml)
                gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow();
                gfg.gfgFreeGift.f.registerEvents();
                if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                    await gfg.gfgFreeGift.f.updateCartState()
                }

            },
            gfgHandleAutoAddDisabled_multipleFreeGift: async function(){

                let { validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers } = gfg.gfgFreeGift.f.gfgFreeGiftAllOfferStatus();

                let freeGiftsFromCart = gfg.gfgFreeGift.f.gfgFindAllFreeGiftsFromCart(gfg.state.cartData)

                if(validFreeGiftTiers.length == 0){
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_NOT_MET"
                    if(freeGiftsFromCart.length > 0){
                       await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                    }
                }

                if(validFreeGiftTiers.length > 0){
                    if(freeGiftsFromCart.length > 0){
                        let checkIfValidFreeGiftIsThereInCart = gfg.gfgFreeGift.f.checkIfValidFreeGiftIsThereInCart(freeGiftsFromCart, validFreeGiftTiers)
                        if(checkIfValidFreeGiftIsThereInCart){
                            gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"
                        }else{
                            await gfg.gfgFreeGift.f.gfgRemoveAllFreeGiftProductsExceptGiven(freeGiftsFromCart, undefined)
                            gfg.gfgFreeGift.state.prepareUIState = "CONDITION_MET"
                        }

                    }else{
                        gfg.gfgFreeGift.state.prepareUIState = "CONDITION_MET"
                    }

                }

                let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers );
                gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml)
                gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow();
                gfg.gfgFreeGift.f.registerEvents()

                if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                    gfg.gfgFreeGift.f.updateCartState()
                }
            },
            gfgFreeGiftFindAndUpdateInArray: function(id, updateValue, dataArray){
                let found = false;

                for (let i = 0; i < dataArray.length; i++) {
                    if (dataArray[i].id === id) {
                        dataArray[i].value = updateValue;
                        found = true;
                        return {id: id, value: updateValue}
                        break;
                    }
                }

                if (!found) {
                    dataArray.push({ id: id, value: updateValue });
                }
            },
            gfgFreeGiftFindInArray: function(id, dataArray){
                for (let i = 0; i < dataArray.length; i++) {
                    if (dataArray[i].id === id) {
                      return dataArray[i].value;
                    }
                  }
                  // Return null (or any other default value) if the id is not found in the array
                  return 0;
            },
            gfgAddSuperiorTierFreeGiftToCart:async function(superiortierFreeGiftVariantId){
                let items = []
                items.push({ id: superiortierFreeGiftVariantId, quantity: 1, properties: { _free_product: true } })
                let freeGiftProductData = await gfg.utility.addToCartV2({ items: items })
                if(freeGiftProductData){
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = true
                    return true
                }
                return false
            },
            gfgAddFreeGiftToCart:async function(freeGiftProduct){
                let items = []
                items.push({ id: freeGiftProduct.variantId, quantity: 1, properties: { _free_product: true,_rule_id: freeGiftProduct._rule_id  } })
                let freeGiftProductData = await gfg.utility.addToCartV2({ items: items })
                if(freeGiftProductData){
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = true
                    return true
                }
                return false
            },
            getSuperiorTierFreeGift: function(){
                let superiorTier = gfg.gfgFreeGift.state.superiorTier;
                let freeGiftProduct = superiorTier.freeGiftProduct;
                let superiortierFreeGiftVariantId = freeGiftProduct[0].variants[0].variantId
                return superiortierFreeGiftVariantId
            },
            getAllValidFreeGiftTiers: function(validFreeGiftTiers){
                debugger
                let allValidFreeGiftProductIds = []
                let alValidFreeGiftTiers = []
                for(let i=0; i< validFreeGiftTiers.length; i++){
                    let freeGiftProduct = validFreeGiftTiers[i].freeGiftProduct;

                    //check if this tier already has a product in cart
                    let ruleId = validFreeGiftTiers[i].ruleId

                    let freeGiftsFromCart = gfg.state.freeGiftsCartData.items
                    let freeGiftsFromCartForThisRuleId = freeGiftsFromCart.filter((product) => {
                        return product.properties["_rule_id"] == ruleId
                    })


                    if (freeGiftsFromCartForThisRuleId.length > 0) {
                        // if yes then remove this tier from validFreeGiftTiers
                        continue;
                    }else {
                        // if no then add this tier to allValidFreeGiftTiers
                        alValidFreeGiftTiers.push(validFreeGiftTiers[i])
                    }

                    // add all the free gift products to array
                }

                return alValidFreeGiftTiers;
                // return allValidFreeGiftProductIds
            },
            gfgGetAllFreeGiftData: async function(){

                

                if(gfg.gfgFreeGift.state.freeGiftsData.length > 0){
                    return;
                }

                //check in session storage
                let freeGiftsData = sessionStorage.getItem("gfgFreeGiftsData")
                if(freeGiftsData){
                    gfg.gfgFreeGift.state.freeGiftsData = JSON.parse(freeGiftsData)
                    return
                }
               

                let productHandleArray = [];
                let rules = gfg.settings.freeGifts[0].rulesList;

                for(let i=0; i< rules.length; i++){
                    let freeGiftProductArray = rules[i].freeGiftProduct
                    for(j = 0; j< freeGiftProductArray.length; j++){
                        let handle = rules[i].freeGiftProduct[j].handle;
                        productHandleArray.push(handle);
                    }
                }

                const promises = productHandleArray.map(async (handle) => {
                    const productData = gfg.utility.getProductDataV2(handle);
                    return productData;
                });

                gfg.gfgFreeGift.state.freeGiftsData = await Promise.all(promises)

                
                sessionStorage.setItem("gfgFreeGiftsData", JSON.stringify(gfg.gfgFreeGift.state.freeGiftsData))
            },
            gfgFreeGiftSuperiorTier: function(validFreeGiftTiers){
                
                gfg.gfgFreeGift.state.superiorTier = validFreeGiftTiers[0]
                
                if(validFreeGiftTiers.length > 1){
                    for(let i=1; i< validFreeGiftTiers.length; i++){
                        let currTierFreeGift = parseFloat(validFreeGiftTiers[i].freeGiftProduct[0].variants[0].price)
                        let superiorTierFreeGift = parseFloat(gfg.gfgFreeGift.state.superiorTier.freeGiftProduct[0].variants[0].price)
                        if(currTierFreeGift > superiorTierFreeGift){
                            gfg.gfgFreeGift.state.superiorTier = validFreeGiftTiers[i]
                        }
                    }
                }
                gfg.utility.debugConsole("validFreeGiftTiers")
            },
            gfgRemoveAllFreeGiftProductsExceptGiven: async function(freeGiftsFromCart, superiortierFreeGiftVariantId){
                if(freeGiftsFromCart.length == 0){
                    return
                }
                let freeGiftProductVariantDataArray = []
                for(let i=0; i< freeGiftsFromCart.length; i++){
                    if(superiortierFreeGiftVariantId && superiortierFreeGiftVariantId == freeGiftsFromCart[i].variant_id){
                        continue
                    }else{
                        freeGiftProductVariantDataArray.push([String(freeGiftsFromCart[i].key)])
                    }
                    
                }

                if(freeGiftProductVariantDataArray.length > 0){
                    let freeGiftProductVariantDataObj = {}
                    //freeGiftProductVariantDataArray convert to object
                    for(let i=0; i< freeGiftProductVariantDataArray.length; i++){
                        let key = freeGiftProductVariantDataArray[i]
                        freeGiftProductVariantDataObj[key] = 0
                    }

                    let cartUpdateStatus =  await gfg.utility.updateCart({ updates: freeGiftProductVariantDataObj})
                    if(cartUpdateStatus){
                        gfg.state.cartData = await gfg.utility.getCart();
                        gfg.gfgFreeGift.state.isCartUpdatedByUs = true
                        return true

                    }else{
                        return false
                    }
                  
                }


            },
            sortFreeGiftByVariantPrice: function(allFreeGiftsArray) {
                const n = allFreeGiftsArray.length;
                for (let i = 0; i < n - 1; i++) {
                    let swapped = false;

                    for (let j = 0; j < n - i - 1; j++) {
                    const priceA = allFreeGiftsArray[j].freeGiftProduct[0].variants[0].price;
                    const priceB = allFreeGiftsArray[j + 1].freeGiftProduct[0].variants[0].price;

                        if (priceA < priceB) {
                            const temp = allFreeGiftsArray[j];
                            allFreeGiftsArray[j] = allFreeGiftsArray[j + 1];
                            allFreeGiftsArray[j + 1] = temp;
                            swapped = true;
                        }
                    }

                        if (!swapped) {
                            break;
                    }
                }
            },
            checkIfValidFreeGiftIsThereInCart: function(freeGiftsFromCart, validFreeGiftTiers){
                // if free gift variant 
                let validFreeGiftProductVariantIds = []
                for(let i=0; i< validFreeGiftTiers.length; i++){
                    let freeGiftProductVariantData = gfg.gfgFreeGift.f.getFreeGiftProductVariantsDataId(validFreeGiftTiers[i].freeGiftProduct);
                    //expand freeGiftProductVariantData and push to validFreeGiftProductVariantIds
                    for(let j=0; j< freeGiftProductVariantData.length; j++){
                        freeGiftProductVariantData[j] = parseInt(freeGiftProductVariantData[j]);
                        validFreeGiftProductVariantIds.push(freeGiftProductVariantData[j])
                    }
                }

                //check if atleast one valid free gift is there in cart
                let isThereValidFreeGiftInCart = false
                for(let i=0; i< freeGiftsFromCart.length; i++){
                    let cartItem = freeGiftsFromCart[i]
                    if(cartItem && cartItem.properties && cartItem.properties["_free_product"] && validFreeGiftProductVariantIds.includes(cartItem.variant_id)){
                        isThereValidFreeGiftInCart = true
                    }
                }
                return isThereValidFreeGiftInCart
            },
            getFreeGiftProductVariantsDataId: (freeGiftProducts)=>{
                let allProductVariantIds = [];
                for(let i=0; i<freeGiftProducts.length; i++){
                    let freeGiftProduct = freeGiftProducts[i];
                    let freeGiftProductVariantData = freeGiftProduct.variants.map((variant)=>{
                        allProductVariantIds.push(variant.variantId);
                    })
                }
                return allProductVariantIds;
            },
            checkIfSuperiorTierFreeGiftAlreadyInCart: function(freeGiftsFromCart, superiortierFreeGiftVariantId){
                let isSuperiorTierFreeGiftAlreadyInCart = false
                for(let i=0; i< freeGiftsFromCart.length; i++){
                    let cartItem = freeGiftsFromCart[i]
                    if(cartItem && cartItem.properties && cartItem.properties["_free_product"] && cartItem.variant_id == superiortierFreeGiftVariantId){
                        isSuperiorTierFreeGiftAlreadyInCart = true
                    }
                }
                return isSuperiorTierFreeGiftAlreadyInCart
            },
            gfgFindAllFreeGiftsFromCart: function(cartData){
                let freeGiftsFromCart = [];
                for(let i=0; i< cartData.items.length; i++){
                    let cartItem = cartData.items[i];
                    if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                        freeGiftsFromCart.push(cartItem);
                    }
                }
                return freeGiftsFromCart;
            },
            freeGiftsToBeRemovedFromCart: function(inValidFreeGiftTiers){
                try {

                    // inValidGiftTiers have an array and then freeGiftProduct
                    // freeGiftProduct have an array and then variants // get the productId from there
                    gfg.utility.debugConsole("inValidFreeGiftTiers", inValidFreeGiftTiers)
                    let cartData = JSON.parse(JSON.stringify(gfg.state.freeGiftsCartData));
                    let freeGiftsProductDataBeRemovedFromCart = []
                    for(let i=0; i < inValidFreeGiftTiers.length; i++){
                        let freeGiftProduct = inValidFreeGiftTiers[i].freeGiftProduct;
                        for(let j=0; j< freeGiftProduct.length; j++){
                            freeGiftsProductDataBeRemovedFromCart.push(freeGiftProduct[j]);
                        }
                    }

                    let freeGiftsToBeRemovedFromCart = []

                    for(let i=0; i< freeGiftsProductDataBeRemovedFromCart.length; i++){
                        // use cartData
                        let freeGiftProduct = freeGiftsProductDataBeRemovedFromCart[i];
                        let freeGiftProductVariantData = freeGiftProduct.variants.map((variant)=>{
                            let variant_id = variant.variantId;
                            let variantDataInCart = gfg.state.freeGiftsCartDataMap_variantId[variant_id];
                            if(variantDataInCart && Object.keys(variantDataInCart).length > 0){
                                freeGiftsToBeRemovedFromCart.push(variantDataInCart);
                            }
                        })
                    }
                    
                    // return freeGiftsToBeRemovedFromCart/

                    // search the data in gfg.state.freeGiftsCartDataMap_productId
                    // if found then add to freeGiftsToBeRemovedFromCart
                    // if(freeGiftsToBeRemovedFromCart.length > 0){
                    //     // lets check if any of the variant is already in cart
                    //     let freeGiftsToBeRemovedFromCart_variantIds = []
                    //     for(let i=0; i< freeGiftsToBeRemovedFromCart.length; i++){
                    //         let freeGiftProduct = freeGiftsToBeRemovedFromCart[i];
                    //         let freeGiftProductVariantData = freeGiftProduct.variants.map((variant)=>{
                    //             freeGiftsToBeRemovedFromCart_variantIds.push(variant.id);
                    //         })
                    //     }

                    //     let freeGiftsToBeRemovedFromCart_variantIds_unique = [...new Set(freeGiftsToBeRemovedFromCart_variantIds)];

                    //     // nowcheck in gfg.state.freeGiftsCartDataMap_variantId
                    //     for(let i=0; i< freeGiftsToBeRemovedFromCart_variantIds_unique.length; i++){
                    //         let variantId = freeGiftsToBeRemovedFromCart_variantIds_unique[i];
                    //         let freeGiftProductData = gfg.state.freeGiftsCartDataMap_variantId[variantId];
                    //         if(freeGiftProductData){
                    //             freeGiftsIdsToBeRemovedFromCart[variant_id] = variantId;
                    //             freeGiftsToBeRemovedFromCart.push(freeGiftProductData);
                    //         }
                    //     }
                    // }


                    return freeGiftsToBeRemovedFromCart;

                } catch (error) {
                    gfg.utility.debugError("freeGiftsToBeRemovedFromCart", error)
                }
            },
            gfgFreeGiftAllOfferStatus: function(){
                let rulesList = gfg.settings.freeGifts[0].rulesList;
                let validFreeGiftTiers = [];
                let inValidFreeGiftTiers = [];

                for(let i=0; i < rulesList.length ; i++){
                    let ruleListItem = rulesList[i]

                    // const freeGiftProductVariantData = gfg.gfgFreeGift.f.getFreeGiftProductVariantsData(ruleListItem.freeGiftProduct);
                    // ruleListItem.freeGiftsVariantsArr = freeGiftProductVariantData;

                  
                    let checkifFreeGiftConditionIsMetCnt = gfg.gfgFreeGift.f.checkifFreeGiftConditionIsMet(ruleListItem, gfg.state.cartData, i);

                    if (checkifFreeGiftConditionIsMetCnt) {
                        validFreeGiftTiers.push(ruleListItem);

                    }else{
                        inValidFreeGiftTiers.push(ruleListItem)
                    }
                }
                gfg.gfgFreeGift.state.validFreeGiftTiers = validFreeGiftTiers;
                gfg.gfgFreeGift.state.inValidFreeGiftTiers = inValidFreeGiftTiers;

                // gfg.gfgFreeGift.f.sortFreeGiftByVariantPrice(rulesList)

                gfg.gfgFreeGift.state.AllFreeGiftTiers  = rulesList;
                return {
                    validFreeGiftTiers,
                    inValidFreeGiftTiers,
                    AllFreeGiftTiers: rulesList
                }

            },
            gfgFreeGiftGetValidTierProductIds: function (validFreeGiftTiers){
                const productIds = [];
                for (const tier of validFreeGiftTiers) {
                  for (const product of tier.freeGiftProduct) {
                    productIds.push(product.productId);
                  }
                }
                return productIds;
            },
            gfgFreeGiftPrepareParentUI: async function(validFreeGiftTiers, inValidFreeGiftTiers, configData){
                let isAccordion = gfg.gfgFreeGift.state.isAccordion
                let gfgFreeGiftMsgParentContainerForDropDown = gfg.$("<div>").addClass('gfgFreeGiftMsgParentContainerForDropDown')

                let gfgFreeGiftMsgContainerForAccordion = gfg.$("<div>").addClass('gfgFreeGiftMsgContainerForAccordion')

                let gfgFreeGiftOptionsContainerDiv = gfg.$("<div>").addClass("gfgFreeGiftOptionsContainerDiv")

                let gfgFreeGiftSelectDiv = gfg.$("<div>").addClass('gfgFreeGiftSelectDiv');


                if(isAccordion || (gfg.gfgFreeGift.state.prepareUIState == "CONDITION_FULFILLED")){
                    let gfgFreeGiftMsgIcon = gfg.$("<div>").addClass('gfgFreeGiftMsgIcon')
                    let gfgFreeGiftMsgIconImageElement = gfg.$("<img>").attr("src", configData.icon).attr("alt", "icon").addClass('gfgFreeGiftMsgIconImageElement')
                    gfgFreeGiftMsgIcon.append(gfgFreeGiftMsgIconImageElement);

                    let gfgFreeGiftMsgTextContainer = gfg.$("<div>").addClass('gfgFreeGiftMsgTextContainer')
                    let gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(configData.title).css("font-weight", "700").css("font-size", "14px")
                    let gfgFreeGiftDropDownButton = gfg.$("<div>").addClass("gfgFreeGiftDropDownButton")
                    let gfgFreeGiftDropDownButtonImageEle = gfg.$("<img>").addClass("gfgFreeGiftDropDownButtonImageEle").attr("src", 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(CONSTANT_ARROW_SVG_APP7EXT));

                    gfgFreeGiftDropDownButton.append(gfgFreeGiftDropDownButtonImageEle);

                    gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgTitle);

                    gfgFreeGiftSelectDiv.append(gfgFreeGiftMsgIcon);
                    gfgFreeGiftSelectDiv.append(gfgFreeGiftMsgTextContainer);
                    if(isAccordion){
                        gfgFreeGiftSelectDiv.append(gfgFreeGiftDropDownButton);
                    }
                    if(isAccordion === false && gfg.gfgFreeGift.state.prepareUIState == "CONDITION_FULFILLED"){
                        // gfgFreeGiftSelectDivExpanded.css("border", "1px solid black")
                    }

                }else{
                    validFreeGiftTiers = JSON.parse(JSON.stringify(validFreeGiftTiers))
                    gfgFreeGiftSelectDiv = await gfg.gfgFreeGift.f.gfgFreeGiftSingleOfferPrepareUI(validFreeGiftTiers, configData)
                }

                return {
                    gfgFreeGiftMsgParentContainerForDropDown,
                    gfgFreeGiftMsgContainerForAccordion,
                    gfgFreeGiftOptionsContainerDiv,
                    gfgFreeGiftSelectDiv
                }
            },
            Old_gfgFreeGiftSingleOfferPrepareUI:async  function(validFreeGiftTiers, configData){
                let AllFreeGiftTiers = gfg.settings.freeGifts[0].rulesList
                let userConfigData = gfg.settings.freeGifts[0].configuration
                let allFreeGifts = gfg.settings.freeGifts[0].rulesList[0].freeGiftProduct;
                let freeGiftInsideCart = gfg.gfgFreeGift.f.gfgFreeGiftGetFreeProductInCart();
                let validTierProductIds = gfg.gfgFreeGift.f.gfgFreeGiftGetValidTierProductIds(validFreeGiftTiers);
                // let product = gfg.settings.freeGifts[0].rulesList[0].freeGiftProduct[0];
                // let configData on basis of tiers
                let gfgSingleOffergiftContainerDiv = gfg.$("<div>").addClass("gfgSingleOffergiftContainerDiv")
                let tierLengthToBeIterated = 1;
                let isAutoAdd = gfg.settings.freeGifts[0].isAutoAdd
                if(!isAutoAdd){
                    tierLengthToBeIterated = allFreeGifts.length
                }
                for(let i=0; i< tierLengthToBeIterated; i++){
                    let product = allFreeGifts[i];

                    // console.log(product);
                    let imagePath;
                    if(product.images.length == 0){
                        imagePath = `https://free-gift-app7.s3.us-east-2.amazonaws.com/public/freeGiftDymmyImage.png`
                    }else{
                        imagePath = product.images[0].originalSrc
                    }
                    
                    let isFreeGiftValid = false;
                    for (const productId of validTierProductIds) {
                        if (productId == product.productId) {
                            isFreeGiftValid = true;
                            break;
                        }
                    }

                    let iterator = 0;
                    let tier = AllFreeGiftTiers[iterator]
                    let optionsConfigData = gfg.gfgFreeGift.f.gfgFreeGiftSetupConfigData(isFreeGiftValid, configData, iterator, tier, product );
                    // console.log(optionsConfigData);
                    let gfgFreeGiftSingleOfferSelectDiv = gfg.$("<div>").addClass("gfgFreeGiftSingleOfferSelectDiv")
                    
                    let gfgFreeGiftMsgIcon = gfg.$("<div>").addClass('gfgFreeGiftMsgIcon')
                
                
                    let  gfgFreeGiftMsgIconImageElementOfItem = gfg.$("<img>").attr("src", imagePath ).addClass('gfgFreeGiftMsgIconImageElementOfItem').attr("alt", "icon");
                    gfgFreeGiftMsgIcon.append(gfgFreeGiftMsgIconImageElementOfItem)

                    let gfgFreeGiftMsgTextContainer = gfg.$("<div>").addClass('gfgFreeGiftMsgTextContainer')
                    let gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(optionsConfigData.title)
                            
                    let gfgFreeGiftMsgSubTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgSubTitle')
                    // let pillContainer = gfg.gfgFreeGift.f.gfgFreeGiftCreatePill(optionsConfigData.subtitle, isFreeGiftValid)
                    gfgFreeGiftMsgSubTitle.append(optionsConfigData.subtitle)


                    let variantSelect = null;
                    let variants = product.variants

                    if(freeGiftInsideCart == null && isFreeGiftValid && variants.length > 1 ){
                        variantSelect = gfg.$("<select>").addClass("gfgFreeGiftVariantSelect").addClass("gfgFreeGiftVariantSelect" + i);
                    
                        for(let l = 0; l < variants.length; l++){
                            let variant = variants[l];
                            let optionText = variant?.title || "XX"
                            let optionSelect = gfg.$("<option>").addClass("gfgFreeGiftVariantOption").val(variant?.variantId)
                            optionSelect.text(optionText)
                            variantSelect.append(optionSelect)
                        }
                        // selectCounter++;
                    }

                    let gfgFreeGiftClaimButton  = gfg.$("<div>").addClass("gfgFreeGiftClaimButton").addClass("gfgFreeGiftClaimButton"+ i)
                    
                    if(isFreeGiftValid == false){
                        gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText).addClass("gfgFreeGiftInvalidProductClaimButton")
                    }

                    if(isFreeGiftValid && freeGiftInsideCart){
                        gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText).addClass("gfgFreeGiftValidProductInactiveClaimButton")
                        gfgFreeGiftMsgSubTitle.addClass("gfgFreeGiftMsgSubTitleNoteTextColor");
                        gfgFreeGiftMsgSubTitle.html(userConfigData.addtionalFields?.conditionMetButCannotClaimSubtitle || "Only 1 gift can be claimed at a time")
                    }

                    if(isFreeGiftValid && freeGiftInsideCart == null ){
                        gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText);
                        gfgFreeGiftClaimButton.addClass("gfgFreeGiftClaimButtonAddToCart").addClass("gfgFreeGiftReadyToClaimButton")
                        gfgFreeGiftMsgSubTitle.html(userConfigData.addtionalFields?.conditionMetCartSubtitle || "Free Gift ready to claim")
                    }    

                    // gfg.$('.gfgFreeGiftClaimButton' + i).off('click');

                    // gfg.$('.gfgFreeGiftClaimButton' + i).unbind('click');

                    // gfg.$(document).on("click", '.gfgFreeGiftClaimButton' + i , function(event) {
                    //     if(gfg.settings.freeGifts[0].isMultipleFreeGiftAllowed){
                    //         gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, i);
                    //         return;
                    //     }else{
                    //         gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, i);
                    //     }
                    // })


                    if(product.productId == freeGiftInsideCart){
                        gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimedText).addClass('gfgFreeGiftActiveFreeGiftClaimButton');
                        pillContainer = gfg.gfgFreeGift.f.gfgFreeGiftCreatePill(userConfigData.addtionalFields.claimedCartSubtitle , isFreeGiftValid)
                        gfgFreeGiftMsgSubTitle.html(pillContainer)
                        gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(userConfigData.addtionalFields.claimedCartTitle)
                        gfgFreeGiftMsgSubTitle.removeClass('gfgFreeGiftMsgSubTitleNoteTextColor')                  
                    }

                            // for dropDown;
                    gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgTitle)
                
                    if(variantSelect == null){
                        gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgSubTitle);
                    }else{
                        gfgFreeGiftMsgTextContainer.append(variantSelect)
                    }

                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftMsgIcon);
                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftMsgTextContainer);
                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftClaimButton);

                    gfgSingleOffergiftContainerDiv.append(gfgFreeGiftSingleOfferSelectDiv);
                }

                return gfgSingleOffergiftContainerDiv;
                
            },
            gfgFreeGiftSingleOfferPrepareUI:async  function(validFreeGiftTiers, configData){
                validFreeGiftTiers = JSON.parse(JSON.stringify(validFreeGiftTiers))
                const settings = gfg.settings.freeGifts[0];
                const allFreeGiftTiers = settings.rulesList;
                const userConfigData = settings.configuration;
                const allFreeGifts = settings.rulesList[0].freeGiftProduct;
                let freeGiftInsideCart;
                const validTierProductIds = gfg.gfgFreeGift.f.gfgFreeGiftGetValidTierProductIds(validFreeGiftTiers);

                const gfgSingleOffergiftContainerDiv = gfg.$("<div>").addClass("gfgSingleOffergiftContainerDiv");
                let tierLengthToBeIterated = gfg.settings.freeGifts[0].isAutoAdd ? 1 : allFreeGifts.length;

                for (let i = 0; i < tierLengthToBeIterated; i++) {
                    const product = allFreeGifts[i];
                    const imagePath = product.images.length == 0 ? 
                    `https://free-gift-app7.s3.us-east-2.amazonaws.com/public/freeGiftDymmyImage.png` : product.images[0].originalSrc;
                    
                    const isFreeGiftValid = validTierProductIds.includes(product.productId);
                    const tier = allFreeGiftTiers[0];
                    freeGiftInsideCart =  gfg.gfgFreeGift.f.gfgFreeGiftGetFreeProductInCart(tier);
                    const optionsConfigData = gfg.gfgFreeGift.f.gfgFreeGiftSetupConfigData(isFreeGiftValid, configData, 0, tier, product);

                    const gfgFreeGiftSingleOfferSelectDiv = gfg.$("<div>").addClass("gfgFreeGiftSingleOfferSelectDiv");
                    const gfgFreeGiftMsgIcon = gfg.$("<div>").addClass('gfgFreeGiftMsgIcon');
                    const gfgFreeGiftMsgIconImageElementOfItem = gfg.$("<img>").attr("src", imagePath).addClass('gfgFreeGiftMsgIconImageElementOfItem').attr("alt", "icon");
                    const gfgFreeGiftMsgTextContainer = gfg.$("<div>").addClass('gfgFreeGiftMsgTextContainer');
                    const gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(optionsConfigData.title);
                    const gfgFreeGiftMsgSubTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgSubTitle').append(optionsConfigData.subtitle);
                    const variants = product.variants;

                    
                    let variantSelect;
                    if (!freeGiftInsideCart && isFreeGiftValid && variants.length > 1) {
                        variantSelect = gfg.$("<select>").addClass("gfgFreeGiftVariantSelect").addClass("gfgFreeGiftVariantSelect" + i);
                        variants.forEach(variant => {
                            const optionText = variant?.title || "XX";
                            const optionSelect = gfg.$("<option>").addClass("gfgFreeGiftVariantOption").val(variant?.variantId).text(optionText);
                            variantSelect.append(optionSelect);
                        });
                    }

                    const gfgFreeGiftClaimButton = gfg.$("<div>").addClass("gfgFreeGiftClaimButton").addClass("gfgFreeGiftClaimButton" + i);
                    gfgFreeGiftClaimButton.attr("data-rule-id", tier.ruleId);
                    gfgFreeGiftClaimButton.attr("data-product-id", product.productId);


                    let divsForMessaging = {
                        gfgFreeGiftMsgTitle,
                        gfgFreeGiftMsgSubTitle,
                    }


                    gfg.$('.gfgFreeGiftClaimButton' + i).off('click');
                    gfg.$('.gfgFreeGiftClaimButton' + i).unbind('click');
                    gfg.$(document).on("click", '.gfgFreeGiftClaimButton' + i, async function(event) {
                       await gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, i,validFreeGiftTiers);
                       return;
                    });
                    
                    // gfgFreeGiftClaimButton.off('click');

                    // gfgFreeGiftClaimButton.on("click", async function(event) {
                    //     await gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, i, validFreeGiftTiers);
                    //     return;
                    // });

                    gfg.gfgFreeGift.f.setUpClaimButton(gfgFreeGiftClaimButton, userConfigData, isFreeGiftValid, freeGiftInsideCart, product, divsForMessaging);
                   
                    

                    gfgFreeGiftMsgIcon.append(gfgFreeGiftMsgIconImageElementOfItem)

                    gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgTitle)
                    
                    if(variantSelect == null){
                        gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgSubTitle);
                    }else{
                        gfgFreeGiftMsgTextContainer.append(variantSelect)
                    }

                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftMsgIcon);
                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftMsgTextContainer);
                    gfgFreeGiftSingleOfferSelectDiv.append(gfgFreeGiftClaimButton);

                    
                    gfgSingleOffergiftContainerDiv.append(gfgFreeGiftSingleOfferSelectDiv);
                }

                    return gfgSingleOffergiftContainerDiv;

            },
            setUpClaimButton:function (claimButton, userConfig, isValid, productIdInsideCart, product,divsForMessaging) {
                let { gfgFreeGiftMsgTitle, gfgFreeGiftMsgSubTitle} = divsForMessaging;


                let productInsideCartForThisTier =  productIdInsideCart;
                // let determinStateForButton =  gfg.gfgFreeGift.utility.getClaimButtonStatus(isValid, productIdInsideCart, product, userConfig);

                // Case when the free gift tier is not valid.
                if (!isValid) {
                    claimButton.html(userConfig.addtionalFields.claimText).addClass("gfgFreeGiftInvalidProductClaimButton");
                } 
                
                // Case when the free gift tier is valid and a gift from this tier is already in the cart.
                else if (isValid && productInsideCartForThisTier) {
                    claimButton.html(userConfig.addtionalFields.claimText).addClass("gfgFreeGiftValidProductInactiveClaimButton");
                    // Additional configurations for this state can be added here.
                } 

                // Case when the free gift tier is valid but a gift from this tier has not been added to the cart.
                else if (isValid && productInsideCartForThisTier == null) {
                    claimButton.html(userConfig.addtionalFields.claimText)
                            .addClass("gfgFreeGiftClaimButtonAddToCart")
                            .addClass("gfgFreeGiftReadyToClaimButton");
                    gfgFreeGiftMsgSubTitle.html(userConfig?.addtionalFields?.conditionMetCartSubtitle);
                    // Additional configurations for this state can be added here.
                }

                // Case when the gift is already claimed and the product is in the cart.
                if (product.productId == productInsideCartForThisTier) {
                    claimButton.html(userConfig.addtionalFields.claimedText).addClass('gfgFreeGiftActiveFreeGiftClaimButton');
                    let pillContainer = gfg.gfgFreeGift.f.gfgFreeGiftCreatePill(userConfig.addtionalFields.claimedCartSubtitle, isValid);
                    gfgFreeGiftMsgSubTitle.html(pillContainer);
                    gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(userConfig.addtionalFields.claimedCartTitle);
                    gfgFreeGiftMsgSubTitle.removeClass('gfgFreeGiftMsgSubTitleNoteTextColor');
                } 

                // Case when a gift is claimed for this tier but it's not the current product.
                else if (isValid && product.productId != productInsideCartForThisTier && productInsideCartForThisTier != null) {
                    gfgFreeGiftMsgSubTitle.css("display", "none");
                    console.log("Another product from this tier has already been claimed");
                    return;
                }

                                
                            
    
            },
            
            gfgFreeGiftContainerOverflow: function(){
                try {
                    gfg.utility.debugConsole('inside overflow')
                
                    let container = gfg.$(".gfgProductPageWrapperV2")
                    let content
                    if(gfg.$(".gfgFreeGiftOptionsContainerDivExpanded").length > 0){
                        content = gfg.$(".gfgFreeGiftOptionsContainerDivExpanded")[0];
                    }else{
                        content = gfg.$(".gfgFreeGiftOptionsContainerDiv")[0]
                    }

                    // let contentWidth = gfg.$(".gfgFreeGiftMsgOptionRow")[0].scrollWidth
                    let contentWidth;
                    let isAccordion = gfg.gfgFreeGift.state.isAccordion;
                    if(isAccordion){
                        contentWidth = content.scrollWidth
                    }else{
                        container = gfg.$(".gfgProductPageWrapperV2")
                        let containerWidth = container.width()


                        let singleOfferDIv = gfg.$(".gfgFreeGiftSingleOfferSelectDiv").css("max-width", containerWidth).css("overflow", "auto")
                        container = gfg.$(".gfgSingleOffergiftContainerDiv")
                        contentWidth = gfg.$(".gfgFreeGiftSingleOfferSelectDiv")[0].scrollWidth
                        // let wrapper = gfg.$(".gfgCartPageWrapperV2").css("max-width", "100%").css("overflow", "auto")
                    }

                    let containerWidth = container.width()
                    let gfgClaimButtons = gfg.$(".gfgFreeGiftClaimButton")

                    gfg.utility.debugConsole(`contentWidth: ${contentWidth} , containerWidth: ${containerWidth} `)

                    isFull = contentWidth > containerWidth;
                    if (isFull) {
                        gfgClaimButtons.addClass('gfgFreeGiftScrollbar-visible');
                    } else {
                        gfgClaimButtons.removeClass('gfgFreeGiftScrollbar-visible');
                    }
                } catch (error) {
                    gfg.utility.debugError("gfgFreeGiftContainerOverflow", error)     
                }
            },
            Old_gfgFreeGiftPrepareChildUI: async function(product, validFreeGiftTiers, inValidFreeGiftTiers, tierCount, tierData, configData, counter){
                let AllFreeGiftTiers = gfg.settings.freeGifts[0].rulesList
                let userConfigData = gfg.settings.freeGifts[0].configuration
                let freeGiftInsideCart = gfg.gfgFreeGift.f.gfgFreeGiftGetFreeProductInCart();
                let validTierProductIds = gfg.gfgFreeGift.f.gfgFreeGiftGetValidTierProductIds(validFreeGiftTiers);

                let iterator = tierCount;
                let tier = tierData;
                let imagePath;
                if(product.images.length == 0){
                    imagePath = `https://free-gift-app7.s3.us-east-2.amazonaws.com/public/freeGiftDymmyImage.png`
                }else{
                    imagePath = product.images[0].originalSrc
                }
                
                let isFreeGiftValid = false;
                for (const productId of validTierProductIds) {
                    if (productId == product.productId) {
                        isFreeGiftValid = true;
                        break;
                    }
                }
                gfg.utility.debugConsole(isFreeGiftValid)
                // let configData on basis of tiers
                let optionsConfigData = gfg.gfgFreeGift.f.gfgFreeGiftSetupConfigData(isFreeGiftValid, configData, iterator, tier, product )

                let gfgFreeGiftMsgOptionRow = gfg.$("<div>").addClass('gfgFreeGiftMsgOptionRow').attr("rule-id-tier", tier.ruleId);
                
                let gfgFreeGiftMsgIcon = gfg.$("<div>").addClass('gfgFreeGiftMsgIcon')
                
                
                let gfgFreeGiftMsgIconImageElementOfItem = gfg.$("<img>").attr("src", imagePath ).addClass('gfgFreeGiftMsgIconImageElementOfItem').attr("alt", "icon");
                gfgFreeGiftMsgIcon.append(gfgFreeGiftMsgIconImageElementOfItem)
                
                let gfgFreeGiftMsgTextContainer = gfg.$("<div>").addClass('gfgFreeGiftMsgTextContainer')
                let gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(optionsConfigData.title)
                // console.log(gfgFreeGiftMsgTitle.scrollWidth, 'scroll width')

                let gfgFreeGiftMsgSubTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgSubTitle')
                        
                


                let pillContainer = gfg.gfgFreeGift.f.gfgFreeGiftCreatePill(optionsConfigData.subtitle, isFreeGiftValid)
                gfgFreeGiftMsgSubTitle.html(optionsConfigData.subtitle)
                
                        
                let variantSelect = null;
                let variants = product.variants

                if(freeGiftInsideCart == null && isFreeGiftValid && variants.length > 1 ){
                    variantSelect = gfg.$("<select>").addClass("gfgFreeGiftVariantSelect").addClass("gfgFreeGiftVariantSelect" + counter);
                
                    for(let l = 0; l < variants.length; l++){
                        let variant = variants[l];
                        let optionText = variant?.title || "XX"
                        let optionSelect = gfg.$("<option>").addClass("gfgFreeGiftVariantOption").val(variant?.variantId)
                        optionSelect.text(optionText)
                        variantSelect.append(optionSelect)
                    }
                    // selectCounter++;
                }

                let gfgFreeGiftClaimButton = gfg.$("<div>").addClass("gfgFreeGiftClaimButton");
                gfgFreeGiftClaimButton.addClass("gfgFreeGiftClaimButton" + counter);                
                if(isFreeGiftValid == false){
                    gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText).addClass("gfgFreeGiftInvalidProductClaimButton")
                }

                if(isFreeGiftValid && freeGiftInsideCart){
                    gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText).addClass("gfgFreeGiftValidProductInactiveClaimButton")
                    gfgFreeGiftMsgSubTitle.addClass("gfgFreeGiftMsgSubTitleNoteTextColor");
                    gfgFreeGiftMsgSubTitle.html(userConfigData.addtionalFields?.conditionMetButCannotClaimSubtitle || "Only 1 gift can be claimed at a time")
                }

                if(isFreeGiftValid && freeGiftInsideCart == null ){
                    gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimText);
                    gfgFreeGiftClaimButton.addClass("gfgFreeGiftClaimButtonAddToCart").addClass("gfgFreeGiftReadyToClaimButton")
                    gfgFreeGiftMsgSubTitle.html(userConfigData.addtionalFields?.conditionMetCartSubtitle || "Free Gift ready to claim")
                }

                gfg.$('.gfgFreeGiftClaimButton' + counter).off('click');

                gfg.$('.gfgFreeGiftClaimButton' + counter).unbind('click');

                // gfg.$(document).on("click", '.gfgFreeGiftClaimButton' + counter, function(event) {
                //     gfg.utility.debugConsole('counter: ', counter, '   product: ', product)
                    
                //     gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, counter);
                //   });

                if(product.productId == freeGiftInsideCart){                    
                    gfgFreeGiftClaimButton.html(userConfigData.addtionalFields.claimedText).addClass('gfgFreeGiftActiveFreeGiftClaimButton');
                    pillContainer = gfg.gfgFreeGift.f.gfgFreeGiftCreatePill(userConfigData.addtionalFields.claimedCartSubtitle , isFreeGiftValid)
                    gfgFreeGiftMsgSubTitle.html(pillContainer)
                    gfgFreeGiftMsgTitle = gfg.$("<div>").addClass('gfgFreeGiftMsgTitle').html(userConfigData.addtionalFields.claimedCartTitle)
                    gfgFreeGiftMsgSubTitle.removeClass('gfgFreeGiftMsgSubTitleNoteTextColor')
                }

                // for dropDown;

                gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgTitle);

                if(variantSelect == null){
                    gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgSubTitle);
                }else{
                    gfgFreeGiftMsgTextContainer.append(variantSelect)
                }


                gfgFreeGiftMsgOptionRow.append(gfgFreeGiftMsgIcon)
                gfgFreeGiftMsgOptionRow.append(gfgFreeGiftMsgTextContainer)
                gfgFreeGiftMsgOptionRow.append(gfgFreeGiftClaimButton)

                return gfgFreeGiftMsgOptionRow;
            },
            gfgFreeGiftPrepareChildUI: async function(product, validFreeGiftTiers, inValidFreeGiftTiers, tierCount, tierData, configData, counter){
                    const settings = gfg.settings.freeGifts[0];
                    const AllFreeGiftTiers = settings.rulesList;
                    const userConfigData = settings.configuration;
                    const validTierProductIds = gfg.gfgFreeGift.f.gfgFreeGiftGetValidTierProductIds(validFreeGiftTiers);
                    
                    const tier = tierData;
                    const freeGiftInsideCart = gfg.gfgFreeGift.f.gfgFreeGiftGetFreeProductInCart(tier); 
                    const imagePath = product.images.length === 0 ? 
                        'https://free-gift-app7.s3.us-east-2.amazonaws.com/public/freeGiftDymmyImage.png' : product.images[0].originalSrc;
                
                    let isFreeGiftValid = validTierProductIds.includes(product.productId);
                
                    gfg.utility.debugConsole(isFreeGiftValid);
                
                    const optionsConfigData = gfg.gfgFreeGift.f.gfgFreeGiftSetupConfigData(isFreeGiftValid, configData, tierCount, tier, product);
                
                    const gfgFreeGiftMsgOptionRow = gfg.$("<div>").addClass("gfgFreeGiftMsgOptionRow").attr("rule-id-tier", tier.ruleId);

                    const gfgFreeGiftMsgIconImageElementOfItem = gfg.$("<img>").attr("src", imagePath).addClass("gfgFreeGiftMsgIconImageElementOfItem").attr("alt", "icon");

                    const gfgFreeGiftMsgIcon = gfg.$("<div>").addClass("gfgFreeGiftMsgIcon").append(gfgFreeGiftMsgIconImageElementOfItem);

                    const gfgFreeGiftMsgTitle = gfg.$("<div>").addClass("gfgFreeGiftMsgTitle").html(optionsConfigData.title);

                    const gfgFreeGiftMsgSubTitle = gfg.$("<div>").addClass("gfgFreeGiftMsgSubTitle").html(optionsConfigData.subtitle);

                    const variants = product.variants;
                    let variantSelect;
                    if (freeGiftInsideCart === null && isFreeGiftValid && variants.length > 1) {
                      variantSelect = gfg.$("<select>").addClass("gfgFreeGiftVariantSelect").addClass("gfgFreeGiftVariantSelect" + counter);

                      variants.forEach((variant) => {
                        const optionText = variant.title || "XX";
                        const optionSelect = gfg.$("<option>").addClass("gfgFreeGiftVariantOption").val(variant.variantId).text(optionText);
                        variantSelect.append(optionSelect);
                      });
                    }

                    const gfgFreeGiftClaimButton = gfg.$("<div>").addClass("gfgFreeGiftClaimButton").addClass("gfgFreeGiftClaimButton" + counter);

                    gfg.$('.gfgFreeGiftClaimButton' + counter).off('click');

                    gfg.$('.gfgFreeGiftClaimButton' + counter).unbind('click');

                    gfg.$(document).on("click", ".gfgFreeGiftClaimButton" + counter, function (event) {
                      gfg.utility.debugConsole("counter: ", counter, "   product: ", product);

                      gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction(event, product, counter,validFreeGiftTiers);
                    });

                    let divsForMessaging = {
                        gfgFreeGiftMsgTitle,
                        gfgFreeGiftMsgSubTitle,
                    }
                    gfg.gfgFreeGift.f.setUpClaimButton(gfgFreeGiftClaimButton,userConfigData, isFreeGiftValid, freeGiftInsideCart, product,divsForMessaging);

                    const gfgFreeGiftMsgTextContainer = gfg.$("<div>").addClass("gfgFreeGiftMsgTextContainer")
                    gfgFreeGiftMsgTextContainer.append(gfgFreeGiftMsgTitle).append(variantSelect || gfgFreeGiftMsgSubTitle);
                
                    gfgFreeGiftMsgOptionRow.append(gfgFreeGiftMsgIcon, gfgFreeGiftMsgTextContainer, gfgFreeGiftClaimButton);
                
                    return gfgFreeGiftMsgOptionRow;
                
            },
            gfgFreeGiftPrepareUI: async function(validFreeGiftTiers, inValidFreeGiftTiers, AllFreeGiftTiers ){
                // let validFreeGiftTiers = validFreeGiftTiers;
                // let inValidFreeGiftTiers = inValidFreeGiftTiers;
                let configData = {}
                let userConfigData = gfg.settings.freeGifts[0].configuration
                let allProductsData = gfg.gfgFreeGift.state.freeGiftsData;
                let isAccordion = gfg.gfgFreeGift.state.isAccordion;
                
                gfg.utility.debugConsole('inside current prepare ui')
                let superiorTier = gfg.gfgFreeGift.state.superiorTier;
                // console.log(superiorTier, 'superior tier')

                // console.log(validFreeGiftTiers , 'valid free gift tiers')

                let freeGiftInsideCart = gfg.gfgFreeGift.f.gfgFreeGiftGetFreeProductInCart();
                
                if(AllFreeGiftTiers.length === 1){
                    gfg.gfgFreeGift.state.isAccordion = false;
                    isAccordion = false
                }
                
                configData =  gfg.gfgFreeGift.f.prepareConfigData(userConfigData, freeGiftInsideCart)
                    

                let {
                    gfgFreeGiftMsgParentContainerForDropDown,
                    gfgFreeGiftMsgContainerForAccordion,
                    gfgFreeGiftOptionsContainerDiv,
                    gfgFreeGiftSelectDiv

                } = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareParentUI(validFreeGiftTiers, inValidFreeGiftTiers, configData)

                if(isAccordion){
                    let gfgFreeGiftPrepareChildUIArr = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareChildUIArr(AllFreeGiftTiers, configData)
                    gfgFreeGiftOptionsContainerDiv.html(gfgFreeGiftPrepareChildUIArr)
                }
                
                gfgFreeGiftMsgContainerForAccordion.append(gfgFreeGiftOptionsContainerDiv);
                gfgFreeGiftMsgParentContainerForDropDown.append(gfgFreeGiftMsgContainerForAccordion)
                gfgFreeGiftMsgParentContainerForDropDown.append(gfgFreeGiftSelectDiv)
                
                return gfgFreeGiftMsgParentContainerForDropDown;

            },
            gfgFreeGiftPrepareChildUIArr: async function(AllFreeGiftTiers, configData){
                let gfgFreeGiftPrepareChildUIArr = []
                let counter = 0
                for (let i = 0; i < AllFreeGiftTiers.length ; i++) {
                    let tier = AllFreeGiftTiers[i];
                    let isAutoAdd = gfg.settings.freeGifts[0].isAutoAdd
                    let freeGiftProductArray = tier.freeGiftProduct;
                    let tierLengthToBeIterated = 1;
                    if(!isAutoAdd){
                        tierLengthToBeIterated = freeGiftProductArray.length
                    }

                    for(let k=0; k < tierLengthToBeIterated; k++){
                        let product = freeGiftProductArray[k];
                        
                        let gfgFreeGiftMsgOptionRow = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareChildUI(product, gfg.gfgFreeGift.state.validFreeGiftTiers, gfg.gfgFreeGift.state.inValidFreeGiftTiers, i, tier, configData, counter);

                        // gfgFreeGiftMsgOptionRow
                        gfgFreeGiftPrepareChildUIArr.push(gfgFreeGiftMsgOptionRow);
                        counter++;
                    }
                      
                }
                return gfgFreeGiftPrepareChildUIArr
            },
            gfgFreeGiftCreatePill: function(title, isFreeGiftValid){
                let color;
                if(isFreeGiftValid == true){
                    color = '#90EE90'
                }else{
                    color = '#75ffff'
                }
                gfg.utility.debugConsole(title)
                let pillContainer = gfg.$('<div>').addClass('gfgFreeGiftPill-container');
                
                let pillSegment = gfg.$('<div>').addClass('gfgFreeGiftPill-segment')
                pillContainer.append(pillSegment);
                
                let pillCenter = gfg.$('<div>').addClass('gfgFreeGiftPill-segment').css("background-color", color).html(title)
                pillContainer.append(pillCenter);

                pillSegment = gfg.$('<div>').addClass('gfgFreeGiftPill-segment')
                pillContainer.append(pillSegment);

                return pillContainer;
            },
            gfgFreeGiftSetupConfigData: function(isFreeGiftValid, configData, iterator, tier, product){
                let optionsConfigData = {};
                let tierConfigs = gfg.settings.freeGifts[0].configuration.tierConfig[iterator];
                let userConfigData = gfg.settings.freeGifts[0].configuration
                let shopName = window.Shopify.shop
                    if(tier.ruleType == "BUY_PRODUCT_X"){
                        let FREE_GIFT_PRODUCT = product?.title || "XX";
                        let PRODUCT_QUANTITY = tier?.minProducts ||  "XX";    
                        let PRODUCT = tier?.productList[0].title || "XX"; // [1].productList[0].title
                        let PRODUCT_HANDLE = tier?.productList[0].handle || "XX"; // [1].productList[0].title
                        let CURRENT_QTY_BUY_PRODUCT_X = gfg.gfgFreeGift.f.gfgFreeGiftFindInArray(iterator, gfg.gfgFreeGift.state.CURRENT_QTY_BUY_PRODUCT_X)
                        let REMAINING_QUANTITY = parseInt(PRODUCT_QUANTITY) - CURRENT_QTY_BUY_PRODUCT_X
                        // optionsConfigData.title = optionsConfigData.title.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        // optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        let tierConfigStringified = JSON.stringify(tierConfigs.conditionNotMet);

                        optionsConfigData = JSON.parse(tierConfigStringified);
                        optionsConfigData.title = optionsConfigData.title.replace("{{PRODUCT_QUANTITY}}", PRODUCT_QUANTITY);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{PRODUCT_QUANTITY}}", PRODUCT_QUANTITY);
    
                        optionsConfigData.title = optionsConfigData.title.replace("{{PRODUCT}}", PRODUCT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{PRODUCT}}", PRODUCT);

                        optionsConfigData.title = optionsConfigData.title.replace("{{PRODUCT_LINK}}", `<a href="/products/${PRODUCT_HANDLE}" target="_blank">${PRODUCT}</a>`);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{PRODUCT_LINK}}", `<a href="/products/${PRODUCT_HANDLE}" target="_blank">${PRODUCT}</a>`);

                        optionsConfigData.title = optionsConfigData.title.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);

                        // remaining qty
                        optionsConfigData.title = optionsConfigData.title.replace("{{REMAINING_QUANTITY}}", REMAINING_QUANTITY);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{REMAINING_QUANTITY}}", REMAINING_QUANTITY);

                        optionsConfigData.icon = optionsConfigData.icon
                    }

                    if(tier.ruleType == "SPEND_X"){
                        let FREE_GIFT_PRODUCT = product?.title || "XX";
                        let minAmount = tier?.minimumCartValue || "0"
                        minAmount = parseFloat(minAmount)
                        let minAmountUserCurrency = gfg.utility.convertFromStoreCurrencyToCustomer(minAmount)
                        let REMAINING_AMOUNT = minAmountUserCurrency - (gfg.state.cartData.items_subtotal_price/100) || '-1';
                        let CURRENCY = gfg.utility.getCurrencySymbol() || "$";
                        REMAINING_AMOUNT = parseFloat(REMAINING_AMOUNT).toFixed(2)
                        let tierConfigStringified = JSON.stringify(tierConfigs.conditionNotMet);

                        optionsConfigData = JSON.parse(tierConfigStringified);

                        optionsConfigData.title = optionsConfigData.title.replace("{{REMAINING_AMOUNT}}", REMAINING_AMOUNT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{REMAINING_AMOUNT}}", REMAINING_AMOUNT);
    
                        optionsConfigData.title = optionsConfigData.title.replace("{{CURRENCY}}", CURRENCY);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{CURRENCY}}", CURRENCY);

                        optionsConfigData.title = optionsConfigData.title.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);

                        optionsConfigData.icon = optionsConfigData.icon
                    }

                    if(tier.ruleType == "SPEND_X_IN_COLLECTION_Y"){
                        let FREE_GIFT_PRODUCT = product?.title || "XX";
                        let minAmount = tier?.minimumCartValue || "0"
                        minAmount = parseFloat(minAmount)
                        let minAmountUserCurrency = gfg.utility.convertFromStoreCurrencyToCustomer(minAmount)
                        minAmountUserCurrency = parseFloat(minAmountUserCurrency)
                        let REMAINING_AMOUNT_FROM_COLLECTION = gfg.gfgFreeGift.f.gfgFreeGiftFindInArray(iterator, gfg.gfgFreeGift.state.CURRENT_TOTAL_FOR_SPEND_X_IN_COLLECTION_Y)
                        let REMAINING_AMOUNT = minAmountUserCurrency - REMAINING_AMOUNT_FROM_COLLECTION;
                        REMAINING_AMOUNT = parseFloat(REMAINING_AMOUNT).toFixed(2)
                        let CURRENCY = gfg.utility.getCurrencySymbol() || "$";

                        let COLLECTION = tier?.collection[0].title || "XX";
                        let COLLECTION_HANDLE = tier?.collection[0].handle || "XX";
                        
                        let tierConfigStringified = JSON.stringify(tierConfigs.conditionNotMet);

                        optionsConfigData = JSON.parse(tierConfigStringified);

                        optionsConfigData.title = optionsConfigData.title.replace("{{REMAINING_AMOUNT}}", REMAINING_AMOUNT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{REMAINING_AMOUNT}}", REMAINING_AMOUNT);
    
                        optionsConfigData.title = optionsConfigData.title.replace("{{CURRENCY}}", CURRENCY);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{CURRENCY}}", CURRENCY);

                        optionsConfigData.title = optionsConfigData.title.replace("{{COLLECTION}}", COLLECTION);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{COLLECTION}}", COLLECTION);

                        optionsConfigData.title = optionsConfigData.title.replace("{{COLLECTION_LINK}}", `<a href="/collections/${COLLECTION_HANDLE}" target="_blank">${COLLECTION}</a>`);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{COLLECTION_LINK}}", `<a href="/collections/${COLLECTION_HANDLE}" target="_blank">${COLLECTION}</a>`);

                        optionsConfigData.title = optionsConfigData.title.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);

                        optionsConfigData.icon = optionsConfigData.icon
                    }

                    if(tier.ruleType == "BUY_ANY_PRODUCT_FROM_COLLECTION_Y"){
                        let COLLECTION = tier?.collection[0].title || "XX";
                        let COLLECTION_HANDLE = tier?.collection[0].handle || "XX";
                        let FREE_GIFT_PRODUCT = product?.title || "XX";
                        let PRODUCT_QUANTITY = tier?.minProducts ||  "XX";
                        let CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y = gfg.gfgFreeGift.f.gfgFreeGiftFindInArray(iterator, gfg.gfgFreeGift.state.CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y)
                        let REMAINING_QUANTITY = parseInt(PRODUCT_QUANTITY) - CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y

                        let tierConfigStringified = JSON.stringify(tierConfigs.conditionNotMet);

                        optionsConfigData = JSON.parse(tierConfigStringified);

                        // optionsConfigData.title = optionsConfigData.title.replace("{{PRODUCT}}", PRODUCT);
                        // optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{PRODUCT}}", PRODUCT);

                        optionsConfigData.title = optionsConfigData.title.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{FREE_GIFT_PRODUCT}}", FREE_GIFT_PRODUCT);

                        optionsConfigData.title = optionsConfigData.title.replace("{{COLLECTION}}", COLLECTION);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{COLLECTION}}", COLLECTION);

                        optionsConfigData.title = optionsConfigData.title.replace("{{COLLECTION_LINK}}", `<a href="/collections/${COLLECTION_HANDLE}" target="_blank">${COLLECTION}</a>`);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{COLLECTION_LINK}}", `<a href="/collections/${COLLECTION_HANDLE}" target="_blank">${COLLECTION}</a>`);

                        optionsConfigData.title = optionsConfigData.title.replace("{{REMAINING_QUANTITY}}", REMAINING_QUANTITY);
                        optionsConfigData.subtitle = optionsConfigData.subtitle.replace("{{REMAINING_QUANTITY}}", REMAINING_QUANTITY);

                        optionsConfigData.icon = optionsConfigData.icon
                    }

                    if(isFreeGiftValid == true){
                        // optionsConfigData.subtitle = "Condition success";
                        userConfigData = gfg.settings.freeGifts[0].configuration.addtionalFields
                        // optionsConfigData.title = userConfigData.claimedCartTitle

                    }else{
                        // optionsConfigData.title = userConfigData.addtionalFields.conditionNotMetText

                    }
                    // console.log(optionsConfigData)

                return optionsConfigData
            },
            gfgFreeGiftCreateMessageToast: function(event){
                let userConfigData = gfg.settings.freeGifts[0].configuration
                
                gfg.$('.gfgFreeGiftToast').remove();
                
                let message = userConfigData.addtionalFields.alreadyClaimedText
                let toast = gfg.$('<div>').addClass('gfgFreeGiftToast').text(message);
                let parentElement = gfg.$(event.currentTarget).parent();
                // Append the toast to the document body gfg.$(event.currentTarget)
                parentElement.append(toast);
              
                // Set a timeout to remove the toast after 5 seconds
                setTimeout(function() {
                  toast.remove();
                }, 5000);
            },
            gfgFreeGiftGetFreeProductInCart: function(ruleData){
                let productId = null;
                let items = gfg.state.cartData.items
                if(!gfg.settings.freeGifts[0].isMultipleFreeGiftAllowed){
                    for (const item of items) {
                      if (item.properties && item.properties._free_product == "true") {
                        productId = item.product_id;
                        break;
                      }
                    }
                }else if(gfg.settings.freeGifts[0].isMultipleFreeGiftAllowed && ruleData){
                    productId = gfg.gfgFreeGift.utility.getProductIdFromRuleId(ruleData.ruleId)
                }

                return productId;
            },
            checkifFreeGiftConditionIsMet: function (ruleData, cartData, iterator) {
                if(ruleData.ruleType == "BUY_PRODUCT_X"){
                    let validProductList = []
                    ruleData.productList.forEach(product => {
                        validProductList.push(product.productId)
                    })
                    //check if condition is true 
                    for(let i = 0; i < cartData.items.length; i++){
                        let cartItem = cartData.items[i]
                        if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                            continue
                        }
                        // gfg.gfgFreeGift.state.CURRENT_QTY_BUY_PRODUCT_X = cartItem.quantity
                        // gfg.gfgFreeGift.f.gfgFreeGiftFindAndUpdateInArray(i, cartItem.quantity, gfg.gfgFreeGift.state.CURRENT_QTY_BUY_PRODUCT_X)
                        if(validProductList.indexOf((""+cartItem.product_id)) >= 0 && cartItem.quantity >= ruleData.minProducts){
                            return parseInt(cartItem.quantity / ruleData.minProducts)
                        }
                    }
                }
                else if(ruleData.ruleType == "BUY_ANY_PRODUCT_FROM_COLLECTION_Y"){
                    let validCollectionList = []
                    ruleData.collectionsData.forEach(collection => {
                        validCollectionList.push(collection)
                    })
                    let returnQty = 0
                    //check if condition is true 
                    for(let i = 0; i < cartData.items.length; i++){
                        let cartItem = cartData.items[i]
                        if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                            continue
                        }
                        if(gfg.f.checkIfCartItemIsPartOfValidCollectionList(cartItem,validCollectionList)){
                            returnQty += parseInt(cartItem.quantity)
                        }
                    }

                    // gfg.gfgFreeGift.state.CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y = returnQty
                    gfg.gfgFreeGift.f.gfgFreeGiftFindAndUpdateInArray(iterator, returnQty, gfg.gfgFreeGift.state.CURRENT_QTY_BUY_ANY_PRODUCT_FROM_COLLECTION_Y)    
                    if(returnQty >= ruleData.minProducts){
                        return parseInt(returnQty / ruleData.minProducts)
                    }else{
                        return 0
                    }
                }
                else if(ruleData.ruleType == "SPEND_X_IN_COLLECTION_Y"){
                    let validCollectionList = []
                    ruleData.collectionsData.forEach(collection => {
                        validCollectionList.push(collection)
                    })
                    //check if condition is true 
                    let totalCartValue =0;
                    for(let i = 0; i < cartData.items.length; i++){
                        let cartItem = cartData.items[i]
                        if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                            continue
                        }
                        if(gfg.f.checkIfCartItemIsPartOfValidCollectionList(cartItem,validCollectionList)){
                           const cartItemPrice= gfg.utility.formatPriceWithoutSymbol(cartItem.price) 
                           totalCartValue +=  cartItemPrice * cartItem.quantity
                        }
                    }
                    // gfg.gfgFreeGift.state.CURRENT_TOTAL_FOR_SPEND_X_IN_COLLECTION_Y = totalCartValue
                    gfg.gfgFreeGift.f.gfgFreeGiftFindAndUpdateInArray(iterator, totalCartValue, gfg.gfgFreeGift.state.CURRENT_TOTAL_FOR_SPEND_X_IN_COLLECTION_Y)
                    if(totalCartValue >= gfg.utility.convertFromStoreCurrencyToCustomer(ruleData.minimumCartValue)){
                        return 1;
                    }
                }else if(ruleData.ruleType == "SPEND_X"){
                    let totalCartValue =0;
                    for(let i = 0; i < cartData.items.length; i++){
                        let cartItem = cartData.items[i]
                        if(cartItem && cartItem.properties && cartItem.properties["_free_product"]){
                            continue
                        }
                        const cartItemPrice= gfg.utility.formatPriceWithoutSymbol(cartItem.final_price) 
                        totalCartValue +=  cartItemPrice * cartItem.quantity
                    }
                    if(totalCartValue >= gfg.utility.convertFromStoreCurrencyToCustomer(ruleData.minimumCartValue)){
                        return 1;
                    }
                }
                return 0 
            },
            prepareConfigData:  function(userConfigData, freeGiftInsideCart){

                let configData = {}
                if(gfg.gfgFreeGift.state.prepareUIState == "CONDITION_NOT_MET"){
                    configData.icon = userConfigData.globalConfig.conditionNotMet.icon || "https://cdn-icons-png.flaticon.com/512/3209/3209955.png" ; // take from gfg
                    configData.title = userConfigData.globalConfig.conditionNotMet.title;
                    configData.subtitle = userConfigData.globalConfig.conditionNotMet.subtitle;
                    configData.buttonText = userConfigData.addtionalFields.claimText
                    configData.buttonBgColor = ""
                }else if(gfg.gfgFreeGift.state.prepareUIState == "CONDITION_FULFILLED"){
                        configData.icon = userConfigData.globalConfig.conditionFulFilled.icon || "https://cdn-icons-png.flaticon.com/512/3209/3209955.png";
                        configData.title = userConfigData.globalConfig.conditionFulFilled.title;
                        configData.subtitle = userConfigData.globalConfig.conditionFulFilled.subtitle;
                        configData.buttonText = userConfigData.addtionalFields.claimText
                        configData.buttonBgColor = "gray"
                }else if(gfg.gfgFreeGift.state.prepareUIState == "CONDITION_MET"){
                    configData.icon = userConfigData.globalConfig.conditionInProgress.icon || "https://cdn-icons-png.flaticon.com/512/3209/3209955.png"; // take from gfg
                    configData.title = userConfigData.globalConfig.conditionInProgress.title;
                    configData.subtitle = userConfigData.globalConfig.conditionInProgress.subtitle;
                    configData.buttonText = userConfigData.addtionalFields.claimText
                    configData.buttonBgColor = ""
                }

                if(freeGiftInsideCart == null){
                    configData.buttonBgColor = "black"
                }else if(freeGiftInsideCart != null){
                    configData.buttonBgColor = "gray"
                }
                return configData

            },
            rerenderCart: async function () {
                let cartData = await gfg.utility.getCart()
                let cartPageWrapperV2 = gfg.$(document).find(gfg.selectors.cartPageWrapperV2)
                cartPageWrapperV2.empty()
                await gfg.cartPage.f.insertWrapperIntoPage(gfg.settings)
                gfg.gfgFreeGift.f.checkForFreeGift(cartData)
            },
            updateCartState: async function(t, e, r) {
                //t is card data
                //e is even
                var n = this;
                var i = window.Shopify && window.Shopify.routes ? window.Shopify.routes.root : "/";
                if ("/cart" === window.location.pathname || window.location.pathname === i + "cart") {window.location.reload(); return}


                //type check the function
                function hn(t) {
                    return hn = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
                        return typeof t
                    } : function(t) {
                        return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                    }, hn(t)
                }

                //refresh the cart 
                function refreshThePage(t, e) {
                    try {
                        window.location.href = window.location.href.toString()
                    } catch (t) {
                        gfg.utility.debugError("Failed to reload page using href assignment!", t), window.location.reload()
                    }
                }
                try {
                    var o, a, c, d, u, l, p, s, m, g, h, y;
                    if (window.HsCartDrawer && "function" == typeof window.HsCartDrawer.updateSlideCart && document.querySelector(".hs-site-cart-popup-layout, .hs-header-layout")) return window.HsCartDrawer.updateSlideCart(), !1;
                    if (!window.ignoreRebuyDrawer && window.Rebuy && "object" === hn(window.Rebuy.Cart) && "function" == typeof window.Rebuy.Cart.fetchCart && document.querySelector("#rebuy-cart")) return window.Rebuy.Cart.fetchCart(), f("Update drawer Rebuy"), !1;
                    if (window.SATCB && "object" === hn(window.SATCB.Widgets) && "object" === hn(window.SATCB.Widgets.CartSlider) && "function" == typeof window.SATCB.Widgets.CartSlider.openSlider && document.querySelector(".satcb-cs")) return window.SATCB.Widgets.CartSlider.openSlider(), f("Update drawer SATCB"), !1;
                    
                    if (t && "function" == typeof window.SLIDECART_SET_CART && document.querySelector("#slidecarthq div")) return window.SLIDECART_SET_CART(t), f("Update drawer SLIDECART_SET_CART"), !1;
                    
                    if ("function" == typeof window.SLIDECART_UPDATE && document.querySelector("#slidecarthq div")) return window.SLIDECART_UPDATE(), f("Update drawer SLIDECART_UPDATE"), !1;
                    if (window.sellify && "object" === hn(window.sellify.ucd) && "object" === hn(window.sellify.ucd.helpers) && "object" === hn(window.sellify.ucd.helpers.ShopifyAPI) && "function" == typeof window.sellify.ucd.helpers.ShopifyAPI.getCart && document.querySelector("#sellify-ucd-cart-drawer")) return window.sellify.ucd.helpers.ShopifyAPI.getCart(window.sellify.ucd.helpers.ajaxCart.buildCart), f("Update drawer sellify"), !1;
                    if ("function" == typeof window.upcartRegisterAddToCart && document.querySelector(".upcart-product-item")) return window.upcartRegisterAddToCart(), f("Update drawer upcart app - upcartRegisterAddToCart"), !1;
                    
                    var w = window.csapps ? document.querySelector("[data-csapp_line_wrapper] .cart-quantity-wrap input[data-id]:not([readonly])") : null;
                    if (w) return t && t.item_count ? (w.dispatchEvent(new Event("change", { bubbles: !0 })), f("Update drawer aiod cart app"), !1) : (f("Update drawer aiod cart app - empty cart = refresh"), refreshThePage(t, e));
                    
                    if ("function" == typeof window.CD_REFRESHCART && document.querySelector("#cart-drawer-app .cd-cart")) return window.CD_REFRESHCART(), f("Update drawer CD_REFRESHCART"), !1;
                    if ("function" == typeof window.BoostPFS && "object" === hn(window.BoostPFS.Utils) && document.querySelector(".boost-pfs-minicart-wrapper")) return f("Update drawer not supported for BoostPFS drawer. Refresh!"), refreshThePage(t, e);
                    if ("function" == typeof window.openeamcart && document.querySelector("#shopify-section-eam-cart")) return window.openeamcart(), f("Update drawer openeamcart"), !1;
                    if (t && void 0 !== window.vndHlp && "function" == typeof window.vndHlp.refreshCart) return window.vndHlp.refreshCart(t), f("Update drawer vndHlp.refreshCart"), !1;
                    
                    if (t && window.Cart && "function" == typeof window.Cart.buildCart) return window.Cart.buildCart(t), f("Update drawer Cart.buildCart"), !1;
                    if (t && "function" == typeof window.buildCart && document.querySelector("#mini__cart.yv_side_drawer_wrapper")) return window.buildCart(t), f("Update drawer window.buildCart"), !1;
                    if (window.cartNotification && "function" == typeof window.cartNotification.getCart && document.querySelector("#cart-notification")) return window.cartNotification.getCart(), f("Update drawer cartNotification"), !1;
                    if ("function" == typeof window.do_cart_refresh) return window.do_cart_refresh(!1), f("Update drawer do_cart_refresh"), !1;
                    if (window.theme && "function" == typeof window.theme.CartDrawer && window.theme.CartDrawer.toString().includes("new theme.Drawers")) return setTimeout((function() {return new window.theme.CartDrawer}), 250), f("Update drawer theme CartDrawer"), !1;
                    if (null !== (o = window.theme) && void 0 !== o && null !== (a = o.settings) && void 0 !== a && a.cart_drawer && document.querySelector("#Cart-Drawer")) {
                        if (!t || !t.item_count) return f("Update drawer #Cart-Drawer no items need to refresh"), refreshThePage(t, e);
                        var v = document.createElement("input");
                        return v.style.display = "none", v.classList.add("qty"), v.dataset.index = "1", v.value = t.items[0].quantity, document.querySelector("#CartDrawerItem-1").appendChild(v), v.dispatchEvent(new Event("change", {
                            bubbles: !0
                        })), f("Update drawer #Cart-Drawer"), !1
                    }
                    if (window.Shopify && window.Shopify.theme && ("Expanse" === window.Shopify.theme.name || 902 === window.Shopify.theme.theme_store_id) && document.querySelector("#HeaderCart.site-header__drawer")) return document.dispatchEvent(new Event("cart:build")), f("Update drawer cart:build"), !1;
                    if (t && "function" == typeof window.refreshCart) return window.refreshCart(t), f("Update drawer window.refreshCart"), !1;
                    if ("undefined" != typeof slate && void 0 !== slate.cart && "function" == typeof slate.cart.updateCart) return slate.cart.updateCart(), f("Update drawer slate.cart.updateCart"), !1;
                    if (t && "undefined" != typeof Shopify && "function" == typeof Shopify.updateQuickCart) return Shopify.updateQuickCart(t), f("Update drawer Shopify.updateQuickCart"), !1;
                    if (t && void 0 !== window.bcActionList && "function" == typeof window.bcActionList.atcBuildMiniCartSlideTemplate) return window.bcActionList.atcBuildMiniCartSlideTemplate(t), "function" == typeof window.openMiniCart && window.openMiniCart(), f("Update drawer bcActionList"), !1;
                    if (t && "undefined" != typeof Shopify && void 0 !== Shopify.updateCartInfo && document.querySelector(".top-cart-holder .cart-target form .cart-info .cart-content")) return Shopify.updateCartInfo(t, ".top-cart-holder .cart-target form .cart-info .cart-content"), f("Update drawer Shopify.updateCartInfo"), !1;
                    if (t && "undefined" != typeof Shopify && void 0 !== Shopify.updateCartInfo && document.querySelector("#cart-info #cart-content")) return Shopify.updateCartInfo(t, "#cart-info #cart-content"), f("Update drawer Shopify.updateCartInfo, selector 2"), !1;
                    if (window.theme && "object" === hn(window.theme.cart) && "function" == typeof window.theme.cart._updateCart && "function" == typeof window.$) return window.theme.cart._updateCart({}), window.$("body").trigger("updateCart"), document.dispatchEvent(new Event("cart:build")), f("Update drawer cart:build + updateCart"), !1;
                    if (window.theme && "function" == typeof window.theme.refreshCart) return window.theme.refreshCart(), f("Update drawer theme.refreshCart"), !1;
                    if (document.querySelector("#sidebar-cart.Drawer form.Cart.Drawer__Content")) return setTimeout((function() {
                        var t = new Event("product:added");
                        t.detail = {}, t.detail.quantity = 0, document.dispatchEvent(t)
                    }), 250), setTimeout((function() {
                        document.documentElement.dispatchEvent(new Event("cart:refresh"))
                    }), 500), f("Update drawer BOOMR product:added / cart:refresh"), !1;
                    if ("function" == typeof window.updateQtyCart && "function" == typeof window.$ && document.querySelector("#sidebar-cart.cart-drawer .cart-content[data-cart-content]")) return fetch("/cart?view=drawer&timestamp=" + Date.now(), {
                        credentials: "same-origin",
                        method: "GET"
                    }).then((function(t) {
                        t.text().then((function(t) {
                            $("[data-cart-content]").html(t)
                        }))
                    })), f("Update drawer #sidebar-cart.cart-drawer"), !1;
                    if (document.querySelector("form#mini-cart .mini-cart__content .mini-cart__line-item")) return setTimeout((function() {
                        return document.documentElement.dispatchEvent(new Event("cart:refresh"))
                    }), 500), f("Update drawer custom cart-drawer elem form#mini-cart"), !1;
                    var b = z("shopify_cart_state");
                    if (t && b && document.querySelector("form.cart-drawer")) {
                        J("shopify_cart_state", JSON.stringify(t));
                        var S = new Event("storage");
                        return S.key = "shopify_cart_state", window.dispatchEvent(S), f("Update drawer BOOMR shopify_cart_state"), !1
                    }
                    if (document.querySelector(["#ajaxifyModal #ajaxifyCart", "#ajaxifyDrawer #ajaxifyCart", ".fixed-cart-wrap #slidedown-cart", ".sidebar-drawer-container .sidebar-drawer"].join(","))) return t && t.item_count ? window.forceUpdateModalCart ? (f("Update drawer using custom forceUpdateModalCart"), window.forceUpdateModalCart(), !1) : (gfg.utility.debugConsole("All-in-One Free Gift on Cart: forceUpdateModalCart not set, but was expected."), refreshThePage(t, e)) : (gfg.utility.debugConsole("All-in-One Free Gift on Cart: forceUpdateModalCart reload due to empty cart."), refreshThePage(t, e));
                    if (window.theme && "object" === hn(window.theme.Cart) && "function" == typeof window.theme.Cart.updateCart) return window.theme.Cart.updateCart(), f("Update drawer Cart updateCart"), !1;
                    if (t && "function" == typeof window.render_cart_drawer && window.render_cart_drawer.toString().includes("render_cart_drawer(cart, target, oldQtd, id_variant)")) return window.render_cart_drawer(t, jQuery(".list-products"), 0, ""), f("Update drawer render_cart_drawer"), !1;
                    if (window.cart && "function" == typeof window.cart.getCart && "function" == typeof window.cart.closeCartDropdown && "function" == typeof window.cart.openCartDropdown && document.getElementById("cart-dropdown")) return window.cart.getCart(), f("Update drawer cart.getCart, #cart-dropdown"), !1;
                    if (window.cart && "function" == typeof window.cart.getCart && document.querySelector(".cart-drawer")) return window.cart.getCart(), f("Update drawer cart.getCart, .cart-drawer"), !1;
                    if (window.ajaxCart && "function" == typeof window.ajaxCart.load) return window.ajaxCart.load(), f("Update drawer ajaxCart load"), !1;
                    if (window.Shopify && "object" === hn(window.Shopify.theme) && "object" === hn(window.Shopify.theme.jsAjaxCart) && "function" == typeof window.Shopify.theme.jsAjaxCart.updateView) return window.Shopify.theme.jsAjaxCart.updateView(), f("Update drawer jsAjaxCart updateView"), !1;
                    if (window.Shopify && "object" === hn(window.Shopify.theme) && "object" === hn(window.Shopify.theme.ajaxCart) && "function" == typeof window.Shopify.theme.ajaxCart.init && document.querySelector(".js-mini-cart-trigger")) return document.querySelector(".js-mini-cart-trigger").dispatchEvent(new Event("click")), f("Update drawer js-mini-cart-trigger"), !1;
                    if (window.theme && "object" === hn(window.theme.ajaxCart) && "function" == typeof window.theme.ajaxCart.update && document.querySelector("#CartDrawer.drawer")) return window.theme.ajaxCart.update(), f("Update drawer theme.ajaxCart.update"), !1;
                    if (window.Shopify && "function" == typeof window.Shopify.addItem && "function" == typeof window.jQuery && document.querySelector(".cart-flyout .cart-flyout__content")) return jQuery.get("/cart?view=json", (function(t) {
                        jQuery(".cart-flyout").html(t)
                    })), f("Update drawer g-addtoicart cart-flyout"), !1;
                    if (t && window.wetheme && "function" == typeof window.wetheme.toggleRightDrawer) return window.wetheme.toggleRightDrawer("cart", !0, {
                        cart: t
                    }), f("Update drawer toggleRightDrawer"), !1;
                    if (window.gfTheme && "function" == typeof window.gfTheme.getCart) return window.gfTheme.getCart((function() {})), f("Update drawer gfTheme"), !1;
                    if (t && z("cartCurrentData") && document.querySelector(".popup__body .js-popup-cart-ajax")) return J("cartCurrentData", JSON.stringify(t)), setTimeout((function() {
                        return J("cartCurrentData", JSON.stringify(t))
                    }), 100), setTimeout((function() {
                        return J("cartCurrentData", JSON.stringify(t))
                    }), 1e3), f("Update drawer cartCurrentData in local storage"), !1;
                    if (document.querySelector("cart-drawer#mini-cart form#mini-cart-form, #shopify-section-mini-cart cart-drawer#mini-cart")) return t && t.item_count ? (setTimeout((function() {
                        return document.documentElement.dispatchEvent(new Event("cart:refresh"))
                    }), 750), f("Update drawer custom cart-drawer elem"), !1) : (f("When cart is empty custom cart-drawer elem's event may not work. Refresh!"), refreshThePage(t, e));
                    if (window.CartJS && "function" == typeof window.CartJS.getCart && document.querySelector("#cart-drawer,#cartDrawer")) return setTimeout((function() {
                        return window.CartJS.getCart(null)
                    }), 500), f("Update drawer CartJS getCart"), !1;
                    if ("function" == typeof window.update_cart && document.querySelector("#custom-drawer-cart")) return window.update_cart(), f("Update drawer custom-drawer-cart"), !1;
                    if (window.fcsb && "function" == typeof window.fcsb.fetchCart && document.querySelector("#sticky-app-client") && document.querySelector('#sticky-app-client [data-cl="mini-cart"]')) return window.fcsb.fetchCart(), f("Update drawer fcsb"), !1;
                    if (window.theme && "function" == typeof window.theme.updateCartSummaries) return window.theme.updateCartSummaries(), f("Update drawer theme.updateCartSummaries"), !1;
                    if (window.BT && "function" == typeof window.BT.updateHeaderCartHtml) return window.BT.updateHeaderCartHtml(!0), f("Update drawer BT.updateHeaderCartHtml"), !1;
                    if (window.geckoShopify && "function" == typeof window.geckoShopify.GetCartData) return document.querySelectorAll(".jsccount").forEach((function(t) {
                        return t.innerHTML = ""
                    })), window.geckoShopify.GetCartData(1, 1), f("Update drawer geckoShopify.GetCartData"), !1;
                    if (window.theme && "object" === hn(window.theme.classes) && "function" == typeof window.theme.classes.CoreCart && document.querySelector('[data-view="cart"] .cart--root')) return document.querySelector('[data-view="cart"] .cart--root').dispatchEvent(new Event("update-html")), f("Update drawer cart--root"), !1;
                    if (window.theme && "function" == typeof window.theme.cart && "function" == typeof window.theme.cart.updateTotals && "function" == typeof(null === (c = document.querySelector('[data-view="cart"] .cart--root')) || void 0 === c ? void 0 : c.updateHtml)) return t && t.item_count ? (document.querySelector('[data-view="cart"] .cart--root').updateHtml(), f("Update drawer cartRoot.updateHtml"), !1) : (f("When cart is empty cartRoot.updateHtml does not work. Refresh!"), refreshThePage(t, e));
                    if (window.theme && "object" === hn(window.theme.classes) && "function" == typeof window.theme.classes.FrameworkCart && document.querySelector('.cart--root[data-js-class="Cart"]')) {
                        var C = document.querySelector('.cart--root[data-js-class="Cart"]');
                        return C.dispatchEvent(new Event("updateHtml", {
                            bubbles: !0
                        })), C.dispatchEvent(new Event("update-html", {
                            bubbles: !0
                        })), f("Update drawer cart--root updateHtml/update-html event"), !1
                    }
                    var q = window.CartDrawer ? document.querySelector("#shopify-section-cart-drawer cart-drawer cart-drawer-items, #CartDrawer.cart-drawer cart-drawer-items") : null;
                    if (q && q.onChange) {
                        if (t && t.items.length) {
                            var A = {
                                target: {
                                    dataset: {
                                        index: 1
                                    },
                                    value: t.items[0].quantity
                                }
                            };
                            return q.onChange(A), _("#CartDrawer-LineItemError-1 {display: none;}"), f('Update drawer customCartDrawerItems["onChange"]'), !1
                        }
                        return f('Update drawer customCartDrawerItems["onChange"] - no items, force refresh!'), refreshThePage(t, e)
                    }
                    var E = window.themeVariables ? document.querySelector("#shopify-section-cart-drawer cart-drawer, .shopify-section cart-drawer") : null;
                    if (E && "function" == typeof E._onCartRefreshListener) return E._onCartRefreshListener(), f("Update drawer #shopify-section-cart-drawer cart-drawer"), !1;
                    var P = window.theme && "object" === hn(window.theme.CartDrawerSection) ? document.querySelector(".cart-drawer-modal cart-form.cart-drawer") : null;
                    if (P && "function" == typeof P.refresh) return P.refresh(), f("Update drawer .cart-drawer-modal cart-form.cart-drawer"), !1;
                    var O = window.CartDrawer ? document.querySelector("#Drawer-Cart cart-drawer") : null;
                    if (O && "function" == typeof O.updateCart) return O.updateCart(), f("Update drawer #Drawer-Cart cart-drawer updateCart"), !1;
                    var k, T, x, j, D, L = window.Shopify && "function" == typeof window.Shopify.CountryProvinceSelector ? document.querySelector("#main-cart-items quantity-input .quantity__input:not([readonly])") : null;
                    if (L && "object" === hn(L.parentElement.changeEvent)) {
                        if (!t || !t.item_count) return f("Update drawer quantity-input .quantity__input - empty cart = refresh"), refreshThePage(t, e);
                        for (var I = parseInt(L.getAttribute("data-index")), N = 0, R = 1; R <= t.items.length; R++) {
                            var G, M = null === (G = t.items[R - 1].handle) || void 0 === G ? void 0 : G.includes("docapp-free-gift");
                            if (M && R <= I && N++, !M && R < I && N--, !M && R >= I) break
                        }
                        return L.setAttribute("data-index", (I + N).toString()), L.dispatchEvent(L.parentElement.changeEvent), _("#main-cart-footer .cart-drawer__cart-error, mini-cart.cart-drawer .cart-item__error {display: none;}"), f("Update drawer quantity-input .quantity__input"), !1
                    }
                    if ("function" == typeof window.showCart && document.querySelector(".drawer .drawer_container")) return window.showCart(), f("Update drawer showCart"), !1;
                    if (window.WAU && "object" === hn(window.WAU.AjaxCart) && "function" == typeof window.WAU.AjaxCart.init && "function" == typeof window.WAU.AjaxCart.showDrawer && document.querySelector('#slideout-ajax-cart[data-wau-slideout="ajax-cart"] #mini-cart') && document.querySelector(".js-mini-cart-trigger.js-slideout-open")) return window.WAU.AjaxCart.hideDrawer({
                        cart_action: "drawer"
                    }), setTimeout((function() {
                        return document.querySelector(".js-mini-cart-trigger.js-slideout-open").dispatchEvent(new Event("click"))
                    }), 400), f("Update drawer WAU - close + click"), !1;
                    if ("function" == typeof window.fetchCart && document.querySelector(".cart-flyout .cart-drawer")) return window.fetchCart(), f("Update drawer fetchCart"), !1;
                    if (window.elessiShopify && "function" == typeof window.elessiShopify.initAddToCart && document.querySelector(".cart__popup, .jas-mini-cart.jas-push-menu")) return t && t.item_count ? (window.elessiShopify.initAddToCart(), f("Update drawer elessiShopify.initAddToCart"), !1) : (f("Update drawer elessiShopify.initAddToCart - empty cart = refresh"), refreshThePage(t, e));
                    if (window.Shopify && "object" === hn(window.Shopify.theme) && "object" === hn(window.Shopify.theme.sections) && "object" === hn(window.Shopify.theme.sections.registered) && "object" === hn(window.Shopify.theme.sections.registered.cart) && document.querySelector(".cart__drawer .drawer__body")) return document.dispatchEvent(new Event("theme:cart:reload")), f("Update drawer Pipeline theme:cart:reload"), !1;
                    if ("function" == typeof window.$ && window.theme && "function" == typeof window.theme.cartUpdatePopup && "function" == typeof window.theme.cartUpdatePopupModel && document.querySelector("#CartDrawer")) return $("body").trigger("completeChangeItem.ajaxCart"), f("Update drawer completeChangeItem.ajaxCart"), !1;
                    if (window.wetheme && "object" === hn(window.wetheme.cartDrawer) && "function" == typeof window.wetheme.cartDrawer.updateCartDrawer && document.querySelector("#cartSlideoutWrapper")) return window.wetheme.cartDrawer.updateCartDrawer(t), f("Update drawer updateCartDrawer"), !1;
                    if (window.iopCart && "object" === hn(window.iopCart.api) && "function" == typeof window.iopCart.api.refreshCart && document.querySelector("#iop-cart-root")) return window.iopCart.api.refreshCart(), f("Update drawer iopCart"), !1;
                    if (window.theme && "object" === hn(window.theme.AjaxCart) && "function" == typeof window.theme.AjaxCart.fetch && document.querySelector("#AjaxCartDrawer")) return window.theme.AjaxCart.fetch(), f("Update drawer theme.AjaxCart.fetch"), !1;
                    if (window.theme && "function" == typeof window.theme.Cart && document.querySelector(".side-cart-popup [data-quantity-input]:not([readonly])")) return t && t.items.length ? (document.querySelector(".side-cart-popup [data-quantity-input]:not([readonly])").dispatchEvent(new Event("change", {
                        bubbles: !0
                    })), f("Update drawer side-cart-popup change event"), !1) : (f("Update drawer side-cart-popup change event - no items, force refresh!"), refreshThePage(t, e));
                    if (window.theme && window.theme.dropdown && "function" == typeof window.theme.ajax_cart_dropdown && document.querySelector("#cart-dropdown")) return window.theme.ajax_cart_dropdown(), f("Update drawer ajax_cart_dropdown"), !1;
                    if ("function" == typeof CartItems && document.querySelector("#drawer-cart")) return document.dispatchEvent(new Event("ajaxProduct:added")), f("Update drawer ajaxProduct:added"), _("#drawer-cart .cart-item__details .cart-item__error {display: none;}"), !1;
                    if ("function" == typeof(null === (d = window.PXUTheme) || void 0 === d || null === (u = d.jsAjaxCart) || void 0 === u ? void 0 : u.updateView) && document.querySelector("#theme-ajax-cart")) return setTimeout((function() {
                        return window.PXUTheme.jsAjaxCart.updateView()
                    }), 250), f("Update drawer PXUTheme.jsAjaxCart.updateView"), !1;
                    if ("function" == typeof(null === (l = window.ctzn_global) || void 0 === l ? void 0 : l.refreshCart) && document.querySelector("#cart-content")) return window.ctzn_global.refreshCart(), f("Update drawer ctzn_global.refreshCart"), !1;
                    if ("object" === ("undefined" == typeof store ? "undefined" : hn(store)) && "function" == typeof(null === (p = store) || void 0 === p ? void 0 : p.getCart) && document.querySelector("#drawer-items")) return store.getCart(), f("Update drawer store.getCart"), !1;
                    if (null !== (s = window.Avatar) && void 0 !== s && null !== (m = s.theme) && void 0 !== m && null !== (g = m.sections) && void 0 !== g && null !== (h = g.SliderCart) && void 0 !== h && null !== (y = h.instance) && void 0 !== y && y.refreshCartSlider && document.querySelector('[data-section-type="slider-cart"]')) return null === (k = window.Avatar) || void 0 === k || null === (T = k.theme) || void 0 === T || null === (x = T.sections) || void 0 === x || null === (j = x.SliderCart) || void 0 === j || null === (D = j.instance) || void 0 === D || D.refreshCartSlider(), f("Update drawer Avatar.theme"), !1;
                    var H = "function" == typeof CartItems ? document.querySelector("mini-cart") : null;
                    if (H) return t && t.item_count ? (H.onChange({
                        target: {
                            dataset: {
                                index: 1
                            },
                            value: t.items[0].quantity
                        }
                    }), _("#MiniCart-Line-item-error-1 {display: none;}"), f("Update drawer athensThemeMiniCart"), !1) : (f("Update drawer athensThemeMiniCart - empty cart = refresh"), refreshThePage(t, e));
                    var B = document.querySelector("sidebar-drawer#site-cart .cart-item input.qty:not([readonly])");
                    if (B) return t && t.item_count ? (B.dispatchEvent(new Event("input", {
                        bubbles: !0
                    })), f("Update drawer sidebar-drawer#site-cart .cart-item .qty"), !1) : (f("Update drawer sidebar-drawer#site-cart .cart-item .qty - empty cart = refresh"), refreshThePage(t, e));
                    var F = [".cart-drawer[data-cart-drawer] input.quantity:not([readonly])", "#dropdown-cart input.item-quantity:not([readonly])", ".halo-sidebar .previewCart input.quantity:not([readonly])", "form.mini-cart .mini-cart__content input.quantity-selector__value:not([readonly])", '#cart-modal-form-body .cart-modal-qty[type="text"]:not([readonly])', ".drawer .cart-drawer__content-container .cart__popup-qty--input:not([readonly])", ".side-cart-item input.quantity__input:not([readonly])", ".top-bar .cart-container .mini-cart__item input[data-cart-quantity-input]:not([readonly])", "#t4s-mini_cart .t4s-mini_cart__item input[data-action-change]:not([readonly])"],
                        W = document.querySelector(F.join(","));
                    if (t && W) return t.item_count ? (setTimeout((function() {
                        var r = document.querySelector(F.join(","));
                        if (!r) return f("Update drawer failed due to missing element after timeout. Force refresh!"), n.refreshThePage(t, e);
                        var i = r.getAttribute("docapp-data-protected"),
                            o = null;
                        if (t.items.forEach((function(t, e) {
                                o || i && i.includes(t.variant_id) && (o = e + 1)
                            })), o) {
                            var a = r.getAttribute("data-line");
                            U(a) && a < 1e3 && r.setAttribute("data-line", o);
                            var c = r.getAttribute("data-line-id");
                            U(c) && c < 1e3 && r.setAttribute("data-line-id", o);
                            var d = r.getAttribute("data-product_id");
                            U(d) && d < 1e3 && r.setAttribute("data-product_id", o);
                            var u = r.closest("[data-line-item-id]");
                            if (u) {
                                var l = u.getAttribute("data-line-item-id");
                                U(l) && l < 1e3 && u.setAttribute("data-line-item-id", o)
                            }
                            var p = r.closest("[data-line]");
                            if (p) {
                                var s = p.getAttribute("data-line");
                                U(s) && s < 1e3 && p.setAttribute("data-line", o)
                            }
                            var m = r.closest("[data-cart-item][data-line-id]");
                            if (m) {
                                var _ = m.getAttribute("data-line-id");
                                U(_) && _ < 1e3 && m.setAttribute("data-line-id", o)
                            }
                        }
                        r.dispatchEvent(new Event("change", {
                            bubbles: !0
                        }))
                    }), 150), f("Update drawer cartModalQtyNonGiftChangeSelectors match pending..."), !1) : (f("Update drawer cartModalQtyNonGiftChangeSelectors - empty cart = refresh"), refreshThePage(t, e));
                    if (window.freeGiftCartUpsellProAppDisableRefreshExceptOnCart) return f("Refresh disabled except on cart page. END"), !1;
                    if (document.querySelector([".go-cart__drawer", ".ajax-cart__drawer.js-ajax-cart-drawer", "mini-cart.cart-drawer .mini-cart", ".halo-sidebar .previewCart", '.nt_mini_cart .mini_cart_items input[name="updates[]"]', ".widget_shopping_cart .mini_cart_item input.custom-qty", '.mini-products-list .item .qty-group input[name="updates[]"]', "#monster-upsell-cart", ".cart-flyout__inner .quick-cart__items .quick-cart__quantity", ".quick-cart__cart .quick-cart__item .quick-cart__qty", ".quick-cart__cart .quick-cart__item .quick-cart__button", "#shopify-section-quick-cart .quick-cart__items .quantity-input__input", ".flyout__content .cart-drawer", '#right-drawer-slot [x-data="ThemeModule_CartItems"] input[\\@change]', '[data-cart-row][data-cart-item-key] input[name="updates[]"][\\@change]', '#modals-rightDrawer [x-data="ThemeModule_CartItems"]', ".cart-mini[data-cart-mini] .cart-mini-sidebar"].join(","))) return f("Update drawer force refresh due to unsupported element"), refreshThePage(t, e);
                    if (t && window.Shopify && "function" == typeof window.Shopify.onCartUpdate && !window.Shopify.onCartUpdate.toString().includes("{alert(")) return window.Shopify.onCartUpdate(t), f("Update drawer Shopify onCartUpdate"), !1;
                    if (document.querySelector(["#cart-summary-overlay", ".cart-summary-overlay .cart-summary-overlay__actions a.to-cart", ".atc-banner--container[data-atc-banner]"].join(",")) || window.freeGiftCartUpsellProAppDisableRefreshExceptOnCart) return f("Update drawer not required due to found element/variable."), !1;
                    var V = document.querySelector(".site-header__cart #CartCount");
                    if (V) return t && (V.innerHTML = t.item_count), f("Update drawer not required on Simple."), !1;
                    var K = document.querySelectorAll("cart-notification #cart-notification #cart-notification-button");
                    if (K.length) return t && (K.forEach((function(e) {
                        return e.innerHTML = e.innerHTML.replace(/\d+/, t.item_count)
                    })), document.querySelectorAll(".cart-count-bubble span[aria-hidden]").forEach((function(e) {
                        return e.innerHTML = t.item_count
                    }))), f("Update drawer not required on Dawn."), !1
                } catch (t) {
                    f("Update drawer - ERROR!!!"), gfg.utility.debugError("Attempted to update drawer cart, Error: ", t)
                }
                return f("Update drawer - no integration found."), refreshThePage(t, e)
            },
            insertIntoPageWrapper: function (freeGiftHTML, freeGift) {
                let showNotifcationSettings = gfg.settings.freeGifts[0].showFreeGiftNotificationSettings;
                let showOnthisProductPage = false;
                
                if(showNotifcationSettings && showNotifcationSettings.productPages) {
                    showOnthisProductPage = true;
                } 


                if(showNotifcationSettings && showNotifcationSettings.specificProductPages && showNotifcationSettings.specificProduct && showNotifcationSettings.specificProduct.length && showNotifcationSettings.specificProduct.length > 0) {
                    
                    let currentProductPageId = gfg.f.getProductPageId()
                    if(currentProductPageId != "undefined") {
                        let validProductIds = showNotifcationSettings.specificProduct.map(function (item) {
                            return parseInt(item.productId);
                        });
                        if(validProductIds.includes(currentProductPageId)) {
                            showOnthisProductPage = true;
                        }
                    }
                    
                }

                if(showNotifcationSettings && showNotifcationSettings?.specificCollectionPages && showNotifcationSettings?.specificCollectionData && showNotifcationSettings?.specificCollectionData?.length && showNotifcationSettings.specificCollectionData.length > 0) {
                    
                    let currentProductPageId = gfg.f.getProductPageId()
                    if(currentProductPageId != "undefined") {
                        let collectionsList = showNotifcationSettings.specificCollectionData;
                        for(let i=0; i<collectionsList.length; i++){
                            let productList = collectionsList[i].productList;
                            if(productList.find(x => x.productId === currentProductPageId)){
                                showOnthisProductPage = true
                                break
                            }
                        }
                    }
                }

                

                
                if(showOnthisProductPage) {
                    let gftFreeGiftWrapperProductEle = gfg.$(".gfgProductPageWrapperV2").find(".gftFreeGiftWrapper")
                    let freeGiftHTMLClone = freeGiftHTML.clone();
                    gftFreeGiftWrapperProductEle.each(function (index) {
                                gfg.$(this).html(freeGiftHTMLClone);
                            });
                }

                if(showNotifcationSettings && showNotifcationSettings.cartPage) {
                    let gftFreeGiftWrapperCartEle = gfg.$(".gfgCartPageWrapperV2").find(".gftFreeGiftWrapper")
                    let freeGiftHTMLClone = freeGiftHTML.clone();
                    gftFreeGiftWrapperCartEle.each(function (index) {
                                gfg.$(this).html(freeGiftHTMLClone);
                            });
                }


                // insert into parent element 
                // gfg.elements.gfgCartGiftMsgAndWrapWrapperParent.find(".gfgGiftMsgAndWrapWrapperInnerEle").append(settings.giftingOptions.shopifyPageinnerHTML);    //cartPageText                 

                // insert final  element into productPageWrapperV2
                // gfg.elements.cartPageWrapperV2.find(".gfgCartUpsellWrapper").append(gfg.elements.gfgCartGiftMsgAndWrapWrapperParent);
                // gfg.elements.cartPageWrapperV2.find(".gftFreeGiftWrapper").html(freeGiftHTML);

            },
            gfgFreeGiftClaimButtonClickAction:  async function(event, product, counter,validFreeGiftTiers){

                try {
                    if(gfg.settings.freeGifts[0].isMultipleFreeGiftAllowed){
                        //JSON.parse(JSOn.stringiyf) all the arguments pass
                        product = JSON.parse(JSON.stringify(product))
                        counter = JSON.parse(JSON.stringify(counter))
                        validFreeGiftTiers = JSON.parse(JSON.stringify(validFreeGiftTiers))
                       return await gfg.gfgFreeGift.f.gfgFreeGiftClaimButtonClickAction_multipleFreeGifts(event, product, counter,validFreeGiftTiers)
                    }
    
                    let userConfigData = gfg.settings.freeGifts[0].configuration
                    gfg.utility.debugConsole("gfg.gfgFreeGift.state.prepareUIState", gfg.gfgFreeGift.state.prepareUIState)
                    gfg.utility.debugConsole(product)
              
                    if(gfg.gfgFreeGift.state.prepareUIState == "CONDITION_FULFILLED"){
                        gfg.utility.debugConsole('inside click button')
                        gfg.gfgFreeGift.f.gfgFreeGiftCreateMessageToast(event);
                        return
                    }
                    //  gfg.$(this) should have class gfgFreeGiftClaimButtonAddToCart and gfg.gfgFreeGift.state.prepareUIState should be CONDITION_MET write code for it
                    if(gfg.gfgFreeGift.state.prepareUIState != "CONDITION_MET" ){
                        return
                    }
    
    
                    if(!gfg.$(event.currentTarget).hasClass('gfgFreeGiftClaimButtonAddToCart')){
                        return
                    }
    

                    let variantId = product.variants[0].variantId
    
                    let selectData = gfg.$('.gfgFreeGiftVariantSelect' + counter).val();
                    // console.log(selectData, 'selectData')
    
                    if(typeof selectData != 'undefined'){
                        variantId = selectData
                    }
                    gfg.$(event.currentTarget).text(userConfigData.addtionalFields.addingText);
    
    
                    let isGiftAdded = await gfg.gfgFreeGift.f.gfgAddSuperiorTierFreeGiftToCart(variantId);
                  
                    if(isGiftAdded == true){
                        gfg.state.cartData = await gfg.utility.getCart();
                        gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"
                        let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(gfg.gfgFreeGift.state.validFreeGiftTiers, gfg.gfgFreeGift.state.inValidFreeGiftTiers, gfg.gfgFreeGift.state.AllFreeGiftTiers);
                        gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml);
                        gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow()
                        gfg.gfgFreeGift.f.registerEvents()
    
                    }
                    
                    // console.log('claim button clicked ', variantId, counter, selectData );
                    if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                        await gfg.gfgFreeGift.f.updateCartState()
                    }
                } catch (error) {
                    console.log("error in gfgFreeGiftClaimButtonClickAction", error);
                }
            },
            gfgFreeGiftClaimButtonClickAction_multipleFreeGifts:  async function(event, product, counter,validFreeGiftTiers){
                    

                const validTierProductIds = gfg.gfgFreeGift.f.gfgFreeGiftGetValidTierProductIds(validFreeGiftTiers);

                let isFreeGiftValid = validTierProductIds.includes(product.productId);

                
                if(!isFreeGiftValid){
                    return
                }

                // alert(`Free Gift Added to Cart, the value of the free gift is ${isFreeGiftValid}`)
                console.log("validTierProductIds", validTierProductIds, product.productId, isFreeGiftValid);
                let userConfigData = gfg.settings.freeGifts[0].configuration
                gfg.utility.debugConsole("gfg.gfgFreeGift.state.prepareUIState", gfg.gfgFreeGift.state.prepareUIState)
                gfg.utility.debugConsole(product)

                let ruleIdTier = gfg.$(event.currentTarget).closest('.gfgFreeGiftMsgOptionRow').attr('rule-id-tier');

                let variantId = product.variants[0].variantId

                let freeGiftProductData = {
                  variantId: variantId,
                  _rule_id: ruleIdTier,
                };

                //getProductIdFromRuleIdTier
                let productId = gfg.gfgFreeGift.utility.getProductIdFromRuleId(ruleIdTier);

                if (productId) {
                    gfg.gfgFreeGift.f.gfgFreeGiftCreateMessageToast(event);
                    return;
                }

                // if(gfg.gfgFreeGift.state.prepareUIState == "CONDITION_FULFILLED"){
                //     gfg.utility.debugConsole('inside click button')
                //     gfg.gfgFreeGift.f.gfgFreeGiftCreateMessageToast(event);
                //     return
                // }
                // //  gfg.$(this) should have class gfgFreeGiftClaimButtonAddToCart and gfg.gfgFreeGift.state.prepareUIState should be CONDITION_MET write code for it
                // if(gfg.gfgFreeGift.state.prepareUIState != "CONDITION_MET" ){
                //     return
                // }


                // if(!gfg.$(event.currentTarget).hasClass('gfgFreeGiftClaimButtonAddToCart')){
                //     return
                // }

                //find the parent class known as gfgFreeGiftMsgOptionRow and then get the attr rule-id-tier


               

  

                let selectData = gfg.$('.gfgFreeGiftVariantSelect' + counter).val();
                // console.log(selectData, 'selectData')

                if(typeof selectData != 'undefined'){
                    variantId = selectData
                }
                gfg.$(event.currentTarget).text(userConfigData.addtionalFields.addingText);


               

                let isGiftAdded = await gfg.gfgFreeGift.f.gfgAddFreeGiftToCart(freeGiftProductData);
              
                if(isGiftAdded == true){
                    gfg.state.cartData = await gfg.utility.getCart();
                    gfg.gfgFreeGift.state.prepareUIState = "CONDITION_FULFILLED"
                    let freeGiftMsgHtml = await gfg.gfgFreeGift.f.gfgFreeGiftPrepareUI(gfg.gfgFreeGift.state.validFreeGiftTiers, gfg.gfgFreeGift.state.inValidFreeGiftTiers, gfg.gfgFreeGift.state.AllFreeGiftTiers);
                    gfg.gfgFreeGift.f.insertIntoPageWrapper(freeGiftMsgHtml);
                    gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow()
                    gfg.gfgFreeGift.f.registerEvents()

                }
                
                // console.log('claim button clicked ', variantId, counter, selectData );
                if(gfg.gfgFreeGift.state.isCartUpdatedByUs){
                    await gfg.gfgFreeGift.f.updateCartState()
                }
            },
            registerEvents: function () {
                
                if(gfg.gfgFreeGift.state.isEventListenerRegistered == false){
                    gfg.gfgFreeGift.state.isEventListenerRegistered = true
                    gfg.$(document).on('click', '.gfgFreeGiftSelectDiv', function(event) {
                        let element = gfg.$(event.currentTarget)
                        let parent = gfg.$(event.currentTarget).parent()
                        gfg.utility.debugConsole(element)
                        gfg.utility.debugConsole('button clicked!');
                        let isAccordion = gfg.gfgFreeGift.state.isAccordion;
                        if( isAccordion === true){
                            element.toggleClass('gfgFreeGiftSelectDivExpanded')
                            gfg.$('.gfgFreeGiftDropDownButton').toggleClass('gfgFreeGiftDropDownButtonRotationClass')
                            parent.find('.gfgFreeGiftOptionsContainerDiv').toggleClass('gfgFreeGiftOptionsContainerDivExpanded')
                        }
                        gfg.gfgFreeGift.f.gfgFreeGiftContainerOverflow()
                    });
                }
            },
            
        },
        utility:{
            removeCartItemsFromCart: async function (cartItems) {

                if(cartItems.length == 0){
                    return
                }
                //now cartItem have something known as key which is unique for each item in cart
                //we need to remove all the items from cart which are in cartItems

                let cartItemData = cartItems.map(function (item) {
                    return {id: item.key, quantity: 0};
                });

                // lets send that in data to changeCart(data)
                //write code to remove line Item keys from cart
                let data = cartItemData;
                let response = await gfg.utility.changeCart(data);
                if(response){
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = true
                }
                else {
                    gfg.gfgFreeGift.state.isCartUpdatedByUs = false
                }
                return response;

            },  
            modifySettingsForRuleIds:function(){
                // = gfg.settings.freeGifts[0].rulesList
                let rulesList = gfg.settings.freeGifts[0].rulesList
                // let ruleIds = rulesList.map(function (item,index) {
                //     return item.ruleType + "-" +index
                // }

                rulesList.forEach(function (item,index) {
                    item.ruleId = item.ruleType + "-" + (index+1)
                })

                gfg.settings.freeGifts[0].rulesList = rulesList
            },
            getFirstVariantSelectedWithProperties: async function (validFreeGiftTiers) {
                //juST ADD THE FIRST VARIANT FROM EACH TIER
                let freeGiftsToBeAddedToCart = []
                validFreeGiftTiers.forEach(function (item) {
                    freeGiftsToBeAddedToCart.push({variantData:item.freeGiftProduct[0].variants[0],ruleId:item.ruleId})
                });
                //now we have all the free gifts to be added to cart
                //lets add them to cart
                //lets prepare the data here;
                let cartItemData = freeGiftsToBeAddedToCart.map(function (item) {
                    return {id: item.variantData.variantId, quantity: 1, properties: {_free_product: true, _rule_id: item.ruleId}};
                });
                return cartItemData;
                // lets send that in data to addToCart(data)
            },
            isProductInFreeGiftCart : function (productId) {
                //use the object gfg.state.freeGiftCartData_productId
                let freeGiftCartData_productId = gfg.state.freeGiftsCartDataMap_productId // is an object

                if(freeGiftCartData_productId[productId] && Object.keys(freeGiftCartData_productId[productId]).length > 0){
                    return true
                }
                return false
            },
            isVariantInFreeGiftCart : function (variantId) {
                //use the object gfg.state.freeGiftCartData_variantId
                let freeGiftCartData_variantId = gfg.state.freeGiftsCartDataMap_variantId // is an object
                if(freeGiftCartData_variantId[variantId] && Object.keys(freeGiftCartData_variantId[variantId]).length > 0){
                    return true
                }
                return false
            },
            isRuleIdProductAlreadyInCart : function (ruleId) {
                // use the gfg.state.freeGiftCartData.items object
                let cartData = gfg.state.freeGiftsCartData
                let cartItems = cartData.items
                let isRuleIdProductAlreadyInCart = false
                cartItems.forEach(function (item) {
                    if(item.properties._rule_id == ruleId){
                        isRuleIdProductAlreadyInCart = true
                    }
                })
                return isRuleIdProductAlreadyInCart
            },
            getProductIdFromRuleId : function (ruleId) {
                let cartData = gfg.state.freeGiftsCartData
                let cartItems = cartData.items
                let productId = null
                cartItems.forEach(function (item) {
                    if(item.properties._rule_id == ruleId){
                        productId = item.product_id
                    }
                })
                return productId
            },
        },
        actions: {
           
        }

    },
    gfgVolDiscount: {
        state:{
            isCartUpdatedByUs: false,
        },
        init: async function (settings, parent) {
            gfg.gfgVolDiscount.initialize(settings, parent)
        },
        initialize: async function (settings, parent) {
            gfg.f.getProductPageHandle(settings)
            gfg.f.getProductPageId(settings)

            //check if there is any  volDiscount for this Product page 
            let volDiscountDataForProductPage = await gfg.gfgVolDiscount.f.getVolDiscountDataForProductPage()

            if (parent == "PRODUCT_PAGE" && volDiscountDataForProductPage) {
                let gfgVolDiscountPageHtml = gfg.gfgVolDiscount.f.prepareBulkUI(parent,volDiscountDataForProductPage)
                // console.log(gfgVolDiscountPageHtml , 'gfgVolDiscountPageHTML')
                gfg.gfgVolDiscount.f.insertIntoPageWrapper(gfgVolDiscountPageHtml, parent)
                gfg.utility.debugConsole("PRODUCT_PAGE-variantListToBeShownOnProductPage")
                // gfg.utility.overWriteBuyNowBtn()
                // gfg.state.isOverWriteBuyNowBtnTriggered = true
            }

            if (parent == "CART_PAGE") {
                
                let gfgVolDiscountCartPageHtml = await gfg.gfgVolDiscount.f.prepareBulkDiscountRulesWidgets(settings)
                gfg.gfgVolDiscount.f.insertIntoPageWrapper(gfgVolDiscountCartPageHtml, parent)
                gfg.utility.debugConsole("CART_PAGE-gfgVolDiscountCartPageHtml")
            }

        },
        f: {
           
            insertIntoPageWrapper: function (gfgVolDiscountPageHtml, parent) {
                try {
                    if(parent == "PRODUCT_PAGE") {
                        let gfgVolDiscountWrapperProductEle = gfg.$(".gfgProductPageWrapperV2").find(".gfgVolDiscountWrapper")
                        let gfgVolDiscountWrapperProductEleClone = gfgVolDiscountPageHtml.clone();
                        gfgVolDiscountWrapperProductEle.each(function (index) {
                                    gfg.$(this).html(gfgVolDiscountWrapperProductEleClone);
                                });
                    } else if(parent == "CART_PAGE") {
                        let gfgBulkDiscountWidgetHTMLEle = gfg.$(".gfgCartPageWrapperV2").find(".gfgVolDiscountWrapper")
                        let gfgBulkDiscountWidgetHTMLEleClone = gfgVolDiscountPageHtml.clone();
                        gfgBulkDiscountWidgetHTMLEle.each(function (index) {
                            gfg.$(this).html(gfgBulkDiscountWidgetHTMLEleClone);
                        });
                    }
                    
                } catch (error) {
                    gfg.utility.debugConsole(error)
                }
                
            },
            searchObjectById: function(array, idToSearch) {
                for (let i = 0; i < array.length; i++) {
                  if (array[i].id == idToSearch) {
                    return array[i]; // Found the object, return it
                  }
                }
                return null; // If the ID was not found, return null
              },
            prepareUIDataWrapper: function(discount){
                
                let configObject = discount.configuration;
                let productPageData = discount.productPageData;
                let discountTitle = configObject.tierListTitle
                let note = configObject.note; // configuration.tiers[0].label
                let tiers = configObject.tiers ;
                let discountTiers = [];
                let conditionType = discount.conditionType;
                let colors = configObject.colors;

                let disValueType = discount.disValueType
                let variant = gfg.f.getSelectedVariant()
                let variantObject = this.searchObjectById(productPageData.variants, variant)
                    
                    if(conditionType == "COUNT"){
                        for(let i=0; i < discount.rules.length; i++){
                            let rule = discount.rules[i];
                            let symbol = gfg.utility.getCurrencySymbol()
                            let qty = parseInt(rule.conditionValue)
                            let totalPrice = qty * (variantObject.price/100);
                            
                            let discountPrice;
                            let text;
                            let label;
                            
                            if(disValueType == "FIXED_DIS"){
                                let discountPriceInCurrency = parseFloat(gfg.utility.getAmountInActiveCurrency(rule.disValue))
                                discountPrice = parseFloat(gfg.utility.getAmountInActiveCurrency(rule.disValue)) * qty;
                                text = configObject.tiers[i].label.replace("{{CONDITION}}", qty).replace("{{DISCOUNT}}", symbol + rule.disValue);
                                // text = `Buy ${qty} products to get ${rule.disValue}% off!`
                                label = configObject.tiers[i].label
                                
                            }else if(disValueType == "PERCENTAGE_DIS"){
                                let percent = parseFloat(rule.disValue)
                                discountPrice = ((variantObject.price/100)*(percent/100))
                                text = configObject.tiers[i].label.replace("{{CONDITION}}", qty).replace("{{DISCOUNT}}", percent + '%');
                                // text = `Buy ${qty} products to get ${discountPrice/qty} off!`
                                label = configObject.tiers[i].label
                            }
                    
                            let finalPrice = ((totalPrice - discountPrice) > 0) ?  symbol + `${totalPrice - discountPrice}` : ` `; 
                            let data = {
                                priceLabel: finalPrice ,
                                quantitylabel: qty,
                                strikethroughLabel: symbol + `${totalPrice}`,
                                disValueType: disValueType,
                                discountValue: rule.disValue,
                                discountPrice: discountPrice,
                                text: text,
                                label: label
                            }
                            discountTiers.push(data)
                        }
                    }else if(conditionType == "SUBTOTAL"){
                        for(let i=0; i < discount.rules.length; i++){
                            let rule = discount.rules[i];
                            let symbol = gfg.utility.getCurrencySymbol()
                            let subtotal = parseFloat(gfg.utility.getAmountInActiveCurrency(rule.conditionValue)) // 
                            let totalPrice = symbol + subtotal;
                            
                            let discountPrice;
                            let text;
                            let label;

                            if(disValueType == "FIXED_DIS"){
                                let discountPriceInCurrency = parseFloat(gfg.utility.getAmountInActiveCurrency(rule.disValue))
                                discountPrice = parseFloat(gfg.utility.getAmountInActiveCurrency(rule.disValue))
                                text = configObject.tiers[i].label.replace("{{CONDITION}}", totalPrice).replace("{{DISCOUNT}}", symbol + discountPrice);
                                // text = `Buy ${totalPrice} products and get ${discountPrice} off!`
                                label = configObject.tiers[i].label
                            }else if(disValueType == "PERCENTAGE_DIS"){
                                let percent = parseFloat(rule.disValue)
                                discountPrice = ((variantObject.price/100)*(percent/100))
                                text = configObject.tiers[i].label.replace("{{CONDITION}}", totalPrice).replace("{{DISCOUNT}}", percent + '%');
                                // text = `Buy ${totalPrice} products and get ${percent}% off!`
                                label = configObject.tiers[i].label
                            }
                    
                            let finalPrice = ((totalPrice - discountPrice) > 0) ?  symbol + `${totalPrice - discountPrice}` : ` `; 
                            let data = {
                                priceLabel: finalPrice ,
                                quantitylabel: '',
                                strikethroughLabel: symbol + `${totalPrice}`,
                                disValueType: disValueType,
                                discountValue: rule.disValue,
                                discountPrice: discountPrice,
                                text: text,
                                label: label
                            }
                            discountTiers.push(data)
                        }
                    }
                    



                let data = {
                    discountTitle: discountTitle,
                    discountTiers: discountTiers,
                    note: note,
                    colors: colors,
                    conditionType: conditionType,
                    disValueType: disValueType
                }

                return data
            },
            prepareUI: function (parent, volDiscountDataForProductPage) {
                // idhr changes krne hein
                let data = volDiscountDataForProductPage.prouctUiDataToBeShown;
                gfg.utility.debugConsole(data);
                let disValueType = data.disValueType;
                // gfgVolDiscountWrapper
                if(data.conditionType == "COUNT"){
                    let gfgFVolDiscountContainer = gfg.$("<div>").addClass('gfgVolDiscountContainer')
            

                    let titleDiv = gfg.$("<div>").addClass('titleDiv').html(data.discountTitle);

                    let gridDiv = gfg.$("<div>").addClass('gridDiv');

                    for (let i = 0; i < data.discountTiers.length; i++) {
                    // < [quantity] , [priceLabel, {strikethroughLabel}] >
                        let discountTier = data.discountTiers[i];
                        let qtyLabel = `Buy ${data.discountTiers[i].quantitylabel} and save`;
                        let priceLabel;

                        if(disValueType == "FIXED_DIS"){
                            priceLabel = data.discountTiers[i].priceLabel
                        }else if(disValueType == "PERCENTAGE_DIS"){
                            priceLabel = data.discountTiers[i].discountValue + '%'
                        }

                        let boxDiv = gfg.$("<div>").addClass('gfgGridBox');

                        let qtyDiv = gfg.$("<div>").addClass('gfgQty')
                        let radioBtn = gfg.$("<input/>").addClass('radioButton').attr("type", "radio").attr("name", "dicountTierBtn").val(i + 1);


                        boxDiv.on('click', function() {
                            // Activate the radio button associated with this boxDiv
                            radioBtn.prop('checked', true);
                        });
                                                                
                        let qtyLabelDiv = gfg.$("<div>").addClass('gfgQtyLabel').html(qtyLabel)

                        qtyDiv.append(radioBtn, qtyLabelDiv)

                        let priceDiv = gfg.$("<div>").addClass("gfgPricesDiv");

                        let costDiv = gfg.$("<div>").addClass("gfgCostLabel").html(priceLabel);

                        priceDiv.append(costDiv)

                        boxDiv.append(qtyDiv, priceDiv)
                        gridDiv.append(boxDiv);
                        // console.log(gridDiv, 'grid DIv is here')
                    }


                    gfgFVolDiscountContainer.append(titleDiv, gridDiv);
                    // console.log(gfgFVolDiscountContainer, 'container')
                    return gfgFVolDiscountContainer
                }else{
                    return this.prepareBulkUI(parent, volDiscountDataForProductPage)
                }
                  
            },
            
            prepareBulkUI: function(parent, volDiscountDataForProductPage){
                let data = volDiscountDataForProductPage.prouctUiDataToBeShown;
                gfg.utility.debugConsole(data)
                let note = data?.note;
                let discountTitle = data?.discountTitle;
                let colors = data?.colors;
                let textColor = colors?.text;
                let borderColor = colors?.border;
                let backgroundColor = colors?.background

                let gfgFVolDiscountContainer = gfg.$("<div>").addClass('gfgVolDiscountContainer').css("background-color", "")
                                                                                                .css("color", "")
                                                                                                .css("display", "grid")
                                                                                                .css("padding", "5px")
                                                                                                .css("text-align", "center")
                                                                                        

                let titleDiv = gfg.$("<div>").addClass('gfgTitleDiv').html(discountTitle).css("font-weight", "bolder").css("text-align", "center")
                                                                                            .css("font-size", "20px").css("margin", "5px 0px");

                let gridDiv = gfg.$("<div>").addClass('gfgGridDiv').css("border", "black solid 1px").css("border-radius", "5px").css("text-align", "center").css("border-color", borderColor).css("background-color", backgroundColor);
                let noteDiv = gfg.$("<div>").addClass('gfgNoteDiv').html(note).css("margin", "20px 0px 10px 0px").css("color",  textColor)


                for (let i = 0; i < data.discountTiers.length; i++) {
                    // < [quantity] , [priceLabel, {strikethroughLabel}] >

                    let quantitylabel = parseFloat(data.discountTiers[i].quantitylabel);
                    let priceLabel = data.discountTiers[i].priceLabel;
                    let strikethroughLabel = data.discountTiers[i].strikethroughLabel;
                    let discountValue = data.discountTiers[i].discountValue;
                    let discountType = data.discountTiers[i].disValueType
                    let discountPrice = data.discountTiers[i].discountPrice
                    let text = data.discountTiers[i].text
                    
                    

                    let boxDiv = gfg.$("<div>").addClass('gfgGridBox').css("text-align", "center").css("padding", "10px").css("margin", "5px 0px").css("font-size", "15px").css("color", textColor);
                    
                    boxDiv.html(text)

                    gridDiv.append(boxDiv);
                }
                if(note){
                    gridDiv.append(hr)
                }
                gridDiv.append(noteDiv);

                gfgFVolDiscountContainer.append(titleDiv, gridDiv);

                return gfgFVolDiscountContainer
            }
            ,
            getVolDiscountDataForProductPage: async function() {

                let productPageId = gfg.state.productPageId
                let productPageHandle = gfg.state.productPageHandle
                let discounts  = gfg.settings.discounts
                let productPageData = undefined
                

                if(productPageHandle){
                    productPageData = await gfg.utility.getProductDataV2(productPageHandle)
                }
                if(!productPageData){
                    return undefined
                }

                let validVolDiscount = undefined 
                let maxFirstTierVolDiscount = undefined
                //As One product could be present in multiple discount campagin, find which one give the minimum finalPrice
                for(let i = 0; i < discounts.length; i++) {
                    let discount = discounts[i]

                    if(discount.isEnabled == false){
                        continue
                    }

                    if(discount?.isEBIntegrationEnabled){
                        continue
                    }
                    //check if eb integration enabled return

                    let checkIfThisDiscountIsForThisProductPage = undefined
                    //check if this discount is for this product page if yes calculate the final price
                    if(discount?.disProducts?.type == "ALL_PRODUCTS")  {
                        checkIfThisDiscountIsForThisProductPage = true    
                    }
                    if(discount?.disProducts?.type == "COLLECTIONS")  {
                        // let calculateFirstTierFinalPrice = gfg.gfgVolDiscount.f.calculateFirstTierFinalPrice(discount, productPageData)
                        let collections = discount?.disProducts?.collectionsData || []
                        for(let k=0; k < collections?.length; k++){
                            let products = collections[k]?.productList || []
                            for(let j = 0; j < products?.length; j++) {
                                let product = products[j]
                                if(product?.id == productPageId || product?.handle == productPageHandle) {
                                    checkIfThisDiscountIsForThisProductPage = true
                                    break
                                }
                            }
                        } 
                    }
                    if(discount?.disProducts?.type == "SELECTED_PRODUCTS")  {
                        let products = discount?.disProducts?.products
                        for(let j = 0; j < products.length; j++) {
                            let product = products[j]
                            if(product?.id == productPageId || product?.handle == productPageHandle) {
                                checkIfThisDiscountIsForThisProductPage = true
                                break
                            }
                        }    
                    }

                    if(checkIfThisDiscountIsForThisProductPage){
                        let currFirstTierVolDiscount =  parseFloat(discount.rules[0].disValue)
                        if(maxFirstTierVolDiscount == undefined || currFirstTierVolDiscount > maxFirstTierVolDiscount ) {
                            maxFirstTierVolDiscount = currFirstTierVolDiscount
                            validVolDiscount = discount
                            discount.productPageData = productPageData;
                            validVolDiscount.prouctUiDataToBeShown = gfg.gfgVolDiscount.f.prepareUIDataWrapper(discount);
                        }
                    }
                    
                    
                }
                gfg.utility.debugConsole(validVolDiscount, 'valid vol discount')
                return validVolDiscount

            },
            prepareBulkDiscountRulesWidgets: async function(settings) {
                try {
                let gfgBulkDiscountWidgetHTMLWrapper = gfg.$("<div>").addClass('gfgBulkDiscountWidgetHTMLWrapper');
                let gfgBulkDiscountWidgetHTML = gfg.$("<div>").addClass('gfgBulkDiscountWidgetHTML');
                let discounts = settings?.discounts;
                 if(!settings?.discounts || settings.discounts.length == 0) {
                    return;
                 }
                 gfg.state.cartData = await gfg.utility.getCart()
                 for(let i = 0; i < discounts.length; i++) {
                    let currDiscount = discounts[i];
                    if(currDiscount?.cartWidgetConfiguration?.isEnabled) {
                        gfgBulkDiscountWidgetHTML.append(gfg.gfgVolDiscount.f.prepareSingleBulkDiscountRulesWidget(currDiscount));
                        gfgBulkDiscountWidgetHTMLWrapper.append(gfgBulkDiscountWidgetHTML);
                    }
                 }
                 return gfgBulkDiscountWidgetHTMLWrapper;
                } catch(err) {
                    console.log("err inside renderAllDiscountRuleWidgets", err);
                }
            },
            prepareSingleBulkDiscountRulesWidget: function(currBulkDiscount) {
                try {
                    let gfgBulkDiscountSingleWidgetHTML = gfg.$("<div>").addClass('gfgBulkDiscountSingleWidgetHTML');
                    gfgBulkDiscountSingleWidgetHTML.css("background-color", currBulkDiscount?.cartWidgetConfiguration?.globalConfig?.customisations?.backgroundColor || "#ffffff");
                    gfgBulkDiscountSingleWidgetHTML.css("color", currBulkDiscount?.cartWidgetConfiguration?.globalConfig?.customisations?.textColor || "#000000");
                    gfgBulkDiscountSingleWidgetHTML.css("border-color", currBulkDiscount?.cartWidgetConfiguration?.globalConfig?.customisations?.borderColor || "#000000");

                    let gfgBulkDiscountSingleWidgetWrapper= gfg.$("<div>").addClass('gfgBulkDiscountSingleWidgetWrapper');
                    
                    let currDiscountIdx = gfg.gfgVolDiscount.f.getIndexOfRuleThatCanBeAppliedAtCurrCartState(currBulkDiscount);
                    let nextDiscountRuleIndex;
                    
                    
                    if (currDiscountIdx == currBulkDiscount.rules.length-1) {
                        return;
                    
                    } else if (currDiscountIdx == -1) {
                        nextDiscountRuleIndex = 0;
                    
                    } else {
                        nextDiscountRuleIndex = currDiscountIdx+1;
                    }
                    
                    let gfgBulkDiscountSingleWidgetIcon = gfg.$("<img>").addClass('gfgBulkDiscountSingleWidgetIcon');
                    gfgBulkDiscountSingleWidgetIcon.attr("src", currBulkDiscount?.cartWidgetConfiguration?.tierConfig[nextDiscountRuleIndex]?.conditionNotMet?.icon);
                    
                    let gfgBulkDiscountSingleWidgetTitle = gfg.$("<div>").addClass('gfgBulkDiscountSingleWidgetTitle');
                    let title = gfg.gfgVolDiscount.f.replaceVolDiscountWidgetVariables(currBulkDiscount, currBulkDiscount?.cartWidgetConfiguration?.tierConfig[nextDiscountRuleIndex]?.conditionNotMet?.title, nextDiscountRuleIndex);
                    gfgBulkDiscountSingleWidgetTitle.html(title);
                    
                    let gfgBulkDiscountSingleWidgetSubTitle = gfg.$("<div>").addClass('gfgBulkDiscountSingleWidgetSubTitle');
                    let subtitle = gfg.gfgVolDiscount.f.replaceVolDiscountWidgetVariables(currBulkDiscount, currBulkDiscount?.cartWidgetConfiguration?.tierConfig[nextDiscountRuleIndex]?.conditionNotMet?.subtitle, nextDiscountRuleIndex);
                    gfgBulkDiscountSingleWidgetSubTitle.html(subtitle);

                    gfgBulkDiscountSingleWidgetWrapper.append(gfgBulkDiscountSingleWidgetIcon);
                    gfgBulkDiscountSingleWidgetWrapper.append(gfgBulkDiscountSingleWidgetTitle);
                    gfgBulkDiscountSingleWidgetWrapper.append(gfgBulkDiscountSingleWidgetSubTitle);
                    
                    gfgBulkDiscountSingleWidgetHTML.append(gfgBulkDiscountSingleWidgetWrapper);
                    
                    return gfgBulkDiscountSingleWidgetHTML;
                
                } catch(err) {
                    console.log("err inside prepareSingleBulkDiscountRulesWidget:", err);
                }
            },
            replaceVolDiscountWidgetVariables: function(currBulkDiscount, text, nextDiscountRuleIndex) {
                try {
                    
                    let _cartData = gfg.state.cartData;
                    let CURRENCY = gfg.utility.getCurrencySymbol() || "$";

                    if(currBulkDiscount.disProducts.type == "COLLECTIONS"){
                        let COLLECTIONS = currBulkDiscount?.disProducts.collections.map(collection => collection.title).join(', ');
                        let COLLECTIONS_LINKS = currBulkDiscount?.disProducts.collections.map(collection => `<a href="/collections/${collection.handle}" target="_blank">${collection.title}</a>`).join(', ');

                        text = text.replace("{{COLLECTIONS}}", COLLECTIONS);
                        text = text.replace("{{COLLECTIONS_LINKS}}", COLLECTIONS_LINKS);
                    }
                    if(currBulkDiscount.disProducts.type == "SELECTED_PRODUCTS"){
                        let PRODUCTS = currBulkDiscount?.disProducts.products.map(product => product.title).join(', ');
                        let PRODUCTS_LINKS = currBulkDiscount?.disProducts.products.map(product => `<a href="/products/${product.handle}" target="_blank">${product.title}</a>`).join(', ');

                        text = text.replace("{{PRODUCTS}}", PRODUCTS);
                        text = text.replace("{{PRODUCTS_LINKS}}", PRODUCTS_LINKS);
                    }
                   
                    if(currBulkDiscount.conditionType == "COUNT") {
                        let conditionValue = parseInt(currBulkDiscount.rules[nextDiscountRuleIndex].conditionValue);
                        let REMAINING_QUANTITY = 0;
                        if(currBulkDiscount.disProducts.type == "ALL_PRODUCTS") {
                            let cartQty = _cartData?.item_count || 0;
                            REMAINING_QUANTITY = conditionValue - cartQty;
                         
                         } else if(currBulkDiscount.disProducts.type == "COLLECTIONS") {
                            let collectionCartData = this.getDataOfProductsPresentInCartFromThisCollection(currBulkDiscount);
                            let totalProductsInCollection = collectionCartData.totalProductsInCollection;
                            REMAINING_QUANTITY = conditionValue - totalProductsInCollection;
                         
                         } else if(currBulkDiscount.disProducts.type == "SELECTED_PRODUCTS") {
                             let productsCartData = this.getDataOfProductsPresentInCartFromThisListOfProducts(currBulkDiscount);
                             let totalProductsInList = productsCartData.totalProductsInList;
                             REMAINING_QUANTITY = conditionValue - totalProductsInList;
                          }
                        text = text.replace("{{REMAINING_QUANTITY}}", REMAINING_QUANTITY);
                    }

                    if(currBulkDiscount.conditionType == "SUBTOTAL") {
                        let conditionValue = parseFloat(currBulkDiscount.rules[nextDiscountRuleIndex].conditionValue);
                        conditionValue = gfg.utility.convertFromStoreCurrencyToCustomer(conditionValue)
                        let REMAINING_AMOUNT = 0;
                        if(currBulkDiscount.disProducts.type == "ALL_PRODUCTS") {
                            let _totalValue = parseFloat(_cartData.total_price / 100);
                           REMAINING_AMOUNT = conditionValue - _totalValue;

                        } else if(currBulkDiscount.disProducts.type == "COLLECTIONS") {
                           let collectionCartData = this.getDataOfProductsPresentInCartFromThisCollection(currBulkDiscount);
                           let totalValueOfCollection = collectionCartData.totalValueOfCollection;
                           REMAINING_AMOUNT = conditionValue - totalValueOfCollection;

                        
                        } else if(currBulkDiscount.disProducts.type == "SELECTED_PRODUCTS") {
                            let productsCartData = this.getDataOfProductsPresentInCartFromThisListOfProducts(currBulkDiscount);
                            let totalValueOfProducts = productsCartData.totalValueOfProducts;
                            REMAINING_AMOUNT = conditionValue - totalValueOfProducts;
                         }
                        
                        REMAINING_AMOUNT = parseFloat(REMAINING_AMOUNT).toFixed(2)
                        text = text.replace("{{REMAINING_AMOUNT}}", REMAINING_AMOUNT);
                    }
                    text = text.replace("{{CURRENCY}}", CURRENCY);
                    
                    let DISCOUNT = parseInt(currBulkDiscount.rules[nextDiscountRuleIndex].disValue);
                    text = text.replace("{{DISCOUNT}}", DISCOUNT);
                    return text;

                } catch(err) {
                    console.log("err inside replaceVolDiscountWidgetVariables", err);
                }
            },
            getIndexOfRuleThatCanBeAppliedAtCurrCartState: function(currBulkDiscount) {
                try {
                    let isQtyBasedDiscount = false;
                    let isValueBasedDiscount = false;
            
                    if (currBulkDiscount?.conditionType == "COUNT") {
                        isQtyBasedDiscount = true;
                    } else if (currBulkDiscount?.conditionType == "SUBTOTAL") {
                        isValueBasedDiscount = true;
                    }
            
                    let i = 0;
                    let lastSatisfyingIndex = -1;
            
                    while (i < currBulkDiscount.rules.length) {
                        let currRule = currBulkDiscount.rules[i];
                        let conditionValue = parseFloat(currRule.conditionValue);
            
                        if (isQtyBasedDiscount) {
                            if (currBulkDiscount.disProducts.type == "ALL_PRODUCTS") {
                                let _cartData = gfg.state.cartData;
                                let _totalProducts = _cartData.item_count;
            
                                if (_totalProducts >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            } else if (currBulkDiscount.disProducts.type == "COLLECTIONS") {
                                let collectionData = this.getDataOfProductsPresentInCartFromThisCollection(currBulkDiscount);
                                let totalProductsInCollection = collectionData.totalProductsInCollection;
            
                                if (totalProductsInCollection >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            } else if (currBulkDiscount.disProducts.type == "SELECTED_PRODUCTS") {
                                let productsData = this.getDataOfProductsPresentInCartFromThisListOfProducts(currBulkDiscount);
                                let totalProductsInList = productsData.totalProductsInList;
            
                                if (totalProductsInList >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            }
                        } else if (isValueBasedDiscount) {
                            if (currBulkDiscount.disProducts.type == "ALL_PRODUCTS") {
                                let _cartData = gfg.state.cartData;
                                let _totalValue = parseFloat(_cartData.total_price / 100);
                                _conditionValue =  gfg.utility.convertFromStoreCurrencyToCustomer(conditionValue);

                                if (_totalValue >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            } else if (currBulkDiscount.disProducts.type == "COLLECTIONS") {
                                let collectionData = this.getDataOfProductsPresentInCartFromThisCollection(currBulkDiscount);
                                let totalValueOfCollection = collectionData.totalValueOfCollection;
            
                                if (totalValueOfCollection >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            } else if (currBulkDiscount.disProducts.type == "SELECTED_PRODUCTS") {
                                let productsData = this.getDataOfProductsPresentInCartFromThisListOfProducts(currBulkDiscount);
                                let totalValueOfProducts = productsData.totalValueOfProducts;
                    
                                if (totalValueOfProducts >= conditionValue) {
                                    lastSatisfyingIndex = i;
                                } else {
                                    break;
                                }
                            }
                        } else {
                            // If the condition is not satisfied, break the loop
                            break;
                        }
            
                        i++;
                    }
                    // `lastSatisfyingIndex` will now hold the index of the last rule for which the condition satisfies
                    return lastSatisfyingIndex;
                } catch(err) {
                    console.log("err inside getIndexOfRuleThatCanBeAppliedAtCurrCartState:", err);
                }
            },
            
            getDataOfProductsPresentInCartFromThisCollection: function(currBulkDiscount) {
                try {
                    let _cartData = gfg.state.cartData;
                    let totalProductsInCollection = 0;
                    let totalValueOfCollection = 0;
                    let collectionData = currBulkDiscount.disProducts.collectionsData;
                    collectionData?.forEach(collection => {
                        collection?.productList?.forEach(productInCollection => {
                            // Find the matching product in the cart
                            let matchingCartItem = _cartData?.items?.find(cartItem => cartItem.product_id === productInCollection.productId);
            
                            if (matchingCartItem) {
                                totalProductsInCollection += matchingCartItem.quantity;
                                totalValueOfCollection += Number(parseFloat(matchingCartItem.line_price / 100)).toFixed(2);
                            }
                        });
                    });
            
                    return { totalProductsInCollection, totalValueOfCollection };
                } catch (err) {
                    console.log("err inside getDataOfProductsPresentInCartFromThisCollection:", err);
                }
            },
            getDataOfProductsPresentInCartFromThisListOfProducts: function(currBulkDiscount) {
                try {
                    let cartData = gfg.state.cartData;
                    const productIdsInCart = cartData.items.map(item => item.product_id);
                
                    let totalProductsInList = 0;
                    let totalValueOfProducts = 0;
                
                    for (const product of currBulkDiscount.disProducts.products) {
                        if (productIdsInCart.includes(parseInt(product.productId))) {
                          for (const item of cartData.items) {
                            if (item.product_id == product.productId) {
                              totalProductsInList += item.quantity;

                              let finalItemPrice = Number(parseFloat(item.price / 100));
                              finalItemPrice = finalItemPrice * item.quantity;
                              totalValueOfProducts += finalItemPrice
                            }
                          }
                        }
                    }
                      
                
                    return {
                        totalProductsInList,
                        totalValueOfProducts
                    };
                } catch(err) {
                    console.log("err inside getDataOfProductsPresentInCartFromThisListOfProducts", err);
                }
            }
            
        },
        actions: {
            
        }

    }
}

window.gfg = gfg;

let codeActive = false;
document.addEventListener("DOMContentLoaded", function(event) { 
    //do work
    // check if its bundle builder product execute the rest of the flow
    console.log("GFG FREE GIFT")
    if(codeActive == false){
        codeActive = true;
        gfgUtils.f.loadJquery(function (jqueryRefObj) {
            gfg.$ = jqueryRefObj;
                gfg.f.initialize(gfg.$);
        })
    }
});

setTimeout(function(){
    if(codeActive == false){
        codeActive = true;
        gfgUtils.f.loadJquery(function (jqueryRefObj) {
            gfg.$ = jqueryRefObj;
                gfg.f.initialize(gfg.$);
        })
    }

}, 3000)