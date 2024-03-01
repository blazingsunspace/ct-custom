<div class="p-4">

    <h2 class="text-2xl mb-4"> Add social networks </h2>

    <?php
    $socialNetworks2 =  get_option('ct_custom_social_networks') ?  get_option('ct_custom_social_networks') :  '[]';

    $socialNetworks = json_decode(stripslashes($socialNetworks2));

    $socialNetworksOutputDiv = '';
    if (count($socialNetworks) > 0) {
        $socialNetworksOutputDiv .= '<ol class="flex flex-col">';
        $custom_css ='';
        foreach ($socialNetworks as $key => $socialNetwork) {
            $socialNetworksOutputDiv .= '<li class="p-4 flex border-indigo-600 border-b-4">' . ($key + 1) . '. ';
            $socialIcon = '';
            if ($socialNetwork->social_icon_type === 'icon') {
                $socialIconStyle = 'style="font-size: ' .  $socialNetwork->size . '; color:' .  $socialNetwork->color . '; border-radius: ' .  $socialNetwork->border_radius . ';"';
                $socialIcon = '<span class="p-0 m-0 flex items-center justify-center text-right dashicons ' . $socialNetwork->social_icon . '" ' . $socialIconStyle . '></span>';
                $socialATagStyle = 'style="height: ' .  $socialNetwork->size . '; width: ' .  $socialNetwork->size . '; background-color: ' .  $socialNetwork->background . '; border-radius: ' .  $socialNetwork->border_radius . '; padding: ' .  $socialNetwork->padding . ';"';
            } else if ($socialNetwork->social_icon_type === 'image') {
                $socialIcon = '<img src="' . $socialNetwork->social_icon . ' />';
            }

            $socialNetworksOutputDiv .= '
        
                       <a class="' . $socialNetwork->custom_class . ' flex items-center justify-center overflow-hidden ml-auto w-auto text-right box-content" href="' . $socialNetwork->url . '" title="' . $socialNetwork->name . '" ' . $socialATagStyle . '>
                        
                            ' . $socialIcon . '    

                       </a>
                    ';
            $socialNetworksOutputDiv .= '</li>';
            $custom_css .= $socialNetwork->custom_css;
        }

        $socialNetworksOutputDiv .= '</ol>';
        $custom_css = '<style>'. $custom_css. '</style>';
    }


    echo $socialNetworksOutputDiv . $custom_css;
    ?>



    <form id="add-social-networks-form" method="post" class="flex flex-col gap-4 bg-blue-500 text-white p-4" data-social-networks='<?php echo $socialNetworks2 ?>'>
        <div class="inputParrent w-full flex">
            <label for="name" class="min-w-[140px]">Name</label>
            <input type="text" name="name" id="name" class="grow" value="" required />


        </div>
        <div class="inputParrent w-full flex">
            <label for="url" class="min-w-[140px]">Url</label>
            <input type="text" name="url" id="url" class="grow" value="" required />


        </div>
        <div class="inputParrent w-full flex items-center">

            <label for="social_icon" class="min-w-[140px]">Social Icon</label>

            <div class="flex gap-4 w-full items-center">
                <input type="button" data-target="#dashicons_picker_example_icon1" class="button dashicons-picker " value="Choose Icon" />

                <span>OR</span>
                <input type='button' class="button-primary open_media_manager" data-selected-image="<?php echo get_option('logo_image'); ?>" data-pointer="socialLogo" value="<?php esc_attr_e('Select a image', 'mytextdomain'); ?>" />

                <div id="social_icon_preview" class="grow flex items-center">
                    <a href="" class="flex items-center justify-center overflow-hidden ml-auto w-auto text-right box-content">
                        <span class="flex items-center justify-center text-2xl"></span>
                    </a>

                </div>
            </div>

            <input type="hidden" id="socialNetworkIcon" name="social_icon" data-type required>

        </div>

        <div class="inputParrent w-full flex">
            <label for="size" class="min-w-[140px]">Size</label>
            <input type="range" name="size" id="size" class="grow" min="0" max="200" value="0" step="1" />
        </div>

        <div class="inputParrent w-full flex gap-4">
            <div class="flex-1 flex">
                <label for="background" class="min-w-[140px]">Backround Color</label>
                <input type="color" name="background" id="background" />


            </div>
            <div class="inputParrent flex-1 flex">
                <label for="color" class="min-w-[140px]">Color</label>
                <input type="color" name="color" id="color" />


            </div>
        </div>
        <div class="inputParrent w-full flex">
            <label for="border_radius" class="min-w-[140px]">Border Radius</label>
            <input type="range" name="border_radius" id="border_radius" class="grow" min="0" max="50" value="0" step="1" />


        </div>
        <div class="inputParrent w-full flex">
            <label for="padding" class="min-w-[140px]">Padding</label>
            <input type="range" name="padding" id="padding" class="grow" min="0" max="20" value="0" step="1" />


        </div>
        <div class="inputParrent w-full flex">
            <label for="custom_class" class="min-w-[140px]">Custom Class</label>
            <input type="text" name="custom_class" id="custom_class" class="grow" value="" />


        </div>
        <div class="inputParrent w-full flex">
            <label for="custom_css" class="min-w-[140px]">Custom CSS</label>
            <textarea rows="4" name="custom_css" id="custom_csss" class="grow text-black"></textarea>


        </div>

        <?php wp_nonce_field('admin_add_social_nerworks_nonce', 'admin_add_social_nerworks_nonce'); ?>
        <input data-check="" type="submit" value="<?php _e('Submit', 'split_traffic_a_b_testing') ?>" class="f1 button button-primary button-large" id="submit_add_social_nerworks">

    </form>
</div>