<?php 

if (!defined('ABSPATH'))
exit;

if (!class_exists('OCMAMQRW_pro_cat_other_settings')) {

    class OCMAMQRW_pro_cat_other_settings {

        protected static $OCMAMQRW_instance;

        // For multiple value
        function mamrecursive_sanitize_text_field($array) {
            foreach ( $array as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->mamrecursive_sanitize_text_field($value);
                } else {
                    $value = sanitize_text_field( $value );
                }
            }
            return $array;
        }


        /* ADD FIELD IN CATEGORY- UPDATE FIELD AND SAVE FIELD */
        function ocmamqrw_add_new_meta_field() {
            ?>

            <div class="form-field">
                <label for="mam_p_min_qty"><?php _e('Minimum Quantity', 'min-and-max-quantity-rule-for-woocommerce'); ?></label>
                <input type="number" name="mam_p_min_qty" id="mam_p_min_qty">
            </div>
            <div class="form-field">
                <label for="mam_p_max_qty"><?php _e('Maximum Quantity', 'min-and-max-quantity-rule-for-woocommerce'); ?></label>
                <input type="number" name="mam_p_max_qty" id="mam_p_max_qty">
            </div>
            <div class="form-field">
                <label for="mamwr_minprice"><?php _e('Minimum Cost', 'min-and-max-quantity-rule-for-woocommerce'); ?></label>
                <input type="number" name="mamwr_minprice" id="mamwr_minprice">
            </div>
            <div class="form-field">
                <label for="mamwr_maxprice"><?php _e('Maximum Cost', 'min-and-max-quantity-rule-for-woocommerce'); ?></label>
                <input type="number" name="mamwr_maxprice" id="mamwr_maxprice">
            </div>
            <?php
        }


        //Product Cat Edit page
        function ocmamqrw_taxonomy_edit_meta_field($term) {

            //getting term ID
            $term_id = $term->term_id;

            // retrieve the existing value(s) for this meta field.
            $mam_p_min_qty = get_term_meta($term_id, 'mam_p_min_qty', true);
            $mam_p_max_qty = get_term_meta($term_id, 'mam_p_max_qty', true);
            $mamwr_minprice = get_term_meta($term_id, 'mamwr_minprice', true);
            $mamwr_maxprice = get_term_meta($term_id, 'mamwr_maxprice', true);
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="mam_p_min_qty"><?php _e('Minimum Quantity', 'min-and-max-quantity-rule-for-woocommerce'); ?></label></th>
                <td>
                    <input type="number" name="mam_p_min_qty" id="mam_p_min_qty" value="<?php echo sanitize_text_field($mam_p_min_qty) ? sanitize_text_field($mam_p_min_qty) : ''; ?>">
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="mam_p_max_qty"><?php _e('Maximum Quantity', 'min-and-max-quantity-rule-for-woocommerce'); ?></label></th>
                <td>
                    <input type="number" name="mam_p_max_qty" id="mam_p_max_qty" value="<?php echo sanitize_text_field($mam_p_max_qty) ? sanitize_text_field($mam_p_max_qty) : ''; ?>">
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="mamwr_minprice"><?php _e('Minimum Cost', 'min-and-max-quantity-rule-for-woocommerce'); ?></label></th>
                <td>
                    <input type="number" name="mamwr_minprice" id="mamwr_minprice" value="<?php echo sanitize_text_field($mamwr_minprice) ? sanitize_text_field($mamwr_minprice) : ''; ?>">
                </td>

            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="mamwr_maxprice"><?php _e('Maximum Cost', 'min-and-max-quantity-rule-for-woocommerce'); ?></label></th>
                <td>
                    <input type="number" name="mamwr_maxprice" id="mamwr_maxprice" value="<?php echo sanitize_text_field($mamwr_maxprice) ? sanitize_text_field($mamwr_maxprice) : ''; ?>">
                </td>
            </tr>
            <?php
        }


        function ocmamqrw_product_custom_fields_save($post_id) {
            
            $woocommerce_custom_product_number_field_min = sanitize_text_field($_POST['_custom_product_number_field_min']);
            if (isset($woocommerce_custom_product_number_field_min))
                update_post_meta($post_id, '_custom_product_number_field_min', $woocommerce_custom_product_number_field_min);

            $woocommerce_custom_product_number_field_max = sanitize_text_field($_POST['_custom_product_number_field_max']);
            if (isset($woocommerce_custom_product_number_field_max))
                update_post_meta($post_id, '_custom_product_number_field_max', $woocommerce_custom_product_number_field_max);

            $_mamwr_groupvalue = sanitize_text_field($_POST['_mamwr_groupvalue']);
            if (isset($_mamwr_groupvalue))
                update_post_meta($post_id, '_mamwr_groupvalue', $_mamwr_groupvalue);

        }

        // Save extra taxonomy fields callback function.
        function ocmamqrw_save_taxonomy_custom_meta($term_id) {

            $mam_p_min_qty = sanitize_text_field($_REQUEST['mam_p_min_qty']);
            if (isset($mam_p_min_qty))
            update_term_meta($term_id, 'mam_p_min_qty', $mam_p_min_qty);

            $mamwr_minprice = sanitize_text_field($_REQUEST['mamwr_minprice']);
            if (isset($mamwr_minprice))
            update_term_meta($term_id, 'mamwr_minprice', $mamwr_minprice);

            $mamwr_maxprice = sanitize_text_field($_REQUEST['mamwr_maxprice']);
            if (isset($mamwr_maxprice))
            update_term_meta($term_id, 'mamwr_maxprice', $mamwr_maxprice);

            $mam_p_max_qty = sanitize_text_field($_REQUEST['mam_p_max_qty']);
            if (isset($mam_p_max_qty))
            update_term_meta($term_id, 'mam_p_max_qty', $mam_p_max_qty);
        }


        function ocmamqrw_product_custom_fields() {
            global $woocommerce, $post;
            $mamwr_groupmanager = get_option( 'mamwr_groupmanager' );
            echo '<div class="product_custom_field">';
	            if(!empty($mamwr_groupmanager)) {
	                echo '<p class="form-field"><label for="_mamwr_groupvalue">'. __('Groups Manager', 'min-and-max-quantity-rule-for-woocommerce').'</label>';
	                echo '<select name="_mamwr_groupvalue" id="_mamwr_groupvalue">';
	                    $mamwr_groupvalue = get_post_meta($post->ID, '_mamwr_groupvalue', true); ?>
	                    <option value="" <?php if(empty($mamwr_groupvalue)){ echo "selected"; }?>>Select Group</option>
	                    <?php
	                    foreach ($mamwr_groupmanager as $mamwr_groupmanager_key => $mamwr_groupmanager_value) { 
	                        if(!empty($mamwr_groupmanager_value['gm_id'])){
	                            ?>
	                                <option value="<?php echo $mamwr_groupmanager_value['gm_id']; ?>" <?php if($mamwr_groupmanager_value['gm_id'] == $mamwr_groupvalue){ echo "selected"; }?>><?php echo $mamwr_groupmanager_value['gm_name']; ?></option>
	                            <?php
	                        }
	                    }
	                echo '</select></p>';
	                echo '<p class="form-field">If both minimum and maximum quantity are not set then only group conditions will work.</p>';
	            }

	            // Custom Product Text Field
	            woocommerce_wp_text_input(
	                array(
	                    'id' => '_custom_product_number_field_min',
	                    'label' => __('Minimum Quantity', 'min-and-max-quantity-rule-for-woocommerce'),
	                    'type' => 'number',
	                    'custom_attributes' => array(
	                        'step' => 'any',
	                        'min' => '0'
	                    )
	                )
	            );

	            //Custom Product Number Field
	            woocommerce_wp_text_input(
	                array(
	                    'id' => '_custom_product_number_field_max',
	                    'label' => __('Maximum Quantity', 'min-and-max-quantity-rule-for-woocommerce'),
	                    'type' => 'number',
	                    'custom_attributes' => array(
	                        'step' => 'any',
	                        'min' => '0'
	                    )
	                )
	            );

            echo '</div>';
        }

     
        function ocmamqrw_variation_settings_fields( $loop, $variation_data, $variation ) {
            $mamwr_groupmanager = get_option( 'mamwr_groupmanager' );
            
            echo '<div class="product_custom_field">';
            
            if(!empty($mamwr_groupmanager)) {
                
                echo '<p class="form-field"><label for="_mamwr_groupvalue">'. __('Groups Manager', 'min-and-max-quantity-rule-for-woocommerce').'</label>';
                echo '<select class="mawr_vargrp" name="_mamwr_groupvalue[' . $variation->ID . ']" id="_mamwr_groupvalue[' . $variation->ID . ']">';

                $mamwr_groupvalue = get_post_meta($variation->ID, '_mamwr_groupvalue', true);
                ?>

                <option value="">Select Group</option>

                <?php
                foreach ($mamwr_groupmanager as $mamwr_groupmanager_key => $mamwr_groupmanager_value) {
                    if(!empty($mamwr_groupmanager_value['gm_id'])) {
                        ?>
                            <option value="<?php echo $mamwr_groupmanager_value['gm_id']; ?>" <?php if($mamwr_groupmanager_value['gm_id'] == $mamwr_groupvalue) { echo "selected"; } ?>><?php echo $mamwr_groupmanager_value['gm_name']; ?></option>
                        <?php
                    }
                }

                echo '</select></p>';
                echo '<p class="form-field">If both minimum and maximum quantity are not set then only group conditions will work.</p>';
            }

            // Minimum Quantity
            woocommerce_wp_text_input( 
                array( 
                    'id'          => '_mamwr_min_qty[' . $variation->ID . ']', 
                    'type'        => 'number',
                    'label'       => __( 'Minimum Quantity', 'woocommerce' ), 
                    'desc_tip'    => 'true',
                    'description' => __( 'Enter the minimum quantity here.', 'woocommerce' ),
                    'value'       => get_post_meta( $variation->ID, '_mamwr_min_qty', true ),
                    'custom_attributes' => array(
                        'step'   => 'any',
                        'min' => '0'
                    ) 
                )
            );

            // Maximum Quantity
            woocommerce_wp_text_input( 
                array( 
                    'id'          => '_mamwr_max_qty[' . $variation->ID . ']', 
                    'type'        => 'number',
                    'label'       => __( 'Maximum Quantity', 'woocommerce' ), 
                    'desc_tip'    => 'true',
                    'description' => __( 'Enter the maximum quantity here.', 'woocommerce' ),
                    'value'       => get_post_meta( $variation->ID, '_mamwr_max_qty', true ),
                    'custom_attributes' => array(
                        'step'   => 'any',
                        'min' => '0'
                    ) 
                )
            );
        }
   
        /**
        * Save new fields for variations
        *
        */
        function ocmamqrw_save_variation_settings_fields( $post_id ) {

            // Minimum Quantity
            $_mamwr_min_qty = sanitize_text_field($_POST['_mamwr_min_qty'][ $post_id ]);
            if( isset( $_mamwr_min_qty ) ) {
                update_post_meta( $post_id, '_mamwr_min_qty', sanitize_text_field( $_mamwr_min_qty ) );
            }

            // Maximum Quantity
            $_mamwr_max_qty = sanitize_text_field($_POST['_mamwr_max_qty'][ $post_id ]);
            if(isset( $_mamwr_max_qty ) ) {
                update_post_meta( $post_id, '_mamwr_max_qty', sanitize_text_field( $_mamwr_max_qty ) );
            }

            // Group Value
            $_mamwr_groupvalue = sanitize_text_field($_POST['_mamwr_groupvalue'][ $post_id ]);
            if (isset($_mamwr_groupvalue))
                update_post_meta($post_id, '_mamwr_groupvalue', $_mamwr_groupvalue);
        }


        function init() {
            add_action('woocommerce_product_options_general_product_data', array($this, 'ocmamqrw_product_custom_fields'));

            add_action('woocommerce_process_product_meta', array($this, 'ocmamqrw_product_custom_fields_save'));

            add_action('edited_product_cat', array($this, 'ocmamqrw_save_taxonomy_custom_meta'), 10, 1);

            add_action('create_product_cat', array($this, 'ocmamqrw_save_taxonomy_custom_meta'), 10, 1);

            add_action('product_cat_add_form_fields', array($this, 'ocmamqrw_add_new_meta_field'), 10, 1);

            add_action('product_cat_edit_form_fields', array($this, 'ocmamqrw_taxonomy_edit_meta_field'), 10, 1);

            add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'ocmamqrw_variation_settings_fields'), 10, 3 );

            add_action( 'woocommerce_save_product_variation', array( $this, 'ocmamqrw_save_variation_settings_fields'), 10, 2 );
        }

        public static function OCMAMQRW_instance() {
            if (!isset(self::$OCMAMQRW_instance)) {
                self::$OCMAMQRW_instance = new self();
                self::$OCMAMQRW_instance->init();
            }
            return self::$OCMAMQRW_instance;
        }
    }
    OCMAMQRW_pro_cat_other_settings::OCMAMQRW_instance();
}