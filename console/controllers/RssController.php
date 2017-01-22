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
                var_dump($model->link);
                $model = new Feed();
                $proverka = $model->getFeed();
                $model->source_id = $source->id;
                var_dump($model->link);
                $model->link = $item->getLink();
                var_dump($model->link);
                $model->name = $item->getTitle(); 
                $model->description = $item->getDescription();
                $title = $model->name;
                $filter = $model->multiexplode([",", ".", "|", ":", "!", "?", "«","»", " "], $title);
                $blackTag = $model->getBlackTag();
                $whiteTag = $model->getWhiteTag();
                foreach ($filter as $needle) {
                    $slovo = $model->mb_convert_case($needle);
                    if (in_array($slovo, $blackTag)) {
                        if (empty($status)) {
                            $model->status = 'Опубликованная новость Black';
                            $status = $model->status;
                            echo "\n" . $status . ' ' . $title . "\n";
                            unset($status);
                        }
                    }
                    if (in_array($slovo, $whiteTag)) {
                        if (empty($status)) {
                            $model->status = 'Опубликованная новость White';
                            $status = $model->status;
                            echo "\n" . $status . ' ' . $title . "\n";
                            unset($status);
                        }
                    }    
                }
                if (empty($model->status)) {
                    $model->status = 'Неопубликованная новость';
                    $status = $model->status;
                    echo "\n" . $status . ' ' . $title . "\n";
                    unset($status);
                }
                $model->save(false);
                die;
        	}
            die;
        }
    }
}


                    














                    // foreach ($model->getFeed() as $model) {
                    // var_dump($model->link);


                //if (!empty($desc) && (stristr($desc, 'мед' ))) {
                    //var_dump($desc);
                //}