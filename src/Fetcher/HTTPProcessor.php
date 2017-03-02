<?php
namespace Fetcher;

class HTTPProcessor extends \PHPixie\HTTPProcessors\Processor\Dispatcher\Builder\Attribute {
 protected $builder;
 protected $attribute = 'processor';

  public function __construct($builder) {
		$this->builder = $builder;
	}

	protected function buildIndexProcessor() {
		$components = $this->builder->components();

		return new HTTPProcessors\Index($components->template());
	}
}