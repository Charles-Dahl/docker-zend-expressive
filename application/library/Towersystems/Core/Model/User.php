<?php
namespace Towersystems\Core\Model;

use Towersystems\User\Model\User as BaseUser;

/**
 *
 */
class User extends BaseUser implements UserInterface {

	/**
	 * @var string
	 */
	protected $dbName;

	/**
	 * @var string
	 */
	protected $dbUsername;

	/**
	 * @var string
	 */
	protected $dbPassword;

	/**
	 * @var string
	 */
	protected $setupState;

	/**
	 * @var string
	 */
	protected $token;

	/** @var string [description] */
	protected $lastJWTToken;

	public function __construct() {
		parent::__construct();
		$this->setupState = UserInterface::SETUP_STATE_PENDING;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDbName() {
		return $this->dbName;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setDbName($dbName): void{
		$this->dbName = $dbName;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDbUsername() {
		return $this->dbUsername;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setDbUsername($dbUsername): void{
		$this->dbUsername = $dbUsername;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDbPassword() {
		return $this->dbPassword;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setDbPassword($dbPassword): void{
		$this->dbPassword = $dbPassword;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSetupState() {
		return $this->setupState;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setSetupState($setupState): void{
		$this->setupState = $setupState;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setToken($token): void{
		$this->token = $token;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setLastJWTToken($lastJWTToken) {
		$this->lastJWTToken = $lastJWTToken;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLastJWTToken() {
		return $this->lastJWTToken;
	}

	public function getPayload(): array{
		return [
			"user" => [
				"id" => $this->getId(),
				"email" => $this->getEmail(),
				"username" => $this->getUsername(),
				"dbName" => $this->getDbName(),
				"dbPassword" => $this->getDbPassword(),
				"dbUsername" => $this->getDbUsername(),
				"setupState" => $this->getSetupState(),
			],
		];
	}
}