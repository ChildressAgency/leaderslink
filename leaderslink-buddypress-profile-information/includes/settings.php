<?php

/*******************************************
* bbp buddypress profile information Settings Page
*******************************************/


function llbpi_settings_page()
{
	global $llbpi_options;
		
	?>
	<div class="wrap">
		<div id="upb-wrap" class="upb-help">
			<h2><?php _e('profile information Settings', 'bbp-buddypress-profile-information'); ?></h2>
			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'bbp-buddypress-profile-information'); ?> ); ?></strong></p></div>
			<?php endif; ?>
			
			<table class="form-table">
			<tr>
		
		<td>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="S6PZGWPG3HLEA">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</td><td>
<?php _e("If you find this plugin useful, please consider donating just a couple of pounds to help me develop and maintain it. You support will be appreciated", 'bbp-last-post'); ?>
		
	</td>
	</tr>
	</table>			
			
			<form method="post" action="options.php">

				<?php settings_fields( 'llbpi_settings_group' ); ?>
								
				<table class="form-table">
					
					<tr valign="top">
						<th colspan="2"><font size="2" color="grey" >This plugin allows you to set up to 4 buddypress user profile fields, and set these fields to display under the authors name and avatar in topics and replies.
						<br> So for Instance in buddypress you can set a profile field with a name of City.  Users can then add their city in their profile.
						<br>If show item is set, then this also displays under the authors name on topics and replies eg 'Atlanta'
						<br> If show label is also set them both the label and content will display under the authors name on topics and replies eg 'City ; Atlanta' </th>
						
					</tr>
					
					<tr valign="top">
						<th colspan="2">Name : Name of the field exactly as in buddypress
						<br>Show label : check to display the label under the authors name and avatar in topics and replies.
						<br>Show Item : check to display the user set data under the authors name and avatar in topics and replies.</font>
						</th>
						
					</tr>

					
					<!-------------------------------Label1 ---------------------------------------->
					<tr valign="top">
						<th colspan="2"><h4><?php _e('Label 1', 'bbp-buddypress-profile-information'); ?></h4></th>
					</tr>
					<tr valign="top">
					<th><?php _e('Name', 'bbp-buddypress-profile-information'); ?></th>
					<td>
						<input id="llbpi_settings[item1_label]" class="large-text" name="llbpi_settings[item1_label]" type="text" value="<?php echo isset( $llbpi_options['item1_label'] ) ? esc_html( $llbpi_options['item1_label'] ) : '';?>" /><br/>
						
					</td>
					</tr>
					
							
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show label', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php labelshow_item1_checkbox() ;?>
					</td>
					</tr>
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show Item', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php itemshow_item1_checkbox() ;?>
					</td>
					</tr>
					
					
					<!------------------------------- Label2 ------------------------------------------>
					<tr valign="top">
						<th colspan="2"><h4><?php _e('Label 2', 'bbp-buddypress-profile-information'); ?></h4></th>
					</tr>
					<tr valign="top">
						<th><?php _e('Name', 'profile-information'); ?></th>
						<td>
							<input id="llbpi_settings[item2_label]" class="large-text" name="llbpi_settings[item2_label]" type="text" value="<?php echo isset( $llbpi_options['item2_label'] ) ? esc_html( $llbpi_options['item2_label'] ) : '';?>" /><br/>
							
						</td>
					</tr>
					
					
					
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show label', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php labelshow_item2_checkbox() ;?>
					</td>
					</tr>
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show Item', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php itemshow_item2_checkbox() ;?>
					</td>
					</tr>
					
					<!------------------------------- Label3 ------------------------------------------>
					<tr valign="top">
						<th colspan="2"><h4><?php _e('Label 3', 'bbp-buddypress-profile-information'); ?></h4></th>
					</tr>
					<tr valign="top">
						<th><?php _e('Name', 'profile-information'); ?></th>
						<td>
							<input id="llbpi_settings[item3_label]" class="large-text" name="llbpi_settings[item3_label]" type="text" value="<?php echo isset( $llbpi_options['item3_label'] ) ? esc_html( $llbpi_options['item3_label'] ) : '';?>" /><br/>
							
						</td>
					</tr>
					
					
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show label', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php labelshow_item3_checkbox() ;?>
					</td>
					</tr>
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show Item', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php itemshow_item3_checkbox() ;?>
					</td>
					</tr>
				
				<!------------------------------- Label 4 ------------------------------------------>
					<tr valign="top">
						<th colspan="2"><h4><?php _e('Label 4', 'bbp-buddypress-profile-information'); ?></h4></th>
					</tr>
					<tr valign="top">
						<th><?php _e('Name', 'profile-information'); ?></th>
						<td>
							<input id="llbpi_settings[item4_label]" class="large-text" name="llbpi_settings[item4_label]" type="text" value="<?php echo isset( $llbpi_options['item4_label'] ) ? esc_html( $llbpi_options['item4_label'] ) : '';?>" /><br/>
							
						</td>
					</tr>
					
					
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show label', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php labelshow_item4_checkbox() ;?>
					</td>
					</tr>
					
					<!-- checkbox to display label in topics/replies -->
					<tr valign="top">  
					<th><?php _e('Show Item', 'bbp-buddypress-profile-information'); ?></th>
					<td>
					<?php itemshow_item4_checkbox() ;?>
					</td>
					</tr>
				
				</table>
				
				<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'bbp-buddypress-profile-information' ); ?>" />
				</p>
								
				
			</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->
		
	<?php
}

