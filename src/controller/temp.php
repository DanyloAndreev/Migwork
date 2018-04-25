<?php
/**
 * Created by PhpStorm.
 * User: danylo
 * Date: 24.04.2018
 * Time: 20:15
 */
$start = microtime(true);
//Insert into table
//$db->beginTransaction();
//$db->query('INSERT INTO users (name, surname, email) VALUES (:name, :surname, :email)');
//$db->bind(':name', 'Dan');
//$db->bind(':surname', 'Andreev');
//$db->bind(':email', 'daanyloandreiev@gmail.com');
//$db->execute();
//echo $db->lastInsertId();
//$db->endTransaction();

//Select single row
//$db->query('SELECT email, surname FROM users WHERE name = :fname');
//$db->bind('fname', 'Dan');
//$row = $db->single();
//echo '<pre>';
//print_r($row);
//echo '</pre>';

//select multiple rows
//$db->query('SELECT email, surname FROM users WHERE name = :fname');
//$db->bind('fname', 'Dan');
//$rows = $db->resultset();
//echo '<pre>';
//print_r($rows);
//echo '</pre>';


$db->query('DELETE FROM users WHERE id > :id');
$db->bind('id', 0 );
$db->execute();

echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';

//добавление в таблицу
//$db = DataBase::getDB();

//$arr = array('table' => 'users',
//    'name' => 'Danylo',
//    'surname' => 'Andreiev',
//    'earn' => '1000',
//    'email' => rand(1, 1000));
//
//$addRow = new addRow($arr);
//
//
//foreach ($arr as $key => $value)
//{
//    $params[] = $key;
//    $values[] = $value;
//}
//$db->beginTransaction();
//$db->query($addRow->request());
//for ($i = 1; $i <count($arr); $i++)
//{
//    $db->bind(':'.$params[$i], $values[$i]);
//}
//$db->execute();
//$db->endTransaction();
//$db = null;