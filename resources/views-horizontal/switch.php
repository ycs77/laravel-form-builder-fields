<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php if ($options['innerWrapper'] ?? true): ?>
        <?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
            <div class="col-lg-10 offset-lg-2">
        <?php else: ?>
            <div class="col">
        <?php endif; ?>
    <?php endif; ?>

    <?= Form::checkbox($name, $options['value'], $options['checked'], $options['attr']) ?>

    <?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
        <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
    <?php endif; ?>

    <?php include 'errors.php' ?>
    <?php include 'help_block.php' ?>

    <?php if ($options['innerWrapper'] ?? true): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
