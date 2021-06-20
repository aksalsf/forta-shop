<div id="carousel" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<?php for($i=1;$i<=6;$i++): ?>
		<button type="button" data-bs-target="#carousel" data-bs-slide-to="<?= $i-1 ?>"
			<?php if($i == 1) echo 'class="active"'; ?> aria-current="true"></button>
		<?php endfor; ?>
	</div>
	<div class="carousel-inner">
		<?php for($i=1;$i<=6;$i++): ?>
		<div class="carousel-item banner-image <?php if($i == 1) echo 'active'; ?>">
			<img src="<?= base_url().'/assets/images/banner/'.$i.'.jpg' ?>" class="d-block w-100">
		</div>
		<?php endfor; ?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>
