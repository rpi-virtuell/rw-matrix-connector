<?php

/**
 * Class RW_Matrix_Connector_Actions
 *
 */

class RW_Matrix_Connector_Actions {


	public static function publish_post( $new_status, $old_status, $post ) {
		if ( $old_status != 'publish'  &&  $new_status == 'publish' ) {
			$posttype = $post->post_type;
			switch ( $posttype ) {
				case 'post' :
					$message          = new RW_Matrix_Connector_Message();
					$message->type    = MatrixMessageText;
					$message->content = get_permalink( $post );
					self::check_event( 'publish_post', $message );
					break;
				case 'page' :
					$message          = new RW_Matrix_Connector_Message();
					$message->type    = MatrixMessageText;
					$message->content = get_permalink( $post );
					self::check_event( 'publish_page', $message );
					break;
				case 'episode' :
					$message          = new RW_Matrix_Connector_Message();
					$message->type    = MatrixMessageText;
					$message->content = get_permalink( $post );
					self::check_event( 'publish_podcast', $message );
					break;

			}
		}
	}

	public static function check_event( $trigger, $message ) {
		if( have_rows('gruppen', 'option') ) {
			while( have_rows('gruppen', 'option') ) {
				the_row();
				foreach ( get_sub_field('events' ) as $event ) {
					if ( $trigger === $event ) {
						$message->receiver = get_sub_field( 'gruppenid' );
						$message->send(  get_field('queue', 'option') );
					}
				}
			}

		}
	}
}
