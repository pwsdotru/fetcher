<?php
namespace Fetcher\Framework;

class Builder extends \PHPixie\Framework\Builder {

	public function configuration() {
		return $this->instance('configuration');
	}

	protected function buildConfiguration() {
		return new Configuration($this);
	}

	protected function getRootDirectory() {
		return realpath(dirname(dirname(dirname(__DIR__))));
	}
}