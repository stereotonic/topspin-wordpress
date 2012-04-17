<?php
/*
 *	Topspin Items Listing
 *
 *	Usage: [topspin_buy_buttons]
 *
 *	Available template variables
 *		storedata	(array)
 *		storeitems	(array)
 *
 *
 *	WARNING: DO NOT EDIT THIS FILE!
 *
 *	To edit the PHP, copy this file to your
 *	active theme's directory and edit from that
 *	new file.
 *
 *	Example: /wp-content/themes/<current-theme>/topspin-simplified/item-listings.php
 *
 */
?>

<?php if(count($storeitems)) : ?>
<div id="topspin-store-<?php echo $storedata['id'];?>" class="topspin-store">
<table class="topspin-simplified-item-listings">
	<?php for($row=1;$row<=ceil(count($storeitems)/$storedata['grid_columns']);$row++) : ?>
	<?php
	$mod = count($storeitems)%$storedata['grid_columns'];
	$diff = ($mod>0) ? $storedata['grid_columns']-$mod : 0;
	?>
	<tr class="topspin-item-title">
		<?php
		for($col=1;$col<=$storedata['grid_columns'];$col++) : $key = ($row*$storedata['grid_columns'])-($storedata['grid_columns']-($col-1)); ?>
		<td width="<?php echo floor(100/$storedata['grid_columns']);?>%">
			<?php if(isset($storeitems[$key])) : ?>
			<h2 class="topspin-title-name"><a class="topspin-view-item" href="#!/<?php echo $storeitems[$key]['id']; ?>"><?php echo $storeitems[$key]['name'];?></a></h2>
			<?php endif; ?>
		</td>
		<?php endfor; ?>
	</tr>
	<tr class="topspin-item-image">
		<?php
		for($col=1;$col<=$storedata['grid_columns'];$col++) : $key = ($row*$storedata['grid_columns'])-($storedata['grid_columns']-($col-1)); ?>
		<td width="<?php echo floor(100/$storedata['grid_columns']);?>%">
        	<?php ## BEGIN SWITCH OFFER TYPE
			$item = $storeitems[$key];
            switch($item['offer_type']) {
				case 'buy_button':
					if(isset($storeitems[$key])) : ?>
					<a class="topspin-view-item" href="#!/<?php echo $storeitems[$key]['id']; ?>"><img src="<?php echo $storeitems[$key]['default_image'];?>" /></a>
					<div id="topspin-view-more-<?php echo $storeitems[$key]['id']; ?>" class="topspin-view-more-canvas">
						<div class="topspin-view-more-image">
							<div class="topspin-view-more-image-default">
								<div class="topspin-view-more-image-default-cell">
									<a href="#!/<?php echo $storeitems[$key]['id']; ?>"><img src="<?php echo $storeitems[$key]['default_image_large'];?>" /></a>
								</div>
							</div>
						</div>
						<h2 class="topspin-view-more-title"><?php echo $storeitems[$key]['name'];?></h2>
						<div class="topspin-view-more-desc"><?php echo $storeitems[$key]['description'];?></div>
				    	<?php $totalImages = count($storeitems[$key]['images']);
				    	if($totalImages>1) : ?>
				    	<ul class="topspin-view-more-image-pager">
				    		<?php foreach($storeitems[$key]['images'] as $image) : ?>
				    		<li class="topspin-view-more-image-pager-item">
				    			<div class="topspin-view-more-image-pager-item-cell"><a href="#"><img src="<?php echo $image['large_url']; ?>" /></a></div>
				    		</li>
				    		<?php endforeach; ?>
				    	</ul>
				    	<?php endif; ?>
						<div class="topspin-view-more-buy">
							<a class="topspin-buy" href="<?php echo $storeitems[$key]['offer_url'];?>">Buy</a>
							<div class="topspin-view-more-price">Price: <?php echo $storeitems[$key]['symbol'];?><?php echo $storeitems[$key]['price'];?></div>
						</div>
						<div class="topspin-clear"></div>
					</div>
					<?php endif;
					break;
				case 'email_for_media':
				case 'bundle_widget':
				case 'single_track_player_widget': ?>
                	<div class="topspin-item-embed"><?php echo $item['embed_code'];?></div>
					<?php break;
			} ## END SWITCH OFFER TYPE
			?>
		</td>
		<?php endfor; ?>
	</tr>
	<tr class="topspin-item-price">
		<?php
		for($col=1;$col<=$storedata['grid_columns'];$col++) : $key = ($row*$storedata['grid_columns'])-($storedata['grid_columns']-($col-1)); ?>
		<td width="<?php echo floor(100/$storedata['grid_columns']);?>%">
		<?php if(isset($storeitems[$key])) : ?>
			Price: <?php echo $storeitems[$key]['symbol'];?><?php echo $storeitems[$key]['price'];?>
		<?php endif; ?>
		</td>
		<?php endfor; ?>
	</tr>
	<tr class="topspin-item-buy">
		<?php
		for($col=1;$col<=$storedata['grid_columns'];$col++) : $key = ($row*$storedata['grid_columns'])-($storedata['grid_columns']-($col-1)); ?>
		<td width="<?php echo floor(100/$storedata['grid_columns']);?>%">
		<?php if(isset($storeitems[$key])) : ?>
		<a class="topspin-buy" href="<?php echo $storeitems[$key]['offer_url'];?>">Buy</a></td>
		<?php endif; ?>
		</td>
		<?php endfor; ?>
	</tr>
	<tr class="topspin-spacer"><td colspan="<?php echo $storedata['grid_columns'];?>"></td></tr>
	<?php endfor; ?>
</table>

<?php ## BEGIN PAGINATION
if(!$storedata['show_all_items'] && $storedata['curr_page']<=$storedata['total_pages'] && $storedata['total_pages']>1) { ?>
   	<div class="topspin-pagination">
   	Page <?php echo $storedata['curr_page'];?> of <?php echo $storedata['total_pages'];?>
	<?php if($storedata['prev_page']) : ?><a class="topspin-prev" href="<?php echo $storedata['prev_page'];?>">Previous</a><?php endif; ?>
	<?php if($storedata['next_page']) : ?><a class="topspin-next" href="<?php echo $storedata['next_page'];?>">Next</a><?php endif; ?>
	</div>
<?php } ## END PAGINATION ?>

</div>
<?php endif; ?>
