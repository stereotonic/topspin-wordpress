<?php

/*
 *	Last Modified:		March 27, 2012
 *
 *	----------------------------------
 *	Change Log
 *	----------------------------------
 *	2012-03-21
 		- Split settings into subgroups
 		- Migrated artist to be selected by Store
 *	2012-01-24
 		- Nav menu feature @eThan
 *	2011-08-01
 		- Updated saving to delete all currently created store if the artist ID is switched.
 *	2011-04-11
 		- Added new button for force rerun upgrade scripts
 *	2011-04-06
 		- Updated Artist ID field to a dropdown of available artists
 		- Moved API credential fields to the top
 		- Updated submit to auto-set artist ID on first save
 		- Added Template description
 *	2011-04-05
 		- Added a new field called "Template"
 */

global $store, $topspin_success;

$apiError = '';
$apiStatus = $store->api_check();
if($apiStatus) { $apiError = $apiStatus->error_detail; }

?>

<div class="wrap">
    <h2>Topspin General Settings</h2>

    <?php if($topspin_success) : ?><div class="updated settings-error"><p><strong><?php echo $topspin_success; ?></strong></p></div><?php endif; ?>
    <?php if($apiError) : ?><div class="error settings-error"><p><strong><?php echo $apiError; ?></strong></p></div><?php endif; ?>

    <form name="topspin_form" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
    <input type="hidden" name="action" value="topspin_general_settings" />
	<?php
	$artistsList = $store->artists_get_list();
	$totalArtists = count($artistsList);
	?>
    <h3>Topspin API Settings</h3>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="topspin_api_username">Topspin API User</label></th>
                <td>
                    <input id="topspin_api_username" class="regular-text" type="text" value="<?php echo $store->settings_get('topspin_api_username'); ?>" name="topspin_api_username" />
                    <span class="description">Go to <a href="http://app.topspin.net/account/profile/" target="_blank">Account Settings</a> to obtain your API credentials.</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="topspin_api_key">Topspin API Key</label></th>
                <td>
                    <input id="topspin_api_key" class="regular-text" type="text" value="<?php echo $store->settings_get('topspin_api_key'); ?>" name="topspin_api_key" />
                    <span class="description">Go to <a href="http://app.topspin.net/account/profile/" target="_blank">Account Settings</a> to obtain your API credentials.</span>
                </td>
            </tr>
		</table>
	</table>

	<?php if(!$apiError) : ?>
	<h3>Cache Settings</h3>
	<table class="form-table">
		<tbody>
            <tr valign="top">
                <th scope="row"><label for="topspin_cache_system">Cache System</label></th>
                <td>
                	<?php $selectedCacheSystem = $store->settings_get('topspin_cache_system'); ?>
					<select id="topspin_cache_system" name="topspin_cache_system"><
						<option value="WP-Cron" <?php echo ($selectedCacheSystem=="WP-Cron") ? 'selected="selected"' : ''; ?>>WP-Cron</option>
						<option value="Manual" <?php echo ($selectedCacheSystem=="Manual") ? 'selected="selected"' : ''; ?>>Manual</option>
					</select>
					<div class="description">
						<p>Select manual if you want to handle caching manually. If you have a large inventory, it is recommended to use Manual and setup a server crontab.</p>
						<p><code>PHP Cron Script: <?php echo sprintf('%s/cron.php',TOPSPIN_PLUGIN_URL); ?></code></p>
					</div>
				</td>
			</tr>
            <tr valign="top">
                <th scope="row"><label for="topspin_artist_id">Topspin Artist</label></th>
                <td>
					<?php if($totalArtists) : ?>
	                    <div class="description"><p>PLEASE NOTE: You have multiple Artist IDs associated with your API user / key combination. Check all the artists you want to cache on your website.</p></div>
						<ul class="topspin-artists-list">
	                		<?php foreach($artistsList as $artist) : ?>
		                		<?php
		                		$checked = '';
		                		$selectedArtist = $store->settings_get('topspin_artist_id');
		                		if(is_array($selectedArtist)) {
		                			if(in_array($artist['id'],$selectedArtist)) { $checked = 'checked="checked"'; }
		                		}
		                		else if(is_string($selectedArtist)) {
		                			if($artist['id']==$selectedArtist) { $checked = 'checked="checked"'; }
		                		}
		                		?>
	                			<li class="topspin-artist-item">
	                				<div class="topspin-artist-item-thumb"><img src="<?php echo $artist['avatar_image']; ?>" alt="" /></div>
	                				<div class="topspin-artist-item-footer">
		                				<input id="topspin_artist_<?php echo $artist['id']; ?>" type="checkbox" name="topspin_artist_id[]" value="<?php echo $artist['id'];?>" <?php echo $checked; ?> />
		                				&nbsp; <label for="topspin_artist_<?php echo $artist['id']; ?>"><?php echo $artist['name'];?> (<?php echo $artist['id'];?>)</label>
									</div>
	                			</li>
	                		<?php endforeach; ?>
                			<li class="clear"></div>
	                	</ul>
                    <?php elseif($totalArtists && $totalArtists==1) : ?>
	                   	<input type="hidden" name="topspin_artist_id[]" value="<?php echo $artistsList[0]['id'];?>" />
	                    <input class="artist-name regular-text" type="text" disabled="disabled" value="<?php echo $artistsList[0]['name'];?> (<?php echo $artistsList[0]['id'];?>)" />
					<?php endif; ?>
                </td>
            </tr>
        </tbody>
	</table>

	<h3>Template Settings</h3>
	<table class="form-table">
		<tbody>
            <tr valign="top">
                <th scope="row"><label for="topspin_api_key">Template:</label></th>
                <td>
                	<?php
                	$selectedTemplate = $store->settings_get('topspin_template_mode');
                	?>
                    <select id="topspin_template_mode" name="topspin_template_mode">
                    	<option value="simplified" <?php echo ($selectedTemplate=='simplified')?'selected="selected"':'';?>>Simplified</option>
                    	<option value="standard" <?php echo ($selectedTemplate=='standard')?'selected="selected"':'';?>>Standard</option>
                    </select>
                    <div class="description">
                    	<?php
                    	$simplified_display = ($selectedTemplate=='simplified') ? '' : 'hide';
                    	$standard_display = ($selectedTemplate=='standard') ? '' : 'hide';
                    	?>
                    	<div class="template-simplified <?php echo $simplified_display;?>">
							<p>
								<strong><em>This Simplified Template is designed to give the best out-of-the box store layout if you prefer to do little or no customization.</em></strong>
								It uses HTML Tables to construct the Store Grid and therefore is less flexible for developers who wish to heavily customize the store's output. 
							</p>
							<p>
								This template can be customized just like the Standard Template, following these steps: <br/>
								1) Copy the /topspin-simplified/ directory from the Plugin's /templates/ folder to your site's active theme folder<br/>
								2) Edit the .php and .css files in this new /topspin-simplified/ directory in your site's active theme folder - this will override the defaults
							</p>
							<p><strong><em>PLEASE NOTE: Do NOT edit the files directly in the Plugin's /templates/ folder!  When you upgrade, all of your customizations will be lost if you do!</em></strong></p>
						</div>
                    	<div class="template-standard <?php echo $standard_display;?>">
                    		<p>
                    			<strong><em>This Standard Template is designed as a skeleton framework with the Developer in mind, allowing for the most flexibility for template customizations.</em></strong>
                    			It uses floating HTML Divs to construct the Store Grid rather than Tables, making it easier to manipulate.
                    		</p>
                    		<p><strong><em>If you are looking to run the plugin out-of-the-box with little or no customization, please user the Simplified Template for the best front-end output and alignment of images and buy buttons.</em></strong></p>
							<p>
								This template can be fully customized following these steps: <br/>
								1) Copy the /topspin-standard/ directory from the Plugin's /templates/ folder to your site's active theme folder<br/>
								2) Edit the .php and .css files in this new /topspin-standard/ directory in your site's active theme folder - this will override the defaults
							</p>
							<p><strong><em>PLEASE NOTE: Do NOT edit the files directly in the Plugin's /templates/ folder!  When you upgrade, all of your customizations will be lost if you do!</em></strong></p>
							<p>(<strong><em>Backward Compatibility:</em></strong> For users upgrading from a version pre-v3.1, the Plugin will still recognize your customized topspin.css, topspin-ie7.css, featured-item.php and item-listings.php files located in your site's active theme folder even if they aren't in the /topspin-standard/ sub-folder.)</p>
                    	</div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

	<script type="text/javascript" language="javascript">
	jQuery(function($) {
		$('#topspin_template_mode').change(function() {
			var open = $(this).val();
			var close = (open=='simplified') ? 'standard' : 'simplified';
			$('.template-'+close).slideUp(function() {
				$('.template-'+open).slideDown();
			});
		});
	});
	</script>

	<?php endif; ?>

    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" /></p>
    </form>

    <?php if(!$apiError) : ?>
    <h3>Database Cache</h3>
    <table class="form-table">
		<form name="topspin_form_rebuild_cache" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
	    <input type="hidden" name="action" value="topspin_sync_cache" />
    	<tbody>
        	<tr valign="top">
            	<th scope="row"><label>Sync Database</label></th>
                <td>
					<input type="submit" name="cache_all" class="button-primary" value="<?php _e('Sync'); ?>" />
                    <span class="description">
                    	<?php $last_cached = $store->settings_get('topspin_last_cache_all'); ?>
                    	Last synced: <?php echo ($last_cached) ? human_time_diff($last_cached).' ago' : 'No action yet'; ?>
                    </span>
                </td>
            </tr>
        </tbody>
		</form>
		<form name="topspin_form_rerun_upgrades" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
	    <input type="hidden" name="action" value="topspin_rerun_upgrades" />
    	<tbody>
        	<tr valign="top">
            	<th scope="row"><label>Fix Plugin Installation</label></th>
                <td>
					<input type="submit" name="fix_upgrades" class="button-primary" value="<?php _e('Fix'); ?>" />
                    <span class="description">Use this if you are experiencing problems with the plugin.  In an attempt to fix your installation, this will force WordPress to re-run all of the upgrade scripts and rebuild the cache.</span>
                </td>
            </tr>
        </tbody>
		</form>
    </table>
    <?php endif; ?>

</div>