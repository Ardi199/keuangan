<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $ID
 * @property string|null $TEST
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID'], 'integer'],
            [['TEST'], 'string', 'max' => 255],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'TEST' => 'Test',
        ];
    }
}