// register the plugin settings
function llbpi_register_settings() {

	// create whitelist of options
	register_setting( 'llbpi_settings_group', 'llbpi_settings' );
	//register_setting( 'llbpi_settings_group', 'Activate_item1' );
	//register_setting( 'llbpi_settings_group', 'Activate_item2' );
}
//call register settings function
add_action( 'admin_init', 'llbpi_register_settings' );


function llbpi_settings_menu() {

	// add settings page
	add_submenu_page('options-general.php', __('bbp buddypress profile information', 'bbp-buddypress-profile-information'), __('bbp buddypress profile Information', 'bbp-buddypress-profile-information'), 'manage_options', 'bbp-buddypress-profile-information-settings', 'llbpi_settings_page');
}
add_action('admin_menu', 'llbpi_settings_menu');

/*****************************   Checkbox functions **************************/

function activate_item1_checkbox() {
 	global $llbpi_options ;
	$item1 =  !empty($llbpi_options['Activate_item1']) ? $llbpi_options['Activate_item1'] : '';
	echo '<input name="llbpi_settings[Activate_item1]" id="llbpi_settings[Activate_item1]" type="checkbox" value="1" class="code" ' . checked( 1,$item1, false ) . ' /> Add this item to the profile';
  }
  
function activate_item2_checkbox() {
	global $llbpi_options ;
	$item2 =  !empty($llbpi_options['Activate_item2']) ? $llbpi_options['Active_item2'] : '';
	echo '<input name="llbpi_settings[Activate_item2]" id="llbpi_settings[Activate_item2]" type="checkbox" value="1" class="code" ' . checked( 1,$item2, false ) . ' /> Add this item to the profile';
  }

function activate_item3_checkbox() {
	global $llbpi_options ;
	$item3 =  !empty($llbpi_options['Activate_item3']) ? $llbpi_option['Activate_item3'] : '';
	echo '<input name="llbpi_settings[Activate_item3]" id="llbpi_settings[Activate_item3]" type="checkbox" value="1" class="code" ' . checked( 1,$item3, false ) . ' />Add this item to the profile';
  }
  
function activate_item4_checkbox() {
	global $llbpi_options ;
	$item4 =  !empty($llbpi_options['Activate_item4']) ? $llbpi_options['Active_item4'] : '';
	echo '<input name="llbpi_settings[Activate_item4]" id="llbpi_settings[Activate_item4]" type="checkbox" value="1" class="code" ' . checked( 1,$item4, false ) . ' /> Add this item to the profile';
  }
