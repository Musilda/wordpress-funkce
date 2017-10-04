add_action( 'template_redirect', 'toret_redirect_404' );
function toret_redirect_404() {
    if (is_404()) {
        wp_redirect( home_url() );
    }
}
