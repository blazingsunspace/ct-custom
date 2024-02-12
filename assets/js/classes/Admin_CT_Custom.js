export default class Admin_CT_Custom {

    constructor() {
        this.submitOptionToDB({
            submitButtonIdSelector: '#submit_add_phone',
            formIdSelector: '#add_phone_form',
            formElementToSubmit: "phone",
            nonceName: "admin_add_phone_nonce",
            wordpresAdminActionName: "admin_add_phone"

        })

        this.inputOnChange({
            submitButtonIdSelector: '#submit_add_phone',
            formIdSelector: '#add_phone_form',
            formElementToSubmit: "phone",
        })

        this.submitOptionToDB({
            submitButtonIdSelector: '#submit_add_fax',
            formIdSelector: '#add_fax_form',
            formElementToSubmit: "fax",
            nonceName: "admin_add_fax_nonce",
            wordpresAdminActionName: "admin_add_fax"

        })

        this.inputOnChange({
            submitButtonIdSelector: '#submit_add_fax',
            formIdSelector: '#add_fax_form',
            formElementToSubmit: "fax",
        })

        this.uploadImage({
            submitButtonIdSelector: '.open_media_manager',
            formIdSelector: '#add_logo_image_form',
            nonceName: "admin_add_logo_image_nonce",
            wordpresAdminActionName: "admin_upload_logo_image"

        })

        this.submitOptionToDB({
            submitButtonIdSelector: '#submit_add_address',
            formIdSelector: '#add_address_form',
            formElementToSubmit: "address",
            nonceName: "admin_add_address_nonce",
            wordpresAdminActionName: "admin_add_address"

        })

        this.addressInputsChange()

        this.socialNetworkInputsChange()
        this.submitOptionToDB({
            submitButtonIdSelector: '#submit_add_social_nerworks',
            formIdSelector: '#add-social-networks-form',
            formElementToSubmit: "social",
            nonceName: "admin_add_social_nerworks_nonce",
            wordpresAdminActionName: "admin_add_social_nerworks"

        })
    }

    socialNetworkInputsChange() {
        let form = document.querySelector('#add-social-networks-form')

        let background = form.elements['background']

        background.addEventListener('input', (e) => {
            let value = e.target.value

            if (document.querySelector('#social_icon_preview a')) {
                let span = document.querySelector('#social_icon_preview a')
                span.style.backgroundColor = value
                console.log('spanjara');
            }
        })

        let color = form.elements['color']

        color.addEventListener('input', (e) => {
            let value = e.target.value


            if (document.querySelector('#social_icon_preview a span')) {
                let span = document.querySelector('#social_icon_preview a span')
                span.style.color = value
                console.log('spanjara');
            } else if (document.querySelector('#social_icon_preview a img')) {
                let img = document.querySelector('#social_icon_preview a img')
                img.style.color = value
                console.log('img');
            }
        })

        let padding = form.elements['padding']

        padding.addEventListener('input', (e) => {
            let value = e.target.value


            if (document.querySelector('#social_icon_preview a')) {
                let span = document.querySelector('#social_icon_preview a')
                span.style.padding = value + 'px'
                console.log('spanjara');
            }
        })

        let custom_class = form.elements['custom_class']

        custom_class.addEventListener('input', (e) => {
            let value = e.target.value


            if (document.querySelector('#social_icon_preview a')) {
                let a = document.querySelector('#social_icon_preview a')
                a.className = `flex items-center justify-center overflow-hidden ml-auto w-auto text-right box-content ${value}`
                console.log('spanjara');
            }
        })

        let custom_css = form.elements['custom_css']

        custom_css.addEventListener('input', (e) => {
            let value = e.target.value


            if (document.querySelector('#social_icon_preview a')) {
                if (document.querySelector('#social_style')) {
                    document.querySelector('#social_style').innerHTML = value
                } else {


                    let style = document.createElement('style')
                    style.innerHTML = value
                    style.id = 'social_style'
                    document.querySelector('#add-social-networks-form').appendChild(style)
                }

            }
        })


        let border_radius = form.elements['border_radius']

        border_radius.addEventListener('input', (e) => {
            let value = e.target.value



            if (document.querySelector('#social_icon_preview a')) {
                let a = document.querySelector('#social_icon_preview a')
                a.style.borderRadius = value + '%'
                console.log('spanjara');
                if (document.querySelector('#social_icon_preview a img')) {
                    let img = document.querySelector('#social_icon_preview a img')
                    img.style.borderRadius = value + '%'
                }
                else if (document.querySelector('#social_icon_preview a span')) {
                    let span = document.querySelector('#social_icon_preview a span')
                    span.style.borderRadius = value + '%'
                }
            }
        })

        let size = form.elements['size']

        size.addEventListener('input', (e) => {
            let value = e.target.value



            if (document.querySelector('#social_icon_preview a span')) {
                let a = document.querySelector('#social_icon_preview a')
                a.style.height = value + 'px'
                a.style.width = value + 'px'
                console.log('spanjara');
                let span = document.querySelector('#social_icon_preview a span')
                span.style.fontSize = value + 'px'
                console.log('spanjara');
            } else if (document.querySelector('#social_icon_preview a img')) {
                let a = document.querySelector('#social_icon_preview a')
                a.style.height = value + 'px'
                a.style.width = value + 'px'
                console.log('spanjara');
                let img = document.querySelector('#social_icon_preview a img')
                img.style.width = value + 'px'
                img.style.height = value + 'px'
                console.log('img');
            }
        })
    }

    uploadImage = ({ submitButtonIdSelector, formIdSelector, nonceName, wordpresAdminActionName }) => {




        // Prevent the default form submission


        document.querySelectorAll(submitButtonIdSelector).forEach((submitButton) => {
            submitButton.addEventListener('click', (e) => {

                e.preventDefault();

                let image_frame;
                if (image_frame) {
                    image_frame.open();
                }
                // Define image_frame as wp.media object
                image_frame = wp.media({
                    title: 'Select Media',
                    multiple: false,
                    library: {
                        type: 'image',
                    }
                });
                //image_frame.on('close', () => {
                image_frame.on('select', () => {
                    // On close, get selections and save to the hidden input
                    // plus other AJAX stuff to refresh the image preview
                    var selection = image_frame.state().get('selection');

                    var gallery_ids = new Array();
                    var my_index = 0;
                    let thumbnail

                    selection.forEach((attachment) => {
                        console.log(attachment.attributes);
                        thumbnail = attachment.attributes.sizes?.thumbnail?.url ? attachment.attributes.sizes?.thumbnail?.url : attachment.attributes.url
                        gallery_ids[my_index] = attachment['id'];
                        my_index++;
                    });

                    var ids = gallery_ids.join(",");

                    console.log(ids);
                    if (ids.length === 0) return true;//if closed withput selecting an image
                    //document.querySelector('#logo_image').value = ids;
                    submitButton.dataset.selectedImage = ids
                    this.refresh_image({ ids, formIdSelector, nonceName, submitButtonIdSelector, wordpresAdminActionName, previewLogoContainer: '#logo_image_preview', pointer: submitButton.dataset.pointer, thumbnail });
                });

                image_frame.on('open', () => {
                    // On open, get the id from the hidden input
                    // and select the appropiate images in the media manager
                    var selection = image_frame.state().get('selection');
                    console.log(submitButton.dataset.selectedImage, submitButton.dataset, submitButton);
                    var ids = submitButton.dataset.selectedImage !== '' ? submitButton.dataset.selectedImage.split(',') : [];
                    console.log(ids, '33333333');

                    ids.forEach((id) => {
                        console.log(id);
                        var attachment = wp.media.attachment(id);
                        attachment.fetch();
                        selection.add(attachment ? [attachment] : []);
                    });

                });

                image_frame.open();
            });
        })




    }

    // Ajax request to refresh the image preview
    refresh_image({ ids, formIdSelector, nonceName, submitButtonIdSelector, wordpresAdminActionName, previewLogoContainer, pointer, thumbnail }) {

        if (pointer === 'logo') {
            let nonce = document.querySelector(formIdSelector).elements[nonceName].value

            let data = new URLSearchParams({
                nonce,
                'action': wordpresAdminActionName,
                id: ids
            })

            loadingDialog.showModal()

            fetch(ajaxurl, {
                method: 'POST',
                body: data,
            }).then(
                response => response.json()
            ).then(data => {
                console.log(data, previewLogoContainer)
                loadingDialog.close()

                document.querySelector(previewLogoContainer).innerHTML = data.data.image;
            }).catch((error) => {
                console.error('Error:', error)
            }).finally(() => {
                loadingDialog.close()
            })

        } else {
            console.log('kromer');

            let thumbnail_image = document.createElement('img')
            thumbnail_image.src = thumbnail

            thumbnail_image.className = 'flex items-center justify-center ml-auto text-right'
            thumbnail_image.style.width = window.getComputedStyle(document.querySelector('#social_icon_preview a span')).fontSize
            thumbnail_image.style.height = window.getComputedStyle(document.querySelector('#social_icon_preview a span')).fontSize
            thumbnail_image.style.borderRadius = window.getComputedStyle(document.querySelector('#social_icon_preview a span')).borderRadius
            document.querySelector('#social_icon_preview a').innerHTML = ''
            document.querySelector('#social_icon_preview a').appendChild(thumbnail_image)

            document.querySelector('#socialNetworkIcon').value = ids
            document.querySelector('#socialNetworkIcon').dataset.type = 'image'
        }

    }



    inputOnChange = ({
        submitButtonIdSelector,
        formIdSelector,
        formElementToSubmit
    }) => {

        let phone = document.querySelector(formIdSelector).elements[formElementToSubmit];

        // Add an event listener for the input event
        phone.addEventListener("input", (e) => {

            if (e.currentTarget.value !== document.querySelector(submitButtonIdSelector).dataset.check) {
                document.querySelector(submitButtonIdSelector).disabled = false;
            } else {
                document.querySelector(submitButtonIdSelector).disabled = true;
            }
        });


    }

    /**
     * submitForm function is used for submitting data from plugin page, with this plugin we assure not to refresh inside of dashboard
    */

    submitOptionToDB = ({ submitButtonIdSelector, formIdSelector, formElementToSubmit, nonceName, wordpresAdminActionName }) => {


        document.querySelector(submitButtonIdSelector).addEventListener('click', (event) => {

            // Prevent the default form submission
            event.preventDefault();
            let input
            if (formElementToSubmit === 'address') {
                input = document.querySelector('#submit_add_address').dataset.check
            } else if (formElementToSubmit === 'social') {
                console.log('grrr');
                this.validateForm({ formIdSelector })
                return
            } else {
                input = document.querySelector(formIdSelector).elements[formElementToSubmit].value;
            }

            let nonce = document.querySelector(formIdSelector).elements[nonceName].value


            let loadingDialog = document.querySelector('#loadingDialog')

            loadingDialog.showModal()

            console.log(nonce);
            let data = new URLSearchParams({
                nonce,
                'action': wordpresAdminActionName,
                input
            })

            loadingDialog.showModal()

            fetch(ajaxurl, {
                method: 'POST',
                body: data,
            }).then(
                response => response.text()
            ).then(data => {
                console.log(data)
                loadingDialog.close()

                document.querySelector(submitButtonIdSelector).disabled = true;
                document.querySelector(submitButtonIdSelector).dataset.check = phone;
            }).catch((error) => {
                console.error('Error:', error)
            }).finally(() => {
                loadingDialog.close()
            })

        })


    }

    /**
     * rangeOnChange function is used for listening range changes so number can be displayed to user
    */

    addressInputsChange() {
        let addressObject = {
            street_address: '',
            street_number: '',
            city: '',
            state: '',
            postal_code: '',
            country: ''
        }

        let inputs = document.querySelectorAll('#add_address_form .addressInputs')

        inputs.forEach((input) => {
            input.addEventListener('input', (e) => {
                console.log(addressObject, document.querySelector('#add_address_form').dataset.check !== document.querySelector('#submit_add_address').dataset.check)
                addressObject[e.currentTarget.id] = e.currentTarget.value
                document.querySelector('#submit_add_address').dataset.check = JSON.stringify(addressObject)
                if (document.querySelector('#add_address_form').dataset.check !== document.querySelector('#submit_add_address').dataset.check) {
                    document.querySelector('#submit_add_address').disabled = false
                } else {
                    document.querySelector('#submit_add_address').disabled = true

                }
            })
        })
    }

    validateForm({ formIdSelector }) {
        let errors = []

        document.querySelectorAll(`${formIdSelector} input`).forEach((input) => {

            if (input.required) {
                if (input.value === '') {
                    console.log(`${formIdSelector} input[type="submit"]`);
                    input.style.border = '1px solid red'
                    input.closest('.inputParrent').style.boxShadow = '0 0 0 1px red'
                    document.querySelector(`${formIdSelector} input[type="submit"]`).disabled = true
                    Toastify({
                        text: `Input <b class="text-lg">${input.name}</b> is required`,
                        duration: 5000,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: false, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                        onClick: function () { } // Callback after click
                    }).showToast();

                    setTimeout(() => {
                        input.style.border = '1px solid #8c8f94'
                        input.closest('.inputParrent').style.boxShadow = '0 0 0 0px transparent'
                        document.querySelector(`${formIdSelector} input[type="submit"]`).disabled = false
                    }, 5000)
                }

            }
        })


    }

}