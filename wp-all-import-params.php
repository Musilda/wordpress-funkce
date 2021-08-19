<?php
add_action('pmxi_saved_post', 'wp_programator_automatically_import_wpai_params', 10, 2);
/**
 * @param $post_id
 * @param $xml
 */
function wp_programator_automatically_import_wpai_params($post_id, $xml)
{
    $atts = [];

    // The $xml is a SimpleXML object
    // Scrub through the PARAM attributes and add these to product
  foreach ( $xml->PARAM as $param ) {
      // Get attribute name
    $name = $param->PARAM_NAME->__toString();
    // Get attribute value
    $value = $param->VAL->__toString();
    // The WC attribute taxonomy is prefixed with pa_, vuild the slug here
    $slug = 'pa_'.wc_sanitize_taxonomy_name($name);
	  
	 $attribute_id = wc_attribute_taxonomy_id_by_name( $name );
	  if ( !$attribute_id ) {
	  	wc_create_attribute(['name' => $name, 'slug' => $slug]);
	  }
	  
	$attribute_term = get_term_by( 'name', $value, $slug );
	  if( $attribute_term === false ){
		  $new_attribute = wp_insert_term( $value, $slug );
		  $attribute_term = get_term_by( 'name', $value, $slug );
	  }
	
    // Create the attribute
    //wc_create_attribute(['name' => $name, 'slug' => $slug]);

    // Add the product to the taxonomy we just created
    wp_set_object_terms( $post_id, $attribute_term->term_id, $slug, true );

    // Add to the attributes data
        // This is needed for attributes to display in the WP admin
    $atts[$slug] = [
        'name'=> $slug,
        'value'=> $value,
        'is_visible' => '1',
        'is_variation' => '0',
        'is_taxonomy' => '1'
        ];
    }

    // Update the _product_attributes meta - this is where the attribute data are stored for products
  $product = wc_get_product($post_id);
  $product->update_meta_data('_product_attributes', $atts);
  $product->save();
}

