<div class="p-4">

    <h2 class="text-2xl mb-4"> Add phone </h2>
    <form id="add_phone_form" class="flex flex-col gap-4 bg-blue-500 text-white p-4">
        <div class="w-full flex">
            <label for="phone" class="min-w-[140px]">Phone</label>
            <input type="tel" name="phone" id="phone" class="grow" value="<?php echo get_option('ct_custom_phone'); ?>" />

            <?php wp_nonce_field('admin_add_phone_nonce', 'admin_add_phone_nonce'); ?>
        </div>

        <input disabled data-check="<?php echo get_option('ct_custom_phone'); ?>" type="submit" value="<?php _e('Submit', 'split_traffic_a_b_testing') ?>" class="f1 button button-primary button-large" id="submit_add_phone">

    </form>
</div>