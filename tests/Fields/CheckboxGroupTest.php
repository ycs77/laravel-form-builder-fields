<?php

namespace Ycs77\LaravelFormBuilderFields\Test;

use Ycs77\LaravelFormBuilderFields\Fields\CheckableGroupType;
use Ycs77\LaravelFormBuilderFields\Test\TestCase;

class CheckboxGroupTest extends TestCase
{
    /** @test */
    public function testCheckboxGroupAsCheckbox()
    {
        // act
        /** @var array */
        $options = [
            'choices' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'selected' => ['yes'],
        ];

        $choice = new CheckableGroupType('some_checkable_group', 'checkable_group', $this->plainForm, $options);
        $choice->render();

        // assert
        $this->assertCount(2, $choice->getChildren());
        $this->assertEquals(['yes'], $choice->getOption('selected'));
    }

    /** @test */
    public function testCheckboxGroupAsRadio()
    {
        // act
        /** @var array */
        $options = [
            'choices' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'selected' => 'yes',
            'is_checkbox' => false,
        ];

        $choice = new CheckableGroupType('some_checkable_group', 'checkable_group', $this->plainForm, $options);
        $choice->render();

        // assert
        $this->assertCount(2, $choice->getChildren());
        $this->assertEquals('yes', $choice->getOption('selected'));
    }
}
