<?php declare(strict_types = 1);

namespace PHPStan\Rules\Deprecations;

/**
 * @extends \PHPStan\Testing\RuleTestCase<CallToDeprecatedFunctionRule>
 */
class CallToDeprecatedFunctionRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new CallToDeprecatedFunctionRule($this->createReflectionProvider());
	}

	public function testDeprecatedFunctionCall(): void
	{
		require_once __DIR__ . '/data/call-to-deprecated-function-definition.php';
		$this->analyse(
			[__DIR__ . '/data/call-to-deprecated-function.php'],
			[
				[
					'Call to deprecated function CheckDeprecatedFunctionCall\deprecated_foo().',
					8,
				],
				[
					'Call to deprecated function CheckDeprecatedFunctionCall\deprecated_foo().',
					9,
				],
				[
					"Call to deprecated function CheckDeprecatedFunctionCall\\deprecated_with_description():\nGlobal function? Seriously?",
					10,
				],
			]
		);
	}

}
