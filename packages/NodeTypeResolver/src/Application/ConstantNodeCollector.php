<?php declare(strict_types=1);

namespace Rector\NodeTypeResolver\Application;

use Nette\Utils\Strings;
use PhpParser\Node\Stmt\ClassConst;
use Rector\Exception\ShouldNotHappenException;
use Rector\NodeTypeResolver\Node\Attribute;
use Rector\PhpParser\Node\Resolver\NameResolver;

final class ConstantNodeCollector
{
    /**
     * @var ClassConst[][]
     */
    private $constantsByType = [];

    /**
     * @var NameResolver
     */
    private $nameResolver;

    public function __construct(NameResolver $nameResolver)
    {
        $this->nameResolver = $nameResolver;
    }

    public function addConstant(ClassConst $classConst): void
    {
        $className = $classConst->getAttribute(Attribute::CLASS_NAME);
        if ($className === null) {
            throw new ShouldNotHappenException();
        }

        $constantName = $this->nameResolver->resolve($classConst);

        $this->constantsByType[$className][$constantName] = $classConst;
    }

    public function findConstant(string $constantName, string $className): ?ClassConst
    {
        if (Strings::contains($constantName, '\\')) {
            throw new ShouldNotHappenException(sprintf('Switched arguments in "%s"', __METHOD__));
        }

        return $this->constantsByType[$className][$constantName] ?? null;
    }
}
