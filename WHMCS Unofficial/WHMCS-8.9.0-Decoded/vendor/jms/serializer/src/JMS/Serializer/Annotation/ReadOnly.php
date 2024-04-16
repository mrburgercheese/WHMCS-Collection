<?php

namespace JMS\Serializer\Annotation;

/**
 * @Annotation
 * @Target({"CLASS","PROPERTY"})
 *
 * @deprecated use `@ReadOnlyProperty` instead
 */
final class ReadOnly extends ReadOnlyProperty
{
    /**
     * @var boolean
     */
    public $readOnly = true;
}
