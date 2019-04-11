<?php
/**
* Returns word count of the sentences.
*
* @since trade-hub 1.0.0
*/
if ( ! function_exists( 'trade_hub_words_count' ) ) :
	function trade_hub_words_count( $length = 25, $trade_hub_content = null ) {
		$length = absint( $length );
		$more = __( '&hellip;','trade-hub' );
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $trade_hub_content );
		$trimmed_content = wp_trim_words( $source_content, $length, $more );
		return $trimmed_content;
	}
endif;