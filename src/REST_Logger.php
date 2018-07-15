<?php
namespace Restserver\Libraries;

class REST_Logger {

  private $_database;

  public $_insert_id;

  protected $_rest_logs_table = 'logs';

  public function __construct($database)
  {
    $this->_database = $database;
    $this->authorized = FALSE;
  }

  /**
   * Add the request to the log table
   *
   * @access protected
   * @param array $log
   * @return bool TRUE the data was inserted; otherwise, FALSE
   */
  public function persist_request_log(array $log)
  {
    // Insert the request into the log table
    $is_inserted = $this->_database->insert(
      $this->_rest_logs_table, [
      'uri'        => $log['uri'],
      'method'     => $log['method'],
      'params'     => $log['params'],
      'api_key'    => $log['api_key'],
      'ip_address' => $log['ip_address'],
      'time'       => $log['time'],
      'authorized' => $log['authorized']
    ]);

    return $is_inserted ? $this->_database->insert_id() : 0;
  }

  public function log_access_time($payload, $id) {
    $this->_database->update( $this->_rest_logs_table, $payload, [ 'id' => $id ]);
  }

  public function log_response_code($response_code, $id) {
    $this->_database->update( $this->_rest_logs_table, ['response_code' => $response_code ], [ 'id' => $id ] );
  }

}