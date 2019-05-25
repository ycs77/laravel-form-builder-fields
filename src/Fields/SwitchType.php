<?php

namespace Ycs77\LaravelFormBuilderFields\Fields;

class SwitchType extends FormField
{
    /**
     * @inheritdoc
     */
    protected $valueProperty = 'checked';

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'switch';
    }

    /**
     * @inheritdoc
     */
    public function getDefaults()
    {
        return [
            'attr' => ['class' => null, 'id' => $this->getName()],
            'value' => 1,
            'checked' => null,
        ];
    }

    /**
     * @inheritdoc
     */
    protected function isValidValue($value)
    {
        return $value !== null;
    }
}
