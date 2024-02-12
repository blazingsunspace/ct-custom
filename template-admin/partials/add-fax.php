<div class="p-4">

    <h2 class="text-2xl mb-4"> Add fax </h2>
    <form id="add_fax_form" class="flex flex-col gap-4  bg-slate-800 text-white p-4">
        <div class="w-full flex">
            <label for="fax" class="min-w-[140px]">Fax</label>
            <input type="tel" name="fax" id="fax" class="grow" value="<?php echo get_option('ct_custom_fax'); ?>" />

            <?php wp_nonce_field('admin_add_fax_nonce', 'admin_add_fax_nonce'); ?>
        </div>


        <input disabled data-check="<?php echo get_option('ct_custom_fax'); ?>" type="submit" value="<?php _e('Submit', 'split_traffic_a_b_testing') ?>" class="f1 button button-primary button-large" id="submit_add_fax">

    </form>
</div>