<?php declare(strict_types = 1);

namespace Tests\Helpers;

use Nette\Caching\Storages\DevNullStorage;
use Nette\Database\Connection;
use Nette\Database\Context;
use Nette\Database\Conventions\DiscoveredConventions;
use Nette\Database\Structure;

final class DatabaseFactory
{

	public static function create(): Context
	{
		$cacheStorage = new DevNullStorage();
		$connection = new Connection('mysql:host=127.0.0.1;dbname=mydb', 'root', null);
		$structure = new Structure($connection, $cacheStorage);
		$conventions = new DiscoveredConventions($structure);
		$context = new Context($connection, $structure, $conventions, $cacheStorage);

		/**
		 * $connection->onQuery[] = function (Connection $connection, $result) {
		 * if ($result instanceof ResultSet) {
		 * //echo $result->getQueryString();
		 * } else if ($result instanceof DriverException) {
		 * //echo $result->getQueryString();
		 * }
		 * };
		 */

		return $context;
	}

}
