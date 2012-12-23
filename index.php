<?php


/*
    Plugin Name: SS Zip Unloader
    Author Name: Nicholas Pickering
    Author Email: 2nickpick@gmail.com
    Author URI: http://soundshrew.com/
    Plugin URI: http://soundshrew.com/plugins/ss-zip-unloader
    Description: Upload and extract zips to wp-content/uploads
    Version: 1.0
    License: GPL2
*/



// create menu page in Tools Menu

// create form to upload zip file

// on post, upload file to temp

// extract contents into /uploads

// remove temp file



function ss_zip_unloader_menu() {
    add_management_page (
        __('SS Zip Unloader'),
        __('SS Zip Unloader'),
        'manage_options',
        'ss-zip-unloader',
        'ss_zip_unloader_callback'        
    );
}
add_action('admin_menu', 'ss_zip_unloader_menu');

function ss_zip_unloader_callback() { ?>
    
    <?php screen_icon(); ?> <h2>SS Zip Unloader</h2>
    <?php include( plugin_dir_path(__FILE__) . 'action.php' ); ?>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="verb" id="verb" value="ss_zip_unloader" />
    <table>
        <tr>
            <th>
                Zip File: 
            </th>
            <td>
                <input type="file" name="file" id="file" /> <input type="checkbox" name="extract" id="extract" checked="checked"><small>Extract zip</small> <input type="submit" value="Upload" />
            </td>
        </tr>
    </table>
    </form>
    
    <hr />
    <small><a href="http://soundshrew.com/bbq-fund" target="_blank">Soundshrew: Keep the Programmer Fed</a></small>
    <?php
}
?>
