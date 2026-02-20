<?php

declare(strict_types=1);

namespace BillysBilling\PhpCodingStandards\PhpStanRules;

use PhpParser\Node;
use PhpParser\Node\Stmt\Interface_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

final class InterfaceNamingRule implements Rule
{
    public function getNodeType(): string
    {
        return Interface_::class;
    }

    /**
     * @param Interface_ $node
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name === null) {
            return [];
        }

        if (!str_ends_with($node->name->toString(), 'Interface')) {
            return [
                RuleErrorBuilder::message(
                    sprintf('Interface "%s" must be suffixed with "Interface".', $node->name->toString())
                )->build(),
            ];
        }

        return [];
    }
}
