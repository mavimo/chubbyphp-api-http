<?php

declare(strict_types=1);

namespace Chubbyphp\ApiHttp\ApiProblem\ClientError;

use Chubbyphp\ApiHttp\ApiProblem\AbstractApiProblem;

final class LengthRequired extends AbstractApiProblem
{
    public function __construct(?string $detail = null, ?string $instance = null)
    {
        parent::__construct(
            'https://tools.ietf.org/html/rfc2616#section-10.4.12',
            411,
            'Length Required',
            $detail,
            $instance
        );
    }
}
