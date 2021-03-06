<?php
/**
 * Created by Sublime Text 2.
 * User: untinosz
 * Date: 19.02.15
 * Time: 11:40
 */

namespace yii3ds\gii\crud\providers;

class CallbackProvider extends \yii3ds\gii\base\Provider
{
    public $activeFields = [];
    public $prependActiveFields = [];
    public $appendActiveFields = [];
    public $attributeFormats = [];
    public $columnFormats = [];

    public function activeField($column, $model)
    {
        $key = $this->findValue($this->getModelKey($column->name, $model), $this->activeFields);
        if ($key) {
            return $this->activeFields[$key]($column, $model);
        }
    }

    public function prependActiveField($column, $model)
    {
        $key = $this->findValue($this->getModelKey($column->name, $model), $this->prependActiveFields);
        if ($key) {
            return $this->prependActiveFields[$key]($column, $model);
        }
    }

    public function appendActiveField($column, $model)
    {
        $key = $this->findValue($this->getModelKey($column->name, $model), $this->appendActiveFields);
        if ($key) {
            return $this->appendActiveFields[$key]($column, $model);
        }
    }


    public function attributeFormat($column, $model)
    {
        $key = $this->findValue($this->getModelKey($column->name, $model), $this->attributeFormats);
        if ($key) {
            return $this->attributeFormats[$key]($column, $model);
        }
    }

    public function columnFormat($column, $model)
    {
        $key = $this->findValue($this->getModelKey($column->name, $model), $this->columnFormats);
        if ($key) {
            return $this->columnFormats[$key]($column, $model);
        }
    }

    private function getModelKey($attribute, $model)
    {
        return $model::className() . '.' . $attribute;
    }

    private function findValue($subject, $array)
    {
        foreach ($array AS $key => $value) {
            if (preg_match('/' . $key . '/', $subject)) {
                return $key;
            }
        }
    }

}