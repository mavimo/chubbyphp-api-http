<?php

declare(strict_types=1);

namespace Chubbyphp\ApiHttp\Negotiation;

/**
 * @see https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.17
 */
final class ContentTypeNegotiator implements NegotiatorInterface
{
    /**
     * @param string $header
     * @param array  $supported
     *
     * @return NegotiatedValue|null
     */
    public function negotiate(string $header, array $supported)
    {
        if ([] === $supported) {
            return null;
        }

        return $this->compareAgainstSupportedTypes($header, $supported);
    }

    /**
     * @param string $header
     * @param array  $supportedMimeTypes
     *
     * @return NegotiatedValue|null
     */
    private function compareAgainstSupportedTypes(string $header, array $supportedMimeTypes)
    {
        if (false !== strpos($header, ',')) {
            return null;
        }

        $headerValueParts = explode(';', $header);
        $mimeType = trim(array_shift($headerValueParts));
        $attributes = [];
        foreach ($headerValueParts as $attribute) {
            list($attributeKey, $attributeValue) = explode('=', $attribute);
            $attributes[trim($attributeKey)] = trim($attributeValue);
        }

        if (in_array($mimeType, $supportedMimeTypes, true)) {
            return new NegotiatedValue($mimeType, $attributes);
        }

        return null;
    }
}
