# cakephp-cw-log plugin for CakePHP
This plugin allows you log your cakephp app in aws cloudwatch

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

	composer require awallef/cakephp-cw-log

## Log settings
Configure the engine in app.php like follow:

	...
	'Log' => [
        'debug' => [
			'className' => 'Awallef\CWL\Log\Engine\CloudwatchLog',
			'levels' => ['notice', 'info', 'debug'],

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
	      ]
	    ]
        ],
        'error' => [
			'className' => 'Awallef\CWL\Log\Engine\CloudwatchLog',
			'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],

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
	      ]
	    ]
        ],
    ],
    ...
