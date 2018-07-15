<?php
namespace Restserver\Libraries;

use Exception;
use stdClass;

/**
 * @property  db
 */
abstract class REST_Model extends \CI_Model {

  protected $_database;

  public function __construct($config = 'rest') {
    parent::__construct();
    $this->_database = $this->db;
  }

}