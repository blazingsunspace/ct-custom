<div class="wrap">

    <section class="accordion accordion--radio">
        <div class="tab">
            <input type="radio" name="accordion-2" class="acordionRadio" id="rd1">
            <label for="rd1" class="tab__label text-2xl">Add Phone</label>
            <div class="tab__content">
                <?php include_once get_template_directory() . '/template-admin/partials/add-phone.php'; ?>
            </div>
        </div>

        <div class="tab">
            <input type="radio" name="accordion-2" class="acordionRadio" id="rd2">
            <label for="rd2" class="tab__label text-2xl">Add Fax</label>
            <div class="tab__content">
                <?php include_once get_template_directory() . '/template-admin/partials/add-fax.php'; ?>
            </div>
        </div>

        <div class="tab">
            <input type="radio" name="accordion-2" class="acordionRadio" id="rd3">
            <label for="rd3" class="tab__label text-2xl">Add Logo</label>
            <div class="tab__content">
                <?php include_once get_template_directory() . '/template-admin/partials/add-logo-image.php'; ?>
            </div>
        </div>

        <div class="tab">
            <input type="radio" name="accordion-2" class="acordionRadio" id="rd4">
            <label for="rd4" class="tab__label text-2xl">Add Address</label>
            <div class="tab__content">
                <?php include_once get_template_directory() . '/template-admin/partials/add-address.php'; ?>
            </div>
        </div>
        <div class="tab">
            <input type="radio" name="accordion-2" class="acordionRadio" id="rd5">
            <label for="rd5" class="tab__label text-2xl">Add Social Networks</label>
            <div class="tab__content">
                <?php include_once get_template_directory() . '/template-admin/partials/add-social-networks.php'; ?>
            </div>
        </div>
        <div class="tab">
            <input type="radio" name="accordion-2" id="rd66" class="acordionRadio">
            <label for="rd66" class="tab__close">Close open tab &times;</label>
        </div>
    </section>


   

    <dialog id="loadingDialog">

        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

    </dialog>
</div>