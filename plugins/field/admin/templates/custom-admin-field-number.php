<td class="label" style="width:300px;">
    <label>
		<?php echo $args["label"]; ?>
    </label>
</td>
<td style="width:350px;">
    <script type="text/javascript">
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode;

            if (charCode > 47 && charCode < 58)
                return true;

            return false;
        }
    </script>

    <input type="number" onkeypress="return isNumberKey(event)" name="<?php echo $args["name"]; ?>" value="<?php echo $args["value"];?>" />
</td>