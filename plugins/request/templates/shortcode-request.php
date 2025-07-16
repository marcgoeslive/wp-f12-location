<form action="" method="post" name="f12cl_request">
	<?php echo $args["wp_nonce_field"];?>
	<input type="hidden" name="action" value="f12cl_request_action_send">
    <input type="hidden" name="f12cl_request-object" value="<?php echo $args["object"];?>">
	<!-- COMPONENT CONTACT CONTAINER BEGIN -->
	<div class="bfi-ce-form bfi-wrapper">
		<!-- BFI CE FORM BEGIN -->
		<div class="bfi-ce-form__box bfi-wrapper-800">
			<!-- BFI CE FORM CONTENT BEGIN -->
			<div class="bfi-ce-form__content">
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<select name="f12cl_request-salutation">
						<option value="Anrede">
							Anrede
						</option>
						<option value="Herr">
							Herr
						</option>
						<option value="Frau">
							Frau
						</option>
					</select>
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<input type="text" class=" <?php if(isset($args["error-name"])) echo "error";?>" value="" placeholder="Vorname/Nachname*" name="f12cl_request-name">
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<input type="text" value="" placeholder="Straße" name="f12cl_request-street">
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<input type="text" value="" placeholder="Ort" name="f12cl_request-city">
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<input type="text" value="" placeholder="Telefon" name="f12cl_request-phone">
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item">
					<input type="text" class="<?php if(isset($args["error-email"])) echo "error";?>" value="" placeholder="E-Mail*" name="f12cl_request-email">
				</div>
				<!-- CE FORM ITEM END -->
				<!-- CE FORM ITEM BEGIN -->
				<div class="bfi-ce-form__item bfi-ce-form__item--full">
					<textarea name="f12cl_request-message" class=" <?php if(isset($args["error-message"])) echo "error";?>" placeholder="Nachricht*"></textarea>
				</div>
				<!-- CE FORM ITEM END -->
			</div>
			<!-- BFI CE FORM CONTENT END -->
			<!-- BFI CE FORM FOOTER BEGIN -->
			<div class="bfi-ce-form__footer">
				<div class="bfi-ce-form__hint">
					*Pflichtfeld
				</div>
				<div class="bfi-ce-form__copy">
					<input id="copy" type="checkbox" name="f12cl_request-copy"  value="1"> <label for="copy">Kopie an meine
						E-Mail-Adresse</label>
				</div>

				<div class="bfi-ce-form__item bfi-ce-form__item--full">
					<button name="f12cl_request-submit" value="Senden" class="bfi-button">Senden</button>
				</div>
			</div>
			<!-- BFI CE FORM FOOTER END -->
		</div>
		<!-- BFI CE FORM END -->
	</div>
	<!-- COMPONENT CONTACT CONTAINER END -->
</form>