<td class="label" style="width:300px;">
    <label>
		<?php echo $args["label"]; ?>
    </label>
</td>
<td style="width:350px;">
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#<?php echo $args['name'];?>").datepicker({dateFormat: "dd-mm-yy"});
        });
    </script>
    <input type="text" id="<?php echo $args['name'];?>" name="<?php echo $args["name"]; ?>" value="<?php echo $args["value"];?>" />
</td>