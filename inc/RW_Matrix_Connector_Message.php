<?php

/**
 * Class RW_Matrix_Connector_Message
 *
 */

use Enqueue\Fs\FsConnectionFactory;
use Enqueue\Client\Message;


class RW_Matrix_Connector_Message {

	public $content = '';
	public $type = '';
	public $receiver = '';
	public $time = 0;

	public function __construct() {
		$this->time = time();

	}

	public function send( $queueName ) {
		$connectionFactory = new FsConnectionFactory();

		$context = $connectionFactory->createContext();
		$queue = $context->createQueue( $queueName);
		$msg = array(
			'time' => $this->time,
			'id' => $this->receiver,
			'type' => $this->type,
			'content' => $this->content
		);
		$message = $context->createMessage( json_encode( $msg ));
		$context->createProducer()->send($queue, $message);
	}
}

