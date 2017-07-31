<?php

namespace Awallef\CWL\Log\Engine;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Logger;
use Cake\Log\Engine\BaseLog;

class CloudwatchLog extends BaseLog
{
  protected $_defaultConfig = [
    // BaseLog...
    'levels' => [],
    'scopes' => [],

    // Cloudwatch
    'groupName' => 'ec2-instance-1',
    'streamName' => 'my-php-app-log-test',
    'retentionDays' => '14', // days...

    // aws
    'aws' => [
      'region' => 'eu-west-1',
      'version' => 'latest',
      'credentials' => [
        'key' => 'your AWS key',
        'secret' => 'your AWS secret',
        //'token' => 'your AWS session token',
      ]
    ]
  ];

  protected $_client = null;

  protected $_handler = null;

  protected $_logger = null;

  public function __construct(array $config = [])
  {
    parent::__construct($config);

  }

  public function client()
  {
    if(!$this->_client)
      $this->_client = new CloudWatchLogsClient($this->config('aws'));
    return $this->_client;
  }

  public function handler($level)
  {
    if(!$this->_handler)
      $this->_handler = new CloudWatch($this->client(), $this->config('groupName'), $this->config('streamName'), $this->config('retentionDays'), 10000,['level' => $level]);
    return $this->_handler;
  }

  public function logger($level)
  {
    if(!$this->_logger){
      $this->_logger = new Logger('default-log-channel');
      $this->_logger->pushHandler($this->handler($level));
    }
    return $this->_logger;
  }

  public function log($level, $message, array $context = [])
  {
    $this->logger($level)->log($level, $message, $context);
    return true;
  }
}
