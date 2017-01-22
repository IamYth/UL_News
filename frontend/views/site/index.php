<?php
$this->title = 'Новости';
?>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel-group" id="accordion">
          <?php foreach ($name as $title): ?>
          <?php $black = 'Опубликованная новость Black' ?>
          <?php $nothing = 'Неопубликованная новость' ?>
          <?php $white = 'Неопубликованная новость White' ?>
          <?php $nameNews = $title->status ?>
          <?php if ($black == $nameNews) : ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$title->id?>">
                        <?php echo $title->name ?>
                      </a>
              </h4>
            </div>
            <div id="collapse<?=$title->id?>" class="panel-collapse collapse">
              <div class="panel-body">
                <?php echo $title->description ?>
                   <a href="<?=$title->link?>">
                  <?php echo $title->link ?> 
                </a>
              </div>
            </div>
          </div>
        <?php endif ?>
        <?php endforeach ?>
        </div>
    </div>
  </div>
</div>
