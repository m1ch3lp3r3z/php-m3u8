<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

abstract class AbstractAttributeList implements TransformerInterface
{
    public function transform($origin)
    {
        preg_match_all('/(?<=^|,)[A-Z0-9-]+=("?).+?\1(?=,|$)/', $origin, $matches);

        $result = $this->initResult();
        $parsed = false;
        foreach ($matches[0] as $attr) {
            list($name, $value) = explode('=', $attr);
            foreach ($this->getAttributeM3u8s() as $property => $m3u8) {
                if (null !== $result->$property || $m3u8->getName() !== $name) {
                    continue;
                }

                $result->$property = $m3u8->parse($value);
                $parsed = true;

                break;
            }
        }

        return $parsed ? $result : null;
    }

    public function reverse($result)
    {
        $keyVals = [];
        foreach ($this->getAttributeM3u8s() as $property => $m3u8) {
            if (null === $result->$property) {
                continue;
            }

            $keyVals[] = sprintf('%s=%s', $m3u8->getName(), $m3u8->dump($result->$property));
        }

        return implode(',', $keyVals);
    }

    abstract protected function getAttributeM3u8s();

    abstract protected function initResult();
}
