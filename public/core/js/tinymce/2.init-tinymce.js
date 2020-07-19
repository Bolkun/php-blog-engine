tinymce.init({
    // replace textarea having class .tinymce with tinymce editor
    selector: "textarea.tinymce",

    // width and height of the editor
    width: "100%",

	// display or hide 1-st row
    menubar: true,

    // 1-st row - plugin
    plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality ' +
		'advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr ' +
		'pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker ' +
		'a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments ' +
		'mentions quickbars linkchecker emoticons advtable autoresize',

    mobile: {
        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save ' +
			'directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample' +
			' table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount ' +
			'tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions ' +
			'quickbars linkchecker emoticons advtable autoresize'
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
		'a11ycheck ltr rtl | showcomments addcomment',

    // display all toolbar in a line
    toolbar_mode: 'wrap',

    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",

	// only for premium user
    a11y_advanced_options: true,

	// display logo "POWERED BY TINY"
    branding: false,
});
