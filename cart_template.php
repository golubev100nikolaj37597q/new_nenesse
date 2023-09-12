<div id="monster-upsell-cart" data-rtl="false" style="display:none">
  <div class="monster_upsell_overlay___3sEH4" style="display: initial;visibility: visible;"></div>
  <div class="monster_upsell_cart___25Ft7 monster_upsell_rtl mu_openned" id="monster-cart-wrapper" style="right: 0px;">
    <div class="mu-w-full mu-h-full mu-m-0 mu-p-0 mu-max-w-full mu-flex mu-flex-col mu-relative mu-disable-outline" style="color: rgb(22, 37, 67); background: rgb(255, 255, 255); font-size: 12px; font-family: inherit; direction: ltr;">
      <div class="">
        <div class="mu-px-5 mu-py-3 mu-flex mu-items-center mu-relative" style="background: rgb(233, 233, 233); color: rgb(0, 0, 0);">
          <div class="mu-pr-2 mu-opacity-0"><svg aria-hidden="true" focusable="false" data-icon="chevron-left" class="mu-cursor-pointer" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 15px; height: 15px;">
              <path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z">
              </path>
            </svg></div><span class="mu-flex-1 mu-flex-grow mu-text-center mu-font-bold mu-cart-header" style="font-size: 1.2em;">Dein Warenkorb</span>
          <div class="mu-pl-2 mu-cursor-pointer" id="closeModal"><svg aria-hidden="true" focusable="false" data-icon="times" class="mu-cursor-pointer" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 15px; height: 15px;">
              <path fill="currentColor" d="M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z">
              </path>
            </svg></div>
        </div>

      </div>
      <?php if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) { ?>
        <div class="mu-flex-1 custom_scrollbar___2sb__" style="--trackBg: rgba(255,255,255,1); --thumbBg: rgba(215,222,255,1);">
          <div class="mu-slider mu-w-full mu-min-w-full mu-flex-1 mu-overflow-hidden mu-flex mu-flex-col" style="min-height: 100%;">
            <div class="mu-flex-1 mu-flex mu-transform mu-transition-transform mu-duration-300 mu-ease-out mu-translate-x-0">
              <div class="mu-w-full mu-min-w-full mu-flex mu-flex-col mu-h-auto">
                <div class="mu-flex mu-flex-col mu-px-5 mu-pt-4 mu-flex-1">
                  <?php
                  $carts = array_unique($_SESSION['cart']);

                  // Получаем количество каждого элемента в $_SESSION['cart']
                  $counts = array_count_values($_SESSION['cart']);
                  $sum = 0;
                  foreach ($carts as $cart_el) {
                    $product = get_info_product_by_name($cart_el);

                  ?>

                    <div class="mu-mb-6 mu-cart-item">
                      <div class="mu-flex">
                        <div class="mu-bg-cover mu-bg-center mu-block mu-mr-2" style="background-image: url(&quot; <?php echo get_src_photo($product['name'])[0] ?>&quot;); width: 80px; height: 80px;">
                        </div>
                        <div class="mu-flex-1 mu-flex-col">
                          <div class="mu-mb-2 mu-overflow-hidden mu-font-bold mu-line-clamp" style="font-size: 1.2em; color: rgb(22, 37, 67);"><a href="/collections/<?php echo $product['collection'] ?>/products/<?php echo $product['name'] ?>">
                              <?php echo $product['title'] ?>
                            </a>
                          </div>
                          <div class="mu-flex mu-items-center"><b class="mu-flex-1" style="font-size: 1.2em; color: rgb(22, 37, 67);">€
                              <?php echo $product['price'] ?>
                            </b>
                            <div class="mu-flex mu-items-stretch"><button id="minus_<?php echo $product['name'] ?>_modal" class="mu-border mu-flex-center mu-p-1 xs:mu-p-2 mu-bg-transparent mu-rounded-l mu-rounded-r-none" aria-label="decrease item quantity by one" style="border: 1px solid rgb(208, 211, 217); color: rgb(22, 37, 67); min-width: unset;"><svg ariaHidden="true" focusable="false" data-icon="minus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 12px;">
                                  <path fill="currentColor" d="M424 318.2c13.3 0 24-10.7 24-24v-76.4c0-13.3-10.7-24-24-24H24c-13.3 0-24 10.7-24 24v76.4c0 13.3 10.7 24 24 24h400z">
                                  </path>
                                </svg></button>
                              <div class="mu-px-2 mu-border-t mu-border-b mu-font-bold mu-flex-center mu-w-8" style="color: rgb(22, 37, 67); border-color: rgb(208, 211, 217);" id="counter_modal">
                                <?php echo $counts[$cart_el] ?>
                              </div><button id="plus_<?php echo $product['name'] ?>_modal" class="mu-border mu-flex-center mu-p-1 xs:mu-p-2 mu-bg-transparent mu-rounded-r mu-rounded-l-none" aria-label="increase item quantity by one" style="border: 1px solid rgb(208, 211, 217); color: rgb(22, 37, 67); min-width: unset;"><svg ariaHidden="true" focusable="false" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 12px;">
                                  <path fill="currentColor" d="M448 294.2v-76.4c0-13.3-10.7-24-24-24H286.2V56c0-13.3-10.7-24-24-24h-76.4c-13.3 0-24 10.7-24 24v137.8H24c-13.3 0-24 10.7-24 24v76.4c0 13.3 10.7 24 24 24h137.8V456c0 13.3 10.7 24 24 24h76.4c13.3 0 24-10.7 24-24V318.2H424c13.3 0 24-10.7 24-24z">
                                  </path>
                                </svg></button>
                            </div>
                          </div>
                          <?php
                          // сделай считывание цены $product['price'] и в конце подставление в #cost
                          $price = $product['price'];
                          $count = $counts[$cart_el];
                          $sum +=  $price * $count;

                          ?>
                          <script>
                            //сделай счетчик
                            var plus_modal = document.getElementById('plus_<?php echo $product['name'] ?>_modal');
                            var minus_modal = document.getElementById('minus_<?php echo $product['name'] ?>_modal');
                            var input_modal = document.getElementById('counter_modal');
                            var count_modal = <?php echo $counts[$cart_el] ?>;
                            plus_modal.addEventListener('click', function() {
                              $.ajax({
                                url: "add_cart.php",
                                type: 'POST',

                                data: {
                                  cart: '<?php echo $product['name'] ?>'
                                },
                                success: function(data) {
                                  console.log(data)
                                  if (data != 'Success') {
                                    console.log('Error')
                                  } else {
                                    console.log('Success')
                                    window.location.reload();
                                  }
                                },
                                error: function(error) {
                                  console.log(error)


                                }
                              })
                              count_modal++;
                              input_modal.innerText = count_modal;
                            });
                            minus_modal.addEventListener('click', function() {

                              $.ajax({
                                url: "delete_card.php",
                                type: 'POST',

                                data: {
                                  cart: '<?php echo $product['name'] ?>',
                                  type: 'single'
                                },
                                success: function(data) {
                                  console.log(data)
                                  if (data != 'Success') {
                                    console.log('Error')
                                  } else {
                                    console.log('Success')
                                    window.location.reload();
                                  }
                                },
                                error: function(error) {
                                  console.log(error)


                                }
                              })
                              count_modal++;
                              input_modal.innerText = count_modal;
                              if (count_modal > 1) {
                                count_modal--;
                                input_modal.innerText = count_modal;
                              }
                            });
                          </script>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="mu-px-5">
                  <div class="mu-pb-3 mu-flex mu-items-center mu-font-bold mu-info-item mu-subtotal" style="font-size: 1.3em; color: rgb(22, 37, 67);"><span class="mu-flex-1 mu-flex-grow" style="color: inherit;">Zwischensumme</span><span data-value="€49,50" style="color: inherit;">
                      <span class="money mw-price" id="cost">€
                        <?php echo $sum ?>
                      </span></span></div>
                  <div class="fondue-cashback-module"></div>
                  <div class="scDiscount__container">
                    <div id="scDiscountApp" class="scDiscount scright ">
                      <div style="width: 550px;">
                        <div>
                          <form>
                            <div class="sc_simple-container sc_simple-container--initial"><input type="text" id="code" name="code" class="sc-cube-text sc-cube-code" placeholder="Rabattcode eingeben" autocomplete="off" style="border-color: rgb(0, 0, 0); color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                              <div class="sc_code-btn sc_state-initial"><input type="button" id="submit" value="Einlösen" style="color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); border: 1px solid rgb(0, 0, 0);">
                                <div class="sc_code-loading" style="background: rgb(0, 0, 0);"><svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling">
                                    <circle cx="50" cy="50" fill="none" stroke-width="7" r="25" stroke-dasharray="117.80972450961724 41.269908169872416" transform="rotate(47.1629 50 50)" style="stroke: rgb(255, 255, 255);">
                                      <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
                                    </circle>
                                  </svg></div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div><button id="mu-checkout-button" class="mu-custom-btn mu-w-full mu-rounded mu-w-full mu-py-3 mu-mb-3 mu-checkout-btn mu-flex mu-items-center mu-justify-center" style="background-color: rgb(255, 174, 38); font-family: inherit; font-size: 1.4em; font-weight: 700; color: rgb(255, 255, 255); --hover-background: rgba(215,222,255,1);">Zur
                    Kasse</button>
                  <div class="mu-rounded mu-border mu-mb-2 mu-frequently-container mu-mt-1" style="border-color: rgb(190, 190, 190);">
                    <div class="mu-text-center mu-p-2 mu-font-bold mu-w-full mu-frequently-header" style="background: rgb(233, 233, 233); color: rgb(22, 37, 67); font-size: 1.1em;">Wird oft zusammen
                      gekauft</div>
                    <div>
                      <?php
                      $recomend = getTopThreeProductsByCollectionsAndViews();
                      foreach ($recomend as $productq) {
                      ?>
                        <div class="mu-border-b last:mu-border-b-0 mu-mx-2 mu-py-2" style="border-color: rgb(190, 190, 190);">
                          <div class="mu-flex">
                            <div class="mu-rounded mu-bg-cover mu-bg-center mu-block" style="background-image: url(&quot;<?php echo get_src_photo($productq['name'])[0] ?>&quot;); width: 70px; height: 70px;">
                            </div>
                            <div class="mu-flex-1 mu-flex mu-flex-col mu-pl-2"><b class="mu-mb-2 mu-overflow-hidden mu-w-full mu-line-clamp" style="font-size: 1.1em; color: rgb(22, 37, 67);"><a href="/collections/<?php echo $product['collection'] ?>/products/<?php echo $product['name'] ?>"><?php echo $productq['title'] ?></a></b>
                              <div class="mu-flex mu-items-center mu-flex-wrap">
                                <div class="mu-flex mu-flex-col mu-flex-1 mu-items-start mu-mr-2"><b class="mu-mb-1" style="font-size: 0.9em; color: rgb(22, 37, 67);">Nur € <?php echo $productq['price'] ?></b>

                                </div><button id="modal_recom_<?php echo $productq['name'] ?>" class="mu-border-solid mu-border-2 mu-bg-transparent mu-btn-small mu-py-2 mu-relative" style="border-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-size: 0.8em;">
                                  <script>
                                    const button_add_cart_<?php echo $productq['name'] ?> = document.getElementById('modal_recom_<?php echo $productq['name'] ?>');

                                    button_add_cart_<?php echo $productq['name'] ?>.addEventListener('click', () => {
                                      $.ajax({
                                        url: "add_cart.php",
                                        type: 'POST',

                                        data: {
                                          cart: <?php echo $productq['name'] ?>
                                        },

                                        success: function(data) {
                                          console.log(data)
                                          if (data != 'Success') {
                                            console.log('Error')
                                          }
                                          window.location.reload();
                                        },
                                        error: function(error) {
                                          console.log(error)
                                        }
                                      })
                                    });
                                  </script><span class="">In den Warenkorb</span>
                                  <div class="mu-absolute mu-inset-0 mu-flex-center mu-hidden"><svg aria-hidden="true" focusable="false" data-icon="spinner-third" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mu-w-3 mu-h-3 mu-fa-spin">
                                      <path fill="currentColor" d="M456.433 371.72l-27.79-16.045c-7.192-4.152-10.052-13.136-6.487-20.636 25.82-54.328 23.566-118.602-6.768-171.03-30.265-52.529-84.802-86.621-144.76-91.424C262.35 71.922 256 64.953 256 56.649V24.56c0-9.31 7.916-16.609 17.204-15.96 81.795 5.717 156.412 51.902 197.611 123.408 41.301 71.385 43.99 159.096 8.042 232.792-4.082 8.369-14.361 11.575-22.424 6.92z">
                                      </path>
                                    </svg></div>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="mu-flex-1 custom_scrollbar___2sb__" style="--trackBg: rgba(255,255,255,1); --thumbBg: rgba(215,222,255,1);">
          <div class="mu-slider mu-w-full mu-min-w-full mu-flex-1 mu-overflow-hidden mu-flex mu-flex-col" style="min-height: 100%;">
            <div class="mu-flex-1 mu-flex mu-transform mu-transition-transform mu-duration-300 mu-ease-out mu-translate-x-0">
              <div class="mu-relative mu-p-3 mu-empty-cart mu-w-full mu-min-w-full mu-max-w-full">
                <div>
                  <p class="ql-align-center"><img src="https://cdn.shopify.com/s/files/1/0597/9367/0293/t/38/assets/download.png?v=1667818689"></p>
                </div>
                <div class="mu-custom-btn mu-w-full mu-w-full mu-py-2 mu-mb-2 mu-text-center mu-cursor-pointer" style="color: rgb(8, 8, 8); font-size: 1em; font-weight: 700; text-decoration: underline;">Einkauf
                  fortsetzen</div>
              </div>
              <div class="mu-w-full mu-min-w-full mu-px-5 mu-py-3" id="monster_product_details" style="max-height: calc(100vh - 107px);">
                <div class="mu-relative " style="min-height: 60px;">
                  <div class="mu-relative mu-slider mu-w-full mu-max-w-full mu-overflow-hidden">
                    <div class="mu-slider-container mu-flex mu-transition-transform mu-duration-300 mu-ease-out" style="transform: translateX(0%);">
                      <div class="mu-w-full mu-min-w-full mu-z-0" style="height: 300px;">
                        <div class="mu-block mu-bg-cover mu-bg-center mu-w-full mu-h-full" style="background-image: url(&quot;https://cdn.shopify.com/s/files/1/0615/4479/2259/files/2S4A2057sPM_1.jpg?v=1693669996&quot;);">
                        </div>
                      </div>
                      <div class="mu-w-full mu-min-w-full mu-z-0" style="height: 300px;">
                        <div class="mu-block mu-bg-cover mu-bg-center mu-w-full mu-h-full" style="background-image: url(&quot;https://cdn.shopify.com/s/files/1/0615/4479/2259/files/2S4A2100sPM.jpg?v=1693669996&quot;);">
                        </div>
                      </div>
                      <div class="mu-w-full mu-min-w-full mu-z-0" style="height: 300px;">
                        <div class="mu-block mu-bg-cover mu-bg-center mu-w-full mu-h-full" style="background-image: url(&quot;https://cdn.shopify.com/s/files/1/0615/4479/2259/files/2S4A2089sPMv2.jpg?v=1693669997&quot;);">
                        </div>
                      </div>
                      <div class="mu-w-full mu-min-w-full mu-z-0" style="height: 300px;">
                        <div class="mu-block mu-bg-cover mu-bg-center mu-w-full mu-h-full" style="background-image: url(&quot;https://cdn.shopify.com/s/files/1/0615/4479/2259/files/sama-gabeczka.jpg?v=1693669997&quot;);">
                        </div>
                      </div>
                    </div><span class="mu-absolute mu-z-10 mu-flex mu-left-0 mu-ml-2 mu-transform mu--translate-y-1/2" style="background: rgba(255, 255, 255, 0.8); border-radius: 50%; top: calc(50% - 12px);"><svg aria-hidden="true" focusable="false" data-icon="arrow-alt-circle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mu-w-5 mu-h-5" style="color: rgba(0, 0, 0, 0.8);">
                        <path fill="currentColor" d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z">
                        </path>
                      </svg></span><span class="mu-absolute mu-z-10 mu-flex mu-right-0 mu-mr-2 mu-transform mu--translate-y-1/2" style="background: rgba(255, 255, 255, 0.8); border-radius: 50%; top: calc(50% - 12px);"><svg aria-hidden="true" focusable="false" data-icon="arrow-alt-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mu-w-5 mu-h-5" style="color: rgba(0, 0, 0, 0.8);">
                        <path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z">
                        </path>
                      </svg></span>
                    <div class="mu-flex-center mu-py-2"><span class="mu-w-2 mu-h-2 mu-rounded-full mu-mx-1 mu-cursor-pointer mu-border" style="background-color: rgb(0, 0, 0); border-color: rgb(0, 0, 0);"></span><span class="mu-w-2 mu-h-2 mu-rounded-full mu-mx-1 mu-cursor-pointer mu-border" style="border-color: rgb(0, 0, 0);"></span><span class="mu-w-2 mu-h-2 mu-rounded-full mu-mx-1 mu-cursor-pointer mu-border" style="border-color: rgb(0, 0, 0);"></span><span class="mu-w-2 mu-h-2 mu-rounded-full mu-mx-1 mu-cursor-pointer mu-border" style="border-color: rgb(0, 0, 0);"></span></div>
                  </div>
                </div>
                <div class="mu-py-3">
                  <h3 class="mu-font-bold mu-mb-3">Beauty Blender</h3><button class="mu-custom-btn mu-p-4 mu-w-full mu-relative " style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); font-size: 1em; width: 100%;"><span class="">In den Warenkorb</span>
                    <div class="mu-absolute mu-inset-0 mu-flex-center mu-hidden"><svg aria-hidden="true" focusable="false" data-icon="spinner-third" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mu-w-4 mu-h-4 mu-fa-spin">
                        <path fill="currentColor" d="M456.433 371.72l-27.79-16.045c-7.192-4.152-10.052-13.136-6.487-20.636 25.82-54.328 23.566-118.602-6.768-171.03-30.265-52.529-84.802-86.621-144.76-91.424C262.35 71.922 256 64.953 256 56.649V24.56c0-9.31 7.916-16.609 17.204-15.96 81.795 5.717 156.412 51.902 197.611 123.408 41.301 71.385 43.99 159.096 8.042 232.792-4.082 8.369-14.361 11.575-22.424 6.92z">
                        </path>
                      </svg></div>
                  </button>
                  <div class="mu-relative " style="min-height: 60px;">
                    <p class="mu-py-2">
                      <meta charset="utf-8">
                    <p data-mce-fragment="1"><strong>Das ist großartig zu hören! Wenn der NENESS Make-up Blender jetzt mit
                        einer Schutzhülle geliefert wird, ist das ein zusätzlicher Bonus für dich. Die Schutzhülle bietet
                        nicht nur Schutz für deinen Blender, sondern trägt auch zur Hygiene bei, indem sie verhindert,
                        dass Schmutz und Bakterien auf den Schaumstoff gelangen. Dies ist besonders praktisch, wenn du
                        deinen Make-up Blender unterwegs verwendest oder auf Reisen bist.</strong></p>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<script>
  //найди элемент a c id HeaderCartTrigger и останови переход на страницу
  var modal = document.querySelector('#monster-upsell-cart');
  var cart = document.querySelector('#HeaderCartTrigger');
  cart.addEventListener('click', function(e) {
    e.preventDefault();
    modal.style.display = 'block';
  })



  //получи кнопку закрытия модального окна
  var close = document.querySelector('#closeModal');
  //при клике на кнопку закрытия модального окна
  close.addEventListener('click', function() {
    //скрой модальное окно
    console.log('click')
    modal.style.display = 'none';
  })
  //получи кнопку Zur Kasse
  var checkout = document.querySelector('#mu-checkout-button');
  //при клике на кнопку Zur Kasse
  checkout.addEventListener('click', function() {
    //скрой модальное окно
    modal.style.display = 'none';
    //перейди на страницу оформления заказа
    window.location.href = '/payment.php';
  })
</script>