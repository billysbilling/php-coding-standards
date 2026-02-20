<?php

declare(strict_types=1);

namespace BillysBilling\PhpCodingStandards\PhpStanRules;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

final class AbstractClassNamingRule implements Rule
{
    public function getNodeType(): string
    {
        return Class_::class;
    }

    /**
     * @param Class_ $node
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name === null) {
            return [];
        }

        if (!$node->isAbstract()) {
            return [];
        }

        if (!str_starts_with($node->name->toString(), 'Abstract')) {
            return [
                RuleErrorBuilder::message(
                    sprintf('Abstract class "%s" must be prefixed with "Abstract".', $node->name->toString())
                )->build(),
            ];
        }

        return [];
    }
}
