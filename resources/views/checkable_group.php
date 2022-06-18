<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php } ?>

<?php if ($showField) { ?>
    <?php foreach ((array)$options['children'] as $child) { ?>
        <?= $child->render($options['choice_options'], true, true, false) ?>
    <?php } ?>

    <?php if ($showError && isset($errors) && $errors->has($nameKey)) { ?>
    <div class="d-none form-control is-invalid"></div>
    <?php } ?>

    <?php include 'errors.php' ?>
    <?php include 'help_block.php' ?>
<?php } ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
