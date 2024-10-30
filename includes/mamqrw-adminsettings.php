<?php 

if (!defined('ABSPATH'))
exit;

if (!class_exists('OCMAMQRW_admin_settings')) {
    class OCMAMQRW_admin_settings {

        protected static $OCMAMQRW_instance;

        public static function OCMAMQRW_instance() {
            if (!isset(self::$OCMAMQRW_instance)) {
                self::$OCMAMQRW_instance = new self();
                self::$OCMAMQRW_instance->init();
            }
            return self::$OCMAMQRW_instance;
        }

        function init() {
            //total qty field
            add_action('admin_menu', array($this, 'ocmamqrw_register_my_custom_submenu_page'));
            //Save all admin options
            add_action( 'admin_init',  array($this, 'ocmamqrw_save_options'));
            //admin script load
            add_action('admin_footer', array($this, 'ocmamqrw_admin_footer_script'));
        }

        
        function ocrecursive_sanitize_text_field($array) {
            foreach ( $array as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->ocrecursive_sanitize_text_field($value);
                }else{
                    $value = sanitize_text_field( $value );
                }
            }
            return $array;
        }


        function ocmamqrw_register_my_custom_submenu_page() { 
            add_menu_page( 'Cart Rules', 'Cart Rules', 'manage_options', 'woo-cartrules',array($this, 'ocmamqrw_submenu_page_callback'));
        }


        function ocmamqrw_submenu_page_callback() {
            ?>  
                <div class="mamwr-container">
                    <div class="wrap">
                        <div class="mawr_ratesup_notice_main">
                            <div class="mawr_rateus_notice">
                                <div class="mawr_rtusnoti_left">
                                    <h3>Rate Us</h3>
                                    <label>If you like our plugin, </label>
                                    <a target="_blank" href="https://wordpress.org/support/plugin/min-and-max-quantity-rule-for-woocommerce/reviews/?filter=5">
                                        <label>Please vote us</label>
                                    </a>
                                    <label>, so we can contribute more features for you.</label>
                                </div>
                                <div class="mawr_rtusnoti_right">
                                    <img src="<?php echo OCMAMQRW_PLUGIN_DIR; ?>/images/review.png" class="mawr_review_icon">
                                </div>
                            </div>
                            <div class="mawr_support_notice">
                                <div class="mawr_rtusnoti_left">
                                    <h3>Having Issues?</h3>
                                    <label>You can contact us at</label>
                                    <a target="_blank" href="https://www.xeeshop.com/support-us/?utm_source=aj_plugin&utm_medium=plugin_support&utm_campaign=aj_support&utm_content=aj_wordpress">
                                        <label>Our Support Forum</label>
                                    </a>
                                </div>
                                <div class="mawr_rtusnoti_right">
                                    <img src="<?php echo OCMAMQRW_PLUGIN_DIR; ?>/images/support.png" class="mawr_review_icon">
                                </div>
                            </div>
                        </div>
                        <div class="mawr_donate_main">
                           <img src="<?php echo OCMAMQRW_PLUGIN_DIR; ?>/images/coffee.svg">
                           <h3>Buy me a Coffee !</h3>
                           <p>If you like this plugin, buy me a coffee and help support this plugin !</p>
                           <div class="mawr_donate_form">
                              <a class="button button-primary mawr_donate_btn" href="https://www.paypal.com/paypalme/shayona163/" data-link="https://www.paypal.com/paypalme/shayona163/" target="_blank">Buy me a coffee !</a>
                           </div>
                        </div>
                        <h2><?php echo __( 'Cart Rules', 'min-and-max-quantity-rule-for-woocommerce' );?></h2>
                        <?php if(isset($_REQUEST['message']) && $_REQUEST['message'] == 'success'){ ?>
                            <div class="notice notice-success is-dismissible"> 
                                <p><strong>Record updated successfully.</strong></p>
                            </div>
                        <?php } ?>
                        <div class="mamwr-inner-block">
                            <form method="post" id="mamwr_grpmngform">
                                <?php wp_nonce_field( 'mamwr_nonce_action', 'mamwr_nonce_field' ); ?>
                                <ul class="tabs">
                                    <li class="tab-link current" data-tab="mamwr-tab-general"><?php echo __( 'General Settings', 'min-and-max-quantity-rule-for-woocommerce' );?></li>
                                    <li class="tab-link" data-tab="mamwr-tab-cart"><?php echo __( 'Cart Settings', 'min-and-max-quantity-rule-for-woocommerce' );?></li>
                                    <li class="tab-link" data-tab="mamwr-tab-group"><?php echo __( 'Groups Manager Settings', 'min-and-max-quantity-rule-for-woocommerce' );?></li>
                                    <li class="tab-link" data-tab="mamwr-tab-messages"><?php echo __( 'Messages Settings', 'min-and-max-quantity-rule-for-woocommerce' );?></li>
                                </ul>
                                <div id="mamwr-tab-general" class="tab-content current">
                                    <fieldset>
                                        <p>
                                            <label>
                                              <?php
                                                  $mamwr_enabled = empty(get_option( 'mamwr_enabled' )) ? 'no' : get_option( 'mamwr_enabled' );
                                              ?>
                                             <input type="checkbox" name="mamwr_enabled" value="yes" <?php if ($mamwr_enabled == "yes") {echo 'checked="checked"';} ?>><strong><?php echo __( 'Enable/Disable This Plugin', 'min-and-max-quantity-rule-for-woocommerce' ); ?></strong>
                                            </label>
                                        </p>
                                        <div class="mamwr-top">
                                            <p class="mamwr-heading"><?php echo __( 'General options', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                            <p class="mamwr-tips"><?php echo __( "Here is general options. These works for all settings.", 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                        </div>
                                        <table class="form-table">
                                            <tbody>
                                                <tr class="form-field">
                                                    <th scope="row">
                                                        <label><?php echo __( 'User Role', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <select name="mamwr_roles[]" id="mamwr_roles" multiple>
                                                            <?php 
                                                                global $wp_roles;
                                                                $inbultroles = $wp_roles->get_names();
                                                                foreach ($inbultroles as $inbultkey => $inbultvalue) {
                                                                    echo "<option value='".$inbultkey."' ".(!in_array($inbultkey, get_option( 'mamwr_roles', array()))).'selected="selected"'.">".$inbultvalue."</option>";
                                                                }
                                                            ?>
                                                        </select> 
                                                        <p class="mamwr-tips"><?php _e('If user role is not selected than rules apply for all user roles.','min-and-max-quantity-rule-for-woocommerce'); ?></p>
                                                    </td>
                                                </tr>
                                                <tr class="form-field">
                                                    <th scope="row">
                                                        
                                                    </th>
                                                    <td>
                                                        <label>
                                                            <?php
                                                                // $mamwr_notapplyvisitors = get_option( 'mamwr_notapplyvisitors' );
                                                                 $mamwr_notapplyvisitors = empty(get_option( 'mamwr_notapplyvisitors' )) ? 'no' : get_option( 'mamwr_notapplyvisitors' );
                                                            ?>
                                                            <input type="checkbox" name="mamwr_notapplyvisitors" value="yes" <?php if ($mamwr_notapplyvisitors == "yes" ) {echo 'checked="checked"';} ?>><?php echo __( 'If checked then rules will not apply for visitors.', 'min-and-max-quantity-rule-for-woocommerce' ); ?>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr class="form-field">
                                                    <th scope="row">
                                                        <label><?php echo __( 'Hide Checkout Button', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <label>
                                                            <?php
                                                                $mamwr_hidecheckoutbtn = empty(get_option( 'mamwr_hidecheckoutbtn' )) ? 'no' : get_option( 'mamwr_hidecheckoutbtn' );
                                                            ?>
                                                            <input type="checkbox" name="mamwr_hidecheckoutbtn" value="yes" disabled=""><?php echo __( 'Hide checkout button if minimum or maximum condition not passed.', 'min-and-max-quantity-rule-for-woocommerce' ); ?>
                                                            <label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div id="mamwr-tab-cart" class="tab-content">
                                    <fieldset>
                                        <div class="mamwr-top">
                                            <p class="mamwr-heading"><?php echo __( 'Cart Page', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                            <p class="mamwr-tips"><?php echo __( 'Set rules for cart page.', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                        </div>
                                        <table class="form-table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Minimum Quantity', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <input type="number"  min="0" name="min_cart_quntity" value="<?php echo get_option( 'min_cart_quntity' ); ?>" id="min_cart_quntity" class="small-text ltr">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Maximum Quantity', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <input type="number"  min="0" name="max_cart_quntity" value="<?php echo get_option( 'max_cart_quntity' ); ?>" id="max_cart_quntity" class="small-text ltr">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Minimum Cost', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <input type="number"  min="0" name="mamwr_minprice" value="<?php echo get_option( 'mamwr_minprice' ); ?>" id="mamwr_minprice" class="small-text ltr">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Maximum Cost', 'min-and-max-quantity-rule-for-woocommerce' );?></label>
                                                    </th>
                                                    <td>
                                                        <input type="number"  min="0" name="mamwr_maxprice" value="<?php echo get_option( 'mamwr_maxprice' ); ?>" id="mamwr_maxprice" class="small-text ltr">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div id="mamwr-tab-group" class="tab-content">
                                    <fieldset>
                                        <div class="mamwr-top">
                                            <p class="mamwr-heading"><?php echo __( 'Groups Manager', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                            <p class="mamwr-tips"><?php echo __( 'Create group for min and max rules (price and quantity). You can apply group to any product.', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                            <p class="mamwr-tips"><?php echo __( 'You can select group while creating or editing product at General (tab)->Groups Manager (field).', 'min-and-max-quantity-rule-for-woocommerce' );?></p>
                                        </div>
                                        <?php $mamwr_groupmanager = get_option( 'mamwr_groupmanager' ); ?>
                                        <table class="mamwr_groping_pro">
                                            <thead>
                                                <tr>
                                                    <th>Group Name ( Required ) </th>
                                                    <th>Minimum Quantity</th>
                                                    <th>Maximum Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(!empty($mamwr_groupmanager)){
                                                        foreach ($mamwr_groupmanager as $mamwr_groupmanager_key => $mamwr_groupmanager_value) { 
                                                            ?>
                                                            <tr class="form-field">
                                                                <td>
                                                                    <input type="text" name="gm_name[]" value="<?php echo $mamwr_groupmanager_value['gm_name']; ?>" id="gm_name">
                                                                </td>
                                                                <td>
                                                                    <input type="number"  min="0" name="gm_min_quntity[]" value="<?php echo $mamwr_groupmanager_value['gm_min_quntity']; ?>" id="gm_min_quntity" class="small-text ltr">
                                                                </td>
                                                                <td>
                                                                    <input type="number"  min="0" name="gm_max_quntity[]" value="<?php echo $mamwr_groupmanager_value['gm_max_quntity']; ?>" id="gm_max_quntity" class="small-text ltr">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);" class="gm_add_button">
                                                                        <img src="<?php echo esc_url( OCMAMQRW_PLUGIN_DIR.'/images/list-add.svg');?>" style="height: 15px;"/>
                                                                    </a>
                                                                </td>
                                                                <?php if($mamwr_groupmanager_key != 0){?>
                                                                    <td>
                                                                        <a href="javascript:void(0);" class="gm_remove_button">
                                                                            <img src="<?php echo esc_url( OCMAMQRW_PLUGIN_DIR.'/images/list-remove.svg');?>" style="height: 15px;"/>
                                                                        </a>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <?php 
                                                        } 
                                                    } else { 

                                                        ?>
                                                        <tr class="form-field">
                                                            <td>
                                                                <input type="text" name="gm_name[]" id="gm_name" value="Group 1">
                                                            </td>
                                                            <td>
                                                                <input type="number"  min="0" name="gm_min_quntity[]" value="<?php echo get_option( 'gm_min_quntity' ); ?>" id="gm_min_quntity" class="small-text ltr">
                                                            </td>
                                                            <td>
                                                                <input type="number"  min="0" name="gm_max_quntity[]" value="<?php echo get_option( 'gm_max_quntity' ); ?>" id="gm_max_quntity" class="small-text ltr">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0);" class="gm_add_button">
                                                                    <img src="<?php echo esc_url( OCMAMQRW_PLUGIN_DIR.'/images/list-add.svg');?>" style="height: 15px;"/>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div id="mamwr-tab-messages" class="tab-content">
                                    <fieldset>
                                        <div class="mamwr-top">
                                            <p class="mamwr-heading"><?php echo __( 'Messages', OCMAMQRW_PLUGIN_DIR );?></p>
                                            <p class="mamwr-tips"><?php echo __( 'Error message templates', OCMAMQRW_PLUGIN_DIR );?></p>
                                            <p class="mamwr-tips"><?php echo __( 'Never change or remove %u and %s type of character in sentence', OCMAMQRW_PLUGIN_DIR );?></p>
                                        </div>
                                        <table class="form-table">
                                            <tbody>
                                            	<tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message Notice ( Simple Product - before add to cart button) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_singleqtymsgbeforeatc = empty(get_option( 'mamwr_singleqtymsgbeforeatc' )) ? 'Qty must be between %u and %u' : get_option( 'mamwr_singleqtymsgbeforeatc' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_singleqtymsgbeforeatc" value="<?php echo $mamwr_singleqtymsgbeforeatc; ?>" id="mamwr_singleqtymsgbeforeatc" class="mamwr_msg">
	                                                </td>
	                                            </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Quantity Message Notice ( Simple Product - before add to cart button - when only min qty set) ', OCMAMQRW_PLUGIN_DIR );?></label>
                                                    </th>
                                                    <td>
                                                      <?php
                                                         $mamwr_singleqtymsgbeforeatc_grtr = empty(get_option( 'mamwr_singleqtymsgbeforeatc_grtr' )) ? 'Qty must be greater than or equal to %u' : get_option( 'mamwr_singleqtymsgbeforeatc_grtr' );
                                                      ?>
                                                        <input type="text" name="mamwr_singleqtymsgbeforeatc_grtr" value="<?php echo $mamwr_singleqtymsgbeforeatc_grtr; ?>" id="mamwr_singleqtymsgbeforeatc_grtr" class="mamwr_msg">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label><?php echo __( 'Quantity Message Notice ( Simple Product - before add to cart button - when only max qty set) ', OCMAMQRW_PLUGIN_DIR );?></label>
                                                    </th>
                                                    <td>
                                                        <input type="text" name="mamwr_singleqtymsgbeforeatc_less" value="Qty must be less than or equal to %u" id="mamwr_singleqtymsgbeforeatc_less" class="mamwr_msg" disabled="">
                                                        <label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
                                                    </td>
                                                </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Simple Product ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_singleqtymsg = empty(get_option( 'mamwr_singleqtymsg' )) ? '%s product quantity must be between %u and %u' : get_option( 'mamwr_singleqtymsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_singleqtymsg" value="<?php echo $mamwr_singleqtymsg; ?>" id="mamwr_singleqtymsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Simple Product - when only min qty set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_singleqtymsg_grtr = empty(get_option( 'mamwr_singleqtymsg_grtr' )) ? '%s product quantity must be greater than or equal to %u' : get_option( 'mamwr_singleqtymsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_singleqtymsg_grtr" value="<?php echo $mamwr_singleqtymsg_grtr; ?>" id="mamwr_singleqtymsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Simple Product - when only max qty set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                    <input type="text" name="mamwr_singleqtymsg_less" value="%s product quantity must be less than or equal to %u" id="mamwr_singleqtymsg_less" class="mamwr_msg" disabled="">
	                                                	<label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Variation Product ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_varqtymsg = empty(get_option( 'mamwr_varqtymsg' )) ? '%s variation product quantity must be between %u and %u' : get_option( 'mamwr_varqtymsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_varqtymsg" value="<?php echo $mamwr_varqtymsg; ?>" id="mamwr_varqtymsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Variation Product - when only min qty set )  ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_varqtymsg_grtr = empty(get_option( 'mamwr_varqtymsg_grtr' )) ? '%s variation product quantity must be greater than or equal to %u' : get_option( 'mamwr_varqtymsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_varqtymsg_grtr" value="<?php echo $mamwr_varqtymsg_grtr; ?>" id="mamwr_varqtymsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Variation Product - when only max qty set )  ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                    <input type="text" name="mamwr_varqtymsg_less" value="%s variation product quantity must be less than or equal to %u" id="mamwr_varqtymsg_less" class="mamwr_msg" disabled="">
	                                                    <label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
	                                                </td>
	                                            </tr>
	                                            <tr>
                                                    <th scope="row">
                                                        <label>
                                                            <?php echo __( 'General Quantity Message', OCMAMQRW_PLUGIN_DIR );?>
                                                        </label>
                                                    </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_qtymsg = empty(get_option( 'mamwr_qtymsg' )) ? 'Total quantity must be between %u and %u' : get_option( 'mamwr_qtymsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_qtymsg" value="<?php echo $mamwr_qtymsg; ?>" id="mamwr_qtymsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
                                                    <th scope="row">
                                                        <label>
                                                            <?php echo __( 'General Quantity Message ( when only min qty set )', OCMAMQRW_PLUGIN_DIR );?>
                                                        </label>
                                                    </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_qtymsg_grtr = empty(get_option( 'mamwr_qtymsg_grtr' )) ? 'Total quantity must be greater than or equal to %u' : get_option( 'mamwr_qtymsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_qtymsg_grtr" value="<?php echo $mamwr_qtymsg_grtr; ?>" id="mamwr_qtymsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
                                                    <th scope="row">
                                                        <label>
                                                            <?php echo __( 'General Quantity Message ( when only max qty set )', OCMAMQRW_PLUGIN_DIR );?>
                                                        </label>
                                                    </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_qtymsg_less = empty(get_option( 'mamwr_qtymsg_less' )) ? 'Total quantity must be less than or equal to %u' : get_option( 'mamwr_qtymsg_less' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_qtymsg_less" value="<?php echo $mamwr_qtymsg_less; ?>" id="mamwr_qtymsg_less" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'General Cost Message', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_pricemsg = empty(get_option( 'mamwr_pricemsg' )) ? 'Total cost of products must be between %s and %s' : get_option( 'mamwr_pricemsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_pricemsg" value="<?php echo $mamwr_pricemsg; ?>" id="mamwr_pricemsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'General Cost Message ( when only min cost set )', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_pricemsg_grtr = empty(get_option( 'mamwr_pricemsg_grtr' )) ? 'Total cost of products must be greater than or equal to %s' : get_option( 'mamwr_pricemsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_pricemsg_grtr" value="<?php echo $mamwr_pricemsg_grtr; ?>" id="mamwr_pricemsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'General Cost Message ( when only max cost set )', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_pricemsg_less = empty(get_option( 'mamwr_pricemsg_less' )) ? 'Total cost of products must be less than or equal to %s' : get_option( 'mamwr_pricemsg_less' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_pricemsg_less" value="<?php echo $mamwr_pricemsg_less; ?>" id="mamwr_pricemsg_less" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Category Wise ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_catqtymsg = empty(get_option( 'mamwr_catqtymsg' )) ? 'Category %s products quantity must be between %u and %u' : get_option( 'mamwr_catqtymsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_catqtymsg" value="<?php echo $mamwr_catqtymsg; ?>" id="mamwr_catqtymsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Category Wise - when only min qty set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_catqtymsg_grtr = empty(get_option( 'mamwr_catqtymsg_grtr' )) ? 'Category %s products quantity must be greater than or equal to %u' : get_option( 'mamwr_catqtymsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_catqtymsg_grtr" value="<?php echo $mamwr_catqtymsg_grtr; ?>" id="mamwr_catqtymsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Quantity Message ( Category Wise - when only max qty set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                    <input type="text" name="mamwr_catqtymsg_less" value="Category %s products quantity must be less than or equal to %u" id="mamwr_catqtymsg_less" class="mamwr_msg" disabled>
	                                                    <label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Cost Message ( Category Wise ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_pricecatmsg = empty(get_option( 'mamwr_pricecatmsg' )) ? 'Category %s products total cost must be between %s and %s' : get_option( 'mamwr_pricecatmsg' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_pricecatmsg" value="<?php echo $mamwr_pricecatmsg; ?>" id="mamwr_pricecatmsg" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Cost Message ( Category Wise - when only min cost set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                  <?php
	                                                     $mamwr_pricecatmsg_grtr = empty(get_option( 'mamwr_pricecatmsg_grtr' )) ? 'Category %s products total cost must be greater than or equal to %s' : get_option( 'mamwr_pricecatmsg_grtr' );
	                                                  ?>
	                                                    <input type="text" name="mamwr_pricecatmsg_grtr" value="<?php echo $mamwr_pricecatmsg_grtr; ?>" id="mamwr_pricecatmsg_grtr" class="mamwr_msg">
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <th scope="row">
	                                                    <label><?php echo __( 'Cost Message ( Category Wise - when only max cost set ) ', OCMAMQRW_PLUGIN_DIR );?></label>
	                                                </th>
	                                                <td>
	                                                    <input type="text" name="mamwr_pricecatmsg_less" value="Category %s products total cost must be less than or equal to %s" id="mamwr_pricecatmsg_less" class="mamwr_msg" disabled="">
	                                                    <label class="mamwr_pro_link mamwr_pro_link_fw">Only available in pro version <a href="https://www.xeeshop.com/product/min-and-max-quantity-rule-woocommerce/" target="_blank">link</a></label>
	                                                </td>
	                                            </tr>
                                          	</tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <input type="hidden" name="ocmamqrw_action" value="ocmamqrw_save_option_data"/>
                                <input type="submit" value="Save changes" name="submit" class="button-primary" id="mamwr-btn-space">
                            </form>
                        </div>
                    </div>
                </div>
            <?php 
        }

        // Save Setting Option
        function ocmamqrw_save_options() {
            if( current_user_can('administrator') ) {
                if(isset($_REQUEST['ocmamqrw_action']) && $_REQUEST['ocmamqrw_action'] == 'ocmamqrw_save_option_data'){
                    if(!isset( $_POST['mamwr_nonce_field'] ) || !wp_verify_nonce( $_POST['mamwr_nonce_field'], 'mamwr_nonce_action' ) ) {
                        print 'Sorry, your nonce did not verify.';
                        exit;
                    }else{
                        $ocmamqrw_enabled = (!empty(sanitize_text_field( $_REQUEST['mamwr_enabled'] )))? sanitize_text_field( $_REQUEST['mamwr_enabled'] ) : 'no';
                        update_option('mamwr_enabled',$ocmamqrw_enabled, 'yes');

                        $mamwr_notapplyvisitors = (!empty(sanitize_text_field( $_REQUEST['mamwr_notapplyvisitors'] )))? sanitize_text_field( $_REQUEST['mamwr_notapplyvisitors'] ) : 'no';
                        update_option('mamwr_notapplyvisitors',$mamwr_notapplyvisitors, 'yes'); 

                        $ocmamqrw_min_cart_quntity = sanitize_text_field( $_REQUEST['min_cart_quntity']);
                        update_option('min_cart_quntity',$ocmamqrw_min_cart_quntity, 'yes');

                        $ocmamqrw_max_cart_quntity = sanitize_text_field( $_REQUEST['max_cart_quntity']);
                        update_option('max_cart_quntity',$ocmamqrw_max_cart_quntity, 'yes');

                        $ocmamqrw_minprice = sanitize_text_field( $_REQUEST['mamwr_minprice']);
                        update_option('mamwr_minprice',$ocmamqrw_minprice, 'yes');

                        $ocmamqrw_maxprice = sanitize_text_field( $_REQUEST['mamwr_maxprice']);
                        update_option('mamwr_maxprice',$ocmamqrw_maxprice, 'yes');

                        $ocmamqrw_roles = $this->ocrecursive_sanitize_text_field( $_REQUEST['mamwr_roles']);

                        if($ocmamqrw_roles == '') {
                            $ocmamqrw_roles = array();
                        }

                        update_option('mamwr_roles', $ocmamqrw_roles, 'yes');

                        $ocmamqrw_pricemsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_pricemsg'] )))? sanitize_text_field( $_REQUEST['mamwr_pricemsg'] ) : 'Total cost of products must between in %u to %u';
                        update_option('mamwr_pricemsg',$ocmamqrw_pricemsg, 'yes');

                        $ocmamqrw_pricemsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_pricemsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_pricemsg_grtr'] ) : 'Total cost of products must greater than or equal to %u';
                        update_option('mamwr_pricemsg_grtr',$ocmamqrw_pricemsg_grtr, 'yes');

                        $ocmamqrw_pricemsg_less = (!empty(sanitize_text_field( $_REQUEST['mamwr_pricemsg_less'] )))? sanitize_text_field( $_REQUEST['mamwr_pricemsg_less'] ) : 'Total cost of products must less than or equal to %u';
                        update_option('mamwr_pricemsg_less',$ocmamqrw_pricemsg_less, 'yes');

                        $ocmamqrw_qtymsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_qtymsg'] )))? sanitize_text_field( $_REQUEST['mamwr_qtymsg'] ) : 'Total quantity must between in %u to %u';
                        update_option('mamwr_qtymsg',$ocmamqrw_qtymsg, 'yes');

                        $ocmamqrw_qtymsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_qtymsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_qtymsg_grtr'] ) : 'Total quantity must be greater than or equal to %u';
                        update_option('mamwr_qtymsg_grtr',$ocmamqrw_qtymsg_grtr, 'yes');

                        $ocmamqrw_qtymsg_less = (!empty(sanitize_text_field( $_REQUEST['mamwr_qtymsg_less'] )))? sanitize_text_field( $_REQUEST['mamwr_qtymsg_less'] ) : 'Total quantity must be less than or equal to %u';
                        update_option('mamwr_qtymsg_less',$ocmamqrw_qtymsg_less, 'yes');

                        $mamwr_singleqtymsgbeforeatc = (!empty(sanitize_text_field( $_REQUEST['mamwr_singleqtymsgbeforeatc'] )))? sanitize_text_field( $_REQUEST['mamwr_singleqtymsgbeforeatc'] ) : 'Qty must be between %u and %u';
                        update_option('mamwr_singleqtymsgbeforeatc',$mamwr_singleqtymsgbeforeatc, 'yes');

                        $mamwr_singleqtymsgbeforeatc_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_singleqtymsgbeforeatc_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_singleqtymsgbeforeatc_grtr'] ) : 'Qty must be greater than or equal to %u';
                        update_option('mamwr_singleqtymsgbeforeatc_grtr',$mamwr_singleqtymsgbeforeatc_grtr, 'yes');
                        
                        $ocmamqrw_singleqtymsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_singleqtymsg'] )))? sanitize_text_field( $_REQUEST['mamwr_singleqtymsg'] ) : '%s product quantity must between in %u to %u';
                        update_option('mamwr_singleqtymsg',$ocmamqrw_singleqtymsg, 'yes');

                        $ocmamqrw_singleqtymsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_singleqtymsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_singleqtymsg_grtr'] ) : '%s product quantity must be greater than or equal to %u';
                        update_option('mamwr_singleqtymsg_grtr',$ocmamqrw_singleqtymsg_grtr, 'yes');

                        $ocmamqrw_catqtymsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_catqtymsg'] )))? sanitize_text_field( $_REQUEST['mamwr_catqtymsg'] ) : 'Category %s products quantity must between in %u to %u';
                        update_option('mamwr_catqtymsg',$ocmamqrw_catqtymsg, 'yes');

                        $ocmamqrw_catqtymsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_catqtymsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_catqtymsg_grtr'] ) : 'Category %s products quantity must greater than or equal to %u';
                        update_option('mamwr_catqtymsg_grtr',$ocmamqrw_catqtymsg_grtr, 'yes');

                        $ocmamqrw_varqtymsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_varqtymsg'] )))? sanitize_text_field( $_REQUEST['mamwr_varqtymsg'] ) : '%s variation product quantity must between in %u to %u';
                        update_option('mamwr_varqtymsg',$ocmamqrw_varqtymsg, 'yes');

                        $ocmamqrw_varqtymsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_varqtymsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_varqtymsg_grtr'] ) : '%s variation product quantity must be greater than or equal to %u';
                        update_option('mamwr_varqtymsg_grtr',$ocmamqrw_varqtymsg_grtr, 'yes');

                        $gm_name = $this->ocrecursive_sanitize_text_field( $_REQUEST['gm_name']);
                        $gm_min_quntity = $this->ocrecursive_sanitize_text_field( $_REQUEST['gm_min_quntity']);
                        $gm_max_quntity = $this->ocrecursive_sanitize_text_field( $_REQUEST['gm_max_quntity']);

                        $mamwr_groupmanager = array();
                        if (!empty($gm_name)){

                            for($i=0;$i<count($gm_name);$i++){

                                if($gm_name[$i]!="" || $gm_min_quntity[$i]!="" || $gm_max_quntity[$i]!="") {

                                    $mamwr_groupmanager[$i] = array(
                                        'gm_id'=>$i+1,
                                        'gm_name' => $gm_name[$i],
                                        'gm_min_quntity' => $gm_min_quntity[$i],
                                        'gm_max_quntity' => $gm_max_quntity[$i]
                                    );
                                }
                            }
                            update_option('mamwr_groupmanager',$mamwr_groupmanager,'yes');
                        }

                        
                       

                        $ocmamqrw_pricecatmsg = (!empty(sanitize_text_field( $_REQUEST['mamwr_pricecatmsg'] )))? sanitize_text_field( $_REQUEST['mamwr_pricecatmsg'] ) : 'Category %s products total cost must between in %s to %s';
                        update_option('mamwr_pricecatmsg',$ocmamqrw_pricecatmsg, 'yes');

                        $ocmamqrw_pricecatmsg_grtr = (!empty(sanitize_text_field( $_REQUEST['mamwr_pricecatmsg_grtr'] )))? sanitize_text_field( $_REQUEST['mamwr_pricecatmsg_grtr'] ) : 'Category %s products total cost must be greater than or equal to %s';
                        update_option('mamwr_pricecatmsg_grtr',$ocmamqrw_pricecatmsg_grtr, 'yes');

                        $ocmamqrw_extrafees = (!empty(sanitize_text_field( $_REQUEST['mamwr_extrafees'] )))? sanitize_text_field( $_REQUEST['mamwr_extrafees'] ) : 'no';
                        update_option('mamwr_extrafees',$ocmamqrw_extrafees, 'yes');

                        wp_redirect( admin_url( 'admin.php?page=woo-cartrules&message=success') ); exit;
                    }
                }
            }
        }

        function ocmamqrw_admin_footer_script() {
            ?>
                <script type="text/javascript">

                    var wrapper = jQuery('.mamwr_groping_pro'); //Input field wrapper

                    var fieldHTML = '<tr class="form-field"><td><input type="text" name="gm_name[]" id="gm_name"></td><td><input type="number"  min="0" name="gm_min_quntity[]"  id="gm_min_quntity" class="small-text ltr"></td><td><input type="number"  min="0" name="gm_max_quntity[]" id="gm_max_quntity" class="small-text ltr"></td><td><a href="javascript:void(0);" class="gm_add_button"><img src="<?php echo esc_url( OCMAMQRW_PLUGIN_DIR.'/images/list-add.svg');?>" style="height: 15px;"/></a></td><td><a href="javascript:void(0);" class="gm_remove_button"><img src="<?php echo esc_url( OCMAMQRW_PLUGIN_DIR.'/images/list-remove.svg');?>" style="height: 15px;"/></a></td></tr>';


                    jQuery(wrapper).on('click', '.gm_add_button', function(e) {
                        e.preventDefault();
                        jQuery(wrapper).append(fieldHTML); //Add field html   
                    });

                    jQuery(wrapper).on('click', '.gm_remove_button', function(e) {
                        e.preventDefault();
                        jQuery(this).closest('tr').remove(); //Remove field html
                    });
                </script>
            <?php
        }
    }
    OCMAMQRW_admin_settings::OCMAMQRW_instance();
}