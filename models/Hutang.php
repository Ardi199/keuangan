<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hutang".
 *
 * @property int $ID
 * @property string|null $KETERANGAN
 * @property float|null $NOMINAL
 * @property string|null $BUKTI
 * @property string|null $CREATED_AT
 * @property string|null $UPDATED_AT
 */
class Hutang extends \yii\db\ActiveRecord
{
    public $icon;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hutang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMINAL'], 'number'],
            [['CREATED_AT', 'UPDATED_AT','STATUS'], 'safe'],
            [['KETERANGAN', 'BUKTI'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'KETERANGAN' => 'Keterangan',
            'NOMINAL' => 'Nominal',
            'BUKTI' => 'Bukti',
            'STATUS' => 'Status',
            'icon' => 'icon',
            'CREATED_AT' => 'Created At',
            'UPDATED_AT' => 'Updated At',
        ];
    }

    public function getId()
    {
        $tahun = date("y");
        
        $query = $this::find()->max('ID');

        if($query == '') 
        {
        $ID = $tahun."0001";
        }
        else
        {
        $ID = $query;
        $ID++;
        }

        return $ID;
    }
}
