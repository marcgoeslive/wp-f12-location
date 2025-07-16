<div class="meta-page f12-page-settings">
    <h1>Immobilien Einstellungen</h1>
    <p>
        <?php echo __("Hier können Sie die Einstellungen für das Immobilien-Plugin vornehmen.");?>
    </p>

    <form action="<?php echo esc_url( admin_url( "admin-post.php" ) ); ?>" method="post"
          name="<?php echo F12_CPT; ?>settings" id="<?php echo F12_CPT; ?>settings">
        <input type="hidden" name="action" value="<?php echo F12_CPT; ?>settings_save">

        <div class="f12-admin">
            <div class="f12-admin-sidebar">
                <ul>
                    <li>
                        <a href="#commercial-property" class="active">Gewerbeimmobilien</a>
                        <ul>
                            <li><a href="#commercial-property-rent">Mietobjekte</a></li>
                            <li><a href="#commercial-property-buy">Kaufobjekte</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#residential-property">Wohnimmobilien</a>
                        <ul>
                            <li><a href="#residential-property-rent">Mietobjekte</a></li>
                            <li><a href="#residential-property-buy">Kaufobjekte</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#images">Bilder</a>
                    </li>
                    <li>
                        <a href="#plugins">Erweiterungen</a>

                        <?php do_action("f12cl_admin_navigation_plugin");?>
                    </li>
                    <?php do_action("f12cl_admin_navigation"); ?>
                </ul>
            </div>
            <div class="f12-admin-content">
                <div id="commercial-property" class="active">
					<?php include( "admin-commercial-property.php" ); ?>
                </div>
                <div id="commercial-property-rent">
					<?php include( "admin-commercial-property-rent.php" ); ?>
                </div>
                <div id="commercial-property-buy">
					<?php include( "admin-commercial-property-buy.php" ); ?>
                </div>
                <div id="residential-property">
					<?php include( "admin-residential-property.php" ); ?>
                </div>
                <div id="residential-property-rent">
					<?php include( "admin-residential-property-rent.php" ); ?>
                </div>
                <div id="residential-property-buy">
					<?php include( "admin-residential-property-buy.php" ); ?>
                </div>
                <div id="images">
					<?php include( "admin-images.php" ); ?>
                </div>
                <div id="plugins">
					<?php include( "admin-plugins.php" ); ?>
                </div>
                <?php do_action("f12cl_admin_content"); ?>
                <input type="submit" name="<?php echo F12_CPT; ?>settings" value="Speichern"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("form#<?php echo F12_CPT; ?>settings").F12FormValidate();
    });
</script>