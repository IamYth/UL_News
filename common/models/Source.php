<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "source".
 *
 * @property integer $id
 * @property string $link
 * @property string $logo
 *
 * @property Feed[] $feeds
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeds()
    {
        return $this->hasMany(Feed::className(), ['source_id' => 'id']);
    }

    public function getUrl()
    {
        $source = self::find()->all();
        return $source;
    }
}
