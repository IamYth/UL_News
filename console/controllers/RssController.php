<?php
namespace console\controllers;

require(__DIR__ . '/../../common/models/RssItem.php');
require(__DIR__ . '/../../common/models/RssParser.php');

use Yii;
use yii\web\Controller;
use common\models\RssParser;
use common\models\RssItem;
use common\models\Feed;
use common\models\Source;

class RssController extends \yii\console\Controller
{
    public function actionPush()
    {
        $source = new Source();
        foreach ($source->getUrl() as $source) {
            $url = $source->link;
            $rss = new RssParser();
            $rss->load($url);
            foreach($rss->getItems() as $item) {
                $model = new Feed();
                $model->source_id = $source->id;
                $model->link = $item->getLink();
                $link = $model->link;

                if (!(Feed::find()->where(['link' => $link])->all())) {
                    // echo "string";
                    // break;
                $model->name = $item->getTitle(); 
                $title = $item->getTitle();
                
                // if (Feed::find()->where(['name' => $title])->all())
                // {
                //     echo "string";
                //     break;
                // }

                $model->description = $item->getDescription();
                $filter = $model->multiexplode([",", ".", "|", ":", "!", "?", "«","»", " "], $model->name);
                $blackTag = $model->getBlackTag();
                $whiteTag = $model->getWhiteTag();
                foreach ($filter as $needle) {
                    $word = $model->mb_convert_case($needle);
                    if (in_array($word, $blackTag)) {
                        if (empty($status)) {
                            $model->status = 'Опубликованная новость Black';
                            $status = $model->status;
                            echo "\n" . $status . ' ' . $title . "\n";
                            unset($status);
                        }
                    }
                    if (in_array($word, $whiteTag)) {
                        if (empty($status)) {
                            $model->status = 'Опубликованная новость White';
                            $status = $model->status;
                            echo "\n" . $status . ' ' . $title . "\n";
                            unset($status);
                        }
                    }    
                }
                if (empty($word->status)) {
                    $model->status = 'Неопубликованная новость';
                    $status = $model->status;
                    echo "\n" . $status . ' ' . $title . "\n";
                    unset($status);
                }
                $model->save(false);
                //die;
                }else{
                    echo  "Новых новостей нет";
                }
            }
           // die;
        }
    }
}