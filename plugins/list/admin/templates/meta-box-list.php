<?php $args["wp-nonce-field"]; ?>
<table class="f12-table">
    <tr>
        <td class="label">
            <label><?php echo __( "Optionen", "f12cl_commercial" ); ?></label>
            <p><?php echo __( "Fügen Sie weitere Optionen hinzu.", "f12cl_commercial" ); ?></p>
        </td>
        <td>
            <a href="post-new.php?post_type=f12cl_list_item&f12cl_list-item-group=<?php echo $args["list-item-group"]; ?>"
               class="button"><?php echo __( "Option erstellen", "f12cl_commercial" ); ?></a>
        </td>
    </tr>
</table>

<table class="wp-list-table widefat fixed striped posts ">
    <thead>
    <tr>
        <th scope="scole" style="width:300px;">
            Optionen
        </th>
    </tr>
    </thead>
    <tbody class="f12-sortable">
	<?php
	if ( isset( $args["list-items"] ) ):
		foreach ( $args["list-items"] as $item ) :
            /* @var $item WP_Post */
			?>
            <tr id="<?php echo $item->ID; ?>">
                <td>
                    <a
                            href="post.php?post=<?php echo $item->ID; ?>&amp;action=edit"
                            aria-label="„<?php echo $item->post_title; ?>“ bearbeiten"><?php echo $item->post_title; ?></a>
                    <br>
                    <div class="row-actions">
                        <span class="edit"><a
                                    href="post.php?post=<?php echo $item->ID; ?>&amp;action=edit"
                                    aria-label="„<?php echo $item->post_title; ?>“ bearbeiten">Bearbeiten</a> | </span>
                        <span class="trash"><a
                                    href="<?php echo get_delete_post_link( $item->ID ); ?>&f12cl_list-item-group=<?php echo $args["list-item-group"];?>"
                                    class="submitdelete"
                                    aria-label="„<?php echo $item->post_title; ?>“ in den Papierkorb verschieben">In Papierkorb legen</a> | </span>
                    </div>
                </td>
            </tr>
		<?php
		endforeach;
	endif;
	?>
    </tbody>
</table>