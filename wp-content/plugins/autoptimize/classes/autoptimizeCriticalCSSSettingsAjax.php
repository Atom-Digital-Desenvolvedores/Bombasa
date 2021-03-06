<?php
/**
 * Critical CSS settings AJAX logic.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class autoptimizeCriticalCSSSettingsAjax {
    public function __construct()
    {
        // fetch all options at once and populate them individually explicitely as globals.
        $all_options = autoptimizeCriticalCSSBase::fetch_options();
        foreach ( $all_options as $_option => $_value ) {
            global ${$_option};
            ${$_option} = $_value;
        }
        $this->run();
    }

    public function run() {
        // add filters.
        add_action( 'wp_ajax_fetch_critcss', array( $this, 'critcss_fetch_callback' ) );
        add_action( 'wp_ajax_save_critcss', array( $this, 'critcss_save_callback' ) );
        add_action( 'wp_ajax_rm_critcss', array( $this, 'critcss_rm_callback' ) );
        add_action( 'wp_ajax_rm_critcss_all', array( $this, 'critcss_rm_all_callback' ) );
        add_action( 'wp_ajax_ao_ccss_export', array( $this, 'ao_ccss_export_callback' ) );
        add_action( 'wp_ajax_ao_ccss_import', array( $this, 'ao_ccss_import_callback' ) );
    }

    public function critcss_fetch_callback() {
        // Ajax handler to obtain a critical CSS file from the filesystem.
        // Check referer.
        check_ajax_referer( 'fetch_critcss_nonce', 'critcss_fetch_nonce' );

        // Initialize error flag.
        $error = true;

        // Allow no content for MANUAL rules (as they may not exist just yet).
        if ( current_user_can( 'manage_options' ) && empty( $_POST['critcssfile'] ) ) {
            $content = '';
            $error   = false;
        } elseif ( current_user_can( 'manage_options' ) && $this->critcss_check_filename( $_POST['critcssfile'] ) ) {
            // Or check user permissios and filename.
            // Set file path and obtain its content.
            $critcssfile = AO_CCSS_DIR . strip_tags( $_POST['critcssfile'] );
            if ( file_exists( $critcssfile ) ) {
                $content = file_get_contents( $critcssfile );
                $error   = false;
            }
        }

        // Prepare response.
        if ( $error ) {
            $response['code']   = '500';
            $response['string'] = 'Error reading file ' . $critcssfile . '.';
        } else {
            $response['code']   = '200';
            $response['string'] = $content;
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }

    public function critcss_save_callback() {
        $error    = false;
        $status   = false;
        $response = array();

        // Ajax handler to write a critical CSS to the filesystem
        // Check referer.
        check_ajax_referer( 'save_critcss_nonce', 'critcss_save_nonce' );

        // Allow empty contents for MANUAL rules (as they are fetched later).
        if ( current_user_can( 'manage_options' ) && empty( $_POST['critcssfile'] ) ) {
            $critcssfile = false;
            $status      = true;
        } elseif ( current_user_can( 'manage_options' ) && $this->critcss_check_filename( $_POST['critcssfile'] ) ) {
            // Or check user permissios and filename
            // Set critical CSS content.
            $critcsscontents = stripslashes( $_POST['critcsscontents'] );

            // If there is content and it's valid, write the file.
            if ( $critcsscontents && autoptimizeCriticalCSSCore::ao_ccss_check_contents( $critcsscontents ) ) {
                // Set file path and status.
                $critcssfile = AO_CCSS_DIR . strip_tags( $_POST['critcssfile'] );
                $status      = file_put_contents( $critcssfile, $critcsscontents, LOCK_EX );
                // Or set as error.
            } else {
                $error = true;
            }
            // Or just set an error.
        } else {
            $error = true;
        }

        // Prepare response.
        if ( ! $status || $error ) {
            $response['code']   = '500';
            $response['string'] = 'Error saving file ' . $critcssfile . '.';
        } else {
            $response['code'] = '200';
            if ( $critcssfile ) {
                $response['string'] = 'File ' . $critcssfile . ' saved.';
            } else {
                $response['string'] = 'Empty content do not need to be saved.';
            }
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }


    public function critcss_rm_callback() {
        // Ajax handler to delete a critical CSS from the filesystem
        // Check referer.
        check_ajax_referer( 'rm_critcss_nonce', 'critcss_rm_nonce' );

        // Initialize error and status flags.
        $error  = true;
        $status = false;

        // Allow no file for MANUAL rules (as they may not exist just yet).
        if ( current_user_can( 'manage_options' ) && empty( $_POST['critcssfile'] ) ) {
            $error = false;
        } elseif ( current_user_can( 'manage_options' ) && $this->critcss_check_filename( $_POST['critcssfile'] ) ) {
            // Or check user permissios and filename
            // Set file path and delete it.
            $critcssfile = AO_CCSS_DIR . strip_tags( $_POST['critcssfile'] );
            if ( file_exists( $critcssfile ) ) {
                $status = unlink( $critcssfile );
                $error  = false;
            }
        }

        // Prepare response.
        if ( $error ) {
            $response['code']   = '500';
            $response['string'] = 'Error removing file ' . $critcssfile . '.';
        } else {
            $response['code'] = '200';
            if ( $status ) {
                $response['string'] = 'File ' . $critcssfile . ' removed.';
            } else {
                $response['string'] = 'No file to be removed.';
            }
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }

    public function critcss_rm_all_callback() {
        // Ajax handler to delete a critical CSS from the filesystem
        // Check referer.
        check_ajax_referer( 'rm_critcss_all_nonce', 'critcss_rm_all_nonce' );

        // Initialize error and status flags.
        $error  = true;
        $status = false;

        // Remove all ccss files on filesystem.
        if ( current_user_can( 'manage_options' ) ) {
            if ( file_exists( AO_CCSS_DIR ) && is_dir( AO_CCSS_DIR ) ) {
                array_map( 'unlink', glob( AO_CCSS_DIR . 'ccss_*.css', GLOB_BRACE ) );
                $error  = false;
                $status = true;
            }
        }

        // Prepare response.
        if ( $error ) {
            $response['code']   = '500';
            $response['string'] = 'Error removing all critical CSS files.';
        } else {
            $response['code'] = '200';
            if ( $status ) {
                $response['string'] = 'Critical CSS Files removed.';
            } else {
                $response['string'] = 'No file removed.';
            }
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }

    public function ao_ccss_export_callback() {
        // Ajax handler export settings
        // Check referer.
        check_ajax_referer( 'ao_ccss_export_nonce', 'ao_ccss_export_nonce' );

        if ( ! class_exists( 'ZipArchive' ) ) {
            $response['code'] = '500';
            $response['msg']  = 'PHP ZipArchive not present, cannot create zipfile';
            echo json_encode( $response );
            wp_die();
        }

        // Init array, get options and prepare the raw object.
        $settings               = array();
        $settings['rules']      = get_option( 'autoptimize_ccss_rules' );
        $settings['additional'] = get_option( 'autoptimize_ccss_additional' );
        $settings['viewport']   = get_option( 'autoptimize_ccss_viewport' );
        $settings['finclude']   = get_option( 'autoptimize_ccss_finclude' );
        $settings['rlimit']     = get_option( 'autoptimize_ccss_rlimit' );
        $settings['noptimize']  = get_option( 'autoptimize_ccss_noptimize' );
        $settings['debug']      = get_option( 'autoptimize_ccss_debug' );
        $settings['key']        = get_option( 'autoptimize_ccss_key' );

        // Initialize error flag.
        $error = true;

        // Check user permissions.
        if ( current_user_can( 'manage_options' ) ) {
            // Prepare settings file path and content.
            $exportfile = AO_CCSS_DIR . 'settings.json';
            $contents   = json_encode( $settings );
            $status     = file_put_contents( $exportfile, $contents, LOCK_EX );
            $error      = false;
        }

        // Prepare archive.
        $zipfile = AO_CCSS_DIR . date( 'Ymd-H\hi' ) . '_ao_ccss_settings.zip';
        $file    = pathinfo( $zipfile, PATHINFO_BASENAME );
        $zip     = new ZipArchive();
        $ret     = $zip->open( $zipfile, ZipArchive::CREATE );
        if ( true !== $ret ) {
            $error = true;
        } else {
            $zip->addFile( AO_CCSS_DIR . 'settings.json', 'settings.json' );
            if ( file_exists( AO_CCSS_DIR . 'queue.json' ) ) {
                $zip->addFile( AO_CCSS_DIR . 'queue.json', 'queue.json' );
            }
            $options = array(
                'add_path'        => './',
                'remove_all_path' => true,
            );
            $zip->addGlob( AO_CCSS_DIR . '*.css', 0, $options );
            $zip->close();
        }

        // Prepare response.
        if ( ! $status || $error ) {
            $response['code'] = '500';
            $response['msg']  = 'Error saving file ' . $file . ', code: ' . $ret;
        } else {
            $response['code'] = '200';
            $response['msg']  = 'File ' . $file . ' saved.';
            $response['file'] = $file;
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }

    public function ao_ccss_import_callback() {
        // Ajax handler import settings
        // Check referer.
        check_ajax_referer( 'ao_ccss_import_nonce', 'ao_ccss_import_nonce' );

        // Initialize error flag.
        $error = false;

        // Process an uploaded file with no errors.
        if ( current_user_can( 'manage_options' ) && ! $_FILES['file']['error'] && strpos( $_FILES['file']['name'], '.zip' ) === strlen( $_FILES['file']['name'] ) - 4 ) {
            // Save file to the cache directory.
            $zipfile = AO_CCSS_DIR . $_FILES['file']['name'];
            move_uploaded_file( $_FILES['file']['tmp_name'], $zipfile );

            // Extract archive.
            $zip = new ZipArchive;
            if ( $zip->open( $zipfile ) === true ) {
                $zip->extractTo( AO_CCSS_DIR );
                $zip->close();
            } else {
                $error = 'could not extract';
            }

            if ( ! $error ) {
                // only known files allowed, all others are deleted.
                $_dir_contents_ccss = glob( AO_CCSS_DIR . 'ccss_*.css' );
                $_dir_known_ok      = array( AO_CCSS_DIR . 'queue.lock', AO_CCSS_DIR . 'queuelog.html', AO_CCSS_DIR . 'index.html', AO_CCSS_DIR . 'settings.json' );
                $_dir_contents_ok   = array_merge( $_dir_contents_ccss, $_dir_known_ok );
                $_dir_contents_all  = glob( AO_CCSS_DIR . '*' );
                $_dir_to_be_deleted = array_diff( $_dir_contents_all, $_dir_contents_ok );
                foreach ( $_dir_to_be_deleted as $_file_to_be_deleted ) {
                    unlink( $_file_to_be_deleted );
                }

                // Archive extraction ok, continue settings importing
                // Settings file.
                $importfile = AO_CCSS_DIR . 'settings.json';

                if ( file_exists( $importfile ) ) {
                    // Get settings and turn them into an object.
                    $settings = json_decode( file_get_contents( $importfile ), true );

                    // Update options.
                    update_option( 'autoptimize_ccss_rules', $settings['rules'] );
                    update_option( 'autoptimize_ccss_additional', $settings['additional'] );
                    update_option( 'autoptimize_ccss_viewport', $settings['viewport'] );
                    update_option( 'autoptimize_ccss_finclude', $settings['finclude'] );
                    update_option( 'autoptimize_ccss_rlimit', $settings['rlimit'] );
                    update_option( 'autoptimize_ccss_noptimize', $settings['noptimize'] );
                    update_option( 'autoptimize_ccss_debug', $settings['debug'] );
                    update_option( 'autoptimize_ccss_key', $settings['key'] );
                } else {
                    // Settings file doesn't exist, update error flag.
                    $error = 'settings file does not exist';
                }
            }
        } else {
            $error = 'file could not be saved';
        }

        // Prepare response.
        if ( $error ) {
            $response['code'] = '500';
            $response['msg']  = 'Error importing settings: ' . $error;
        } else {
            $response['code'] = '200';
            $response['msg']  = 'Settings imported successfully';
        }

        // Dispatch respose.
        echo json_encode( $response );

        // Close ajax request.
        wp_die();
    }

    public function critcss_check_filename( $filename ) {
        // Try to avoid directory traversal when reading/writing/deleting critical CSS files.
        if ( strpos( $filename, 'ccss_' ) !== 0 ) {
            return false;
        } elseif ( substr( $filename, -4, 4 ) !== '.css' ) {
            return false;
        } elseif ( sanitize_file_name( $filename ) !== $filename ) {
            // Use WordPress core's sanitize_file_name to see if anything fishy is going on.
            return false;
        } else {
            return true;
        }
    }
}
