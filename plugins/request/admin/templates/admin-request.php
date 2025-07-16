<div id="plugin-objectrequest">
    <div class="f12-panel">
        <div class="f12-panel__header">
            <h2><?php echo __( "Objektanfragen", "f12cl_commercial" ); ?></h2>
            <p>
				<?php echo __( "Einstellungen für das Kontaktformular", "f12cl_commercial" ); ?>
            </p>
        </div>
        <div class="f12-panel__content">
            <table class="f12-table">
                <tr>
                    <td class="label" style="width:300px;">
                        <label><?php echo __( "Absender E-Mail", "f12cl_commercial" ); ?></label>
                        <p><?php echo __( "Geben Sie die E-Mail ein, von der die Mails versendet werden sollen.", "f12cl_commercial" ); ?></p>
                    </td>
                    <td>
                        <input type="text" name="<?php echo F12_CPT . "request-"; ?>email"
                               value="<?php echo $args[ F12_CPT . "request-email" ]; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width:300px;">
                        <label><?php echo __( "Seite nach dem senden?", "f12cl_commercial" ); ?></label>
                        <p><?php echo __( "Wählen Sie eine Seite aus, die nach dem senden des Formulars angezeigt werden soll.", "f12cl_commercial" ); ?></p>
                    </td>
                    <td>
                        <select name="<?php echo F12_CPT . "request-"; ?>page-send">
							<?php echo $args[ F12_CPT . "request-page-send" ]; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width:300px;">
                        <label><?php echo __( "Objektanfrage", "f12cl_commercial" ); ?></label>
                        <p>
				            <?php echo __( "Diese Seite wird beim Betätigen der Objektanfrage Schaltfläche geöffnet. Verwenden Sie den Shortcode [f12cl_request_form] zum laden des Formulars.", "f12cl_commercial" ); ?>
                        </p>
                    </td>
                    <td>
                        <select name="<?php echo F12_CPT."request-";?>page" class="f12-form-validate"
                                validation='{"validation":{"required":true}}'>
				            <?php echo $args[F12_CPT."request-page"]; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="plugin-objectrequest-intern">
    <div class="f12-panel__header">
        <h2><?php echo __( "Interne E-Mail Benachrichtigung", "f12cl_commercial" ); ?></h2>
        <p>
			<?php echo __( "Hier können Sie die E-Mail, die als interne Benachrichtigung an Sie versendet wird, editieren.", "f12cl_commercial" ); ?>
        </p>
    </div>
    <div class="f12-panel__content">
        <table class="f12-table">
            <tr>
                <td class="label" style="width:300px;">
                    <label><?php echo __( "Betreff", "f12cl_commercial" ); ?></label>
                    <p><?php echo __( "Geben Sie einen Betreff für die Nachricht ein", "f12cl_commercial" ); ?></p>
                </td>
                <td>
                    <input type="text" name="<?php echo F12_CPT . "request-"; ?>intern-subject"
                           value="<?php echo $args[ F12_CPT . "request-intern-subject" ]; ?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label><?php echo __( "Nachricht", "f12cl_commercial" ); ?></label>
                    <p><?php echo __( "Geben Sie den Inhalt der Nachricht ein.", "f12cl_commercial" ); ?></p>
                    <p><strong><?php echo __( "Platzhalter", "f12cl_commercial" ); ?></strong></p>
                    <p>{email}</p>
                    <p>{salutation}</p>
                    <p>{name}</p>
                    <p>{phone}</p>
                    <p>{city}</p>
                    <p>{message}</p>
                    <p>{object-id}</p>
                    <p>{object-name}</p>
                    <p>{object-link}</p>
                </td>
                <td>
					<?php
					echo wp_editor( $args[ F12_CPT . "request-intern-message" ], F12_CPT . "request-intern-message" );
					?>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="plugin-objectrequest-extern">
    <div class="f12-panel__header">
        <h2><?php echo __( "Externe E-Mail Benachrichtigung", "f12cl_commercial" ); ?></h2>
        <p>
			<?php echo __( "Hier können Sie die E-Mail, die als externe Benachrichtigung an den Besucher versendet wird, editieren.", "f12cl_commercial" ); ?>
        </p>
    </div>
    <div class="f12-panel__content">
        <table class="f12-table">
            <tr>
                <td class="label" style="width:300px;">
                    <label><?php echo __( "Betreff", "f12cl_commercial" ); ?></label>
                    <p><?php echo __( "Geben Sie einen Betreff für die Nachricht ein", "f12cl_commercial" ); ?></p>
                </td>
                <td>
                    <input type="text" name="<?php echo F12_CPT . "request-"; ?>extern-subject"
                           value="<?php echo $args[ F12_CPT . "request-extern-subject" ]; ?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label><?php echo __( "Nachricht", "f12cl_commercial" ); ?></label>
                    <p><?php echo __( "Geben Sie den Inhalt der Nachricht ein.", "f12cl_commercial" ); ?></p>
                    <p><strong><?php echo __( "Platzhalter", "f12cl_commercial" ); ?></strong></p>
                    <p>{email}</p>
                    <p>{salutation}</p>
                    <p>{name}</p>
                    <p>{phone}</p>
                    <p>{city}</p>
                    <p>{message}</p>
                    <p>{object-id}</p>
                    <p>{object-name}</p>
                    <p>{object-link}</p>
                </td>
                <td>
					<?php
					echo wp_editor( $args[ F12_CPT . "request-extern-message" ], F12_CPT . "request-extern-message" );
					?>
                </td>
            </tr>
        </table>
    </div>
</div>