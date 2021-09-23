<?php declare(strict_types = 1);

namespace PHPStan\Rules\Deprecations;

use PHPStan\Rules\RuleLevelHelper;

/**
 * @extends \PHPStan\Testing\RuleTestCase<InstantiationOfDeprecatedClassRule>
 */
class InstantiationOfDeprecatedClassRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new InstantiationOfDeprecatedClassRule($this->createReflectionProvider(), self::getContainer()->getByType(RuleLevelHelper::class));
	}

	public function testInstantiationOfDeprecatedClass(): void
	{
		require_once __DIR__ . '/data/instantiation-of-deprecated-class-definition.php';
		$this->analyse(
			[__DIR__ . '/data/instantiation-of-deprecated-class.php'],
			[
				[
					'Instantiation of deprecated class InstantiationOfDeprecatedClass\DeprecatedFoo.',
					6,
				],
				[
					"Instantiation of deprecated class InstantiationOfDeprecatedClass\DeprecatedWithDescription:\nDo not instantiate.",
					7,
				],
			]
		);
	}

}
