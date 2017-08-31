<?php


/*******************************************
* bbp buddypress profile Information Display Functions
*******************************************/


 
function leaderslink_buddypress_profile_information () 
//This function adds the item and label if required to the author section of topics/replies

{
		global $llbpi_options;
		global $wpdb;
		global $table_prefix ;
		$xfields= $table_prefix.'bp_xprofile_fields' ;
		$xdata= $table_prefix.'bp_xprofile_data' ;
		echo '<ul class="list-unstyled profile-meta">';
		//$user_id = bbp_get_reply_author_id();
		$user_id = get_the_author_meta('ID');
		//var_dump($user_id);
		
		//show item1 if activated show on topics/replies
		if (!empty($llbpi_options['itemshow_item1']) && $llbpi_options['itemshow_item1'] == true) {
			echo '<li>' ;
			$label1 =  $llbpi_options['item1_label'] ;
			//show label if required
				if(!empty($llbpi_options['labelshow_item1']) && $llbpi_options['labelshow_item1'] == true) {
				echo $label1." : " ;
				}
			$xpid=$wpdb->get_var("select id from $xfields where name = '$label1'") ;
			$xpdata2= $wpdb->get_var("select VALUE from $xdata where field_id  = '$xpid' AND user_id = '$user_id' ") ;
			echo $xpdata2;
			echo '</li>' ;	
			
		}
		
		//show item2 if activated show on topics/replies
		if (!empty($llbpi_options['itemshow_item2']) && $llbpi_options['itemshow_item2'] == true) {
			echo '<li>' ;
			$label2 =  $llbpi_options['item2_label'] ;
			//show label if required
				if(!empty($llbpi_options['labelshow_item2']) && $llbpi_options['labelshow_item2'] == true) {
				echo $label2." : " ;
				}
			$xpid=$wpdb->get_var("select id from $xfields where name = '$label2'") ;
			$xpdata2= $wpdb->get_var("select VALUE from $xdata where field_id  = '$xpid' AND user_id = '$user_id' ") ;
			echo $xpdata2;
			echo '</li>' ;
		}
		
		//show item3 if activated show on topics/replies
		if (!empty($llbpi_options['itemshow_item3']) && $llbpi_options['itemshow_item3'] == true) {
			echo '<li>' ;
			$label3 =  $llbpi_options['item3_label'] ;
			//show label if required
				if(!empty($llbpi_options['labelshow_item3']) && $llbpi_options['labelshow_item3'] == true) {
				echo $label3." : " ;
				}
			$xpid=$wpdb->get_var("select id from $xfields where name = '$label3'") ;
			$xpdata2= $wpdb->get_var("select VALUE from $xdata where field_id  = '$xpid' AND user_id = '$user_id' ") ;
			echo $xpdata2;
			echo '</li>' ;
		}
		
		//show item4 if activated on topics/replies
		if (!empty($llbpi_options['itemshow_item4']) && $llbpi_options['itemshow_item4'] == true) {
			echo '<li>' ;
			$label4 =  $llbpi_options['item4_label'] ;
			//show label if required
				if(!empty($llbpi_options['lableshow_item4']) && $llbpi_options['labelshow_item4'] == true) {
				echo $label4." : " ;
				}
			$xpid=$wpdb->get_var("select id from $xfields where name = '$label4'") ;
			$xpdata2= $wpdb->get_var("select VALUE from $xdata where field_id  = '$xpid' AND user_id = '$user_id' ") ;
			echo $xpdata2;
			echo '</li>' ;
		}
		echo '</ul>' ;
		
}
add_action ('bbp_theme_after_reply_author_details', 'leaderslink_buddypress_profile_information') ;



?>
