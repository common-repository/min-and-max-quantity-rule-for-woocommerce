<?php 
if (!defined('ABSPATH'))
    exit;

if (!class_exists('OCMAMQRW_functionality')) {
    class OCMAMQRW_functionality {

        /**
        * Constructor.
        *
        * @version 3.2.3
        */
        public $mamwr_enabled, $mamwr_min, $mamwr_max, $mamwr_qtymsg, $mamwr_qtymsg_grtr, $mamwr_qtymsg_less, $mamwr_singleqtymsgbeforeatc, $mamwr_singleqtymsgbeforeatc_grtr, $mamwr_singleqtymsgbeforeatc_less, $mamwr_singleqtymsg, $mamwr_singleqtymsg_grtr, $mamwr_singleqtymsg_less, $mamwr_catqtymsg, $mamwr_catqtymsg_grtr, $mamwr_catqtymsg_less, $mamwr_minprice, $mamwr_maxprice, $mamwr_roles, $mamwr_varqtymsg, $mamwr_varqtymsg_grtr, $mamwr_varqtymsg_less, $mamwr_groupmanager, $mamwr_pricemsg, $mamwr_pricemsg_grtr, $mamwr_pricemsg_less, $mamwr_pricecatmsg, $mamwr_pricecatmsg_grtr, $mamwr_pricecatmsg_less, $mamwr_notapplyvisitors;

        function __construct() {
            //Enable Plugin
            if ( 'yes' === get_option( 'mamwr_enabled') ) {
                $this->mamwr_enabled = get_option('mamwr_enabled');
            }

            //Get value minimum qty
            if ( !empty(get_option( 'min_cart_quntity')) ) {
                $this->mamwr_min = get_option('min_cart_quntity');
            }

            //Get value maximum qty
            if ( !empty(get_option( 'max_cart_quntity')) ) {
                $this->mamwr_max = get_option('max_cart_quntity');
            }
            
            //Get Quantity Messages common
            if ( !empty(get_option( 'mamwr_qtymsg')) ) {
                $this->mamwr_qtymsg = get_option('mamwr_qtymsg');
            }

            //Get Quantity Messages common when only min qty set
            if ( !empty(get_option( 'mamwr_qtymsg_grtr')) ) {
                $this->mamwr_qtymsg_grtr = get_option('mamwr_qtymsg_grtr');
            }

            //Get Quantity Messages common when only max qty set
            if ( !empty(get_option( 'mamwr_qtymsg_less')) ) {
                $this->mamwr_qtymsg_less = get_option('mamwr_qtymsg_less');
            }

            //Get Quantity Messages simple product - before add to cart button
            if ( !empty(get_option( 'mamwr_singleqtymsgbeforeatc')) ) {
                $this->mamwr_singleqtymsgbeforeatc = get_option('mamwr_singleqtymsgbeforeatc');
            }

            //Get Quantity Messages simple product - before add to cart button - when only min qty set
            if ( !empty(get_option( 'mamwr_singleqtymsgbeforeatc_grtr')) ) {
                $this->mamwr_singleqtymsgbeforeatc_grtr = get_option('mamwr_singleqtymsgbeforeatc_grtr');
            }

            //Get Quantity Messages simple product - before add to cart button - when only max qty set
            $this->mamwr_singleqtymsgbeforeatc_less = 'Qty must be less than or equal to %u';

            //Get Quantity Messages single product
            if ( !empty(get_option( 'mamwr_singleqtymsg')) ) {
                $this->mamwr_singleqtymsg = get_option('mamwr_singleqtymsg');
            }

            //Get Quantity Messages single product when only min qty set
            if ( !empty(get_option( 'mamwr_singleqtymsg_grtr')) ) {
                $this->mamwr_singleqtymsg_grtr = get_option('mamwr_singleqtymsg_grtr');
            }

            //Get Quantity Messages single product when only max qty set
            $this->mamwr_singleqtymsg_less = '%s product quantity must be less than or equal to %u';

            //Get Quantity Messages Category product
            if ( !empty(get_option( 'mamwr_catqtymsg')) ) {
                $this->mamwr_catqtymsg = get_option('mamwr_catqtymsg');
            }

            //Get Quantity Messages Category product when only min qty set
            if ( !empty(get_option( 'mamwr_catqtymsg_grtr')) ) {
                $this->mamwr_catqtymsg_grtr = get_option('mamwr_catqtymsg_grtr');
            }

            //Get Quantity Messages Category product when only max qty set
            $this->mamwr_catqtymsg_less = 'Category %s products quantity must be less than or equal to %u';

            //Get value of min price
            if ( !empty(get_option( 'mamwr_minprice')) ) {
                $this->mamwr_minprice = get_option('mamwr_minprice');
            }

            //Get value of max price
            if ( !empty(get_option( 'mamwr_maxprice')) ) {
                $this->mamwr_maxprice = get_option('mamwr_maxprice');
            }

            //Get value of user roles for general option
            if ( !empty(get_option( 'mamwr_roles')) ) {
                $this->mamwr_roles = get_option('mamwr_roles');
            }

            //Get Quantity Messages variation product
            if ( !empty(get_option( 'mamwr_varqtymsg')) ) {
                $this->mamwr_varqtymsg = get_option('mamwr_varqtymsg');
            }

            //Get Quantity Messages variation product when only min qty set
            if ( !empty(get_option( 'mamwr_varqtymsg_grtr')) ) {
                $this->mamwr_varqtymsg_grtr = get_option('mamwr_varqtymsg_grtr');
            }

            //Get Quantity Messages variation product when only max qty set
            $this->mamwr_varqtymsg_less = '%s variation product quantity must be less than or equal to %u';

            //Get group manager data
            if ( !empty(get_option( 'mamwr_groupmanager')) ) {
                $this->mamwr_groupmanager = get_option('mamwr_groupmanager');
            }

            //Get price messages common
            if ( !empty(get_option( 'mamwr_pricemsg')) ) {
                $this->mamwr_pricemsg = get_option('mamwr_pricemsg');
            }

            //Get price messages common when only min cost set
            if ( !empty(get_option( 'mamwr_pricemsg_grtr')) ) {
                $this->mamwr_pricemsg_grtr = get_option('mamwr_pricemsg_grtr');
            }

            //Get price messages common when only max cost set
            if ( !empty(get_option( 'mamwr_pricemsg_less')) ) {
                $this->mamwr_pricemsg_less = get_option('mamwr_pricemsg_less');
            }
            
            //Get price messages Category product
            if ( !empty(get_option( 'mamwr_pricecatmsg')) ) {
                $this->mamwr_pricecatmsg = get_option('mamwr_pricecatmsg');
            }

            //Get price messages Category product when only min cost set
            if ( !empty(get_option( 'mamwr_pricecatmsg_grtr')) ) {
                $this->mamwr_pricecatmsg_grtr = get_option('mamwr_pricecatmsg_grtr');
            }

            //Get price messages Category product when only max cost set
            $this->mamwr_pricecatmsg_less = 'Category %s products total cost must be less than or equal to %s';

            if( !empty(get_option( 'mamwr_notapplyvisitors')) && get_option( 'mamwr_notapplyvisitors' ) == "yes" && !is_user_logged_in()) {
                $this->mamwr_notapplyvisitors = get_option('mamwr_notapplyvisitors');
            } else {
                $this->mamwr_notapplyvisitors = 'no';
            }
        }
          
        protected static $OCMAMQRW_instance;

        public static function OCMAMQRW_instance() {
            if (!isset(self::$OCMAMQRW_instance)) {
                self::$OCMAMQRW_instance = new self();
                self::$OCMAMQRW_instance->init();
            }
            return self::$OCMAMQRW_instance;
        }

        function init() {


            if($this->mamwr_enabled === 'yes' && $this->mamwr_notapplyvisitors !== 'yes') {

                add_filter( 'woocommerce_add_to_cart_validation', array($this, 'ocmamqrw_product_validate_cart_item_add'), 10, 4);

                add_action( 'woocommerce_check_cart_items', array($this, 'ocmamqrw_min_max_quantities_proceed_to_checkout_conditions'));

                add_action( 'woocommerce_before_add_to_cart_form', array($this, 'ocmamqrw_min_max_notice' ));
            }
        }
        

        function ocmamqrw_product_validate_cart_item_add($passed, $product_id, $quantity, $variation_id = '', $variations= '') {
            
            $product = wc_get_product( $product_id );
            $product_id = $product_id;

            global $current_user;
            if ( is_user_logged_in() ) {
                $user_roles = $current_user->roles[0];
            }

            if( $product->get_type() == 'variable' ) {

            	$mamwr_groupvalue = get_post_meta($variation_id, '_mamwr_groupvalue', true);
                $mamwrmin = get_post_meta($variation_id, '_mamwr_min_qty', true);
                $mamwrmax = get_post_meta($variation_id, '_mamwr_max_qty', true);


                $mamwr_min_qty = $mamwrmin;
				$mamwr_max_qty = $mamwrmax;

                if(empty($mamwrmin) && empty($mamwrmax)) {
                    if(!empty($mamwr_groupvalue)) {
                        if(!empty($this->mamwr_groupmanager)) {
                            foreach ($this->mamwr_groupmanager as $mamwr_gm_key => $mamwr_gm_value) {
                                if($mamwr_gm_value['gm_id'] == $mamwr_groupvalue){
                                    $mamwr_min_qty = $mamwr_gm_value['gm_min_quntity'];
                                    $mamwr_max_qty = $mamwr_gm_value['gm_max_quntity'];
                                }
                            }
                        }
                    }
                }


                $mamwr_less_than = '';
                $mamwr_greater_than = '';

                if($mamwr_min_qty == '' && $mamwr_max_qty != '') {
                	$mamwr_min_qty = 1;
                	$mamwr_less_than = 'true';
                }

                if($mamwr_max_qty == ''  && $mamwr_min_qty != '') {
                	$mamwr_max_qty = 9999999999;
                	$mamwr_greater_than = 'true';
                }

                global $woocommerce;

                $items = $woocommerce->cart->get_cart();
                $variation_sum = 0;

                if (sizeof( WC()->cart->get_cart() ) > 0 ) {
                    foreach($items as $item => $values) {
                        if($values['variation_id'] == $variation_id) {
                            $variation_sum = $values['quantity'] + $quantity;
                        }
                    }
                }

                
                if(!empty($mamwr_min_qty) && !empty($mamwr_max_qty)) {
                    if($variation_sum == 0) {
                        if ($mamwr_max_qty >= $quantity && $mamwr_min_qty <= $quantity) {
                            $passed = true;
                        } else {
                            if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                    $passed = false;
                                    if($mamwr_greater_than == 'true' ) {
                                    	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $product->get_name(), $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    } elseif ($mamwr_less_than == 'true') {
                                    	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $product->get_name(), $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    } else {
                                    wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $product->get_name(),$mamwr_min_qty,$mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    }
                                }
                            } else {
                                $passed = false;
                                if($mamwr_greater_than == 'true' ) {
                                	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $product->get_name(), $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                } elseif ($mamwr_less_than == 'true') {
                                	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $product->get_name(), $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                } else {
                                wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $product->get_name(),$mamwr_min_qty,$mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                }
                            }
                        } 
                    } else {

                        if ($mamwr_min_qty <= $variation_sum &&  $mamwr_max_qty >= $variation_sum) {
                            $passed = true;
                        } else {
                            if ( is_user_logged_in() && !empty($this->mamwr_roles) ) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                  $passed = false;
                                  if($mamwr_greater_than == 'true' ) {
	                            	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $product->get_name(), $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
	                              } elseif ($mamwr_less_than == 'true') {
	                            	wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $product->get_name(), $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
	                              } else {
	                            	wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $product->get_name(),$mamwr_min_qty,$mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
	                              }
                                }
                            } else {
                                $passed = false;
                                if($mamwr_greater_than == 'true' ) {
                            		wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $product->get_name(), $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                              	} elseif ($mamwr_less_than == 'true') {
                            		wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $product->get_name(), $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                              	} else {
                            		wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $product->get_name(),$mamwr_min_qty,$mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                              	}
                            }
                        }
                    }
                }
            } else {
                $mamwr_groupvalue = get_post_meta($product_id, '_mamwr_groupvalue', true);
                $mamwrmin = get_post_meta($product_id, '_custom_product_number_field_min', true);
                $mamwrmax = get_post_meta($product_id, '_custom_product_number_field_max', true);

                $min = $mamwrmin;
				$max = $mamwrmax;

                if(empty($mamwrmin) && empty($mamwrmax)) {
                    if(!empty($mamwr_groupvalue)) {
                        if(!empty($this->mamwr_groupmanager)) {
                            foreach ($this->mamwr_groupmanager as $mamwr_gm_key => $mamwr_gm_value) {
                                if($mamwr_gm_value['gm_id'] == $mamwr_groupvalue){
                                    $min = $mamwr_gm_value['gm_min_quntity'];
                                    $max = $mamwr_gm_value['gm_max_quntity'];
                                }
                            }
                        }
                    }
                }

                $mamwr_sngl_less_than = '';
                $mamwr_sngl_greater_than = '';

                if($min == '' && $max != '') {
                	$min = 1;
                	$mamwr_sngl_less_than = 'true';
                }

                if($max == ''  && $min != '') {
                	$max = 9999999999;
                	$mamwr_sngl_greater_than = 'true';
                }

                $qun = $quantity;

                global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                $sum = 0;

                if (sizeof( WC()->cart->get_cart() ) > 0 ) {
                    foreach($items as $item => $values) {
                        if($values['product_id'] == $product_id) {
                            $sum = $values['quantity'] + $qun;
                        }
                    }
                }

                if(!empty($min) && !empty($max)) {
                    if($sum == 0) {
                        
                        if ($max >= $qun && $min <= $qun) {
                            $passed = true;
                        } else {
                            if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                    $passed = false;
									if($mamwr_sngl_greater_than == 'true' ) {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $product->get_name(), $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									} elseif ($mamwr_sngl_less_than == 'true') {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $product->get_name(), $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									} else {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $product->get_name(),$min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									}
                                }
                            } else {
                                $passed = false;
                                if($mamwr_sngl_greater_than == 'true' ) {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $product->get_name(), $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								} elseif ($mamwr_sngl_less_than == 'true') {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $product->get_name(), $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								} else {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $product->get_name(),$min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								}
                            }
                        }

                    } else {
                        if ($min <= $sum &&  $max >= $sum) {
                            $passed = true;
                        } else {
                            if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                    $passed = false;
                                    if($mamwr_sngl_greater_than == 'true' ) {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $product->get_name(), $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									} elseif ($mamwr_sngl_less_than == 'true') {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $product->get_name(), $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									} else {
										wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $product->get_name(),$min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
									}
                                }
                            } else {
                                $passed = false;
                                if($mamwr_sngl_greater_than == 'true' ) {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $product->get_name(), $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								} elseif ($mamwr_sngl_less_than == 'true') {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $product->get_name(), $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								} else {
									wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $product->get_name(),$min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
								}
                            }
                        }
                    }
                }
            }
            return $passed;
        }


        function ocmamqrw_min_max_quantities_proceed_to_checkout_conditions() {
            
            $checkout_url = wc_get_checkout_url();

            global $woocommerce;

            $total_quantity = $woocommerce->cart->cart_contents_count;
            $total_amount   = floatval( WC()->cart->cart_contents_total );

            global $current_user;

            if ( is_user_logged_in() ) {
                $user_roles = $current_user->roles[0];
            }

            $user_apply = 'false';

            if ( is_user_logged_in()) {
                if (!empty($this->mamwr_roles)) {
                    if (in_array($user_roles, $this->mamwr_roles)) {
                        $user_apply = 'true';
                    } else {
                        $user_apply = 'false';
                    }
                } else {
                    $user_apply = 'true';
                }
            } else {
                $user_apply = 'true';
            }

            if ($user_apply == 'true') {
                $mamwr_ctset_minqty = $this->mamwr_min;
                $mamwr_ctset_maxqty = $this->mamwr_max;
                $mamwr_ctset_minprice = $this->mamwr_minprice;
                $mamwr_ctset_maxprice = $this->mamwr_maxprice;

                $mamwrctsetqty_less_than = '';
                $mamwrctsetqty_greater_than = '';
                $mamwrctsetprc_less_than = '';
                $mamwrctsetprc_greater_than = '';


                if($mamwr_ctset_minqty == '' && $mamwr_ctset_maxqty != '') {
                    $mamwr_ctset_minqty = 1;
                    $mamwrctsetqty_less_than = 'true';
                }

                if($mamwr_ctset_maxqty == ''  && $mamwr_ctset_minqty != '') {
                    $mamwr_ctset_maxqty = 9999999999;
                    $mamwrctsetqty_greater_than = 'true';
                }

                if($mamwr_ctset_minprice == '' && $mamwr_ctset_maxprice != '') {
                    $mamwr_ctset_minprice = 1;
                    $mamwrctsetprc_less_than = 'true';
                }

                if($mamwr_ctset_maxprice == '' && $mamwr_ctset_minprice != '') {
                    $mamwr_ctset_maxprice = 9999999999;
                    $mamwrctsetprc_greater_than = 'true';
                }


                if ( WC()->cart->get_cart_contents_count() != 0 ) {

                    if(!empty($mamwr_ctset_minqty) && !empty($mamwr_ctset_maxqty)) {
                        if($mamwr_ctset_minqty > $total_quantity || $mamwr_ctset_maxqty < $total_quantity) {
                            if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                    if($mamwrctsetqty_greater_than == 'true' ) {
                                        wc_add_notice( __(sprintf($this->mamwr_qtymsg_grtr, $mamwr_ctset_minqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    } elseif ($mamwrctsetqty_less_than == 'true') {
                                        wc_add_notice( __(sprintf($this->mamwr_qtymsg_less, $mamwr_ctset_maxqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    } else {
                                        wc_add_notice( __(sprintf($this->mamwr_qtymsg, $mamwr_ctset_minqty, $mamwr_ctset_maxqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    }
                                }
                            } else {
                                if($mamwrctsetqty_greater_than == 'true' ) {
                                    wc_add_notice( __(sprintf($this->mamwr_qtymsg_grtr, $mamwr_ctset_minqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                } elseif ($mamwrctsetqty_less_than == 'true') {
                                    wc_add_notice( __(sprintf($this->mamwr_qtymsg_less, $mamwr_ctset_maxqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                } else {
                                    wc_add_notice( __(sprintf($this->mamwr_qtymsg, $mamwr_ctset_minqty, $mamwr_ctset_maxqty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                }
                            }
                        }
                    }
                }


                if ( WC()->cart->get_cart_contents_count() != 0 ) {
                    if(!empty($mamwr_ctset_minprice) && !empty($mamwr_ctset_maxprice)) {
                        if($mamwr_ctset_minprice > $total_amount || $mamwr_ctset_maxprice < $total_amount) {

                            $mamwr_ctset_minprice_html = wc_price($mamwr_ctset_minprice);
                            $mamwr_ctset_maxprice_html = wc_price($mamwr_ctset_maxprice);

                            if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                if (in_array($user_roles, $this->mamwr_roles)) {
                                    if($mamwrctsetprc_greater_than == 'true' ) {
                                        wc_add_notice( __(sprintf($this->mamwr_pricemsg_grtr, $mamwr_ctset_minprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    } elseif ($mamwrctsetprc_less_than == 'true') {
                                        wc_add_notice( __(sprintf($this->mamwr_pricemsg_less, $mamwr_ctset_maxprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    } else {
                                        wc_add_notice( __(sprintf($this->mamwr_pricemsg, $mamwr_ctset_minprice_html, $mamwr_ctset_maxprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                    }
                                }
                            } else {
                                if($mamwrctsetprc_greater_than == 'true' ) {
                                    wc_add_notice( __(sprintf($this->mamwr_pricemsg_grtr, $mamwr_ctset_minprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                } elseif ($mamwrctsetprc_less_than == 'true') {
                                    wc_add_notice( __(sprintf($this->mamwr_pricemsg_less, $mamwr_ctset_maxprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                } else {
                                    wc_add_notice( __(sprintf($this->mamwr_pricemsg, $mamwr_ctset_minprice_html, $mamwr_ctset_maxprice_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                    remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
                                }
                            }
                        }
                    }
                }


                $items = WC()->cart->get_cart();
                $categorydatas = array();

                foreach ( $items as $item ) {
                    $product_id    = $item['product_id'];
                    $product_name  = $item['data']->get_title();

                    $mamwr_term_list = wp_get_post_terms($product_id, 'product_cat', array('fields'=>'ids'));

                    foreach ($mamwr_term_list as $mamwr_key => $mamwr_value) {

                        $mam_p_min_qty = get_term_meta($mamwr_value, 'mam_p_min_qty', true);
                        $mam_p_max_qty = get_term_meta($mamwr_value, 'mam_p_max_qty', true);
                        $mamwr_minpricec = get_term_meta($mamwr_value, 'mamwr_minprice', true);
                        $mamwr_maxpricec = get_term_meta($mamwr_value, 'mamwr_maxprice', true);

                        $mamwrcatprc_less_than = '';
                        $mamwrcatprc_greater_than = '';
                        $mamwrcatqty_less_than = '';
                        $mamwrcatqty_greater_than = '';

                        if($mamwr_minpricec == '' && $mamwr_maxpricec != '') {
                            $mamwr_minpricec = 1;
                            $mamwrcatprc_less_than = 'true';
                        }

                        if($mamwr_maxpricec == ''  && $mamwr_minpricec != '') {
                            $mamwr_maxpricec = 9999999999;
                            $mamwrcatprc_greater_than = 'true';
                        }

                        if($mam_p_min_qty == '' && $mam_p_max_qty != '') {
                            $mam_p_min_qty = 1;
                            $mamwrcatqty_less_than = 'true';
                        }

                        if($mam_p_max_qty == '' && $mam_p_min_qty != '') {
                            $mam_p_max_qty = 9999999999;
                            $mamwrcatqty_greater_than = 'true';
                        }

                        if(!empty($mamwr_minpricec) && !empty($mamwr_maxpricec)) {

                            if(!isset($categorydatas[$mamwr_value]['cost'])) {
                                $categorydatas[$mamwr_value]['cost'] = 0;
                            }

                            $cat_cost_total = $categorydatas[$mamwr_value]['cost'] + $item['line_total'];
                            $categorydatas[$mamwr_value]['cost'] = $cat_cost_total;
                        }

                        if(!empty($mam_p_min_qty) && !empty($mam_p_max_qty)) {

                            if(!isset($categorydatas[$mamwr_value]['qty'])) {
                                $categorydatas[$mamwr_value]['qty'] = 0;
                            }

                            $cat_qty_total = $categorydatas[$mamwr_value]['qty'] + $item['quantity'];
                            $categorydatas[$mamwr_value]['qty'] = $cat_qty_total;
                        }
                    }
                }


                if ( WC()->cart->get_cart_contents_count() != 0 ) {
                    if(!empty($categorydatas)) {
                        foreach ($categorydatas as $cate_key => $totalvalue) {
                            $mamwrcatprc_less_than = '';
                            $mamwrcatprc_greater_than = '';
                            $mamwrcatqty_less_than = '';
                            $mamwrcatqty_greater_than = '';

                            $mam_p_min_qty = get_term_meta($cate_key, 'mam_p_min_qty', true);
                            $mam_p_max_qty = get_term_meta($cate_key, 'mam_p_max_qty', true);           
                            $mamwr_minpricec = get_term_meta($cate_key, 'mamwr_minprice', true);
                            $mamwr_maxpricec = get_term_meta($cate_key, 'mamwr_maxprice', true);
                            $mamwr_termc = get_term_by( 'id', $cate_key, 'product_cat' );

                            if($mamwr_minpricec == '' && $mamwr_maxpricec != '') {
                                $mamwr_minpricec = 1;
                                $mamwrcatprc_less_than = 'true';
                            }

                            if($mamwr_maxpricec == '' && $mamwr_minpricec != '') {
                                $mamwr_maxpricec = 9999999999;
                                $mamwrcatprc_greater_than = 'true';
                            }

                            if($mam_p_min_qty == '' && $mam_p_max_qty != '') {
                                $mam_p_min_qty = 1;
                                $mamwrcatqty_less_than = 'true';
                            }

                            if($mam_p_max_qty == '' && $mam_p_min_qty != '') {
                                $mam_p_max_qty = 9999999999;
                                $mamwrcatqty_greater_than = 'true';
                            }

                            if(!empty($mamwr_minpricec) && !empty($mamwr_maxpricec)) {
                                
                                if($mamwr_minpricec > $totalvalue['cost'] || $mamwr_maxpricec < $totalvalue['cost']) {
                                    
                                    $mamwr_minpricec_html = wc_price($mamwr_minpricec);
                                    $mamwr_maxpricec_html = wc_price($mamwr_maxpricec);

                                    if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                        if (in_array($user_roles, $this->mamwr_roles)) {
                                            if($mamwrcatprc_greater_than == 'true' ) {
                                                wc_add_notice( __(sprintf($this->mamwr_pricecatmsg_grtr, $mamwr_termc->name, $mamwr_minpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } elseif ($mamwrcatprc_less_than == 'true') {
                                                wc_add_notice( __(sprintf($this->mamwr_pricecatmsg_less, $mamwr_termc->name, $mamwr_maxpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } else {
                                                wc_add_notice( __(sprintf($this->mamwr_pricecatmsg, $mamwr_termc->name, $mamwr_minpricec_html, $mamwr_maxpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            }
                                        }
                                    } else {
                                        if($mamwrcatprc_greater_than == 'true' ) {
                                            wc_add_notice( __(sprintf($this->mamwr_pricecatmsg_grtr, $mamwr_termc->name, $mamwr_minpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } elseif ($mamwrcatprc_less_than == 'true') {
                                            wc_add_notice( __(sprintf($this->mamwr_pricecatmsg_less, $mamwr_termc->name, $mamwr_maxpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } else {
                                            wc_add_notice( __(sprintf($this->mamwr_pricecatmsg, $mamwr_termc->name, $mamwr_minpricec_html, $mamwr_maxpricec_html), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        }
                                    }
                                }
                            }


                            if(!empty($mam_p_min_qty) && !empty($mam_p_max_qty)) {
                                if ($mam_p_min_qty > $totalvalue['qty'] ||  $mam_p_max_qty < $totalvalue['qty']) {
                                    if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                        if (in_array($user_roles, $this->mamwr_roles)) {
                                            if($mamwrcatqty_greater_than == 'true') {
                                                wc_add_notice( __(sprintf($this->mamwr_catqtymsg_grtr, $mamwr_termc->name, $mam_p_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } elseif ($mamwrcatqty_less_than == 'true') {
                                                wc_add_notice( __(sprintf($this->mamwr_catqtymsg_less, $mamwr_termc->name, $mam_p_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } else {
                                                wc_add_notice( __(sprintf($this->mamwr_catqtymsg, $mamwr_termc->name, $mam_p_min_qty, $mam_p_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            }
                                        }
                                    } else {
                                        if($mamwrcatqty_greater_than == 'true') {
                                            wc_add_notice( __(sprintf($this->mamwr_catqtymsg_grtr, $mamwr_termc->name, $mam_p_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } elseif ($mamwrcatqty_less_than == 'true') {
                                            wc_add_notice( __(sprintf($this->mamwr_catqtymsg_less, $mamwr_termc->name, $mam_p_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } else {
                                            wc_add_notice( __(sprintf($this->mamwr_catqtymsg, $mamwr_termc->name, $mam_p_min_qty, $mam_p_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }


                $items = $woocommerce->cart->get_cart();

                if ( WC()->cart->get_cart_contents_count() != 0 ) {
                    foreach ( $items as $item => $values ) {
                    	$mamwr_groupvalue = '';
                        $mamwr_min_qty = '';
                        $mamwr_max_qty = '';
                        $min = '';
                        $max = '';

                        $_product =  wc_get_product( $values['data']->get_id());

                        $product_id = $values['data']->get_id();
                        $product_qty = $values['quantity'];
                        $prod_title = $_product->get_title();

                        if( $_product->get_type() == 'variation' ) {
                            $variation_id = $values['variation_id'];
                            $variation = new WC_Product_Variation($variation_id);
                            $var_attributes = array_map('ucfirst', $variation->get_variation_attributes());
                            $variationName = implode(", ", $var_attributes);
                            $prod_title = $_product->get_title().' - '.$variationName;

                            $variation_id = $values['variation_id'];
                            $mamwr_groupvalue = get_post_meta($variation_id, '_mamwr_groupvalue', true);
                            $mamwrmin = get_post_meta($variation_id, '_mamwr_min_qty', true);
                            $mamwrmax = get_post_meta($variation_id, '_mamwr_max_qty', true);

                            $mamwr_min_qty = $mamwrmin;
							$mamwr_max_qty = $mamwrmax;

			                if(empty($mamwrmin) && empty($mamwrmax)) {
			                    if(!empty($mamwr_groupvalue)) {
			                        if(!empty($this->mamwr_groupmanager)) {
                                        foreach ($this->mamwr_groupmanager as $mamwr_gm_key => $mamwr_gm_value) {
    			                            if($mamwr_gm_value['gm_id'] == $mamwr_groupvalue){
    			                                $mamwr_min_qty = $mamwr_gm_value['gm_min_quntity'];
    			                                $mamwr_max_qty = $mamwr_gm_value['gm_max_quntity'];
    			                            }
    			                        }
                                    }
			                    }
			                }

                            if($mamwr_min_qty == '' && $mamwr_max_qty != '') {
                                $mamwr_min_qty = 1;
                                $mamwr_less_than = 'true';
                            }

                            if($mamwr_max_qty == ''  && $mamwr_min_qty != '') {
                                $mamwr_max_qty = 9999999999;
                                $mamwr_greater_than = 'true';
                            }

                            if(!empty($mamwr_min_qty) && !empty($mamwr_max_qty)) {
                                if ($mamwr_min_qty <= $product_qty &&  $mamwr_max_qty >= $product_qty) {
                                } elseif ($mamwr_min_qty >= $product_qty &&  $mamwr_max_qty <= $product_qty) {
                                    if ( is_user_logged_in() && !empty($this->mamwr_roles) ) {
                                        if (in_array($user_roles, $this->mamwr_roles)) {
                                            if($mamwr_greater_than == 'true' ) {
                                                wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $prod_title, $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } elseif ($mamwr_less_than == 'true') {
                                                wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $prod_title, $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } else {
                                                wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $prod_title, $mamwr_min_qty, $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            }
                                        }
                                    } else {
                                        if($mamwr_greater_than == 'true' ) {
                                            wc_add_notice( __(sprintf($this->mamwr_varqtymsg_grtr, $prod_title, $mamwr_min_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } elseif ($mamwr_less_than == 'true') {
                                            wc_add_notice( __(sprintf($this->mamwr_varqtymsg_less, $prod_title, $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } else {
                                            wc_add_notice( __(sprintf($this->mamwr_varqtymsg, $prod_title, $mamwr_min_qty, $mamwr_max_qty), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        }
                                    }
                                }
                            }
                        } else {
                            $mamwr_groupvalue = get_post_meta($product_id, '_mamwr_groupvalue', true);
                            $mamwrmin = get_post_meta($product_id, '_custom_product_number_field_min', true);
                            $mamwrmax = get_post_meta($product_id, '_custom_product_number_field_max', true);

                            if(empty($mamwrmin) && empty($mamwrmax)) {
                                if(!empty($mamwr_groupvalue)) {
                                    if(!empty($this->mamwr_groupmanager)) {
                                        foreach ($this->mamwr_groupmanager as $mamwr_gm_key => $mamwr_gm_value) {
                                            if($mamwr_gm_value['gm_id'] == $mamwr_groupvalue) {
                                                $min = $mamwr_gm_value['gm_min_quntity'];
                                                $max = $mamwr_gm_value['gm_max_quntity'];
                                            }
                                        }
                                    }
                                }
                            } else {
                                $min = $mamwrmin;
                                $max = $mamwrmax;
                            }

                            $mamwr_sngl_less_than = '';
                            $mamwr_sngl_greater_than = '';

                            if($min == '' && $max != '') {
                                $min = 1;
                                $mamwr_sngl_less_than = 'true';
                            }

                            if($max == ''  && $min != '') {
                                $max = 9999999999;
                                $mamwr_sngl_greater_than = 'true';
                            }

                            if(!empty($min) && !empty($max)) {
                                if ($min <= $product_qty &&  $max >= $product_qty) {
                                } else {
                                    if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
                                		if (in_array($user_roles, $this->mamwr_roles)) {
                                            if($mamwr_sngl_greater_than == 'true' ) {
                                                wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $prod_title, $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } elseif ($mamwr_sngl_less_than == 'true') {
                                                wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $prod_title, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            } else {
                                                wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $prod_title, $min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                            }
                                        }
                                    } else {
                                        if($mamwr_sngl_greater_than == 'true' ) {
                                            wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_grtr, $prod_title, $min), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } elseif ($mamwr_sngl_less_than == 'true') {
                                            wc_add_notice( __(sprintf($this->mamwr_singleqtymsg_less, $prod_title, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        } else {
                                            wc_add_notice( __(sprintf($this->mamwr_singleqtymsg, $prod_title, $min, $max), 'min-and-max-quantity-rule-for-woocommerce'), 'error');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        function ocmamqrw_min_max_notice() {
			global $product;
			$product_id = $product->get_id();
			$mamwr_groupvalue = get_post_meta($product_id, '_mamwr_groupvalue', true);
			$mamwrmin = get_post_meta($product_id, '_custom_product_number_field_min', true);
			$mamwrmax = get_post_meta($product_id, '_custom_product_number_field_max', true);
            
			$minqty = $mamwrmin;
			$maxqty = $mamwrmax;

            if(empty($mamwrmin) && empty($mamwrmax)) {
                if(!empty($mamwr_groupvalue)) {
                    if(!empty($this->mamwr_groupmanager)) {
                        foreach ($this->mamwr_groupmanager as $mamwr_gm_key => $mamwr_gm_value) {
                            if($mamwr_gm_value['gm_id'] == $mamwr_groupvalue) {
                                $minqty = $mamwr_gm_value['gm_min_quntity'];
                                $maxqty = $mamwr_gm_value['gm_max_quntity'];
                            }
                        }
                    }
                }
            }

            $mamwr_sngl_less_than = '';
            $mamwr_sngl_greater_than = '';

        	if($minqty == '' && $maxqty != '') {
            	$minqty = 1;
            	$mamwr_sngl_less_than = 'true';
            }

            if($maxqty == '' && $minqty != '') {
            	$maxqty = 9999999999;
            	$mamwr_sngl_greater_than = 'true';
            }

            $qty_notice_single_page = '';


        	if($mamwr_sngl_less_than == 'true') {
                $qty_notice_single_page = __(sprintf($this->mamwr_singleqtymsgbeforeatc_less, $maxqty), 'min-and-max-quantity-rule-for-woocommerce');
            } elseif ($mamwr_sngl_greater_than == 'true') {
                $qty_notice_single_page = __(sprintf($this->mamwr_singleqtymsgbeforeatc_grtr, $minqty), 'min-and-max-quantity-rule-for-woocommerce');
            } else {
                $qty_notice_single_page =  __(sprintf($this->mamwr_singleqtymsgbeforeatc, $minqty, $maxqty), 'min-and-max-quantity-rule-for-woocommerce');
            }

            global $current_user;
            $user_roles = $current_user->roles[0];

            if($qty_notice_single_page != '') {
	            if(!empty($minqty) && !empty($maxqty) ) {
	                if ( is_user_logged_in() && !empty($this->mamwr_roles)) {
						if (in_array($user_roles, $this->mamwr_roles)) {
	                        ?>
	                        <div class="mam_noticeqty">
	                          <p class="mam_qty_notice"><?php echo $qty_notice_single_page; ?></p>
	                        </div>
	                        <?php
	                    }
	                } else {
	                ?>
	                    <div class="mam_noticeqty">
	                      <p class="mam_qty_notice"><?php echo $qty_notice_single_page; ?></p>
	                    </div>
	                <?php
	                }
	            }
	        }
        }
    }
    OCMAMQRW_functionality::OCMAMQRW_instance();
}