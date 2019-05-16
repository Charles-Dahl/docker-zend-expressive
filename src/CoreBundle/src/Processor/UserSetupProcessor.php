<?php

declare (strict_types = 1);

namespace CoreBundle\Processor;

use Towersystems\User\Model\UserInterface;
use Towersystems\User\Processor\UserProcessorInterface;
use Zend\Stdlib\PriorityQueue;

final class UserSetupProcessor implements UserProcessorInterface {

	/**
	 * @var PriorityQueue|UserProcessorInterface[]
	 */
	private $userProcessorQueue;

	public function __construct() {
		$this->userProcessorQueue = new PriorityQueue();
	}

	/**
	 * @param UserProcessorInterface $userProcessor
	 * @param int $priority
	 */
	public function addProcessor(UserProcessorInterface $userProcessor, $priority = 0): void{
		$this->userProcessorQueue->insert($userProcessor, $priority);
	}

	/**
	 * {@inheritdoc}
	 */
	public function process(UserInterface $user): void {
		foreach ($this->userProcessorQueue as $userProcessor) {
			$userProcessor->process($user);
		}
	}
}
