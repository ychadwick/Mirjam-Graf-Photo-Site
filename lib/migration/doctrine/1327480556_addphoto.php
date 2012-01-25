<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addphoto extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('photo', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'title' => 
             array(
              'type' => 'varchar',
              'notnull' => true,
              'length' => 255,
             ),
             'image' => 
             array(
              'type' => 'varchar',
              'notnull' => true,
              'length' => 255,
             ),
             'caption' => 
             array(
              'type' => 'varchar',
              'length' => 3000,
             ),
             'category_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 8,
             ),
             'sort_order' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'charset' => 'UTF8',
             ));
    }

    public function down()
    {
        $this->dropTable('photo');
    }
}