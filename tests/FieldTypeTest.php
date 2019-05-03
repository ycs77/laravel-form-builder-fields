<?php

namespace Ycs77\LaravelFormFieldType\Test;

use FieldType;
use FormBuilder;

class FieldTypeTest extends TestCase
{
    /** @test */
    public function testRenderCheckboxGroup()
    {
        // arrange
        $form     = FormBuilder::plain();
        $expected = FormBuilder::plain()
            ->add('checkbox_group_field', 'checkable_group', [
                'choices' => [
                    'en' => 'English',
                    'fr' => 'French',
                ],
                'choice_options' => [
                    'wrapper' => ['class' => ''],
                ],
                'selected' => ['en'],
            ]);

        // act
        $actual = FieldType::render($form, [
            'checkbox_group_field' => [
                'type' => 'checkable_group',
                'choices' => [
                    'en' => 'English',
                    'fr' => 'French',
                ],
                'choice_options' => [
                    'wrapper' => ['class' => ''],
                ],
                'selected' => ['en'],
            ],
        ]);

        // assert
        $this->assertEquals($expected, $actual);
    }
}
