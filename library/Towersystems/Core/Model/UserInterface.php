<?php
namespace Towersystems\Core\Model;

use Towersystems\User\Model\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface {

	const SETUP_STATE_PENDING = "pending";
	const SETUP_STATE_IN_PROGRESS = "in_progress";
	const SETUP_STATE_COMPLETE = "complete";
	const SETUP_STATE_FAILED = "failed";
	const SETUP_STATE_QUEUED = "queued";

	/**
	 * @return mixed
	 */
	public function getDbName();

	/**
	 * @param mixed $dbName
	 */
	public function setDbName($dbName): void;

	/**
	 * @return mixed
	 */
	public function getDbUsername();

	/**
	 * @param mixed $dbUsername
	 */
	public function setDbUsername($dbUsername): void;

	/**
	 * @return mixed
	 */
	public function getDbPassword();

	/**
	 * @param mixed $dbPassword
	 */
	public function setDbPassword($dbPassword): void;

	/**
	 * @return string
	 */
	public function getSetupState();

	/**
	 * @param string $setupState
	 */
	public function setSetupState($setupState): void;

	/**
	 * @return string
	 */
	public function getToken();

	/**
	 * @param string $token
	 */
	public function setToken($token): void;

	/**
	 * [getPayload description]
	 * @return [type] [description]
	 */
	public function getPayload(): array;

	/**
	 * [setLastJWTToken description]
	 *
	 * @param [type] $lastJWTToken [description]
	 */
	public function setLastJWTToken($lastJWTToken);

	/**
	 * [getLastJWTToken description]
	 *
	 * @return [type] [description]
	 */
	public function getLastJWTToken();
}