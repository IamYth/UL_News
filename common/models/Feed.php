<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feed".
 *
 * @property integer $id
 * @property integer $source_id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property string $status
 *
 * @property Source $source
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_id'], 'integer'],
            [['name', 'description', 'link', 'status'], 'string', 'max' => 255],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['source_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_id' => 'Source ID',
            'name' => 'Name',
            'description' => 'Description',
            'link' => 'Link',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Source::className(), ['id' => 'source_id']);
    }

    public function multiexplode ($delimiters,$string) 
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    public function mb_convert_case($needle)
    {
        $key = mb_convert_case($needle, MB_CASE_LOWER, "UTF-8");
        return $key;
    }

    public static function getFeed()
    {
      $feed = self::find()->all();
      return $feed;
    }

    public function getBlackTag()
    {
        $blackTags = ['смерть', 'ограбление', 'украли', 'похители', 'избили', 'суд', 'нож', 'оружие', 'напал', 'дтп', 'следствия', 'ограбления', 'кража', 'похищение', 'убили', 'убийство', 'скончался', 'побили', 'избил', 'побил', 'нападение', 'изнасилование', 'розыскивается', 'розыск', 'изнасилованной', 'раздавил', 'погиб', 'изнасиловал', 'пострадавшие', 'пострадавшая', 'пострадали', 'пострадала', 'пострадал', 'похитила', 'похитил', 'задавила', 'задавил', 'обокрали', 'труп', 'разбился', 'разбилась', 'потерпевшая', 'потерпевший', 'зарезали', 'зарезали', 'зарезала', 'воровал' , 'вор', 'воры', 'своровали', 'своровал', 'своровала', 'умерла', 'уголовное', 'возбуждено', 'уголовному', 'уголовного', 'сбил', 'сбила', 'сбили', 'наехали', 'наехала', 'наехал', 'наезд', 'угнал', 'угнала', 'угнали', 'незаконно', 'арестовали', 'смертью', 'ссора', 'зарубил', 'зарубили', 'зарубила', 'аварии', 'разбились', 'забили', 'забил', 'забила', 'смерти', 'погбишим', 'погибла', 'погибшими', 'скончалась', 'скончались'];
        return $blackTags;
    }

    public function getWhiteTag()
    {
        $whiteTags = ['Многодетные', 'семьи', 'получат','жизнь', 'убрал', 'наград', 'мероприят', 'появил', 'уникальн', 'чист', 'спорт', 'порядок', 'помощь', 'конкурс'];
        return $whiteTags;
    }


    public function getLink($proverka)
    {
        foreach ($proverka as $linka) {
            if (($linka->link) !== ($item->getLink())) {
                unset($proverka);
                return $proverka;
            }
        }
    }

}
