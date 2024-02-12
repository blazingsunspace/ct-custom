<div class="p-4">

    <h2 class="text-2xl mb-4"> Add address </h2>
    <form id="add_address_form" class="bg-sky-800 text-white p-4 flex flex-col gap-4" value="<?php echo get_option('ct_custom_address'); ?>" data-check="<?php echo get_option('ct_custom_address'); ?>">

        <?php

            $addressObject = json_decode(stripslashes(get_option('ct_custom_address')));

        ?>

        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="street_address">Street address</label>
            <input type="text" name="street_address" class="grow addressInputs" id="street_address" value="<?php echo $addressObject->street_address ?>" />
        </div>

        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="street_number">Street number</label>
            <input type="text" name="street_number" class="grow addressInputs" id="street_number" value="<?php echo $addressObject->street_number ?>" />
        </div>


        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="city">City</label>
            <input type="text" name="city" class="grow addressInputs" id="city" value="<?php echo $addressObject->city ?>" />
        </div>

        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="state">State</label>
            <input type="text" name="state" class="grow addressInputs" id="state" value="<?php echo $addressObject->state ?>" />
        </div>

        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="postal_code">Postal code</label>
            <input type="text" name="postal_code" class="grow addressInputs" id="postal_code" value="<?php echo $addressObject->postal_code ?>" />
        </div>


        <div class="w-full flex gap-4">
            <label class="min-w-[140px]" for="country">Country</label>
            <input type="text" name="country" class="grow addressInputs" id="country" value="<?php echo $addressObject->country ?>" />
        </div>

        <?php wp_nonce_field('admin_add_address_nonce', 'admin_add_address_nonce'); ?>

        <input disabled data-check="<?php echo get_option('ct_custom_address'); ?>" type="submit" value="<?php _e('Submit', 'split_traffic_a_b_testing') ?>" class="f1 button button-primary button-large" id="submit_add_address">

    </form>
</div>