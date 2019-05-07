<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?= Form::textarea($name, $options['value'], $options['attr']) ?>

    <?php include 'help_block.php' ?>
<?php endif; ?>

<?php include 'errors.php' ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<script src="<?= asset(mix('js/tinymce/tinymce.min.js', 'vendor/laravel-form-builder-fields')) ?>"></script>
<script>
tinymce.init({
    selector: '#<?= $name ?>',
    language: '<?= str_replace('-', '_', app()->getLocale()) ?>',
    height: 400,
    plugins: [
        'advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking',
        'save table directionality emoticons template paste'
    ],
    menubar: false,
    statusbar: false,
    paste_data_images: true,
    relative_urls: false,
    style_formats: [
        { title: 'Heading 1', format: 'h1' },
        { title: 'Heading 2', format: 'h2' },
        { title: 'Heading 3', format: 'h3' }
    ],
    toolbar_drawer: 'sliding',
    toolbar: [
        'preview | styleselect | undo redo copy paste | bold italic underline strikethrough',
        'forecolor backcolor emoticons | link image media table',
        'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'
    ]<?php if ($options['upload_image']): ?>,
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
    }<?php endif; ?>
});
</script>
