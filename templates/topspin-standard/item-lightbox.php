<div id="topspin-view-more-<?php echo $item['id']; ?>" class="topspin-view-more-canvas">
	<div class="topspin-view-more-image">
		<div class="topspin-view-more-image-default">
			<div class="topspin-view-more-image-default-cell">
				<a href="#!/<?php echo $item['id']; ?>"><img src="<?php echo $item['default_image_large'];?>" /></a>
			</div>
		</div>
	</div>
    <h2 class="topspin-view-more-title"><?php echo $item['name'];?></h2>
    <div class="topspin-view-more-desc"><?php echo $item['description'];?></div>
	<?php $totalImages = count($item['images']);
	if($totalImages>1) : ?>
	<ul class="topspin-view-more-image-pager">
		<?php foreach($item['images'] as $image) : ?>
		<li class="topspin-view-more-image-pager-item">
			<div class="topspin-view-more-image-pager-item-cell"><a href="#"><img src="<?php echo $image['large_url']; ?>" /></a></div>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
    <div class="topspin-view-more-buy">
    	<a class="topspin-buy" href="<?php echo $item['offer_url'];?>">Buy</a>
        <div class="topspin-view-more-price">Price: <?php echo $item['symbol'];?><?php echo $item['price'];?></div>
	</div>
</div>