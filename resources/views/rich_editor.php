<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php } ?>

<?php if ($showField) { ?>
    <?= Form::textarea($name, $options['value'], $options['attr']) ?>

    <?php include 'help_block.php' ?>
<?php } ?>

<?php include 'errors.php' ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>

<script src="<?= asset(mix('js/tinymce/tinymce.min.js', 'vendor/laravel-form-builder-fields')) ?>"></script>
<script>
tinymce.init({
    selector: '#<?= $name ?>',
    language: '<?= str_replace('-', '_', app()->getLocale()) ?>',
    height: 400,
    plugins: [
        'advlist autolink link image media lists charmap',
        'preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking',
        'save table directionality emoticons template paste'
    ],
    statusbar: false,
    paste_data_images: true,
    relative_urls: false,
    style_formats: [
        { title: 'Paragraph', format: 'p' },
        { title: 'Heading 1', format: 'h1' },
        { title: 'Heading 2', format: 'h2' },
        { title: 'Heading 3', format: 'h3' },
        { title: 'Heading 4', format: 'h4' },
        { title: 'Heading 5', format: 'h5' },
        { title: 'Heading 6', format: 'h6' }
    ],
    toolbar_drawer: 'sliding',
    toolbar: [
        'undo redo | styleselect | bold italic underline strikethrough',
        'forecolor backcolor emoticons | link image media table',
        'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'
    ]<?php if ($options['upload_image']) { ?>,
    images_upload_handler: function (blobInfo, success, failure) {
        var formData = new FormData();
        formData.append('upload_file', blobInfo.blob(), blobInfo.filename());
        axios.post('<?= route('upload') ?>', formData)
            .then(function (response) {
                success(response.data.location);
            })
            .catch(error => {
                if (error.response.status === 422) {
                    failure(error.response.data.errors.upload_file[0]);
                }

                failure('<?= __('Upload error') ?>');
            });
    }<?php } ?>
});
</script>
