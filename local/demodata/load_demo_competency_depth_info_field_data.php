<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'competency_depth_info_field'<br>";
$items = array(array('id' => '1','fullname' => 'example checkbox','shortname' => 'examplecheckbox','depthid' => '1','datatype' => 'checkbox','description' => '<p>test</p>','sortorder' => '1','categoryid' => '4','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '1','param1' => '','param2' => '','param3' => '','param4' => '','param5' => '',),
array('id' => '2','fullname' => 'example menu','shortname' => 'examplemenu','depthid' => '1','datatype' => 'menu','description' => '<p>example menu</p>','sortorder' => '2','categoryid' => '4','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '1','param1' => '1
2
3','param2' => '','param3' => '','param4' => '','param5' => '',),
array('id' => '3','fullname' => 'example text area','shortname' => 'exampletextarea','depthid' => '1','datatype' => 'textarea','description' => '','sortorder' => '1','categoryid' => '5','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '10','param3' => '','param4' => '','param5' => '',),
array('id' => '4','fullname' => 'text input','shortname' => 'textinput','depthid' => '1','datatype' => 'text','description' => '','sortorder' => '2','categoryid' => '5','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0','param4' => '','param5' => '',),
array('id' => '5','fullname' => 'test','shortname' => 'test','depthid' => '4','datatype' => 'textarea','description' => '','sortorder' => '1','categoryid' => '1','hidden' => '1','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '10','param3' => '','param4' => '','param5' => '',),
array('id' => '6','fullname' => 'test','shortname' => 'test','depthid' => '6','datatype' => 'checkbox','description' => '','sortorder' => '1','categoryid' => '3','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '0','param1' => '','param2' => '','param3' => '','param4' => '','param5' => '',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('competency_depth_info_field', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('competency_depth_info_field',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('competency_depth_info_field', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'competency_depth_info_field');
    // make sure sequence is higher than highest ID
    bump_sequence('competency_depth_info_field', $CFG->prefix, $maxid);
    // print output
    // 1 dot per 10 inserts
    if($i%10==0) {
        print ".";
        flush();
    }
    // new line every 200 dots
    if($i%2000==0) {
        print $i." <br>";
    }
    $i++;
}
print "<br>";