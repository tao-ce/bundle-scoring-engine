<?php

// SPDX-FileCopyrightText: 2012-2026 Open Assessment Technologies S.A.
// Copyright (C) 2022 (original work) Open Assessment Technologies SA;
//
// SPDX-License-Identifier: AGPL-3.0-only OR LicenseRef-TAO-Commercial-License

declare(strict_types=1);

namespace OAT\Bundle\ScoringEngineBundle\Normalizer;

use OAT\Bundle\ScoringEngineBundle\Model\ItemAttemptInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ItemAttemptNormalizer implements NormalizerInterface
{
    /** @var ItemAttemptInterface $object */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'item' => $object->getItem(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        if (!is_object($data)) {
            return false;
        }

        return $data instanceof ItemAttemptInterface;
    }
}
