<?php

if( !class_exists( 'WP_Widget_Soldi_Icon_Category' ) ){

	add_action( 'widgets_init', function(){
		register_widget( 'Category icons' );
	});

	class WP_Widget_Soldi_Icon_Category extends WP_Widget {

		$text_domain = 'soldi';
	
		/**
    	 * Constructor
    	 *
    	 */
		public function __construct() {
		
			$widget_ops = array( 
            	'classname'     => 'widget_soldi_category_icons', 
            	'description'   => __( 'Display icons and category links', $this->text_domain ) 
        	);
        	$control_ops = array( 
            	'width' => 600 
        	);
        
        	parent::__construct( 'soldi-category-icons', __( 'Category icons' , $this->text_domain ), $widget_ops, $control_ops );

		}

		/**
    	 * Outputs the options form on admin
    	 *
    	 */
		public function form( $instance ) {
				
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Widget title', $this->text_domain );
		
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', $this->text_domain ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php
		}
	

		/**
    	 * Update widget data
    	 *
    	 */
		public function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			return $instance;

		}

		/**
    	 * Outputs widget
    	 *
    	 */
		public function widget( $args, $instance ) {
		
			extract($args);

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Widget title', $this->text_domain ) : esc_html( $instance['title'] ) );

		 	echo $before_widget;

		 	if ( $title ){
				echo $before_title . $title . $after_title;
			}

			//Widget content

		 	echo $after_widget; 
				
		}

	}

}
