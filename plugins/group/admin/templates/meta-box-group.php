<?php $args["wp-nonce-field"]; ?>
<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label><?php echo __( "Optionen", "f12cl_commercial" ); ?></label>
            <p><?php echo __( "Wählen Sie die Listen & Felder aus, die in dieser Gruppe dargestellt werden sollen.", "f12cl_commercial" ); ?></p>
        </td>
        <td>
            <b><?php echo __("Listen", "f12cl_commercial");?></b>
            <ul>
                <?php echo $args["lists"];?>
            </ul>
            <b><?php echo __("Felder", "f12cl_commercial");?></b>
            <ul>
	            <?php echo $args["fields"];?>
            </ul>
        </td>
    </tr>
</table>