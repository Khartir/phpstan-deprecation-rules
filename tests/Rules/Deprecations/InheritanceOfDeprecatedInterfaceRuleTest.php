<?php declare(strict_types = 1);

namespace PHPStan\Rules\Deprecations;

/**
 * @extends \PHPStan\Testing\RuleTestCase<InheritanceOfDeprecatedInterfaceRule>
 */
class InheritanceOfDeprecatedInterfaceRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new InheritanceOfDeprecatedInterfaceRule($this->createReflectionProvider());
	}

	public function testInheritanceOfDeprecatedInterfaces(): void
	{
		require_once __DIR__ . '/data/inheritance-of-deprecated-interface-definition.php';
		$this->analyse(
			[__DIR__ . '/data/inheritance-of-deprecated-interface.php'],
			[
				[
					'Interface InheritanceOfDeprecatedInterface\Foo2 extends deprecated interface InheritanceOfDeprecatedInterface\DeprecatedFooable.',
					10,
				],
				[
					'Interface InheritanceOfDeprecatedInterface\Foo3 extends deprecated interface InheritanceOfDeprecatedInterface\DeprecatedFooable.',
					15,
				],
				[
					'Interface InheritanceOfDeprecatedInterface\Foo3 extends deprecated interface InheritanceOfDeprecatedInterface\DeprecatedFooable2.',
					15,
				],
				[
					"Interface InheritanceOfDeprecatedInterface\Foo4 extends deprecated interface InheritanceOfDeprecatedInterface\DeprecatedWithDescription:\nImplement something else.",
					20,
				],
			]
		);
	}

}
