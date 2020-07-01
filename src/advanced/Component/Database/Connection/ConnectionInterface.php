<?php
namespace Jan\Component\Database\Connection;


/**
 * Interface ConnectionInterface
 * @package Jan\Component\Database\Connection
*/
interface ConnectionInterface
{
     /**
      * @return mixed
     */
     public function getConnection();
}