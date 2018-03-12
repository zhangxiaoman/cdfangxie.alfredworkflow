<?php

require "vendor/autoload.php";


$data = \QL\QueryList::get('http://www.cdfangxie.com/Infor/type/typeid/36.html')
    // 设置采集规则
    ->rules([
        'title'=>array('li > span:even > a','text'),
        'time'=>array('li > span:odd','text'),
    ])
    ->query()->getData();

$arr = $data->all();

$workflow = new \Alfred\Workflows\Workflow();
foreach ($arr as $key => $item) {
    $workflow->result()
        ->uid($key)
        ->title($item['title'])
        ->subtitle($item['time'])
        ->type('default')
        ->icon('icon.png');
}
echo $workflow->output();

?>