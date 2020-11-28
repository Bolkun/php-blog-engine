tinymce.init({
    // replace textarea having class .tinymce with tinymce editor
    selector: "textarea.tinymce",

    // toolbar sticky when scrolling down a web page until the editor is no longer visible.
    toolbar_sticky: true,

    // width and height of the editor
    width: "100%",

	// display or hide 1-st row
    menubar: true,

    // 1-st row - plugin
    plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality ' +
		'advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr ' +
		'pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker ' +
		'a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments ' +
		'mentions quickbars linkchecker emoticons advtable autoresize code',

    mobile: {
        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save ' +
			'directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample ' +
			'table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount ' +
			'tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter pageembed charmap mentions ' +
			'quickbars linkchecker emoticons advtable autoresize code'
    },
    menu: {
        tc: {
            title: 'TinyComments',
            items: 'addcomment showcomments deleteallconversations'
        }
    },

    // 2-d row toolbar
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect | fontsizeselect | formatselect | ' +
		'alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | ' +
		'forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | ' +
		'fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | ' +
		'a11ycheck ltr rtl | showcomments addcomment | code',

    // display all toolbar in a line
    toolbar_mode: 'wrap',

    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",

	// display logo "POWERED BY TINY"
    branding: false,

    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Arial,sans-serif; font-size:14px }',
    image_class_list: [
        //{title: 'None', value: ''},
        {title: 'img-fluid zoom', value: 'img-fluid zoom'}
    ],
});
