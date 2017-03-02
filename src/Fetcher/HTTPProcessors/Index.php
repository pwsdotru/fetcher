<?php
namespace Fetcher\HTTPProcessors;

class Index extends \PHPixie\HTTPProcessors\Processor\Actions\Attribute {
	protected $template;

	public function __construct($template) {
		$this->template = $template;
	}

	public function defaultAction($request) {
		$container = $this->template->get('index');
		$container->message = "Hello world!";
		return $container;
	}
}