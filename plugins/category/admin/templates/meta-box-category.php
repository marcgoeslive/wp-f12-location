<?php $args["wp-nonce-field"]; ?>
<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label><?php echo __( "Optionen", "f12cl_commercial" ); ?></label>
            <p><?php echo __( "Wählen Sie die Gruppen aus die in dieser Kategorie dargestellt werden sollen.", "f12cl_commercial" ); ?></p>
        </td>
        <td style="padding:0;">
            <table class="f12-table">
	            <?php echo $args["group"]; ?>
            </table>
        </td>
    </tr>
</table>