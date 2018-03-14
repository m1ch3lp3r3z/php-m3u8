<?php

namespace Chrisyue\PhpM3u8\M3u8\PropertyReader;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * @Annotation
 */
class Reader implements PropertyReaderInterface
{
    public function read($class, $type)
    {
        $reader = $this->getAnnotationReader();
        $class = new \ReflectionClass($class);

        $annots = [];
        foreach ($class->getProperties() as $property) {
            $annot = $reader->getPropertyAnnotation($property, $type);
            if (null === $annot) {
                continue;
            }

            $annots[$property->getName()] = $annot;
        }

        return $annots;
    }

    protected function getAnnotationReader()
    {
        static $reader;
        if (null === $reader) {
            AnnotationRegistry::registerLoader('class_exists');
            $reader = new AnnotationReader();
        }

        return $reader;
    }
}
