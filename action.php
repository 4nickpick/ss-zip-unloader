<?php

    if( isset($_POST['verb']) && $_POST['verb'] == 'ss_zip_unloader' )
    {
        if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $uploadedfile = $_FILES['file'];
        $upload_overrides = array( 'test_form' => false );
        $ext = pathinfo($uploadedfile['name'], PATHINFO_EXTENSION);
        if( $ext == 'zip' )
        {   
            if( isset($_POST['extract']) && $_POST['extract'] == 'on' )
            {
                $zip = zip_open($uploadedfile['tmp_name']);
                
                $uploads_dir = wp_upload_dir();
                while($zip_read = zip_read($zip)):

                    $zip_entry_name = zip_entry_name($zip_read);
                    if(strpos($zip_entry_name, '.')):
                        $path_to_touch = $uploads_dir['path'] . '/' . $zip_entry_name;
                        touch($path_to_touch);
                        $fopen = fopen($path_to_touch, 'w+');
                        fwrite($fopen, zip_entry_read($zip_read));
                        fclose($fopen);
                    else:
                        @mkdir($uploads_dir['path'] . '/'. $zip_entry_name);
                    endif;

                endwhile;
            }
            
            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
            if ( isset($movefile['url']) ) {
                echo '<div id="message" class="updated"><p>Files uploaded successfully. <br />URL: <a href="' . $uploads_dir['url'] . '">' . $uploads_dir['url'] . '</a><br /></p></div>';
            } else {
            echo '<div id="message" class="error"><p>File upload failed.</p></div>';
            }
        }   
        else
        {
            echo '<div id="message" class="error"><p>Only Zip files are accepted.</p></div>';
        }
    }
    else if( isset($_POST['verb']) )
    {
        wp_die("Coming from the wrong angle.");
    }
?>
