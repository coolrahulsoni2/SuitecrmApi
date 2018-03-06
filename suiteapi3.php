<?php

include "http://localhost/SuitGit/SuiteCRM/data/BeanFactory.php";



$bean = BeanFactory::getBean('Leads');
$account_list = $bean->get_full_list("", "Leads.name like '%a%'");


$module="Hello Test"
//Create bean
$bean = BeanFactory::newBean($module);

//Set the record id
$bean->id = '38c90c70-7788-13a2-668d-513e2b8df5e1';
$bean->new_with_id = true;

//Populate bean fields
$bean->name = 'Example Record';

//Save
$bean->save();

 ?>