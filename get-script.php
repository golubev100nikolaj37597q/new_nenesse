/**
################################## BEECLEVER GMBH KOBLENZ ###################################
##### Copyright (c) 2019-present, beeclever GmbH Koblenz DE, All rights reserved. #####
##### THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR #####
##### IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS #####
##### FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR #####
##### COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER #####
##### IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN #####
##### CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. #####
#############################################################################################
v2.0.15
*/
if ( !( !!window.Shopify && !!window.Shopify.Checkout) ) {
if ( !!window.Shopify && !!window.Shopify.loadFeatures && !window.Shopify.trackingConsent ) {
window.Shopify.loadFeatures ( [{ name : 'consent-tracking-api', version : '0.1' }], error => {
if ( error ) {
throw error
}
} )
}
;
if ( window.GDPR_LC_INIT === undefined ) {
window.GDPR_LC_INIT = true;
console.log ( 'GDPR_LC_INIT' );
var util = {};
util.browser = {
bot : /bot|google|baidu|bing|msn|teoma|slurp|yandex|googlebot|crawler|spider|robot|crawling/i.test ( navigator.userAgent ),
lightHouse : /Chrome-Lighthouse/i.test ( navigator.userAgent )
};
if ( typeof GDPR_LC_ZLoad !== undefined && !util.browser.bot && !util.browser.lightHouse && !navigator['webdriver'] ) {
var GDPR_LC_versionNr = 20201216225107;

var ShopifyCookies = {"_ab":{"description":"Used in connection with access to admin.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"86400","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_secure_session_id":{"description":"Used in connection with navigation through a storefront.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"2592000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_shopify_country":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_shopify_m":{"description":"Used for managing customer privacy settings.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_shopify_tm":{"description":"Used for managing customer privacy settings.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_shopify_tw":{"description":"Used for managing customer privacy settings.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_storefront_u":{"description":"Used to facilitate updating customer account information.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_tracking_consent":{"description":"For Shopify User Consent Tracking.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"c":{"description":"Used in connection with shopping cart.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"cart":{"description":"Used in connection with shopping cart.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"cart_currency":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"cart_sig":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"cart_ts":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"cart_ver":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"checkout":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"2592000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"checkout_token":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"dynamic_checkout_shown_on_cart":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_0","recommendation":"0","editable":"false","set":"0"},"keep_alive":{"description":"Used in connection with buyer localization.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"master_device_id":{"description":"Used in connection with merchant login.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"63072000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"previous_step":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"remember_me":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"secure_customer_sig":{"description":"Used in connection with customer login.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"shopify_pay":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"shopify_pay_redirect":{"description":"Used in connection with checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"source_name":{"description":"Used in combination with mobile apps to provide custom checkout behavior, when viewing a store from within a compatible mobile app.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"0","type":"type_0","recommendation":"0","editable":"false","set":"0"},"storefront_digest":{"description":"Used in connection with customer login.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"tracked_start_checkout":{"description":"Shopify analytics relating to checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_1","recommendation":"1","editable":"true","set":"1"},"checkout_session_lookup":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"2592000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"checkout_session_token_<<id>>":{"description":"Used in connection with cart and checkout.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"2592000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"identity-state":{"description":"Used in connection with customer authentication","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"3600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"identity-state-<<id>>":{"description":"Used in connection with customer authentication","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"3600","type":"type_0","recommendation":"0","editable":"false","set":"0"},"identity_customer_account_number":{"description":"Used in connection with customer authentication","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"7776000","type":"type_0","recommendation":"0","editable":"false","set":"0"},"_landing_page":{"description":"Track landing pages.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_orig_referrer":{"description":"Used in connection with shopping cart.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_s":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_d":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_fs":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1209600","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_s":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_sa_p":{"description":"Shopify analytics relating to marketing & referrals.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_sa_t":{"description":"Shopify analytics relating to marketing & referrals.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"1800","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_y":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_y":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"31536000","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_evids":{"description":"Shopify analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"0","type":"type_1","recommendation":"1","editable":"true","set":"1"},"_shopify_ga":{"description":"Shopify and Google Analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"0","type":"type_1","recommendation":"1","editable":"true","set":"1"},"customer_auth_provider":{"description":"Shopify Analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"0","type":"type_1","recommendation":"1","editable":"true","set":"1"},"customer_auth_session_created_at":{"description":"Shopify Analytics.","path":"\/","domain":"","provider":"Shopify","deletable":"false","expires":"0","type":"type_1","recommendation":"1","editable":"true","set":"1"},"__cfduid":{"description":"The _cfduid cookie helps Cloudflare detect malicious visitors to our Customers\u2019 websites and minimizes blocking legitimate users.","path":"\/","domain":"","provider":"Cloudflare","type":"type_0","expires":"2592000","recommendation":"0","editable":"false","deletable":"false","set":"0"},"_bc_c_set":{"description":"Used in connection with GDPR legal Cookie.","path":"\/","domain":"","provider":"GDPR Legal Cookie","type":"type_0","expires":"2592000","recommendation":"0","editable":"false","deletable":"false","set":"0","optIn":true,"live":0}};
        window.GDPR_LC = window.GDPR_LC || {};
        window._GDPR_VAL = window._GDPR_VAL || {};
        window.BC_JSON_ObjectBypass = window.BC_JSON_ObjectBypass || {};
        window.GDPR_googleFacebookPixelCustomSourceTagManagerTrackData = window.GDPR_googleFacebookPixelCustomSourceTagManagerTrackData || {};
        window.BC_GDPR_2ce3a13160348f524c8cc9 = window.BC_GDPR_2ce3a13160348f524c8cc9 || {};
        window.BC_GDPR_CustomScriptForShop = window.BC_GDPR_CustomScriptForShop || '';
        window.bc_tagManagerTasks = window.bc_tagManagerTasks || {};
        window.bc_tagManagerData = window.bc_tagManagerData || {};
        window.customCookies = window.customCookies || {};
        window.GDPR_LC.userConsentSetting = window.GDPR_LC.userConsentSetting || null;
        (function ( bypass, shopify ) {
        var ShopifyCookieKeys = Object.keys ( shopify );
        ShopifyCookieKeys.forEach ( function ( key ) {
        if ( typeof bypass[key] === "undefined" ) {
        bypass[key] = shopify[key]
        }
        } )
        }) ( window.BC_JSON_ObjectBypass, ShopifyCookies );
        var getCookie = function ( name ) {
        var match = document.cookie.match ( new RegExp ( '(^| )' + name + '=([^;]+)' ) );
        if ( match ) {
        return match[2]
        } else {
        return null
        }
        };

        function setUserConsentFromCookie () {
        var gdprCookieValue = getCookie ( '_bc_c_set' );
        if ( gdprCookieValue !== null ) {
        try {
        var data = atob ( gdprCookieValue );
        window.GDPR_LC.userConsentSetting = JSON.parse ( data );
        document.dispatchEvent ( new CustomEvent ( "GDPR_LC:userConsentSetting", { detail : window.GDPR_LC.userConsentSetting } ) );
        } catch ( e ) {
        window.GDPR_LC.userConsentSetting = null
        }
        }
        };setUserConsentFromCookie ();

        function set_bc_c_set_cookie ( holdDate = false ) {
        window.GDPR_LC.DEBUGGER = window.GDPR_LC.DEBUGGER || [];
        window.GDPR_LC.DEBUGGER.push ( GDPR_LC.Cookies.list );
        var date = Date.now ();
        if ( holdDate ) {
        if ( GDPR_LC !== undefined && GDPR_LC.Cookies !== undefined && GDPR_LC.Cookies.list !== undefined && GDPR_LC.Cookies.list._bc_c_set !== undefined && GDPR_LC.Cookies.list._bc_c_set.lastChange !== undefined ) {
        date = GDPR_LC.Cookies.list._bc_c_set.lastChange
        }
        }
        var userConsentData = { "date" : date, "version" : GDPR_LC_versionNr };
        Object.keys ( GDPR_LC.Cookies.list ).forEach ( function ( cookie ) {
        var Cookie = GDPR_LC.Cookies.list[cookie];
        var type = Cookie.type;
        if ( typeof userConsentData[type] === "undefined" ) {
        userConsentData[type] = { "true" : 0, "false" : 0 }
        }
        if ( Cookie.userSetting === true ) {
        userConsentData[type]["true"] = 1
        } else {
        userConsentData[type]["false"] = 1
        }
        } );
        window.GDPR_LC.userConsentSetting = userConsentData;
        document.dispatchEvent ( new CustomEvent ( "GDPR_LC:userConsentSetting", { detail : userConsentData } ) );
        ;window.GDPR_LC.DEBUGGER.push ( GDPR_LC.Cookies.list );
        window.GDPR_LC.DEBUGGER.push ( userConsentData );
        window.GDPR_LC.DEBUGGER.push ( window.GDPR_LC.userConsentSetting );
        var userConsentBase64 = btoa ( JSON.stringify ( userConsentData ) );
        if ( GDPR_LC !== undefined && GDPR_LC.Cookies !== undefined && GDPR_LC.Cookies.list !== undefined && GDPR_LC.Cookies.list._bc_c_set !== undefined ) {
        GDPR_LC.Cookies.list._bc_c_set.update ( 'value', userConsentBase64, !1 )
        }
        document.cookie = '_bc_c_set=' + userConsentBase64 + ';path=/;max-age=2592000;SameSite=Lax;'
        };GDPR_LC.iterate = !function () {
        var setParam = function ( param, defaultValue ) {
        if ( param !== undefined ) {
        return param
        } else {
        return defaultValue
        }
        };
        GDPR_LC.console = function () {
        var $this = this;
        var c = GDPR_LC.console, k = 'GDPR_LC.console';
        this.d = !1;
        this.m = { 'log' : {}, 'error' : {} };
        this.dc = { 'log' : 'color:green', 'error' : 'color:red' };
        this.s = function ( s, m ) {
        s = setParam ( s, !1 );
        m = setParam ( m, !1 );
        if ( s ) {
        if ( m !== !1 ) {
        sessionStorage.setItem ( k, m );
        this.d = m
        }
        }
        if ( m === !1 && k in sessionStorage ) {
        this.sd ( sessionStorage.getItem ( k ) )
        }
        if ( c === _U ) {
        c = GDPR_LC.console
        }
        this.i ()
        };
        this.i = function () {
        var m = this.gd ();
        if ( m !== !1 && m !== _U ) {
        m = m.toLowerCase ();
        console.log ( '##################### BEECLEVER GMBH KOBLENZ #####################' + '\n DEBUG MODE ' + m.toUpperCase () + '\n reset console mode with command GDPR_LC.console.reset()' );
        if ( m === 'any' ) {
        this.oc ( "log" );
        this.oc ( 'error' )
        } else {
        this.oc ( m )
        }
        }
        };
        this.pmh = function ( t, n, v ) {
        if ( this.gd () === t || this.gd () === 'any' ) {
        this.mo ( n, v, t )
        } else {
        this.po ( t, [n, v] )
        }
        };
        this.l = function ( n, v ) {
        this.pmh ( "log", n, v )
        };
        this.e = function ( n, v ) {
        this.pmh ( 'error', n, v )
        };
        this.oc = function ( mt ) {
        var m = $this.m;
        if ( c !== _U && m !== _U ) {
        $O_K ( m[mt] ).forEach ( function ( k ) {
        var mK = m[mt][k];
        if ( mK !== _U ) {
        mo ( mK[0], mK[1], mt );
        delete m[mt][k]
        }
        } )
        }
        };
        this.mo = function ( n, v, t ) {
        t = setParam ( t, !1 );
        if ( this.gd () !== !1 ) {
        console.log ( '%c### ' + n, this.dc[t] );
        if ( v !== _U ) {
        console.log ( '%c' + v, this.dc[t] )
        }
        }
        };
        this.po = function ( mt, m ) {
        if ( mt !== _U && mt !== null && mt !== '' && typeof mt === 'string' ) {
        var t = Date.now ();
        if ( this.m[mt] !== _U ) {
        this.m[mt][t] = m
        } else {
        this.m[mt] = {};
        this.m[mt][t] = m
        }
        }
        };
        this.sd = function ( m ) {
        this.d = m
        };
        this.gd = function () {
        return this.d
        };
        this.r = function () {
        sessionStorage.removeItem ( k )
        };
        this.s ();
        return {
        start : function ( s, m ) {
        if ( $this !== _U && $this.s !== _U && typeof $this.s === "function" ) {
        $this.s ( s, m )
        }
        }, reset : function () {
        if ( $this !== _U && $this.r !== _U && typeof $this.r === "function" ) {
        $this.r ()
        }
        }, log : function ( n, v ) {
        if ( $this !== _U && $this.l !== _U && typeof $this.l === "function" ) {
        $this.l ( n, v )
        }
        }, error : function ( n, v ) {
        if ( $this !== _U && $this.e !== _U && typeof $this.e === "function" ) {
        $this.e ( n, v )
        }
        }
        }
        } ();
        var beeclever = !1, _d = document, _w = window, _GL = GDPR_LC, _U = undefined, _ = null, _O = 'object',
        _SS = sessionStorage, _LS = localStorage, _M = {
        '1' : 'BC_GDPR_2ce3a13160348f524c8cc9',
        '2' : 'BC_GDPR_CustomScriptForShop',
        '3' : '_GDPR_VAL',
        '4' : 'bc_tagManagerTasks',
        '5' : 'bc_tagManagerData',
        '6' : 'customCookies',
        '7' : 'GDPR_LC_Version',
        '8' : 'GDPR_googleFacebookPixelCustomSourceTagManager',
        '9' : 'GDPR_legal_cookie',
        'S' : 'Shopify',
        's' : 'shopify'
        };
        var $JP = function ( v ) {
        var r = !1;
        try {
        r = JSON.parse ( v )
        } catch ( e ) {
        GDPR_LC.console.error ( '$JP', m )
        }
        return r
        };
        var $JS = function ( v, s ) {
        var r = !1;
        s = setParam ( s, !1 );
        if ( !!s ) {
        try {
        r = JSON.stringify ( v )
        } catch ( e ) {
        GDPR_LC.console.error ( '$JS', e )
        }
        }
        return r
        };
        var $S_G = function ( k, s ) {
        return $JP ( s.getItem ( k ) )
        };
        var $S_S = function ( k, v, s ) {
        if ( typeof v === _O ) {
        v = $JS ( v, !0 )
        }
        s.setItem ( k, v )
        };
        var $SS_S = function ( k, v ) {
        $S_S ( k, v, _SS )
        };
        var $SS_G = function ( k ) {
        return $S_G ( k, _SS )
        };
        var $LS_S = function ( k, v ) {
        $S_S ( k, v, _LS )
        };
        var $LS_G = function ( k ) {
        return $S_G ( k, _LS )
        };
        var $LS_R = function ( k ) {
        _LS.removeItem ( k )
        };
        var $Q = function ( n, v ) {
        return n.querySelector ( v )
        };
        var $QA = function ( n, v ) {
        return Array.from ( n.querySelectorAll ( v ) )
        };
        var $O_K = function ( o ) {
        if ( typeof o !== "object" || o === null ) {
        return !1
        }
        return Object.keys ( o )
        };
        var $N_V = function ( n, s, d ) {
        s = setParam ( s, !1 );
        d = setParam ( d, 'flex' );
        if ( s ) {
        n.style.opacity = 1;
        n.style.display = d;
        n.style.visibility = 'visible'
        } else {
        n.style.opacity = 0;
        n.style.display = 'none';
        n.style.visibility = 'hidden'
        }
        };
        var minConsentActivated = function () {
        return BC_JSON_ObjectBypass !== _U && BC_JSON_ObjectBypass['_bc_c_set'] !== _U && BC_JSON_ObjectBypass['_bc_c_set']['ShopifyMinConsent'] !== _U && BC_JSON_ObjectBypass['_bc_c_set']['ShopifyMinConsent'] === true
        };
        window.GDPR_whiteList = window.GDPR_whiteList || Object.keys ( ShopifyCookies );

        function isWhiteListed ( cookieName ) {
        var isInWhitelist = false;
        window.GDPR_whiteList.forEach ( function ( whitelistCookie ) {
        if ( whitelistCookie === cookieName ) {
        isInWhitelist = true
        }
        } );
        return isInWhitelist
        };var documentCookie = {
        set : function ( name, dataSet ) {
        _d.cookie = name + dataSet
        }, remove : function ( name ) {
        var count = 0, cookieIncludesInDocument = (name in _GL.docCookies), path, paths = [],
        domains = _w[_M[3]].global.domains;
        paths = location.pathname.split ( '/' );
        paths[0] = "/";
        path = paths.shift ();
        while ( cookieIncludesInDocument && count < 3 ) { if ( location.host.includes ( 'myshopify.com' ) ) { documentCookie.set ( name, '=;expires=Thuu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ); documentCookie.set ( name, '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ); documentCookie.set ( name, '=;path=' + path + '; domain=.myshopify.com;expires=Thu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ) } else { domains.forEach ( function ( domain ) { documentCookie.set ( name, '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ); documentCookie.set ( name, '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ); documentCookie.set ( name, '=;path=' + path + '; domain=' + domain + ';expires=Thu, 01 Jan 1970 00:00:01 GMT;SameSite=None; Secure;' ) } ) } _GL.setCookiesFromDocument (); cookieIncludesInDocument=(name in _GL.docCookies); if ( cookieIncludesInDocument ) { count++ } else { break } path +=paths.shift () + '/' } var logMessage='remove' ; if ( cookieIncludesInDocument ) { logMessage='not removed' } GDPR_LC.console.log ( 'Cookie => ' + logMessage, name ) } }; (function setScript () { var s=$Q ( _d, '[src*="beeclever.app/"]' ); if ( s !==_ ) { beeclever=!0 } }) (); if ( beeclever || !1 ) { (function () { if ( !('remove' in Element.prototype) ) { Element.prototype.remove=function () { if ( this.parentNode ) { this.parentNode.removeChild ( this ) } } } var $bc_polyfills=window.$bc_polyfills || {}; $bc_polyfills.scope={}; $bc_polyfills.arrayIteratorImpl=function ( g ) { var d=0; return function () { return d < g.length ? { done : !1, value : g[d++] } : { done : !0 } } }; $bc_polyfills.arrayIterator=function ( g ) { return { next : $bc_polyfills.arrayIteratorImpl ( g ) } }; $bc_polyfills.ASSUME_ES5=!1; $bc_polyfills.ASSUME_NO_NATIVE_MAP=!1; $bc_polyfills.ASSUME_NO_NATIVE_SET=!1; $bc_polyfills.SIMPLE_FROUND_POLYFILL=!1; $bc_polyfills.ISOLATE_POLYFILLS=!1; $bc_polyfills.defineProperty=$bc_polyfills.ASSUME_ES5 || "function"==typeof Object.defineProperties ? Object.defineProperty : function ( g, d, k ) { if ( g==Array.prototype || g==Object.prototype ) return g; g[d]=k.value; return g }; $bc_polyfills.getGlobal=function ( g ) { g=["object"==typeof globalThis && globalThis, g, "object"==typeof window && window, "object"==typeof self && self, "object"==typeof global && global]; for ( var d=0; d < g.length; ++d ) { var k=g[d]; if ( k && k.Math==Math ) return k } throw Error ( "Cannot find global object" ) }; $bc_polyfills.global=$bc_polyfills.getGlobal ( this ); $bc_polyfills.IS_SYMBOL_NATIVE="function"===typeof Symbol && "symbol"===typeof Symbol ( "x" ); $bc_polyfills.TRUST_ES6_POLYFILLS=!$bc_polyfills.ISOLATE_POLYFILLS || $bc_polyfills.IS_SYMBOL_NATIVE; $bc_polyfills.polyfills={}; $bc_polyfills.propertyToPolyfillSymbol={}; $bc_polyfills.POLYFILL_PREFIX="$jscp$" ; var $bc_polyfills$lookupPolyfilledValue=function ( g, d ) { var k=$bc_polyfills.propertyToPolyfillSymbol[d]; if ( _==k ) return g[d]; k=g[k]; return void 0 !==k ? k : g[d] }; $bc_polyfills.polyfill=function ( g, d, k, e ) { d && ($bc_polyfills.ISOLATE_POLYFILLS ? $bc_polyfills.polyfillIsolated ( g, d, k, e ) : $bc_polyfills.polyfillUnisolated ( g, d, k, e )) }; $bc_polyfills.polyfillUnisolated=function ( g, d, k, e ) { k=$bc_polyfills.global; g=g.split ( "." ); for ( e=0; e < g.length - 1; e++ ) { var n=g[e]; if ( !(n in k) ) return; k=k[n] } g=g[g.length - 1]; e=k[g]; d=d ( e ); d !=e && _ !=d && $bc_polyfills.defineProperty ( k, g, { configurable : !0, writable : !0, value : d } ) }; $bc_polyfills.polyfillIsolated=function ( g, d, k, e ) { var n=g.split ( "." ); g=1===n.length; e=n[0]; e=!g && e in $bc_polyfills.polyfills ? $bc_polyfills.polyfills : $bc_polyfills.global; for ( var l=0; l < n.length - 1; l++ ) { var q=n[l]; if ( !(q in e) ) return; e=e[q] } n=n[n.length - 1]; k=$bc_polyfills.IS_SYMBOL_NATIVE && "es6"===k ? e[n] : _; d=d ( k ); _ !=d && (g ? $bc_polyfills.defineProperty ( $bc_polyfills.polyfills, n, { configurable : !0, writable : !0, value : d } ) : d !==k && ($bc_polyfills.propertyToPolyfillSymbol[n]=$bc_polyfills.IS_SYMBOL_NATIVE ? $bc_polyfills.global.Symbol ( n ) : $bc_polyfills.POLYFILL_PREFIX + n, n=$bc_polyfills.propertyToPolyfillSymbol[n], $bc_polyfills.defineProperty ( e, n, { configurable : !0, writable : !0, value : d } ))) }; $bc_polyfills.initSymbol=function () { }; $bc_polyfills.polyfill ( "Symbol" , function ( g ) { if ( g ) return g; var d=function ( n, l ) { this.$$bc_polyfills$symbol$id_=n; $bc_polyfills.defineProperty ( this, "description" , { configurable : !0, writable : !0, value : l } ) }; d.prototype.toString=function () { return this.$bc_polyfills$symbol$id_ }; var k=0, e=function ( n ) { if ( this instanceof e ) throw new TypeError ( "Symbol is not a constructor" ); return new d ( "bc_polyfills_symbol_" + (n || "" ) + "_" + k++, n ) }; return e }, "es6" , "es3" ); $bc_polyfills.initSymbolIterator=function () { }; $bc_polyfills.polyfill ( "Symbol.iterator" , function ( g ) { if ( g ) return g; g=Symbol ( "Symbol.iterator" ); for ( var d="Array Int8Array Uint8Array Uint8ClampedArray Int16Array Uint16Array Int32Array Uint32Array Float32Array Float64Array" .split ( " " ), k=0; k < d.length; k++ ) { var e=$bc_polyfills.global[d[k]]; "function"===typeof e && "function" !=typeof e.prototype[g] && $bc_polyfills.defineProperty ( e.prototype, g, { configurable : !0, writable : !0, value : function () { return $bc_polyfills.iteratorPrototype ( $bc_polyfills.arrayIteratorImpl ( this ) ) } } ) } return g }, "es6" , "es3" ); $bc_polyfills.initSymbolAsyncIterator=function () { }; $bc_polyfills.iteratorPrototype=function ( g ) { g={ next : g }; g[Symbol.iterator]=function () { return this }; return g }; $bc_polyfills.iteratorFromArray=function ( g, d ) { g instanceof String && (g +="" ); var k=0, e={ next : function () { if ( k < g.length ) { var n=k++; return { value : d ( n, g[n] ), done : !1 } } e.next=function () { return { done : !0, value : void 0 } }; return e.next () } }; e[Symbol.iterator]=function () { return e }; return e }; $bc_polyfills.polyfill ( "Array.prototype.keys" , function ( g ) { return g ? g : function () { return $bc_polyfills.iteratorFromArray ( this, function ( d ) { return d } ) } }, "es6" , "es3" ); $bc_polyfills.polyfill ( "Array.from" , function ( g ) { return g ? g : function ( d, k, e ) { k=_ !=k ? k : function ( x ) { return x }; var n=[], l="undefined" !=typeof Symbol && Symbol.iterator && d[Symbol.iterator]; if ( "function"==typeof l ) { d=l.call ( d ); for ( var q=0; !(l=d.next ()).done; ) n.push ( k.call ( e, l.value, q++ ) ) } else for ( l=d.length, q=0; q < l; q++ ) n.push ( k.call ( e, d[q], q ) ); return n } }, "es6" , "es3" ); $bc_polyfills.owns=function ( g, d ) { return Object.prototype.hasOwnProperty.call ( g, d ) }; $bc_polyfills.assign=$bc_polyfills.TRUST_ES6_POLYFILLS && "function"==typeof Object.assign ? Object.assign : function ( g, d ) { for ( var k=1; k < arguments.length; k++ ) { var e=arguments[k]; if ( e ) for ( var n in e ) $bc_polyfills.owns ( e, n ) && (g[n]=e[n]) } return g }; $bc_polyfills.polyfill ( "Object.assign" , function ( g ) { return g || $bc_polyfills.assign }, "es6" , "es3" ); $bc_polyfills.polyfill ( "Object.is" , function ( g ) { return g ? g : function ( d, k ) { return d===k ? 0 !==d || 1 / d===1 / k : d !==d && k !==k } }, "es6" , "es3" ); $bc_polyfills.polyfill ( "Array.prototype.includes" , function ( g ) { return g ? g : function ( d, k ) { var e=this; e instanceof String && (e=String ( e )); var n=e.length; k=k || 0; for ( 0> k && (k = Math.max ( k + n, 0 )); k < n; k++ ) { var l=e[k]; if ( l===d || Object.is ( l, d ) ) return !0 } return !1 } }, "es7" , "es3" ); $bc_polyfills.checkStringArgs=function ( g, d, k ) { if ( _===g ) throw new TypeError ( "The 'this' value for String.prototype." + k + " must not be _ or undefined" ); if ( d instanceof RegExp ) throw new TypeError ( "First argument to String.prototype." + k + " must not be a regular expression" ); return g + "" }; $bc_polyfills.polyfill ( "String.prototype.includes" , function ( g ) { return g ? g : function ( d, k ) { return -1 !==$bc_polyfills.checkStringArgs ( this, d, "includes" ).indexOf ( d, k || 0 ) } }, "es6" , "es3" ) }) (); _w[_M[4]]={ "bc_tgm_aw" : "google" , "bc_tgm_gtm" : "google" , "bc_tgm_ua" : "google" , "bc_tgm_fbp" : "facebook" , "any" : "any" , "_bc_c_set" : "customScript" }; _w[_M[5]]={ "google" : { "executeBefore" : { "params" : _w[_M[1]].google || [] }, "load" : { "params" : _w[_M[1]].google || [] }, "executeAfter" : { "params" : _w[_M[1]].google || [] }, "data" : { "googleSRC" : 'https://www.googletagmanager.com/gtag/js?id=' , "googleGTM" : "https://www.googletagmanager.com/gtm.js?id=" } }, "facebook" : { "load" : { "params" : _w[_M[1]].facebook || null, } }, 'customScripts' : _w[_M[1]].customScriptsSRC || [], }; function checkHasThirdPartyScriptsAndExecute () { if ( GDPR_LC !==undefined && GDPR_LC.Cookies !==undefined && GDPR_LC.Cookies.list !==undefined && window.GDPR_LC_thirdPartyFunctions !==undefined && typeof window.GDPR_LC_thirdPartyFunctions==='object' ) { window.GDPR_LC_thirdPartyFunctions.forEach ( function ( config ) { if ( config['execute']===undefined ) { if ( GDPR_LC.Cookies.list[config['cookie_name']] !==undefined && GDPR_LC.Cookies.list[config['cookie_name']]['userSetting'] ) { config['function'] (); config['execute']=true } } } ) } }; function ICS () { if ( typeof _w[_M[2]]==="function" ) { var f=_w[_M[2]] (); var fh={}; var CL=GDPR_LC.Cookies; if ( Array.isArray ( f ) ) { for ( var x=0; x < f.length; x++ ) { fh[f[x].name]=x } if ( _w[_M[6]] !==_U && CL !==_U && CL.list !==_U ) { $O_K ( _w[_M[6]] ).forEach ( function ( cn ) { try { if ( cn !==_U && CL.list[cn] !==_U && CL.list[cn].userSetting ) { if ( fh.hasOwnProperty ( cn ) ) { var i=fh[cn]; f[i] (); if ( _w[_M[6]][cn] ) { documentCookie.set ( cn, '=1;' ) } } else { console.log ( '%cGDPR Legal Cookie => Custom scripts: ' + cn + ' is not a function. Please check, in theme snippets => load-metafields.liquid, the name from custom function, and from custom cookie.' , "color:red;font-size:bold" ) } } } catch ( e ) { console.log ( '%cGDPR Legal Cookie => Custom scripts: ' + cn + ' is not a valid function. Please check the custom function.' , "color:red" ) } } ) } } } checkHasThirdPartyScriptsAndExecute () } (function () { var r=!1; if ( $O_K ( _w[_M[1]] ).length===0 && _M[1] in _LS ) { r=$LS_G ( _M[1] ); if ( !!r ) { _w[_M['1']]=r } } if ( $O_K ( _w[_M[5]] ).length===0 && _M[5] in _LS ) { r=$LS_G ( _M[5] ); if ( !!r ) { _w[_M[5]]=r } } if ( $O_K ( _w[_M[6]] ).length===0 && _M[6] in _LS ) { r=$LS_G ( _M[6] ); if ( !!r ) { _w[_M[6]]=r } } if ( $O_K ( _w[_M[4]] ).length===0 && _M[4] in _LS ) { r=$LS_G ( _M[4] ); if ( !!r ) { _w[_M[4]]=r } } if ( typeof _w[_M[2]] !=="function" && _M[2] in _LS ) { r=localStorage.getItem ( _M[2] ); if ( !!r ) { if ( _w.BC_GDPR_LEGAL_custom_cookies===_U ) { _w.BC_GDPR_LEGAL_custom_cookies=GDPR_LC.Cookies } ICS (); r=r.replace ( 'function ' + _M[2] + ' () {' , '' ); r=r.substr ( 0, r.length -1 ); _w[_M[2]]=new Function ( r ) () } } if ( 'GDPR_legal_cookie' in _LS ) { if ( _w.GDPR_LC===_U ) { _w.GDPR_LC={} } if ( _w.GDPR_LC.Cookies===_U ) { _w.GDPR_LC.Cookies={} } if ( _w.GDPR_LC.Cookies.list ) { _w.GDPR_LC.Cookies.list=$LS_G ( 'GDPR_legal_cookie' ) } } }) (); _GL.localStorageDataExist=(_M[9] in _LS); !function () { if ( _w.GDPR_LC_Banner===_U ) { !function () { var n=$Q ( _d, 'div#banner-wrapper' ); if ( n !==_ ) { $N_V ( n, !1 ) } } () } } (); _GL.g={ groupFilter : function () { var dynamicGroups=[]; if ( _w.thirdPartyScriptDefinition !==_U ) { _w.thirdPartyScriptDefinition.forEach ( function ( cookieData ) { if ( cookieData.group !==undefined ) { if ( !dynamicGroups.includes ( cookieData.group ) ) { dynamicGroups.push ( cookieData.group ) } } } ) } return dynamicGroups }, defineDynamicGroup : function () { var dynamicGroups=this.groupFilter (); if ( dynamicGroups.length> 0 ) {
                dynamicGroups.forEach ( function ( gName ) {
                if ( !_GL.g.cG.hasOwnProperty ( gName ) ) {
                _GL.g.cG[gName] = {}
                }
                _GL.g.setDynamicCookiesToGroup ( gName )
                } )
                }
                },
                getGroupObject : function ( gName, cookieData ) {
                var cObjet = {}, name = cookieData.cookie;
                cObjet.group = gName;
                cObjet.selected = cookieData.declaration > 0 ? !1 : !0;
                if ( document.location.host !== cookieData.domain ) {
                name = cookieData.cookie + '$%bc%$' + cookieData.domain
                }
                return { "name" : name, "cObject" : cObjet }
                },
                setDynamicCookiesToGroup : function ( gName ) {
                if ( _w.thirdPartyScriptDefinition !== _U ) {
                _w.thirdPartyScriptDefinition.forEach ( function ( cookieData ) {
                if ( cookieData.group !== undefined && cookieData.group === gName ) {
                var o = _GL.g.getGroupObject ( gName, cookieData );
                _GL.g.cG[gName][o.name] = o.cObject
                }
                } )
                }
                },
                c : function ( c ) {
                var hg = _GL.g.cHG ( c );
                if ( hg !== !1 ) {
                if ( GDPR_LC.Cookies !== _U && GDPR_LC.Cookies.list !== _U ) {
                var gn = $O_K ( hg );
                var gC = $O_K ( hg[gn] );
                var uC = _GL.g.cUc ( c );
                this.setUserConsentForCookieGroup ( gn, gC, uC );
                if ( hg[_M.S] !== _U ) {
                return { "shopifyTracking" : uC }
                }
                }
                return !0
                }
                return !1
                },
                setUserConsentForCookieGroup : function ( groupName, groupCookies, userConsent ) {
                groupCookies.forEach ( function ( gCookie ) {
                if ( GDPR_LC.Cookies.list[gCookie] !== _U ) {
                var cookieNode = _GL.g.gN ( gCookie );
                if ( cookieNode !== !1 ) {
                cookieNode.checked = userConsent
                }
                }
                _GL.g.cG[groupName][gCookie].selected = userConsent
                } )
                },
                gN : function ( cn ) {
                var n = $Q ( _d, '#banner-wrapper .banner-body__content [id="input_' + cn + '"]' );
                if ( n === _ ) {
                GDPR_LC.console.error ( 'GDPR_LC.groups => getCookieNode > node _', '#input_' + cn );
                return !1
                }
                return n
                },
                cUc : function ( c ) {
                var cn = _GL.g.gN ( c );
                var r = !1;
                if ( cn !== !1 ) {
                r = cn.checked
                }
                return r
                },
                cHG : function ( cn ) {
                var gK = $O_K ( _GL.g.cG );
                var hG = !1;
                for ( var x = 0; x < gK.length; x++ ) { if ( cn in _GL.g.cG[gK[x]] ) { hG={}; hG[gK[x]]=_GL.g.cG[gK[x]] } } if ( !hG ) { if ( cn.indexOf ( '_dc_gtm_' ) !==-1 || cn.indexOf ( '_gat_gtag_' ) !==-1 || cn.indexOf ( '_gac_' ) !==-1 ) { hG=gK.googleGTM } } return hG }, cG : { shopify : { '_s' : { group : _M.S, selected : !1 }, '_shopify_fs' : { group : _M.S, selected : !1 }, '_shopify_s' : { group : _M.S, selected : !1 }, '_shopify_y' : { group : _M.S, selected : !1 }, '_y' : { group : _M.S, selected : !1 }, '_shopify_sa_p' : { group : _M.S, selected : !1 }, '_shopify_sa_t' : { group : _M.S, selected : !1 }, '_shopify_uniq' : { group : _M.S, selected : !1 }, '_shopify_visit' : { group : _M.S, selected : !1 }, 'tracked_start_checkout' : { group : _M.S, selected : !1 }, 'bc_trekkie_fbp_custom' : { group : _M.S, selected : !1 } }, facebook : { '_fbp' : { group : "facebook" , selected : !1 }, 'bc_tgm_fbp' : { group : "facebook" , selected : !1 }, }, googleGTM : { "bc_tgm_aw" : { group : "googleGTM" , selected : !1 }, "_gid" : { group : "googleGTM" , selected : !1 }, "_gat" : { group : "googleGTM" , selected : !1 }, "_dc_gtm_XXXXXXXXX" : { group : "googleGTM" , selected : !1 }, "_gat_gtag_XXXXXXXXX" : { group : "googleGTM" , selected : !1 }, "_gac_XXXXXXXXX" : { group : "googleGTM" , selected : !1 }, }, googleUA : { "bc_tgm_ua" : { group : "googleUA" , selected : !1 }, "_ga" : { group : "googleUA" , selected : !1 }, } } }; _GL.g.defineDynamicGroup (); _GL.SCT={ tCI : !1, gUT : function () { if ( _GL.SCT.tCI !==!1 ) { return { "userCanBeTracked" : _GL.SCT.uCT (), "userTrackingConsent" : _GL.SCT.gTC (), } } else { return !1 } }, sTC : function ( us ) { try { if ( typeof us==="boolean" ) { if ( window.Shopify !==_U && Shopify.trackingConsent.getRegulation () !=='' ) { if ( us && !Shopify.trackingConsent.userCanBeTracked () ) { _w[_M.S].trackingConsent.setTrackingConsent ( us, function () { } ); Shopify.trackingConsent.setCCPAConsent ( us, function () { } ); Shopify.trackingConsent.userDataCanBeSold (); document.addEventListener ( "trackingConsentAccepted" , function () { } ) } else if ( !us && Shopify.trackingConsent.userCanBeTracked () ) { _w[_M.S].trackingConsent.setTrackingConsent ( us, function () { } ); Shopify.trackingConsent.setCCPAConsent ( us, function () { } ); Shopify.trackingConsent.userDataCanBeSold () } } } } catch ( e ) { GDPR_LC.console.error ( 'GDPR_LC.ShopifyConsentTracking => setTrackingConsent' , e ) } }, gTC : function () { try { if ( _GL.SCT.tCI ) { return _w[_M.S].trackingConsent.gTC () !=='no_interaction' } } catch ( e ) { GDPR_LC.console.error ( 'GDPR_LC.ShopifyConsentTracking => getTrackingConsent' , e ) } return !1 }, hasMinConsent : function () { var result=false; if ( minConsentActivated () ) { if ( GDPR_LC !==_U && GDPR_LC.userConsentSetting !==null && GDPR_LC.userConsentSetting.type_1 !==null && GDPR_LC.userConsentSetting.type_1.true !==null ) { result=GDPR_LC.userConsentSetting.type_1.true===1 } if ( GDPR_LC !==_U && GDPR_LC.userConsentSetting !==null && GDPR_LC.userConsentSetting.type_2 !==null && GDPR_LC.userConsentSetting.type_2.true !==null ) { result=GDPR_LC.userConsentSetting.type_2.true===1 || result===true } } return result }, uCT : function () { try { if ( _GL.SCT.tCI || _GL.SCT.hasMinConsent () ) { return _w[_M.S].trackingConsent.userCanBeTracked () } } catch ( e ) { GDPR_LC.console.error ( 'GDPR_LC.ShopifyConsentTracking => userCanBeTracked' , e ) } return !1 }, cTCI : function () { if ( _w[_M.S] !==_U ) { if ( _w[_M.S].trackingConsent !==_U ) { return !0 } } return !1 } }; _GL.ShopifyTrekkie=function () { var sTCI=_GL.SCT.gUT (); var GDPR_LC_tracking=cFT (); GDPR_LC.SCT.sTC ( GDPR_LC_tracking ); var r=!1; if ( sTCI===!0 && GDPR_LC_tracking ) { var sTC=(sTCI.userCanBeTracked && sTCI.userTrackingConsent); if ( sTC && GDPR_LC_tracking ) { r=!0 } } else if ( GDPR_LC_tracking ) { r=!0 } else { GDPR_LC.SCT.sTC ( !1 ) } if ( r ) { i () } function cFT () { if ( minConsentActivated () ) { return _GL.SCT.hasMinConsent () } var t=!1, us='userSetting' , LC=!1; var sc=$O_K ( GDPR_LC.g.cG[_M.s] ); if ( GDPR_LC.Cookies===_U ) { if ( 'GDPR_legal_cookie' in _LS ) { LC=$LS_G ( 'GDPR_legal_cookie' ) } } if ( GDPR_LC.Cookies !==_U && GDPR_LC.Cookies.list !==_U && GDPR_LC.Cookies.list !==null ) { LC=GDPR_LC.Cookies.list } if ( LC !==!1 && sc !==_U ) { var cg=$O_K ( LC ); sc.forEach ( function ( c ) { if ( !!LC[c] && LC[c][us] && LC[c] !==_U ) { t=!0 } } ) } if ( t===false && window.GDPR_LC.userConsentSetting !==null && window.GDPR_LC.userConsentSetting !==undefined ) { var consent=window.GDPR_LC.userConsentSetting; var result=false; if ( (consent.type_1 !==null && consent.type_1.false !==undefined && consent.type_1.false===0) || (consent.type_2 !==undefined && consent.type_2.false !==undefined && consent.type_2.false===0) ) { result=true } t=result } return t } function gTS () { var r=!1; $QA ( _d, 'script.analytics' ).filter ( function ( s ) { if ( s.innerHTML.indexOf ( 'trekkie' ) !==-1 ) { r=s } } ); if ( r===!1 ) { GDPR_LC.console.error ( 'GDPR_LC.ShopifyTrekkie => getTrekkieScript > not found Shopify trekkie script:' , "script.analytics" ) } return r } function i () { var st=gTS (); if ( st !==!1 && typeof ShopifyAnalytics.lib.integrations !=="object" ) { delete window.trekkie; GDPR_LC.console.log ( 'shopify trekkie re-init' ); var trekkie=new Function ( st.innerHTML.toString () ); trekkie () } } }; GDPR_LC.ShopifyTrekkie (); GDPR_googleFacebookPixelCustomSourceTagManagerTrackData=GDPR_googleFacebookPixelCustomSourceTagManagerTrackData || {}; if ( _w._GDPR_TREKKI===undefined ) { _w._GDPR_TREKKI={} } (function DEFINE_GDPR_TREKKI () { _w._GDPR_TREKKI.update=function () { var so={}; $O_K ( _w._GDPR_TREKKI ).forEach ( function ( k ) { var d={}; d[k]=_w._GDPR_TREKKI[k]; Object.assign ( so, d ) } ); $SS_S ( '_GDPR_TREKKI' , so ); _w._GDPR_TREKKI.resetFromSession () }; _w._GDPR_TREKKI.resetFromSession=function () { var pso={}; if ( '_GDPR_TREKKI' in sessionStorage ) { pso=$SS_G ( '_GDPR_TREKKI' ) } if ( !!pso ) { $O_K ( pso ).forEach ( function ( k ) { _w._GDPR_TREKKI[k]=pso[k] } ) } } }) (); _d.bc_timer=_w.performance.now (); _d.bc_timestamp=Date.now (); _d._GDPR_Setting={ "scriptPath" : "https://gdpr-legal-cookie.beeclever.app" }; _w[_M[3]]=_w[_M[3]]={ "global" : { "exprire_BC_COOKIE" : 30, "localStorage" : "GDPR_legal_cookie" , "delExpires" : new Date ( 1000 ).toUTCString (), "expires" : 86400000, "defaultSetting" : 0, "defaltInterval" : 100, "defaultIntervalMaxLength" : 1000, "defaultCountIterate" : 5, "defaultEndIterate" : 15, "defaultTimerCount" : 60, "currentIteration" : 0, "hasSetting" : !1, "domains" : ['www.' + location.host.replace ( 'www.' , '' ), '.www.' + location.host.replace ( 'www.' , '' )], "bannerIsSet" : !1, "timerIsSet" : !1, "customScriptSet" : !1, "googleSet" : !1, "facebookSet" : !1, "googleElements" : [], "flags" : {}, "checkCookieStackInit" : !1, "inProgress" : false, "bannerOpen" : false }, "Defaults" : { "providerDefaults" : { "0" : "Shop provider" , "1" : "Third-Party" }, "recommendationDefaults" : { "0" : "Essential" , "1" : "Statistik" , "2" : "Marketing" }, "duration" : "Session" }, "Cookie" : { "emptyDescription" : "" , "defaultOwner" : "Shopify" , "defaultRecommendation" : 0, "defaultDuration" : "Session" , "defaultRecommendationUnknowCookie" : 2, "translations" : { "default" : { 'type_0' : 'Essentiell' , 'type_1' : 'Analytics & Marketing' }, 'type_0' : 'Essentiell' , 'type_1' : 'Analytics' , 'type_2' : 'Marketing' } }, "const" : { "GDPR_legal_cookie_setList" : !1, "GDPR_legal_cookie" : { "list" : { "cookieList" : [] } }, "observedElements" : [], "GDPR_banner_wrapper" : _, "GDPR_cookie_banner_flag" : _, "GDPR_cookie_tabs" : _, "GDPR_cookie_event" : { "isSet" : !1 } }, "extensions" : { "bc_XMLRequests" : { "isLoaded" : !1, "path" : _d._GDPR_Setting.scriptPath + "/js/extensions/xmlRequest.js" }, "bc_GDPR_TREKKI" : { "isLoaded" : !1, "path" : _d._GDPR_Setting.scriptPath + "/js/extensions/GDPR_trekkie.js" }, "GDPR_googleFacebookPixelCustomSourceTagManager" : { "isLoaded" : !1, "path" : _d._GDPR_Setting.scriptPath + "/js/extensions/" + _M[8] + ".js" } }, "log" : { "level_1" : [] } }; _GL.docCookies={}; GDPR_LC.Cookies=GDPR_LC.Cookies || {}; GDPR_LC.Cookies.list=GDPR_LC.Cookies.list || {}; _GL.setCookiesFromDocument=_; _GL.setDocCookies=_; !function () { var se=_d.location.host.split ( '.' ); se[se.length - 2]=se[se.length - 2] + '.' + se.pop (); var sd=se.pop (); function pushToArray ( sd ) { _w[_M[3]].global.domains.push ( sd ) } pushToArray ( sd ); pushToArray ( '.' + sd ); while ( se.length> 0 ) {
                    sd = se.pop () + '.' + sd;
                    pushToArray ( sd );
                    pushToArray ( '.' + sd )
                    }
                    } ();
                    window._GDPR_TREKKI.resetFromSession ();
                    window.GDPR_HELPER = {
                    saveAndUpdateData : function () {
                    if ( _GDPR_VAL.global.bannerOpen === false && _GDPR_VAL.global.inProgress === false ) {
                    _GDPR_VAL.global.inProgress = !0;
                    $LS_S ( 'GDPR_legal_cookie', GDPR_LC.Cookies.list );
                    _GDPR_VAL.global.inProgress = !1
                    }
                    }, scriptExist : function ( s ) {
                    $QA ( _d, 'script' ).forEach ( function ( src ) {
                    if ( src.hasAttribute ( 'src' ) && src.getAttribute ( 'src' ) !== _ ) {
                    if ( src.getAttribute ( 'src' ).includes ( s ) ) {
                    return !0
                    }
                    }
                    } );
                    return !1
                    }, loadScript : function loadScript ( i, s, a ) {
                    a = setParam ( a, !0 );
                    s = s + i;
                    if ( _w.GDPR_HELPER.scriptExist ( s ) === !1 ) {
                    var sn = _d.createElement ( "script" );
                    sn.async = a;
                    sn.setAttribute ( 'whiteListed', !0 );
                    sn.src = s;
                    _d.head.appendChild ( sn )
                    }
                    }, loadExtensions : function loadExtensions () {
                    if ( bc_tagManagerData.facebook.load.params === undefined && bc_tagManagerData.google.load.params.length === 0 ) {
                    return
                    }
                    var r = !1;
                    var extensions = _w[_M[3]].extensions[_M[8]];
                    if ( !extensions.isLoaded && GDPR_LC.Cookies !== _U && GDPR_LC.Cookies.list !== _U ) {
                    var tks = $O_K ( _w[_M[4]] ) || [];
                    tks.forEach ( function ( key ) {
                    var c = GDPR_LC.Cookies.list[key];
                    if ( c !== _U && c.userSetting && c.name !== '_bc_c_set' ) {
                    r = !0
                    }
                    } );
                    if ( r && !_w.GDPR_HELPER.scriptExist ( extensions.path ) ) {
                    _w.GDPR_HELPER.loadScript ( extensions.path, '', !1 );
                    extensions.isLoaded = !0
                    }
                    var initTagManager = setInterval ( function () {
                    if ( typeof GDPR_googleFacebookPixelCustomSourceTagManager === "function" ) {
                    GDPR_googleFacebookPixelCustomSourceTagManager ( 'any' );
                    clearInterval ( initTagManager )
                    }
                    }, 200 )
                    }
                    }
                    };
                    (function () {
                    GDPR_LC.Cookies.settingExist = !1;
                    GDPR_LC.Cookies.getSettingExist = function () {
                    return GDPR_LC.Cookies.settingExist
                    };
                    GDPR_LC.Cookies.setSettingExist = function ( s ) {
                    GDPR_LC.Cookies.settingExist = s
                    };
                    GDPR_LC.Cookies.cookieTypes = [];
                    GDPR_LC.Cookies.setCookieTypes = function ( t ) {
                    var isSetType = !1;
                    for ( var x = 0; x < GDPR_LC.Cookies.cookieTypes.length; x++ ) { if ( GDPR_LC.Cookies.cookieTypes[x].toString ()===t.toString () ) { isSetType=!0 } } if ( !isSetType ) { GDPR_LC.Cookies.cookieTypes.push ( t ) } }; GDPR_LC.Cookies.includesType=function ( search ) { for ( var x=0; x < GDPR_LC.Cookies.cookieTypes.length; x++ ) { if ( GDPR_LC.Cookies.cookieTypes===search ) { return !0 } } return !1 }; GDPR_LC.Cookies.getCookieTypes=function ( search ) { if ( search in GDPR_LC.Cookies.cookieTypes ) { return GDPR_LC.Cookies.cookieTypes[search] } return !1 }; GDPR_LC.Cookies.get=function ( c ) { return GDPR_LC.Cookies.list[c] } }) (); _GL.setDocCookies=function () { _GL.docCookies={}; var cl=[], x=0; if ( _d.cookie ) { cl=_d.cookie.split ( ';' ); x=cl.length; for ( ; x> 0; ) {
                        --x;
                        var c = cl[x], i = c.indexOf ( '=' );
                        if ( i !== -1 ) {
                        var cn = c.substring ( 0, i ).replace ( /\s+/g, '' );
                        _GL.docCookies[cn] = c.substring ( i + 1 ).replace ( /\s+/g, '' )
                        }
                        }
                        }
                        };
                        _GL.setCookiesFromDocument = function () {
                        _GL.setDocCookies ();
                        for ( var dc in _GL.docCookies ) {
                        var cO = GDPR_LC.Cookies.list[dc], dCV = {}, v = 'value', u = 'update',
                        i = 'isDocumentCookie';
                        dCV[v] = _GL.docCookies[dc];
                        if ( cO === _U ) {
                        GDPR_LC.console.log ( 'new document Cookie', dc );
                        new Cookie ( dc, dCV, !0 )
                        } else if ( cO[v] !== dCV[v] ) {
                        if ( cO[u] !== _U ) {
                        cO[u] ( v, dCV[v] );
                        cO[u] ( i, !0 )
                        }
                        }
                        }
                        };
                        var shopifyPreviewModeAddToWhiteList = {
                        shopifyCookies : $O_K ( GDPR_LC.g.cG.shopify ),
                        customizerCookies : ['_design_overrides_token', 'identity-state', 'preview_theme', 'new_theme_editor_disabled', 'request_method', 'online_store_editor_user_locale'],
                        cookieList : [],
                        pushToWhitList : function () {
                        this.createCookieList ();
                        this.push ( this.cookieList, window.GDPR_whiteList )
                        },
                        resetDefault : function () {
                        if ( GDPR_LC.Cookies.list[this.customizerCookies[0]] !== _U ) {
                        this.customizerCookies.forEach ( function ( cookie ) {
                        delete GDPR_LC.Cookies.list[cookie]
                        } )
                        }
                        },
                        createCookieList : function () {
                        window.GDPR_whiteList = window.GDPR_whiteList || [];
                        this.push ( this.shopifyCookies, this.cookieList );
                        this.push ( this.customizerCookies, this.cookieList )
                        },
                        push : function ( addList, holdList ) {
                        addList.forEach ( function ( cookie ) {
                        holdList.push ( cookie )
                        } )
                        }
                        };
                        shopifyPreviewModeAddToWhiteList.createCookieList ();
                        if ( window.Shopify !== _U && Shopify.preview_host !== _U ) {
                        shopifyPreviewModeAddToWhiteList.pushToWhitList ()
                        }

                        function setFallbackSetting ( cookie ) {
                        if ( window.GDPR_LC.userConsentSetting !== null && window.GDPR_LC.userConsentSetting[cookie.type] !== undefined ) {
                        if ( window.GDPR_LC.userConsentSetting[cookie.type].true === 1 && window.GDPR_LC.userConsentSetting[cookie.type].false === 0 ) {
                        return !0
                        } else {
                        return !1
                        }
                        } else {
                        return cookie.userSetting
                        }
                        }

                        var Cookie = function Cookie ( n, data, isDocumentCookie ) {
                        let isInWhitelist = false;
                        window.GDPR_whiteList.forEach ( function ( whitelistCookie ) {
                        if ( whitelistCookie === n ) {
                        isInWhitelist = true
                        } else {
                        if ( whitelistCookie.includes ( '<<id>>' ) ) {
                            if ( n.startsWith ( whitelistCookie.split ( '<<id>>' )[0] ) ) {
                                isInWhitelist = true;
                                if ( !!ShopifyCookies[whitelistCookie] || !!BC_JSON_ObjectBypass[whitelistCookie] ) {
                                data = Object.assign ( data, ShopifyCookies[whitelistCookie] || BC_JSON_ObjectBypass[whitelistCookie] )
                                }
                                }
                                }
                                }
                                } );

                                this.name = n;
                                this.value = '';
                                if ( data.value !== _U && data.value !== _U ) {
                                this.value = data.value
                                }
                                this.description = data.description || '';
                                this.domain = data.domain || _d.location.hostname;
                                this.duration = data.duration || 'Session';
                                this.expires = data.expires || 0;
                                this.secure = '';
                                if ( data.secure !== undefined ) {
                                this.secure = data.secure
                                }
                                this.sameSite = data.sameSite || 'Lax';
                                this.lastChange = data.lastChange || Date.now ();
                                this.path = data.path || '/';
                                this.provider = data.provider || "Third-party";
                                this.recommendation = 2;
                                if ( data.recommendation !== undefined ) {
                                this.recommendation = parseInt ( data.recommendation )
                                }
                                this.countRecursions = 0;
                                this.set = 2;
                                if ( data.set !== _U ) {
                                this.set = +data.set
                                }
                                this.type = data.type || 'type_' + this.set;
                                if ( data.type !== undefined && data.type !== 'type_' + this.set ) {
                                this.type = 'type_' + this.set
                                }
                                this.isDocumentCookie = isDocumentCookie;
                                if ( !GDPR_LC.Cookies.includesType ( this.type ) ) {
                                GDPR_LC.Cookies.cookieTypes.push ( this.type )
                                }
                                if ( BC_JSON_ObjectBypass._bc_c_set !== _U && (BC_JSON_ObjectBypass._bc_c_set.optIn === '!1' || BC_JSON_ObjectBypass._bc_c_set.optIn === !1) ) {
                                this.userSetting = !0
                                } else {
                                if ( data.userSetting === !0 ) {
                                this.userSetting = !0
                                } else {
                                this.userSetting = +this.set === 0
                                }
                                }
                                if ( GDPR_LC.Cookies !== _U && !this.userSetting && GDPR_LC.Cookies.list !== _U && GDPR_LC.Cookies.list._bc_c_set !== _U ) {
                                var bcObJ = GDPR_LC.Cookies.list._bc_c_set;
                                if ( bcObJ.type_all !== _U ) {
                                this.userSetting = bcObJ.type_all
                                } else if ( bcObJ[this.type] !== _U ) {
                                this.userSetting = bcObJ[this.type]
                                }
                                }
                                if ( n === '_bc_c_set' ) {
                                var $this = this;
                                $O_K ( data ).forEach ( function ( k ) {
                                if ( $this[k] === _U && k !== 'ShopifyMinConsent' ) {
                                $this[k] = data[k]
                                } else if ( k === 'ShopifyMinConsent' ) {
                                $this[k] = window.BC_JSON_ObjectBypass._bc_c_set.ShopifyMinConsent || false
                                }
                                } )
                                }
                                this.isInTab = !1;
                                this.all = data.all || !1;
                                GDPR_LC.Cookies.setCookieTypes = this.set;
                                if ( GDPR_LC.localStorageDataExist === false ) {
                                this.userSetting = setFallbackSetting ( this )
                                }
                                GDPR_LC.Cookies.list[this.name.toString ()] = this;
                                this.remove ()
                                };
                                Cookie.prototype = {
                                setCountRecursions : function setCountRecursions () {
                                this.countRecursions++
                                }, resetRecursion : function resetRecursion () {
                                this.countRecursions = 0
                                }, update : function update ( key, value, userInteraction ) {
                                if ( userInteraction === _U ) {
                                userInteraction = !1
                                }
                                if ( value !== _U && this[key] !== _U && this[key].toString () !== value.toString () ) {
                                this[key] = value;
                                this.setUpdate ( this.userSetting, userInteraction );
                                window.GDPR_HELPER.saveAndUpdateData ()
                                }
                                this.remove ()
                                }, setUpdate : function setUpdate ( userSetting, userChange ) {
                                userChange = userChange || !1;
                                if ( userChange ) {
                                this.lastChange = Date.now ();
                                this.userSetting = userSetting
                                }
                                }, toString : function toString () {
                                var value = '=' + this.value + ';', path = 'path=' + this.path + ';', domain = '',
                                expires = '', secure = '', sameSite = '';
                                if ( this.domain !== _U && this.domain !== window.location.host ) {
                                domain = 'domain=' + this.domain.replace ( 'www.', '' ) + ';'
                                }
                                if ( this.expires > 0 ) {
                                expires = 'max-age=' + this.expires + ';'
                                }
                                if ( this.secure ) {
                                secure = 'Secure;'
                                }
                                if ( this.sameSite ) {
                                sameSite = 'SameSite=' + this.sameSite + ';'
                                }
                                return value + path + domain + expires + secure + sameSite
                                }, remove : function remove () {
                                if ( this.set === 0 || this.userSetting ) {
                                return
                                }
                                documentCookie.remove ( this.name );
                                _GL.CookieStack.push ( this.name )
                                }, recover : function recover () {
                                _GL.setCookiesFromDocument ();
                                if ( (this.name in _GL.docCookies) && this.name !== '_bc_c_set' ) {
                                this.setUpdate ( !0 )
                                } else {
                                if ( this.value !== '' || this.isDocumentCookie || this.name === '_bc_c_set' ) {
                                documentCookie.set ( this.name, this.toString () );
                                GDPR_LC.console.log ( 'Cookie => recover', this.name, this.toString () )
                                }
                                }
                                }, getExpires : function getExpires () {
                                var expires = 'Session';
                                if ( this.expires != _ && parseInt ( this.expires ) !== 0 ) {
                                var seconds = parseInt ( this.expires );
                                var days = Math.floor ( seconds / (3600 * 24) );
                                seconds -= days * 3600 * 24;
                                var hrs = Math.floor ( seconds / 3600 );
                                seconds -= hrs * 3600;
                                var mnts = Math.floor ( seconds / 60 );
                                seconds -= mnts * 60;
                                expires = '';
                                if ( days !== 0 ) {
                                expires = days + 'd'
                                } else if ( hrs > 0 ) {
                                expires = hrs + 'h'
                                } else if ( mnts > 0 ) {
                                expires = mnts + 'm'
                                } else if ( seconds > 0 ) {
                                expires = seconds + 's'
                                }
                                }
                                return expires
                                }, template : function template ( type ) {
                                var group = GDPR_LC.g.cHG ( this.name ), content = data_gdpr_legal_banner_content,
                                checked = '', toggleButton = '', groupTemplate = '', template = '', domain,
                                name = this.name;
                                if ( this.userSetting ) {
                                checked == 'checked=""'
                                }
                                if ( +this.set > 0 ) {
                                toggleButton = '<tr>' + '<th>' + content.buttons.accept_single + '</th>' + '<td class="selection">' + '<div class="toggle" style="background-color: unset">' + '<label for="input_' + this.name + '">' + '<input name="' + this.name + '" id="input_' + this.name + '" data-dynamicrows="dynamicrows_type_' + type + '" data-parent="input_all_cookies_type_' + type + '" type="checkbox" ' + checked + ' onchange="window.GDPR_LC_Banner.checkCheckboxChange( this )">' + '<span class="slider"></span>' + '</label>' + '</div>' + '</td>' + '</tr>'
                                }
                                if ( group !== !1 ) {
                                groupTemplate = '<tr>' + '<th>Group</th>' + '<td>' + $O_K ( group )[0] + '</td>' + '</tr>'
                                }
                                if ( this.name.indexOf ( '$%bc%$' ) !== -1 ) {
                                name = this.name.split ( '$%bc%$' )[0]
                                }
                                domain = content.tabs.domain !== undefined ? content.tabs.domain : 'Domain';
                                template = '<table>' + '<tbody>' + toggleButton + '<tr>' + '<th>' + content.tabs.name + '</th>' + '<td id="tabs_cookie_' + this.name + '">' + name.replaceAll ( '<', '&lt' ).replaceAll ( '>' , '&gt' ) + '</td>' + '</tr>' + '<tr>' + '<th>' + content.tabs.provider + '</th>' + '<td>' + this.provider + '</td>' + '</tr>' + '<tr>' + '<th>' + content.tabs.description + '</th>' + '<td>' + this.description + '</td>' + '</tr>' + '<tr>' + '<th>' + domain + '</th>' + '<td>' + this.domain + '</td>' + '</tr>' + '<tr>' + '<th>' + content.tabs.duration + '</th>' + '<td>' + this.getExpires () + '</td>' + '</tr>' + groupTemplate + '</tbody>' + '</table>' ; return template } }; _d.Cookie=_d.Cookie || Cookie; _GL.CookieStackFunction=function () { this.size=0; this.cookies={} }; _GL.CookieStackFunction.prototype={ "delete" : function _delete ( cn ) { var _CSF=_GL.CookieStack; delete _CSF.cookies[cn]; _CSF.setSize () }, includes : function includes ( cn ) { return cn.toString () in _GL.CookieStack.cookies }, size : function size () { return _GL.CookieStack.size }, setSize : function setSize () { _GL.CookieStack.size=Array.from ( Object.keys ( _GL.CookieStack.cookies ) ).length }, push : function push ( cn ) { if ( cn==='_bc_c_set' ) { return } var _CSF=_GL.CookieStack; if ( !(cn in _CSF.cookies) ) { _CSF.cookies[cn.replace ( /\s+/g, '' )]=!1; _CSF.setSize () } }, checkStack : function checkStack () { if ( !_w[_M[3]].global.checkCookieStackInit ) { _w[_M[3]].global.checkCookieStackInit=!0; _GL.setCookiesFromDocument (); var _CSF=_GL.CookieStack, _CL=GDPR_LC.Cookies.list; $O_K ( _CSF.cookies ).forEach ( function ( c ) { _CSF.updateCookieStack ( c ); if ( c in _CL ) { if ( _CL[c].userSetting ) { _CSF["delete"] ( c ) } else { _CL[c].remove () } } if ( !c in GDPR_LC.docCookies ) { _CSF["delete"] ( c ) } } ); _w[_M[3]].global.checkCookieStackInit=!1 } }, scriptAddOnload : function scriptAddOnload () { for ( var s in _GL.srcList ) { var n=$Q ( _d, '[src="' + s + '"]' ); if ( n !==_ ) { delete _GL.srcList[s]; _GL.CookieStack.checkStack ( 'init from script tag' ) } } }, updateCookieStack : function updateCookieStack ( cn ) { var _CSF=_GL.CookieStack, co=GDPR_LC.Cookies.list[cn.replace ( /\s+/g, '' )], i=_CSF.includes ( cn ); if ( !(cn in _GL.docCookies) ) { if ( i ) { _CSF["delete"] ( cn ) } if ( co !==_U && co.setUpdate !==_U ) { co.setUpdate ( !1 ) } } else { if ( !i ) { _CSF.push ( cn ) } if ( co.countRecursions < 3 ) { co.remove (); co.setCountRecursions () } } } }; _GL.CookieStack=new _GL.CookieStackFunction (); var clearData=function () { $LS_R ( _M[2] ); $LS_R ( _M[3] ); $LS_R ( _M[1] ); $LS_R ( _M[4] ); $LS_R ( _M[6] ); $LS_R ( _M[5] ); $LS_R ( _M[8] ); $LS_R ( 'GDPR_Trekkie' ); $LS_R ( _M[7] ); console.log ( 'Update GDPR_legal_cookie LocalStorage element' ); return !0 }; (function () { (function () { for ( var mc in BC_JSON_ObjectBypass ) { if ( !GDPR_LC.Cookies.list.hasOwnProperty ( mc ) ) { new Cookie ( mc, BC_JSON_ObjectBypass[mc], !1 ) } } }) (); (function () { if ( _w.thirdPartyScriptDefinition !==_U ) { var currentDomain=document.location.host; for ( var x=_w.thirdPartyScriptDefinition.length - 1; x> 0; x-- ) {
                                                    var tCookie = _w.thirdPartyScriptDefinition[x];
                                                    var name = tCookie.cookie;
                                                    var provider = tCookie.provider || '';
                                                    var description = tCookie.description || '';
                                                    var domain = tCookie.domain;
                                                    var expires = tCookie.expires || 0;
                                                    var duration = tCookie.expires || 0;
                                                    var declaration = tCookie.declaration;
                                                    if ( currentDomain !== domain ) {
                                                    name = name + '$%bc%$' + domain
                                                    }
                                                    GDPR_LC.console.log ( 'name', name, 'domain', domain, 'cookieName', name );
                                                    if ( !GDPR_LC.Cookies.list.hasOwnProperty ( name ) ) {
                                                    var cookieObject = {};
                                                    cookieObject.provider = provider;
                                                    cookieObject.description = description;
                                                    cookieObject.domain = domain;
                                                    cookieObject.expires = expires;
                                                    cookieObject.duration = duration;
                                                    cookieObject.set = declaration;
                                                    new Cookie ( name, cookieObject, !1 )
                                                    } else {
                                                    continue
                                                    }
                                                    }
                                                    _GL.thirdPartyScriptsIsSet = true
                                                    }
                                                    }) ();
                                                    (function () {
                                                    if ( 'GDPR_legal_cookie' in localStorage ) {
                                                    var cookies = JSON.parse ( localStorage.getItem ( 'GDPR_legal_cookie' ) );
                                                    Array.from ( Object.keys ( cookies ) ).forEach ( function ( cookie ) {
                                                    var cookieName = cookie.toString ();
                                                    new Cookie ( cookieName, cookies[cookieName], false )
                                                    } )
                                                    }
                                                    }) ();
                                                    if ( window.Shopify !== _U && Shopify.preview_host === undefined ) {
                                                    shopifyPreviewModeAddToWhiteList.resetDefault ()
                                                    }
                                                    GDPR_LC.setCookiesFromDocument ()
                                                    }) ();
                                                    var ch = function ch () {
                                                    this.shopifyTrekkieIsInit = !1;
                                                    this.defaultTime = 30;
                                                    this.maxTime = 2000;
                                                    this.timerIsSet = !1;
                                                    this.iterateTimer = _;
                                                    this.runs = 0;
                                                    this.maxRuns = 3
                                                    };
                                                    ch.prototype = {
                                                    start : function start () {
                                                    if ( _d.CookieHandler.timerIsSet === !1 ) {
                                                    _d.CookieHandler.TimeOutManager ()
                                                    }
                                                    }, reset : function reset () {
                                                    _d.bc_timer = _w.performance.now ();
                                                    _d.CookieHandler.runs = 0;
                                                    _d.CookieHandler.defaultTime = 100;
                                                    if ( _d.CookieHandler.timerIsSet === !1 ) {
                                                    _d.CookieHandler.start ()
                                                    }
                                                    }, Timer : function Timer () {
                                                    if ( !_d.CookieHandler.timerIsSet ) {
                                                    _d.CookieHandler.timerIsSet = !0;
                                                    var defaultTime = _d.CookieHandler.defaultTime;
                                                    var iterateTimer = setInterval ( function () {
                                                    _GL.CookieStack.checkStack ();
                                                    _d.CookieHandler.currentIteration++;
                                                    if ( _d.CookieHandler.runs < _d.CookieHandler.maxRuns ) { if ( GDPR_LC.CookieStack.size> 0 ) {
                                                        if ( _d.CookieHandler.runs > 0 ) {
                                                        _d.CookieHandler.runs--
                                                        } else {
                                                        _d.CookieHandler.runs = 0
                                                        }
                                                        } else {
                                                        _d.CookieHandler.runs = _d.CookieHandler.maxRuns
                                                        }
                                                        clearInterval ( iterateTimer );
                                                        defaultTime += defaultTime / 2;
                                                        _d.CookieHandler.TimeOutManager ()
                                                        } else {
                                                        window.GDPR_HELPER.saveAndUpdateData ();
                                                        clearInterval ( iterateTimer )
                                                        }
                                                        }, defaultTime )
                                                        }
                                                        }, TimeOutManager : function TimeOutManager () {
                                                        if ( !_d.CookieHandler.timerIsSet ) {
                                                        if ( _d.CookieHandler.defaultTime > _d.CookieHandler.maxTime ) {
                                                        return
                                                        }
                                                        _d.CookieHandler.timerIsSet = !1;
                                                        _d.CookieHandler.Timer ()
                                                        }
                                                        }
                                                        };
                                                        _d.CookieHandler = new ch ();
                                                        _d.CookieHandler.start ();
                                                        _GL.banner = function () {
                                                        this.banner = $Q ( _d, 'div#banner-wrapper' );
                                                        this.node_banner_flag = $Q ( _d, 'div#cookie-banner_flag' );
                                                        this.node_banner_tagWithLink = $QA ( _d, 'a' ).filter ( function ( e ) {
                                                        if ( e.getAttribute ( 'href' ) !== null && e.getAttribute ( 'href' ).toUpperCase ().match ( /\/\?ID=GDPR_769769DD5C4DA8EFB4D18BF16CA2C677/i ) ) {
                                                        return e
                                                        }
                                                        } );
                                                        this.node_tab = $Q ( this.banner, '.banner-body__content .tabs' );
                                                        this.node_essential = $Q ( this.banner, '.cookie_tab__wrapper.essential' );
                                                        this.node_marketing = $Q ( this.banner, '.cookie_tab__wrapper.marketing' );
                                                        this.node_toggleButtonSelectAll = $Q ( this.banner, '#input_all_cookies' );
                                                        this.button_all = $Q ( this.banner, '#all_accept' );
                                                        this.button_essenc = $Q ( this.banner, '#essential_accept' );
                                                        this.button_checkAll = $Q ( this.banner, '[for="input_all_cookies"]' );
                                                        this.node_saveButton = $Q ( this.banner, '.btn-manage__save' );
                                                        this.node_individualSettings = $Q ( this.banner, '.btn-manage' );
                                                        this.countEssentialCookies = 0;
                                                        this.countMarketingCookies = 0;
                                                        this.countSelectedCookie = 0;
                                                        this.hasSelected = !1;
                                                        this.optIn = BC_JSON_ObjectBypass._bc_c_set.optIn;
                                                        this.tabTypes = {};
                                                        this.selectedCookies = [];
                                                        this.shopifyTracking = !1;
                                                        this.userSettingType = 0;
                                                        this.selectedCookiesIncludes = function ( cn ) {
                                                        this.selectedCookies.forEach ( function ( c ) {
                                                        if ( c === cn ) {
                                                        return !0
                                                        }
                                                        } );
                                                        return !1
                                                        };
                                                        setTimeout ( function () {
                                                        window.GDPR_LC_Banner.init ()
                                                        }, 200 )
                                                        };
                                                        _GL.banner.prototype = {
                                                        init : function () {
                                                        if ( window.Shopify !== _U && Shopify.preview_host === undefined ) {
                                                        shopifyPreviewModeAddToWhiteList.resetDefault ()
                                                        }
                                                        this.hiddenAllElements ();
                                                        this.setTagWithLinkAttributes ();
                                                        if ( !_w[_M[3]]["const"].GDPR_cookie_event.isSet ) {
                                                        this.banner.style.top = 0;
                                                        this.banner.style.left = 0;
                                                        this.eventForIndividualSetting ();
                                                        this.eventForSave ();
                                                        this.eventForEssentialSetting ();
                                                        this.eventForAcceptAllSetting ();
                                                        this.addEvents ();
                                                        _w[_M[3]]["const"].GDPR_cookie_event.isSet = !0;
                                                        this.generateBannerContent ();
                                                        this.replaceBeecleverLink ();
                                                        _GL.CookieStack.checkStack ()
                                                        }
                                                        }, replaceBeecleverLink : function () {
                                                        var node = document.querySelector ( '[href="https://gdpr-legal-cookie.myshopify.com/"]' );
                                                        if ( node !== null && node.innerText.indexOf ( 'beeclever' ) !== -1 ) {
                                                        node.parentElement.innerHTML = '<a href="https://gdpr-legal-cookie.myshopify.com/" rel="nofollow" style="color: #7d7d7d;">GDPR legal Cookie</a>'
                                                        }
                                                        }, shopifyMinConsentHiddenElements : function () {
                                                        if ( BC_JSON_ObjectBypass['_bc_c_set']['ShopifyMinConsent'] ) {
                                                        var toggleNodes = document.querySelectorAll ( '#banner-wrapper .toggle' );
                                                        var firstTableRowsStatistics = document.querySelectorAll ( "#banner-wrapper #dynamicrows_type_1 tr:nth-child(1)" );
                                                        var firstTableRowsMarketing = document.querySelectorAll ( "#banner-wrapper #dynamicrows_type_2 tr:nth-child(1)" );

                                                        function hiddenElements ( elements ) {
                                                        Array.from ( elements ).forEach ( function ( element ) {
                                                        element.style.display = 'none'
                                                        } )
                                                        }

                                                        hiddenElements ( toggleNodes );
                                                        hiddenElements ( firstTableRowsStatistics );
                                                        hiddenElements ( firstTableRowsMarketing )
                                                        }
                                                        }, generateBannerContent : function () {
                                                        this.setTabTypes ();
                                                        if ( data_gdpr_legal_banner_content !== undefined ) {
                                                        this.generateDynamicTypeHeader ();
                                                        this.generateDynamicContent ();
                                                        setTimeout ( function () {
                                                        window.GDPR_LC_Banner.setCookieCounters ();
                                                        window.GDPR_LC_Banner.shopifyMinConsentHiddenElements ()
                                                        }, 50 )
                                                        }
                                                        this.setInputsFromUserSetting ();
                                                        this.checkHasSettings ()
                                                        }, resetBanner : function () {
                                                        $O_K ( GDPR_LC.Cookies.list ).forEach ( function ( cookieName ) {
                                                        GDPR_LC.Cookies.list[cookieName].isInTab = false
                                                        } );
                                                        this.tabTypes = {};
                                                        this.generateBannerContent ();
                                                        this.helpers.setVisibility ( this.banner, !0 )
                                                        }, addEvents : function () {
                                                        this.node_banner_flag.addEventListener ( 'click', function () {
                                                        window.GDPR_LC_Banner.toggleBanner ( !0 )
                                                        } )
                                                        }, toggleBanner : function ( visibilityBanner ) {
                                                        if ( visibilityBanner ) {
                                                        setTimeout ( function () {
                                                        (function () {
                                                        window.GDPR_LC_Banner.checkHasNewCookiesForBanner ()
                                                        }) ()
                                                        }, 10 )
                                                        }
                                                        this.helpers.setVisibility ( this.banner, visibilityBanner );
                                                        if ( this.node_banner_tagWithLink.length === 0 ) {
                                                        this.helpers.setVisibility ( this.node_banner_flag, !visibilityBanner )
                                                        }
                                                        }, checkHasSettings : function () {
                                                        if ( window.GDPR_LC_checkHasSettings === undefined ) {
                                                        var lastChange = 0;
                                                        var lastGDPR_LC_Version = window.GDPR_LC.userConsentSetting !== null && window.GDPR_LC.userConsentSetting.version !== undefined ? window.GDPR_LC.userConsentSetting.version : $LS_G ( 'GDPR_LC_Version' );
                                                        var currentDate = Date.now ();
                                                        var maxAge = 2592000000;
                                                        var showBanner = false;

                                                        function setLastChange () {
                                                        lastChange = window.GDPR_LC.userConsentSetting !== null && window.GDPR_LC.userConsentSetting.date !== undefined ? window.GDPR_LC.userConsentSetting.date : 0
                                                        };setLastChange ();
                                                        if ( lastGDPR_LC_Version !== null && GDPR_LC_versionNr > +lastGDPR_LC_Version ) {
                                                        if ( window.GDPR_LC.userConsentSetting !== null ) {
                                                        clearData ();
                                                        showBanner = true
                                                        } else {
                                                        set_bc_c_set_cookie ( true );
                                                        setUserConsentFromCookie ();
                                                        setLastChange ()
                                                        }
                                                        }
                                                        if ( window.GDPR_LC.userConsentSetting === null ) {
                                                        showBanner = true
                                                        }
                                                        if ( (currentDate - lastChange) > maxAge ) {
                                                        showBanner = true
                                                        }
                                                        var bannerFooterLinks = $QA ( this.banner, '.banner-footer a' );
                                                        bannerFooterLinks.forEach ( function ( link ) {
                                                        if ( link.hasAttribute ( 'href' ) ) {
                                                        if ( link.getAttribute ( 'href' ) === document.location.pathname ) {
                                                        showBanner = false
                                                        }
                                                        }
                                                        } );
                                                        this.toggleBanner ( showBanner );
                                                        window.GDPR_LC_checkHasSettings = true
                                                        }
                                                        }, setInputsFromUserSetting : function () {
                                                        var inputNodes = this.helpers.getInputNodes ();
                                                        var allEnabled = !1;
                                                        if ( GDPR_LC.Cookies.list._bc_c_set.type_all !== _U ) {
                                                        allEnabled = GDPR_LC.Cookies.list._bc_c_set.type_all
                                                        }
                                                        inputNodes.forEach ( function ( input ) {
                                                        if ( input.getAttribute ( 'onclick' ) === _ ) {
                                                        var cookieName = input.getAttribute ( 'name' ),
                                                        cookieObject = GDPR_LC.Cookies.list[cookieName], typeEnabled = !1,
                                                        selected = !1;
                                                        if ( cookieName !== _ && cookieObject !== undefined ) {
                                                        if ( GDPR_LC.Cookies.list._bc_c_set[cookieObject.type] !== _U ) {
                                                        typeEnabled = GDPR_LC.Cookies.list._bc_c_set[cookieObject.type]
                                                        }
                                                        if ( allEnabled || typeEnabled || cookieObject.userSetting ) {
                                                        selected = !0
                                                        }
                                                        input.checked = selected
                                                        }
                                                        }
                                                        } )
                                                        }, setTagWithLinkAttributes : function () {
                                                        if ( this.node_banner_tagWithLink.length > 0 ) {
                                                        var $this = this;
                                                        this.node_banner_tagWithLink.forEach ( function ( node ) {
                                                        node.setAttribute ( 'data-bc_gdpr-linkTag', '/?id=GDPR_769769dd5c4da8efb4d18bf16ca2c677' );
                                                        node.setAttribute ( 'href', '#banner-wrapper' );
                                                        node.classList.add ( 'no-transition', 'js-no-transition' )
                                                        } );
                                                        Array.from ( document.querySelectorAll ( '[data-bc_gdpr-linkTag]' ) ).forEach ( function ( node ) {
                                                        let clone = node.cloneNode ( true );
                                                        node.parentElement.replaceChild ( clone, node );
                                                        clone.addEventListener ( 'click', function ( event ) {
                                                        event.preventDefault ();
                                                        window.GDPR_LC_Banner.toggleBanner ( !0 )
                                                        } )
                                                        } )
                                                        }
                                                        }, hiddenAllElements : function () {
                                                        this.helpers.setVisibility ( this.banner, !1 );
                                                        this.helpers.setVisibility ( this.node_banner_flag, !1 )
                                                        }, helpers : {
                                                        setVisibility : function setVisibility ( node, isVisible, display ) {
                                                        display = display || 'flex';
                                                        GDPR_LC_Banner.helpers.setBannerIsOpen ( node, isVisible );
                                                        if ( isVisible ) {
                                                        node.removeAttribute ( node.getAttribute ( 'hidden' ) );
                                                        node.removeAttribute ( 'hidden' );
                                                        $N_V ( node, !0, display )
                                                        } else {
                                                        $N_V ( node, !1, display )
                                                        }
                                                        }, setBannerIsOpen : function ( node, visibilityBanner ) {
                                                        if ( node == GDPR_LC_Banner.banner ) {
                                                        window._GDPR_VAL.global.bannerOpen = visibilityBanner;
                                                        if ( !visibilityBanner && !!GDPR_LC_Banner.fireCallback && !window._GDPR_VAL.global.bannerOpen ) {
                                                        GDPR_LC_Banner.fireCallback = false, document.dispatchEvent ( new CustomEvent ( 'bc_banner:banner_closed' ) )
                                                        } else if ( !visibilityBanner && !GDPR_LC_Banner.fireCallback ) {
                                                        GDPR_LC_Banner.fireCallback = true
                                                        }
                                                        }
                                                        }, getInputNodes : function getInputNodes () {
                                                        return $QA ( _d, '#banner-wrapper .banner-body__content > .tabs input' )
                                                        }
                                                        }, setTabTypes : function () {
                                                        var cookies = $O_K ( GDPR_LC.Cookies.list ), hasTypes = !1, tabTypes = this.tabTypes;
                                                        cookies.forEach ( function ( cookie ) {
                                                        var cookieData = GDPR_LC.Cookies.list[cookie];
                                                        if ( cookieData.type !== undefined ) {
                                                        var includesTabTypes = !1;
                                                        $O_K ( tabTypes ).forEach ( function ( tabType ) {
                                                        if ( tabType === cookieData.set ) {
                                                        includesTabTypes = !0
                                                        }
                                                        } );
                                                        if ( !includesTabTypes && tabTypes[cookieData.set] === undefined ) {
                                                        tabTypes[cookieData.set] = cookieData.type;
                                                        hasTypes = !0
                                                        }
                                                        }
                                                        } );
                                                        if ( hasTypes ) {
                                                        if ( data_gdpr_legal_banner_content !== undefined && data_gdpr_legal_banner_content.cookieType !== undefined ) {
                                                        if ( this.tabTypes[0] !== _ && this.tabTypes[0] !== undefined ) {
                                                        this.tabTypes[0] = data_gdpr_legal_banner_content.cookieType.type_0
                                                        } else {
                                                        this.tabTypes[0] = _
                                                        }
                                                        if ( this.tabTypes[1] !== _ && this.tabTypes[1] !== undefined ) {
                                                        this.tabTypes[1] = data_gdpr_legal_banner_content.cookieType.type_1
                                                        } else {
                                                        this.tabTypes[1] = _
                                                        }
                                                        if ( this.tabTypes[2] !== _ && this.tabTypes[2] !== undefined ) {
                                                        this.tabTypes[2] = data_gdpr_legal_banner_content.cookieType.type_2
                                                        } else {
                                                        this.tabTypes[2] = _
                                                        }
                                                        } else {
                                                        if ( this.tabTypes[0] !== _ && this.tabTypes[0] !== undefined ) {
                                                        this.tabTypes[0] = _w[_M[3]].Cookie.translations.type_0
                                                        } else {
                                                        this.tabTypes[0] = _
                                                        }
                                                        if ( this.tabTypes[1] !== _ && this.tabTypes[1] !== undefined ) {
                                                        this.tabTypes[1] = _w[_M[3]].Cookie.translations.type_1
                                                        } else {
                                                        this.tabTypes[1] = _
                                                        }
                                                        if ( this.tabTypes[2] !== _ && this.tabTypes[2] !== undefined ) {
                                                        this.tabTypes[2] = _w[_M[3]].Cookie.translations.type_2
                                                        } else {
                                                        this.tabTypes[2] = false
                                                        }
                                                        }
                                                        } else {
                                                        Object.assign ( this.tabTypes, JSON.parse ( '{ "0" : "' + _w[_M[3]].Cookie.translations.default.type_0 + '" }' ) );
                                                        Object.assign ( this.tabTypes, JSON.parse ( '{ "1" : "' + _w[_M[3]].Cookie.translations.default.type_1 + '" }' ) )
                                                        }
                                                        }, generateDynamicTypeHeader : function () {
                                                        var headerListCookieType = $Q ( this.banner, '.banner-main_header.list-type' );
                                                        headerListCookieType.innerHTML = '';
                                                        $O_K ( this.tabTypes ).forEach ( function ( type ) {
                                                        window.GDPR_LC_Banner.setDynamicTypeHeader ( type, headerListCookieType )
                                                        } )
                                                        }, setDynamicTypeHeader : function ( type, headerListCookieType ) {
                                                        if ( this.tabTypes[type] === _ ) {
                                                        return
                                                        }
                                                        var headerListCookieType_p_tag = _d.createElement ( 'p' );
                                                        headerListCookieType_p_tag.innerText = this.tabTypes[type].toString ();
                                                        headerListCookieType.appendChild ( headerListCookieType_p_tag )
                                                        }, generateDynamicContent : function () {
                                                        var tabs = $Q ( this.banner, '.banner-body__content .tabs' );
                                                        tabs.innerHTML = '';
                                                        $O_K ( this.tabTypes ).forEach ( function ( type ) {
                                                        window.GDPR_LC_Banner.setDynamicContent ( type, tabs )
                                                        } )
                                                        }, setDynamicContent : function ( type, tabs ) {
                                                        if ( this.tabTypes[type] === _ ) {
                                                        return
                                                        }
                                                        var countEssentialCookies = this.countEssentialCookies, checked = !1,
                                                        cookieNodes = _d.createElement ( 'div' ), hasCheckedElement = !1, typeIsSelected = !1;
                                                        $O_K ( GDPR_LC.Cookies.list ).forEach ( function ( cookie ) {
                                                        var cookieObject = GDPR_LC.Cookies.list[cookie];
                                                        if ( +cookieObject.set === +type && !cookieObject.isInTab ) {
                                                        var row = _d.createElement ( 'div' );
                                                        if ( cookieObject.userSetting ) {
                                                        hasCheckedElement = !0
                                                        }
                                                        if ( cookieObject.template === undefined ) {
                                                        return
                                                        }
                                                        row.innerHTML = '<table>' + '<tbody>' + cookieObject.template ( type ) + '</tbody>' + '</table>';
                                                        cookieNodes.appendChild ( row );
                                                        countEssentialCookies++;
                                                        cookieObject.isInTab = !0
                                                        }
                                                        if ( cookieObject.name === '_bc_c_set' ) {
                                                        if ( cookieObject.type_all !== _U ) {
                                                        if ( cookieObject.type_all || (cookieObject[type] !== _U && cookieObject[type]) ) {
                                                        typeIsSelected = !0
                                                        }
                                                        }
                                                        }
                                                        } );
                                                        if ( hasCheckedElement || typeIsSelected ) {
                                                        checked = 'checked=""'
                                                        } else {
                                                        checked = ''
                                                        }
                                                        var tabNodes = _d.createElement ( 'div' ), text = '';
                                                        if ( +type === 0 ) {
                                                        if ( data_gdpr_legal_banner_content.essential !== _U ) {
                                                        text = data_gdpr_legal_banner_content.essential
                                                        } else {
                                                        text = 'Essential'
                                                        }
                                                        } else if ( +type === 1 ) {
                                                        if ( data_gdpr_legal_banner_content.statistic !== _U ) {
                                                        text = data_gdpr_legal_banner_content.statistic
                                                        } else if ( data_gdpr_legal_banner_content.statistics !== _U ) {
                                                        text = data_gdpr_legal_banner_content.statistics
                                                        } else {
                                                        text = 'Statistics'
                                                        }
                                                        } else if ( +type === 2 ) {
                                                        if ( data_gdpr_legal_banner_content.marketing !== _U ) {
                                                        text = data_gdpr_legal_banner_content.marketing
                                                        } else {
                                                        text = 'Marketing'
                                                        }
                                                        }
                                                        tabNodes.setAttribute ( 'class', 'cookie_tab__wrapper_header' );
                                                        tabNodes.innerHTML = '<p id="count_' + type + '">' + '<strong>' + window.GDPR_LC_Banner.tabTypes[type] + '</strong>' + '</p>' + '<p>' + text + '</p>';
                                                        if ( type > 0 ) {
                                                        tabNodes.innerHTML += '<div class="toggle" style="margin-bottom: 1em;height: 2.2em;">' + '<style>
                                                                #banner-wrapper .toggle .slider::before {
                                                                    transition: left 0.3s ease-in-out;
                                                                }
                                                            </style>' + '<label for="input_all_cookies_type_' + type + '">' + '<input name="all_cookies" id="input_all_cookies_type_' + type + '"' + checked + ' data-row="dynamicrows_type_' + type + '" onchange="window.GDPR_LC_Banner.checkCheckboxChange( this )" type="checkbox">' + '<span class="slider" style="transition: unset"></span>' + '</label>' + '</div>'
                                                        }
                                                        tabNodes.innerHTML += '<details>' + '<summary id="summary_' + type + '" style="cursor: pointer;">' + data_gdpr_legal_banner_content.details + '<strong class="counter"></strong>' + '</summary>' + '<div id="dynamicrows_type_' + type + '" class="cookie_tab__wrapper marketing display">' + cookieNodes.innerHTML + '</div>' + '</details>';
                                                        tabs.appendChild ( tabNodes )
                                                        }, checkHasNewCookiesForBanner : function () {
                                                        var hasElements = !1;
                                                        $O_K ( GDPR_LC.Cookies.list ).forEach ( function ( cookie ) {
                                                        if ( !GDPR_LC.Cookies.list[cookie].isInTab ) {
                                                        hasElements = !0
                                                        }
                                                        } );
                                                        if ( hasElements ) {
                                                        window.GDPR_LC_Banner.resetBanner ()
                                                        }
                                                        }, setCookieCounters : function () {
                                                        for ( var type in this.tabTypes ) {
                                                        var typeNodes = [];
                                                        var typeNodesSelected = 0;
                                                        if ( +type === 0 ) {
                                                        typeNodes = $QA ( _d, '#banner-wrapper #dynamicrows_type_' + type + ' div' );
                                                        $Q ( _d, '#banner-wrapper #summary_' + type + ' .counter' ).innerText = ' ' + '(' + ' ' + typeNodes.length + ' ' + ')'
                                                        } else {
                                                        typeNodes = $QA ( _d, '#banner-wrapper #dynamicrows_type_' + type + ' input' );
                                                        typeNodes.filter ( function ( node ) {
                                                        if ( node.checked ) {
                                                        typeNodesSelected++
                                                        }
                                                        } );
                                                        var node = $Q ( _d, '#banner-wrapper #summary_' + type + ' .counter' );
                                                        if ( node !== _ ) {
                                                        node.innerText = ' ' + '(' + ' ' + typeNodesSelected + ' ' + data_gdpr_legal_banner_content.buttons.how_many_are_accepted + ' ' + typeNodes.length + ' ' + ')'
                                                        } else {
                                                        GDPR_LC.console.log ( 'setCookieCounter undefined node', type )
                                                        }
                                                        }
                                                        }
                                                        }, checkCheckboxChange : function ( target ) {
                                                        if ( target.hasAttribute ( 'data-dynamicrows' ) ) {
                                                        this.shopifyTracking = GDPR_LC.g.c ( target.getAttribute ( 'name' ) );
                                                        var parentElement = $Q ( _d, '#' + target.getAttribute ( 'data-dynamicrows' ) ),
                                                        hasSelectedElements = $QA ( parentElement, ' input' ).filter ( function ( input ) {
                                                        if ( input.hasAttribute ( 'data-row' ) ) {
                                                        return
                                                        }
                                                        return window.GDPR_LC_Banner.prepareRecoverCookies ( input )
                                                        } );
                                                        $Q ( _d, '#' + target.getAttribute ( 'data-parent' ) ).checked = hasSelectedElements.length > 0;
                                                        GDPR_LC.console.log ( 'Banner => checkCheckboxChange', hasSelectedElements.length )
                                                        } else {
                                                        if ( target.hasAttribute ( 'data-row' ) ) {
                                                        var inputs = $QA ( _d, '#' + target.getAttribute ( 'data-row' ) + ' input' );
                                                        var targetIsChecked = target.checked;
                                                        var inputsLength = inputs.length;
                                                        for ( var x = 0; x < inputsLength; x++ ) { var input=inputs[x]; input.checked=targetIsChecked; window.GDPR_LC_Banner.prepareRecoverCookies ( input ) } GDPR_LC.Cookies.list._bc_c_set.update ( target.getAttribute ( 'data-row' ).replace ( 'dynamicrows_' , '' ), target.checked ) } } this.setCookieCounters () }, prepareRecoverCookies : function ( input ) { var name=input.getAttribute ( 'name' ); if ( !input.checked ) { if ( this.selectedCookiesIncludes ( name ) ) { this.selectedCookies.splice ( this.selectedCookies.indexOf ( name ), 1 ) } } else { if ( !this.selectedCookiesIncludes ( name ) ) { this.selectedCookies.push ( name ) } return input } }, resetBannerElementsAndHiddenBanner : function () { var banner=window.GDPR_LC_Banner; banner.helpers.setVisibility ( banner.node_tab, !1 ); banner.helpers.setVisibility ( banner.node_individualSettings, !0, 'block' ); banner.helpers.setVisibility ( banner.node_saveButton, !1 ); banner.helpers.setVisibility ( banner.banner, !1 ); $QA ( banner.banner, 'details' ).forEach ( function ( detail ) { detail.open=!1 } ); if ( this.node_banner_tagWithLink.length===0 ) { banner.helpers.setVisibility ( this.node_banner_flag, !0 ) } }, eventForIndividualSetting : function () { this.node_individualSettings.addEventListener ( 'click' , function () { window.GDPR_LC_Banner.userSettingType=3; var banner=window.GDPR_LC_Banner; if ( banner.node_tab.style.display==='' || banner.node_tab.style.display==='none' ) { banner.helpers.setVisibility ( banner.node_tab, !0 ); banner.helpers.setVisibility ( banner.node_individualSettings, !1 ); banner.helpers.setVisibility ( banner.node_saveButton, !0, 'block' ) } } ) }, sendConsent : function () { return; var consent=0; var custom=false; if ( window.GDPR_LC !==undefined && window.GDPR_LC.userConsentSetting !==undefined ) { var cSetting=window.GDPR_LC.userConsentSetting; if ( cSetting.type_2 !==undefined && cSetting.type_2.true===1 && cSetting.type_2.false===1 || cSetting.type_1.true===1 && cSetting.type_1.false===1 || cSetting.type_2 !==undefined && cSetting.type_2.true===1 && cSetting.type_1.false===1 ) { custom=true } else if ( cSetting.type_2 !==undefined && cSetting.type_2.true===1 && cSetting.type_1.true===1 ) { consent=2 } else if ( (cSetting.type_1.true===1 && cSetting.type_2 !==undefined) || cSetting.type_2 !==undefined && cSetting.type_1.true===1 && cSetting.type_2.false===1 ) { consent=1 } consent=custom ? 'c' : consent; if ( navigator.sendBeacon ) { navigator.sendBeacon ( 'https://gdpr-legal-cookie.beeclever.app/api/user-consent?shop=' + Shopify.shop + '&type=' + consent ) } else { fetch ( 'https://gdpr-legal-cookie.beeclever.app/api/user-consent?shop=' + Shopify.shop + '&type=' + consent, { method : 'GET' , mode : 'no-cors' } ) } } }, resetBannerAndSaveUserSetting : function () { window.GDPR_LC_Banner.resetBannerElementsAndHiddenBanner (); window.GDPR_LC_Banner.saveUserSettings () }, setInputs : function ( setting ) { var inputNodes=$QA ( _d, '#banner-wrapper input' ); inputNodes.forEach ( function ( node ) { node.checked=setting } ); setTimeout ( function () { window.GDPR_LC_Banner.userSettingType=setting ? 2 : 0; window.GDPR_LC_Banner.setAllCookieTypes ( setting ) } ) }, eventForEssentialSetting : function () { this.button_essenc.addEventListener ( 'click' , function () { window.GDPR_LC_Banner.setInputs ( false ) } ) }, eventForAcceptAllSetting : function () { this.button_all.addEventListener ( 'click' , function () { window.GDPR_LC_Banner.setInputs ( true ) } ) }, setAllCookieTypes : function ( selected, type=null ) { GDPR_LC.Cookies.list._bc_c_set.type_all=type !==null ? type : selected; var inputNodes=$QA ( _d, '#banner-wrapper input' ); inputNodes.forEach ( function ( node ) { var cookie=null; if ( node.name in GDPR_LC.Cookies.list ) { cookie=GDPR_LC.Cookies.list[node.name]; cookie.userSetting=typeof selected !=="boolean" ? node.checked : selected } } ); window.GDPR_LC_Banner.resetBannerAndSaveUserSetting ( selected ) }, eventForSave : function () { this.node_saveButton.addEventListener ( 'click' , function () { window.GDPR_LC_Banner.userSettingType=3; window.GDPR_LC_Banner.setAllCookieTypes ( 'custom' , false ) } ) }, reInitScripts : function () { function createScriptNode ( src ) { if ( window.GDPR_LC_Beta_activate !==_U ) { if ( src.includes ( 'beeclever.app' ) ) { return } } var node=document.createElement ( 'script' ); node.setAttribute ( 'type' , 'text/javascript' ); node.async=true; node.src=src; document.querySelector ( 'head' ).appendChild ( node ) }; if ( window.scriptElementsHidden !==_U ) { var scriptElementsHiddenLength=window.scriptElementsHidden.length; for ( var x=scriptElementsHiddenLength - 1; x>= 0; x-- ) {
                                                            var script = window.scriptElementsHidden.splice ( 0, 1 )[0];
                                                            if ( Array.isArray ( script ) ) {
                                                            createScriptNode ( script.src )
                                                            } else if ( script.hasAttribute ( 'src' ) ) {
                                                            createScriptNode ( script.getAttribute ( 'src' ) )
                                                            }
                                                            }
                                                            }
                                                            }, saveUserSettings : function ( uSetting ) {
                                                            this.toggleBanner ( !1 );
                                                            var inputNodes = window.GDPR_LC_Banner.helpers.getInputNodes (),
                                                            docCookiesKeys = $O_K ( _GL.docCookies ), trekking = !1;

                                                            function setSettings ( cName, userSetting ) {
                                                            if ( GDPR_LC.Cookies.list[cName] !== _U ) {
                                                            userSetting = GDPR_LC.Cookies.list[cName].set === 0 ? true : userSetting;
                                                            GDPR_LC.Cookies.list[cName].update ( 'userSetting', userSetting, true );
                                                            GDPR_LC.Cookies.list[cName].update ( 'isInTab', !1 );
                                                            if ( userSetting === !1 ) {
                                                            _GL.CookieStack.push ( cName )
                                                            } else {
                                                            _GL.CookieStack.delete ( cName )
                                                            }
                                                            if ( !(GDPR_LC.Cookies.list[cName].name in docCookiesKeys) && GDPR_LC.Cookies.list[cName].userSetting ) {
                                                            GDPR_LC.Cookies.list[cName].recover ()
                                                            } else {
                                                            GDPR_LC.Cookies.list[cName].remove ()
                                                            }
                                                            if ( _w[_M[4]][cName] !== _U ) {
                                                            trekking = !0
                                                            }
                                                            }
                                                            }

                                                            if ( typeof uSetting === 'boolean' ) {
                                                            Array.from ( Object.keys ( GDPR_LC.Cookies.list ) ).forEach ( function ( cName ) {
                                                            setSettings ( cName, uSetting )
                                                            } )
                                                            } else {
                                                            inputNodes.forEach ( function ( input ) {
                                                            setSettings ( input.getAttribute ( 'name' ), input.checked )
                                                            } )
                                                            }
                                                            GDPR_LC.Cookies.list._bc_c_set.userSettingType = window.GDPR_LC_Banner.userSettingType;
                                                            GDPR_LC.Cookies.list._bc_c_set.lastChange = Date.now ();
                                                            GDPR_LC.Cookies.list._bc_c_set.userConsent = true;
                                                            $LS_S ( _M[7], GDPR_LC_versionNr.toString () );
                                                            $LS_S ( 'GDPR_legal_cookie', GDPR_LC.Cookies.list );
                                                            window.GDPR_LC.DEBUGGER = window.GDPR_LC.DEBUGGER || [];
                                                            window.GDPR_LC.DEBUGGER.push ( GDPR_LC.Cookies.list );
                                                            window.GDPR_HELPER.saveAndUpdateData ();
                                                            set_bc_c_set_cookie ();
                                                            setUserConsentFromCookie ();
                                                            window.GDPR_LC_Banner.sendConsent ();
                                                            _GL.CookieStack.checkStack ();
                                                            _d.CookieHandler.reset ();
                                                            GDPR_LC_Banner.reInitScripts ();
                                                            setTimeout ( function () {
                                                            GDPR_LC.ShopifyTrekkie ();
                                                            if ( typeof _w[_M[2]] === "function" ) {
                                                            ICS ()
                                                            }
                                                            GDPR_HELPER.loadExtensions ()
                                                            }, 200 )
                                                            }
                                                            };
                                                            _d.addEventListener ( 'click', _GL.setCookiesFromDocument );
                                                            _w.onload = function () {
                                                            _GL.CookieStack.checkStack ()
                                                            };
                                                            var BC_TabManager_fkdfs2ce3a13160348f524c8cc9 = function () {
                                                            if ( window.Shopify !== _U && typeof Shopify.Checkout === "undefined" ) {
                                                            $LS_S ( _M[2], _w[_M[2]] );
                                                            $LS_S ( _M[3], _w[_M[3]] );
                                                            $LS_S ( _M[1], _w[_M[1]] );
                                                            $LS_S ( _M[4], _w[_M[4]] );
                                                            $LS_S ( _M[5], _w[_M[5]] );
                                                            $LS_S ( _M[6], _w[_M[6]] );
                                                            if ( typeof _w[_M[8]] !== "undefined" ) {
                                                            $LS_S ( _M[8], _w[_M[8]].toString () )
                                                            }
                                                            if ( typeof GDPR_Trekkie !== "undefined" ) {
                                                            $LS_S ( 'GDPR_Trekkie', GDPR_Trekkie.toString () )
                                                            }
                                                            }
                                                            };
                                                            BC_TabManager_fkdfs2ce3a13160348f524c8cc9 ();
                                                            if ( window.Shopify !== _U && typeof Shopify.Checkout !== "undefined" ) {
                                                            if ( typeof Shopify.Checkout.step !== "undefined" ) {
                                                            if ( Shopify.Checkout.step === 'thank_you' ) {
                                                            _w[_M[4]] = $LS_G ( _M[4] );
                                                            tagManagerKeys = $O_K ( _w[_M[4]] );
                                                            _w[_M[5]] = $LS_G ( _M[5] );
                                                            _w[_M[1]] = $LS_G ( _M[1] )
                                                            }
                                                            }
                                                            }
                                                            ICS ();
                                                            if ( _GDPR_VAL.stackIntervalIsSet === _U ) {
                                                            setInterval ( function () {
                                                            _GL.CookieStack.checkStack ()
                                                            }, 500 );
                                                            _GDPR_VAL.stackIntervalIsSet = true
                                                            }
                                                            Array.from ( document.head.querySelectorAll ( '[bc_empty_script_tag=""]' ) ).forEach ( function ( script ) {
                                                            script.remove ()
                                                            } )
                                                            }
                                                            } ();
                                                            document.addEventListener ( 'DOMContentLoaded', function () {
                                                            function _createForOfIteratorHelper ( o, allowArrayLike ) {
                                                            var it;
                                                            if ( typeof Symbol === "undefined" || o[Symbol.iterator] == null ) {
                                                            if ( Array.isArray ( o ) || (it = _unsupportedIterableToArray ( o )) || allowArrayLike && o && typeof o.length === "number" ) {
                                                            if ( it ) o = it;
                                                            var i = 0;
                                                            var F = function F () {
                                                            };
                                                            return {
                                                            s : F, n : function n () {
                                                            if ( i >= o.length ) return { done : true };
                                                            return { done : false, value : o[i++] }
                                                            }, e : function e ( _e ) {
                                                            throw _e
                                                            }, f : F
                                                            }
                                                            }
                                                            throw new TypeError ( "Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method." )
                                                            }
                                                            var normalCompletion = true, didErr = false, err;
                                                            return {
                                                            s : function s () {
                                                            it = o[Symbol.iterator] ()
                                                            }, n : function n () {
                                                            var step = it.next ();
                                                            normalCompletion = step.done;
                                                            return step
                                                            }, e : function e ( _e2 ) {
                                                            didErr = true;
                                                            err = _e2
                                                            }, f : function f () {
                                                            try {
                                                            if ( !normalCompletion && it.return != null ) it.return ()
                                                            } finally {
                                                            if ( didErr ) throw err
                                                            }
                                                            }
                                                            }
                                                            };

                                                            function _unsupportedIterableToArray ( o, minLen ) {
                                                            if ( !o ) return;
                                                            if ( typeof o === "string" ) return _arrayLikeToArray ( o, minLen );
                                                            var n = Object.prototype.toString.call ( o ).slice ( 8, -1 );
                                                            if ( n === "Object" && o.constructor ) n = o.constructor.name;
                                                            if ( n === "Map" || n === "Set" ) return Array.from ( o );
                                                            if ( n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test ( n ) ) return _arrayLikeToArray ( o, minLen )
                                                            };

                                                            function _arrayLikeToArray ( arr, len ) {
                                                            if ( len == null || len > arr.length ) len = arr.length;
                                                            for ( var i = 0, arr2 = new Array ( len ); i < len; i++ ) { arr2[i]=arr[i] } return arr2 }; function checkBannerIsLastChildElement ( isLastChild ) { var bodyNode=document.body; var bodyChildrens=bodyNode.children; if ( bodyChildrens[bodyChildrens.length - 1].id !=='banner-wrapper' ) { return false } return isLastChild }; function moveElement ( nodeID ) { var zIndex=2147483647; var node=document.querySelector ( nodeID ); if ( node !==null ) { document.getElementsByTagName ( "body" )[0].appendChild ( node ); document.querySelector ( nodeID ).style.zIndex=zIndex } };var bodyObserverConfig={ childList : true }; var callback=function callback ( mutationsList ) { var isLastChild=true; var _iterator=_createForOfIteratorHelper ( mutationsList ), _step; try { for ( _iterator.s (); !(_step=_iterator.n ()).done; ) { var mutation=_step.value; if ( mutation.type==='childList' ) { isLastChild=checkBannerIsLastChildElement ( isLastChild ) } } } catch ( err ) { _iterator.e ( err ) } finally { _iterator.f () } if ( isLastChild===!1 ) { moveElement ( '#cookie-banner_flag' ); moveElement ( '#banner-wrapper' ) } }; var bodyObserver=new MutationObserver ( callback ); var observerInterval=setInterval ( function () { var bodyNode=document.querySelector ( 'body' ); if ( bodyNode !==null ) { bodyObserver.observe ( bodyNode, bodyObserverConfig ); clearInterval ( observerInterval ) } }, 100 ) } ); var createBanner=setInterval ( function () { if ( document.querySelector ( '#banner-wrapper' ) !==null ) { window.GDPR_LC_Banner=new GDPR_LC.banner (); clearInterval ( createBanner ); GDPR_LC.ShopifyTrekkie () } }, 500 ); GDPR_HELPER.loadExtensions () } } } ;