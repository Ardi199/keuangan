<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rekap".
 *
 * @property int $ID
 * @property string|null $NOMINAL
 * @property string|null $KETERANGAN
 * @property string|null $CREATED_AT
 * @property string|null $UPDATED_AT
 */
class Rekap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CREATED_AT', 'UPDATED_AT','NOMINAL','HARI','TANGGAL'], 'safe'],
            [['KETERANGAN'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NOMINAL' => 'Nominal',
            'KETERANGAN' => 'Keterangan',
            'HARI' => 'Hari',
            'TANGGAL' => 'Tanggal',
            'CREATED_AT' => 'Created At',
            'UPDATED_AT' => 'Updated At',
        ];
    }

    public function getHari()
    {
        if($this->HARI == 'Sunday'):
            return 'Minggu';
        elseif($this->HARI == 'Monday'):
            return 'Senin';
        elseif($this->HARI == 'Tuesday'):
            return 'Selasa';
        elseif($this->HARI == 'Wednesday'):
            return 'Rabu';
        elseif($this->HARI == 'Thursday'):
            return 'Kamis';
        elseif($this->HARI == 'Friday'):
            return 'Jumat';
        elseif($this->HARI == 'Saturday'):
            return 'Sabtu';
        endif;
    }
}
