<?php 
public function admin_upload_logo_image()
{

    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'admin_add_logo_image_nonce')) {
        wp_send_json_error('invalid nonce fax');
    }

    if (isset($_POST['id'])) {

        if (!$this->option_exists('logo_image')) {

            add_option('logo_image', $_POST['id'], '', 'yes');
        } else {

            update_option('logo_image', $_POST['id']);
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

?>