function labelshow_item1_checkbox() {
	global $llbpi_options ;
	$labelshowitem1 =  !empty($llbpi_options['labelshow_item1']) ? $llbpi_options['lableshow_item1'] : '';
	echo '<input name="llbpi_settings[labelshow_item1]" id="llbpi_settings[labelshow_item1]" type="checkbox" value="1" class="code" ' . checked( 1,$labelshowitem1, false ) . ' /> Show the label for this item on topics/replies';
  }

function labelshow_item2_checkbox() {
	global $llbpi_options ;
	$labelshowitem2 =  !empty($llbpi_options['labelshow_item2']) ? $llbpi_options['labelshow_item2'] : '';
	echo '<input name="llbpi_settings[labelshow_item2]" id="llbpi_settings[labelshow_item2]" type="checkbox" value="1" class="code" ' . checked( 1,$labelshowitem2, false ) . ' /> Show the label for this item on topics/replies';
  }

  
function labelshow_item3_checkbox() {
	global $llbpi_options ;
	$labelshowitem3 =  !empty($llbpi_options['labelshow_item3']) ? $llbpi_options['lableshow_item3'] : '';
	echo '<input name="llbpi_settings[labelshow_item3]" id="llbpi_settings[labelshow_item3]" type="checkbox" value="1" class="code" ' . checked( 1,$labelshowitem3, false ) . ' /> Show the label for this item on topics/replies';
  }  
  
function labelshow_item4_checkbox() {
	global $llbpi_options ;
	$labelshowitem4 =  !empty($llbpi_options['labelshow_item4']) ? $llbpi_options['lableshow_item4'] : '';
	echo '<input name="llbpi_settings[labelshow_item4]" id="llbpi_settings[labelshow_item4]" type="checkbox" value="1" class="code" ' . checked( 1,$labelshowitem4, false ) . ' /> Show the label for this item on topics/replies';
  }  
  
function itemshow_item1_checkbox() {
	global $llbpi_options ;
	$itemshowitem1 =  !empty($llbpi_options['itemshow_item1']) ? $llbpi_options['itemshow_item1'] : '';
	echo '<input name="llbpi_settings[itemshow_item1]" id="llbpi_settings[item_item1]" type="checkbox" value="1" class="code" ' . checked( 1,$itemshowitem1, false ) . ' /> Show this item on topics/replies';
  }  
function itemshow_item2_checkbox() {
	global $llbpi_options ;
	$itemshowitem2 =  !empty($llbpi_options['itemshow_item2']) ? $llbpi_options['itemshow_item2'] : '';
	echo '<input name="llbpi_settings[itemshow_item2]" id="llbpi_settings[itemshow_item2]" type="checkbox" value="1" class="code" ' . checked( 1,$itemshowitem2, false ) . ' /> Show this item on topics/replies';
  }  
function itemshow_item3_checkbox() {
	global $llbpi_options ;
	$itemshowitem3 =  !empty($llbpi_options['itemshow_item3']) ? $llbpi_options['itemshow_item3'] : '';
	echo '<input name="llbpi_settings[itemshow_item3]" id="llbpi_settings[itemshow_item3]" type="checkbox" value="1" class="code" ' . checked( 1,$itemshowitem3, false ) . ' /> Show this item on topics/replies';
  }  
  
function itemshow_item4_checkbox() {
	global $llbpi_options ;
	$itemshowitem4 =  !empty($llbpi_options['itemshow_item4']) ? $llbpi_options['itemshow_item4'] : '';
	echo '<input name="llbpi_settings[itemshow_item4]" id="llbpi_settings[itemshow_item4]" type="checkbox" value="1" class="code" ' . checked( 1,$itemshowitem4, false ) . ' /> Show this item on topics/replies';
  }  