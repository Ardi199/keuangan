<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemasukan".
 *
 * @property int $ID
 * @property float|null $NOMINAL
 * @property string|null $KETERANGAN
 * @property string|null $CREATED_AT
 * @property string|null $UPDATED_AT
 */
class Pemasukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemasukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMINAL'], 'number'],
            [['CREATED_AT', 'UPDATED_AT','TANGGAL','BULAN'], 'safe'],
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
            'TANGGAL' => 'Tanggal',
            'BULAN' => 'Bulan',
            'CREATED_AT' => 'Waktu',
            'UPDATED_AT' => 'Updated At',
        ];
    }
}
