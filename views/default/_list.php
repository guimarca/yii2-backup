<?php
use yii\helpers\Html;
use yii\grid\GridView;

echo GridView::widget([
		'id' => 'install-grid',
		'dataProvider' => $dataProvider,
		
		'columns' => array(
				'name',
				[
			            'label' => 'Size',
			            'value' => function ($data)
			            {
			                $type = "MB";
			                switch($type){
			                    case "KB":
			                        $filesize = $data['size'] * .0009765625; // bytes to KB
			                        break;
			
			                    case "MB":
			                        $filesize = ($data['size'] * .0009765625) * .0009765625; // bytes to MB
			                        break;
			
			                    case "GB":
			                        $filesize = (($data['size'] * .0009765625) * .0009765625) * .0009765625; // bytes to GB
			                        break;
			                }
			                if ($filesize <= 0) {
			                    return $filesize = 'unknown file size';
			                }
			                else {
			                    return round($filesize, 2).' '.$type;
			                }
			            }
			        ],
				'create_time',
				'modified_time:relativeTime',
				array(
						'class' => 'yii\grid\ActionColumn',
						'template' => '{restore}',
						'buttons' => ['restore' => function ($url, $model, $key) {
												        return Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span>', $url, ['title' => 'Restore']);
												    }
						],

				),
				
				array(
						'class' => 'yii\grid\ActionColumn',
						'template' => '{download}',
						'buttons' => ['download' => function ($url, $model, $key) {
												        return Html::a('<span class="glyphicon glyphicon-download"></span>', $url, ['title' => 'Download']);
												    }
							],
				),
				
				array(
						'class' => 'yii\grid\ActionColumn',
						'template' => '{delete}',

				),
		),
]); ?>
