<tr>
    <th colspan="3">
		<?php echo $args["label"] ?>
    </th>
</tr>
<tr>
    <td class="label" style="width:300px;">
        <label for="<?php echo $args["name"]; ?>"
               style="font-weight:normal; vertical-align:top;"><?php echo __( "Anzeigen?", "f12cl_commercial" ); ?></label>
    </td>
    <td colspan="2">
        <input id="<?php echo $args["name"]; ?>" type="checkbox" name="<?php echo $args["input"]; ?>"
               value="1" <?php echo $args["value"]; ?>>
        Ja
    </td>
</tr>
<tr>
    <td class="label" style="width:300px;">
        <label for="<?php echo $args["name"]; ?>"
               style="font-weight:normal; vertical-align:top;"><?php echo __( "Position?", "f12cl_commercial" ); ?></label>
    </td>
    <td>
        <input id="<?php echo $args["name"]; ?>-position" type="radio" name="<?php echo $args["input"]; ?>-position"
               value="0" <?php echo $args["position-left"]; ?>>
        <label for="<?php echo $args["name"]; ?>-position">Links</label>
    </td>
    <td>
        <input id="<?php echo $args["name"]; ?>-position" type="radio" name="<?php echo $args["input"]; ?>-position"
               value="1" <?php echo $args["position-right"]; ?>>
        <label for="<?php echo $args["name"]; ?>-position">Rechts</label>
    </td>
</tr>
<tr>
    <td class="label" style="width:300px;">
        Felder
    </td>
    <td colspan="2" style="padding:0;">
        <table class="f12-table" >
			<?php echo $args["items"]; ?>
        </table>
    </td>
</tr>