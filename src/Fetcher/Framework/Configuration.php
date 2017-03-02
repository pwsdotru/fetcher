<?php
namespace Fetcher\Framework;

class Configuration implements \PHPixie\Framework\Configuration
{
	protected $builder;
	protected $instances = array();

	public function __construct($builder) {
		$this->builder = $builder;
	}

	public function databaseConfig() {
		return $this->instance('databaseConfig');
	}

	public function httpConfig() {
		return $this->instance('httpConfig');
	}

	public function templateConfig() {
		return $this->instance('templateConfig');
	}

	public function filesystemRoot() {
		return $this->instance('filesystemRoot');
	}

	public function authConfig() {
		return $this->instance('authConfig');
	}

	public function migrateConfig() {
		return $this->instance('migrateConfig');
	}

	public function migrateRoot() {
		return $this->instance('migrateRoot');
	}

	public function assetsRoot() {
		return $this->instance('assetsRoot');
	}

	public function ormConfig() {
		return $this->instance('ormConfig');
	}

	public function ormWrappers() {
		return $this->instance('ormWrappers');
	}

	public function httpProcessor() {
		return $this->instance('httpProcessor');
	}

	public function httpRouteResolver() {
		return $this->instance('httpRouteResolver');
	}

	public function templateLocator() {
		return $this->instance('templateLocator');
	}

	public function imageDefaultDriver() {
		return $this->instance('imageDefaultDriver');
	}

	public function socialConfig() {
		return $this->instance('socialConfig');
	}

	public function consoleProvider() {
		return $this->instance('consoleProvider');
	}

	public function cacheConfig() {
		return $this->instance('cacheConfig');
	}

	public function cacheRoot() {
		return $this->instance('cacheRoot');
	}

	public function authRepositories() {
		return $this->instance('authRepositories');
	}

	protected function instance($name) {
		if(!isset($this->instances[$name])) {
			$method = 'build'.ucfirst($name);
			if (method_exists($this, $method)) {
				$this->instances[$name] = $this->$method();
			} else {
				$this->instances[$name] = null;
			}
		}
		return $this->instances[$name];
	}

	protected function buildAuthConfig() {
		return $this->configStorage()->slice('auth');
	}
	protected function buildDatabaseConfig() {
		return $this->configStorage()->slice('database');
	}

	protected function buildOrmConfig() {
		return $this->configStorage()->slice('orm');
	}

	protected function buildOrmWrappers() {
		return new \Fetcher\ORMWrappers();
	}

	protected function buildHttpConfig() {
		return $this->configStorage()->slice('http');
	}

	protected function buildTemplateConfig() {
		return $this->configStorage()->slice('template');
	}

	protected function buildFilesystemRoot() {
		$filesystem = $this->builder->components()->filesystem();

		$path = realpath(dirname(dirname(dirname(__DIR__))));
		return $filesystem->root($path);
	}

	protected function buildAssetsRoot() {
		$filesystem = $this->builder->components()->filesystem();

		$path = $this->filesystemRoot()->path('/assets');
		return $filesystem->root($path);
	}

	protected function buildHttpProcessor() {
		return new \Fetcher\HTTPProcessor($this->builder);
	}

	protected function buildHttpRouteResolver() {
		$components = $this->builder->components();

		return $components->route()->buildResolver(
			$this->configStorage()->slice('http.resolver')
		);
	}

	protected function buildTemplateLocator() {
		$components = $this->builder->components();

		$config = $this->configStorage()->slice('template.locator');
		return $components->filesystem()->buildLocator(
			$config,
			$this->filesystemRoot()
		);
	}

	protected function configStorage() {
		return $this->instance('configStorage');
	}

	protected function buildConfigStorage() {
		$config = $this->builder->components()->config();

		return $config->directory(
			$this->assetsRoot()->path(),
			'config'
		);
	}
}