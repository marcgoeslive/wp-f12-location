<tr>
    <td class="label" style="width:300px;">
		<?php echo $args["label"]; ?>
    </td>
    <td>
        <input id="<?php echo $args["input"]; ?>" type="checkbox" name="<?php echo $args["input"]; ?>"
               value="1" <?php echo $args["highlight"]; ?>>
        <label for="<?php echo $args["input"]; ?>">Hervorheben</label>
    </td>
</tr>