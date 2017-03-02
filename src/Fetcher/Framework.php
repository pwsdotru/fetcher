<?php
namespace Fetcher;

class Framework extends \PHPixie\Framework
{
	protected function buildBuilder()
	{
		return new Framework\Builder();
	}
}