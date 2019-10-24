<?php

namespace Ycs77\LaravelFormBuilderFields\Test;

use Illuminate\Translation\Translator;
use Kris\LaravelFormBuilder\FormHelper;
use Mockery;
use Ycs77\LaravelFormBuilderFields\Fields\CheckableGroupType;
use Ycs77\LaravelFormBuilderFields\Test\TestCase;

class CheckboxGroupTest extends TestCase
{
    public function testCheckboxGroupAsCheckbox()
    {
        // arrange
        $options = [
            'choices' => [
                'yes' => '是',
                'no' => '否',
            ],
            'selected' => ['yes'],
        ];

        // act
        $field = new CheckableGroupType(
            'some_checkable_group',
            'checkable_group',
            $this->plainForm,
            $options
        );
        $actual = $field->render();

        // assert
        $this->assertCount(2, $field->getChildren());
        $this->assertEquals(['yes'], $field->getOption('selected'));
        $this->assertNull($field->getOption('language_name'));
        $this->assertStringContainsString('<input id="some_checkable_group_yes" checked="checked" name="some_checkable_group[]" type="checkbox" value="yes">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_yes">是</label>', $actual);
        $this->assertStringContainsString('<input id="some_checkable_group_no" name="some_checkable_group[]" type="checkbox" value="no">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_no">否</label>', $actual);
    }

    public function testCheckboxGroupAsRadio()
    {
        // arrange
        $options = [
            'choices' => [
                'yes' => '是',
                'no' => '否',
            ],
            'selected' => 'yes',
            'is_checkbox' => false,
        ];

        // act
        $field = new CheckableGroupType(
            'some_checkable_group',
            'checkable_group',
            $this->plainForm,
            $options
        );
        $actual = $field->render();

        // assert
        $this->assertCount(2, $field->getChildren());
        $this->assertEquals('yes', $field->getOption('selected'));
        $this->assertNull($field->getOption('language_name'));
        $this->assertStringContainsString('<input id="some_checkable_group_yes" checked="checked" name="some_checkable_group" type="radio" value="yes">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_yes">是</label>', $actual);
        $this->assertStringContainsString('<input id="some_checkable_group_no" name="some_checkable_group" type="radio" value="no">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_no">否</label>', $actual);
    }

    public function testCheckboxGroupNoKeysChoices()
    {
        // arrange
        $options = [
            'choices' => [
                'yes',
                'no',
            ],
            'selected' => ['yes'],
        ];

        // act
        $field = new CheckableGroupType(
            'some_checkable_group',
            'checkable_group',
            $this->plainForm,
            $options
        );
        $actual = $field->render();

        // assert
        $this->assertCount(2, $field->getChildren());
        $this->assertEquals(['yes'], $field->getOption('selected'));
        $this->assertNull($field->getOption('language_name'));
        $this->assertStringContainsString('<input id="some_checkable_group_yes" checked="checked" name="some_checkable_group[]" type="checkbox" value="yes">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_yes">Yes</label>', $actual);
        $this->assertStringContainsString('<input id="some_checkable_group_no" name="some_checkable_group[]" type="checkbox" value="no">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_no">No</label>', $actual);
    }

    public function testCheckboxGroupSetLanguageName()
    {
        // arrange
        $options = [
            'choices' => [
                'yes',
                'no',
            ],
            'selected' => ['yes'],
            'language_name' => 'test-lang-name',
        ];
        // Mock translator
        /** @var \Mockery\MockInterface|\Illuminate\Translation\Translator $mockTrans */
        $mockTrans = Mockery::mock(Translator::class);
        $mockTrans->shouldReceive('has')->once()->with('some_checkable_group')->andReturn(true);
        $mockTrans->shouldReceive('get')->once()->with('some_checkable_group')->andReturn('some_checkable_group');
        $mockTrans->shouldReceive('has')->once()->with('test-lang-name.yes')->andReturn(true);
        $mockTrans->shouldReceive('get')->once()->with('test-lang-name.yes')->andReturn('是');
        $mockTrans->shouldReceive('has')->once()->with('test-lang-name.no')->andReturn(true);
        $mockTrans->shouldReceive('get')->once()->with('test-lang-name.no')->andReturn('否');
        $this->formHelper = new FormHelper($this->view, $mockTrans, $this->config);
        $this->plainForm->setFormHelper($this->formHelper);

        // act
        $field = new CheckableGroupType(
            'some_checkable_group',
            'checkable_group',
            $this->plainForm,
            $options
        );
        $actual = $field->render();

        // assert
        $this->assertCount(2, $field->getChildren());
        $this->assertEquals(['yes'], $field->getOption('selected'));
        $this->assertEquals('test-lang-name', $field->getOption('language_name'));
        $this->assertStringContainsString('<input id="some_checkable_group_yes" checked="checked" name="some_checkable_group[]" type="checkbox" value="yes">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_yes">是</label>', $actual);
        $this->assertStringContainsString('<input id="some_checkable_group_no" name="some_checkable_group[]" type="checkbox" value="no">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_no">否</label>', $actual);
    }

    public function testCheckboxGroupSetFieldLanguageNameIsFalse()
    {
        // arrange
        $options = [
            'choices' => [
                'yes',
                'no',
            ],
            'selected' => ['yes'],
            'language_name' => false,
        ];
        // Mock translator
        /** @var \Mockery\MockInterface|\Illuminate\Translation\Translator $mockTrans */
        $mockTrans = Mockery::mock(Translator::class);
        $mockTrans->shouldReceive('has')->once()->with('test-lang-name.some_checkable_group')->andReturn(true);
        $mockTrans->shouldReceive('get')->once()->with('test-lang-name.some_checkable_group')->andReturn('測試勾選框');
        $mockTrans->shouldReceive('has')->once()->with('yes')->andReturn(false);
        $mockTrans->shouldReceive('has')->once()->with('no')->andReturn(false);
        $this->formHelper = new FormHelper($this->view, $mockTrans, $this->config);
        $this->plainForm->setFormHelper($this->formHelper);
        $this->plainForm->setLanguageName('test-lang-name');

        // act
        $field = new CheckableGroupType(
            'some_checkable_group',
            'checkable_group',
            $this->plainForm,
            $options
        );
        $actual = $field->render();

        // assert
        $this->assertCount(2, $field->getChildren());
        $this->assertEquals(['yes'], $field->getOption('selected'));
        $this->assertFalse($field->getOption('language_name'));
        $this->assertStringContainsString('<input id="some_checkable_group_yes" checked="checked" name="some_checkable_group[]" type="checkbox" value="yes">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_yes">Yes</label>', $actual);
        $this->assertStringContainsString('<input id="some_checkable_group_no" name="some_checkable_group[]" type="checkbox" value="no">', $actual);
        $this->assertStringContainsString('<label for="some_checkable_group_no">No</label>', $actual);
    }
}
