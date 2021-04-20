<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/bhavsinh-ker
 * @since      1.0.0
 *
 * @package    My_Music
 * @subpackage My_Music/admin/partials
 */
$my_music_currency = get_option( 'my_music_currency', 'USD' );
$musics_per_page = get_option( 'my_music_musics_per_page', '10' );
?>
<div class="wrap">
    <h1><?php _e( 'Music Settings', 'my-music' ); ?></h1>
    <hr />
    <form method="post" action="options.php">
        <?php 
            if ( isset( $_GET['settings-updated'] ) ) {
                add_settings_error( 'my_music_setting_messages', 'my_music_setting_messages', __( 'Settings Saved', 'my-music' ), 'updated' );
            }
            settings_errors( 'my_music_setting_messages' );
    
            settings_fields( 'my_music_settings_group' );
            do_settings_sections( 'my-music-settings' );
        ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label for="my_music_currency">
                            <?php _e( 'Currency', 'my-music' ); ?>
                        </label>
                    </th>
                    <td>
                        <select name="my_music_currency" id="my_music_currency" class="regular-text">
                            <option <?php echo ($my_music_currency=="USD") ? 'selected="selected"' : ''; ?> value="USD"><?php echo '&#36; '.__( 'USD', 'my-music' ); ?></option>
                            <option <?php echo ($my_music_currency=="EUR") ? 'selected="selected"' : ''; ?> value="EUR"><?php echo '&#128; '.__( 'EUR', 'my-music' ); ?></option>
                            <option <?php echo ($my_music_currency=="GBP") ? 'selected="selected"' : ''; ?> value="GBP"><?php echo '&#163; '.__( 'GBP', 'my-music' ); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="my_music_musics_per_page">
                            <?php _e( 'Musics Per Page', 'my-music' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="number" id="my_music_musics_per_page" name="my_music_musics_per_page" value="<?php echo $musics_per_page; ?>" class="regular-text" max="100">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>