<div class="p-4">

    <h2 class="text-2xl mb-4"> Add logo image </h2>
    <form id="add_logo_image_form" class="flex flex-col gap-4 bg-orange-400 text-white p-4">

        <div class="w-full flex items-center">
            <?php wp_nonce_field('admin_add_logo_image_nonce', 'admin_add_logo_image_nonce'); ?>
            <label for="logo_image" class="min-w-[140px]">Upload logo image</label>
            <input type="hidden" name="logo_image" id="logo_image" value="<?php echo get_option('logo_image'); ?>" class="regular-text" />



            <?php

            if (get_option('logo_image')) {
                // Change with the image size you want to use
                $image = '<div id="logo_image_preview" class="grow" class="grow flex items-center"> ' .
                    wp_get_attachment_image(get_option('logo_image'), 'medium', false, array( 'class' => 'ml-auto text-2xl max-h-[128px] w-auto'))
                    . '</div>';
            } else {
                // Some default image
                $image = '<div id="logo_image_preview" class="grow flex items-center"><h2 class="ml-auto text-2xl">' . get_bloginfo('name') . '</h2></div>';
            }

            echo $image;

            ?>
        </div>

        <input type='button' class="button-primary open_media_manager" data-selected-image="<?php echo get_option('logo_image'); ?>" data-pointer="logo" value="<?php esc_attr_e('Select a image', 'mytextdomain'); ?>" />
    </form>
</div>