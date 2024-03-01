<?php



trait AdminAjaxTrait
{
    public function admin_upload_logo_image()
    {

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_logo_image_nonce')) {
            wp_send_json_error('invalid nonce fax');
        }

        if (isset($_POST['id'])) {

            if (!$this->option_exists('site_logo')) {

                add_option('site_logo', $_POST['id'], '', 'yes');
            } else {

                update_option('site_logo', $_POST['id']);
            }

            $image = wp_get_attachment_image($_POST['id'], 'medium', false, array('class' => 'ml-auto text-2xl max-h-[128px] w-auto'));

            $data = array(
                'image'    => $image,
            );

            wp_send_json_success($data);
        } else {
            wp_send_json_error();
        }
    }

    public function admin_add_phone()
    {


        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_phone_nonce')) {
            wp_send_json_error('invalid nonce phone');
        }

        if (!current_user_can('manage_options')) {
            wp_send_json_error('invalid permissions');
        }

        try {
            if (isset($_POST['input'])  && !empty($_POST['input'])) {
                if (!$this->option_exists('ct_custom_phone')) {
                    add_option('ct_custom_phone', $_POST['input'], '', 'yes');
                } else {
                    update_option('ct_custom_phone', $_POST['input']);
                }


                wp_send_json_success(data: ['message' => '✅ Nonce is valid! phone'], options: 1);
            }
        } catch (\Throwable $th) {
            wp_send_json_error(data: ['message' => $th->getMessage()], options: 1);
        }
    }

    public function admin_add_social_nerworks()
    {



        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_social_nerworks_nonce')) {
            wp_send_json_error('invalid nonce fax');
        }

        if (!current_user_can('manage_options')) {
            wp_send_json_error('invalid permissions');
        }

        try {
            if (isset($_POST['input'])  && !empty($_POST['input'])) {
                $jsonObject = json_encode(json_decode(stripslashes($_POST['input'])));

                if (!$this->option_exists('ct_custom_social_networks')) {
                    add_option('ct_custom_social_networks', $jsonObject, '', 'yes');
                } else {
                    update_option('ct_custom_social_networks', $jsonObject);
                }


                wp_send_json_success(data: ['message' => '✅ Nonce is valid! address'], options: 1);
            }
        } catch (\Throwable $th) {
            wp_send_json_error(data: ['message' => $th->getMessage()], options: 1);
        }
    }

    public function admin_add_address()
    {



        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_address_nonce')) {
            wp_send_json_error('invalid nonce fax');
        }

        if (!current_user_can('manage_options')) {
            wp_send_json_error('invalid permissions');
        }

        try {
            if (isset($_POST['input'])  && !empty($_POST['input'])) {
                /* $jsonObject = json_decode(base64_decode($_POST['input'])); */

                if (!$this->option_exists('ct_custom_address')) {
                    add_option('ct_custom_address', $_POST['input'], '', 'yes');
                } else {
                    update_option('ct_custom_address', $_POST['input']);
                }


                wp_send_json_success(data: ['message' => '✅ Nonce is valid! address'], options: 1);
            }
        } catch (\Throwable $th) {
            wp_send_json_error(data: ['message' => $th->getMessage()], options: 1);
        }
    }

    public function admin_add_fax()
    {


        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_fax_nonce')) {
            wp_send_json_error('invalid nonce fax');
        }

        if (!current_user_can('manage_options')) {
            wp_send_json_error('invalid permissions');
        }

        try {
            if (isset($_POST['input'])  && !empty($_POST['input'])) {
                if (!$this->option_exists('ct_custom_fax')) {
                    add_option('ct_custom_fax', $_POST['input'], '', 'yes');
                } else {
                    update_option('ct_custom_fax', $_POST['input']);
                }


                wp_send_json_success(data: ['message' => '✅ Nonce is valid! fax'], options: 1);
            }
        } catch (\Throwable $th) {
            wp_send_json_error(data: ['message' => $th->getMessage()], options: 1);
        }
    }

    private function option_exists($name, $site_wide = false)
    {
        global $wpdb;
        return $wpdb->query("SELECT * FROM " . ($site_wide ? $wpdb->base_prefix : $wpdb->prefix) . "options WHERE option_name ='$name' LIMIT 1");
    }
}
