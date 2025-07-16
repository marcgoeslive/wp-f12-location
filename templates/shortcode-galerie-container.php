<!-- LOCATION SLIDER BEGIN -->
<div class="bfi-ce-location-slider" id="<?php echo $args["id"]; ?>">
    <div class="bfi-ce-location-slider__header">
        <h2>
			<?php echo $args["title"]; ?>
        </h2>
        <div class="bfi-divider"></div>
    </div>
    <div class="bfi-ce-location-slider__content">
		<?php echo $args["items"]; ?>
    </div>
    <div class="bfi-ce-location-slider__navigation">
        <div class="bfi-ce-location-slider__button"><i class="ic-arrow--left"></i></div>
        <div class="bfi-ce-location-slider__navigation--dots">
            <span class="active"></span>
            <span></span>
            <span></span>
        </div>
        <div class="bfi-ce-location-slider__button"><i class="ic-arrow--right"></i></div>
    </div>
</div>