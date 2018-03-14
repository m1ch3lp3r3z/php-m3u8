<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

abstract class AbstractParentCore extends AbstractCore
{
    /**
     * @var Chrisyue\PhpM3u8\M3u8\Builder\BuilderInterface
     */
    public $builder;

    public function parse()
    {
        $parsedSequence = -1;
        $this->builder->setResult($this->initResult());

        $ret = null;
        do {
            foreach ($this->getChildren() as $property => $parser) {
                if ($parser->getSequence() < $parsedSequence) {
                    continue;
                }

                $oldChildValue = $this->builder->getValue($property);
                $isChildValueArray = is_array($oldChildValue);
                if (null !== $oldChildValue && !$isChildValueArray) {
                    continue;
                }

                $childValue = $parser->setLines($this->getLines())->parse();
                if (null === $childValue) {
                    continue;
                }

                $isChildValueArray ? $this->builder->addValue($property, $childValue) : $this->builder->setValue($property, $childValue);
                $parsedSequence = $parser->getSequence();

                break;
            }

            $ret = $parsedSequence > -1 ? $this->builder->getResult() : null;
        } while ($this->shouldParseNextLine($ret) && $this->moveToNextLine());

        return $ret;
    }

    public function dump($result)
    {
        $children = $this->getChildren();
        uasort($children, function (ChildCoreInterface $core, ChildCoreInterface $core2) {
            return $core->getSequence() > $core2->getSequence();
        });

        $this->builder->setResult($result);
        foreach ($children as $property => $dumper) {
            $childResult = $this->builder->getValue($result, $property);
            if (null === $childResult) {
                continue;
            }

            $dumper->setLines($this->getLines());

            is_array($childResult) ? array_walk($childResult, function ($val) use ($dumper) {
                $dumper->dump($val);
            }) : $dumper->dump($childResult);
        }
    }

    abstract protected function initResult();

    abstract protected function shouldParseNextLine($result);

    abstract protected function getChildren();

    private function moveToNextLine()
    {
        $this->getLines()->goNext();

        return $this->getLines()->isValid();
    }
}
