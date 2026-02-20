<?php

declare(strict_types=1);

namespace BillysBilling\PhpCodingStandards\PhpStanRules;

use PhpParser\Node;
use PhpParser\Node\Stmt\Trait_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

final class TraitNamingRule implements Rule
{
    public function getNodeType(): string
    {
        return Trait_::class;
    }

    /**
     * @param Trait_ $node
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name === null) {
            return [];
        }

        if (!str_ends_with($node->name->toString(), 'Trait')) {
            return [
                RuleErrorBuilder::message(
                    sprintf('Trait "%s" must be suffixed with "Trait".', $node->name->toString())
                )->build(),
            ];
        }

        return [];
    }
}
