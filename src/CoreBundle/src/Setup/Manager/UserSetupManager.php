<?php

declare (strict_types = 1);

namespace CoreBundle\Setup\Manager;

use Doctrine\ORM\EntityManagerInterface;
use ResourceBundle\Repository\EntityRepository;
use Towersystems\Core\Model\User;
use Towersystems\User\Model\UserInterface;
use Towersystems\User\Processor\UserProcessorInterface;
use Webmozart\Assert\Assert;

class UserSetupManager implements UserSetupManagerInterface {

	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	/**
	 * @var UserProcessorInterface
	 */
	private $userSetupProcessor;

	/**
	 * @var EntityRepository
	 */
	private $userRepository;

	/**
	 * @var UserInterface
	 */
	private $user;

	public function __construct(
		EntityManagerInterface $entityManager,
		UserProcessorInterface $userSetupProcessor,
		EntityRepository $userRepository
	) {
		$this->entityManager = $entityManager;
		$this->userSetupProcessor = $userSetupProcessor;
		$this->userRepository = $userRepository;
	}

	public function setup(): void{
		$user = $this->user;
		Assert::isInstanceOf($user, UserInterface::class, 'User must be an instance of %2$s. Received %s');

		$setupState = $user->getSetupState();
		if (User::SETUP_STATE_COMPLETE !== $setupState) {
			if (User::SETUP_STATE_IN_PROGRESS === $setupState) {
				throw new \Exception("User setup is already in progress");
			}

			$entityManager = $this->entityManager;
			$entityManager->getConnection()->beginTransaction();
			try {
				$user->setSetupState(User::SETUP_STATE_IN_PROGRESS);
				$entityManager->flush();

				$this->userSetupProcessor->process($user);
				$user->setSetupState(User::SETUP_STATE_COMPLETE);
				$entityManager->flush();
				$entityManager->getConnection()->commit();
			} catch (\Exception $exception) {
				$entityManager->getConnection()->rollBack();
				$user->setSetupState(User::SETUP_STATE_FAILED);
				$entityManager->flush();
				throw new \Exception("User setup failed: " . $exception->getMessage());
			}
		}
	}

	public function setupAll(): void{
		$users = $this->userRepository->findBy(['setupState' => User::SETUP_STATE_PENDING]);

		$setupQueue = new \Zend\Stdlib\SplQueue();

		foreach ($users as $user) {
			$setupQueue->enqueue($user);
			$user->setSetupState(User::SETUP_STATE_QUEUED);
		}

		$this->entityManager->flush();

		while (!$setupQueue->isEmpty()) {
			$currentUser = $setupQueue->dequeue();
			$this->setUser($currentUser)->setup();
		}

	}

	/**
	 * @param UserInterface $user
	 *
	 * @return Self
	 */
	public function setUser(UserInterface $user): UserSetupManagerInterface{
		$this->user = $user;

		return $this;
	}
}