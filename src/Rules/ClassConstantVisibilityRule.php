<?php

declare(strict_types=1);

namespace simplesurance\PHPStan\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;

class ClassConstantVisibilityRule implements \PHPStan\Rules\Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\ClassConst::class;
    }

    /**
     * @param Node\Stmt\ClassConst $node
     * @param Scope                $scope
     *
     * @return (string|\PHPStan\Rules\RuleError)[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (($node->flags & Node\Stmt\Class_::VISIBILITY_MODIFIER_MASK) === 0) {
            return [
                sprintf(
                    'Constant %s must declare a visibility keyword.',
                    $node->consts[0]->name->name
                )
            ];
        }

        return [];
    }

}
