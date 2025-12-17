<?php

// SPDX-FileCopyrightText: 2012-2026 Open Assessment Technologies S.A.
// Copyright (C) 2022 (original work) Open Assessment Technologies SA;
//
// SPDX-License-Identifier: AGPL-3.0-only OR LicenseRef-TAO-Commercial-License

declare(strict_types=1);

namespace OAT\Bundle\ScoringEngineBundle\Tests\Unit\Normalizer;

use OAT\Bundle\ScoringEngineBundle\Model\DeliveryInterface;
use OAT\Bundle\ScoringEngineBundle\Model\ItemInterface;
use OAT\Bundle\ScoringEngineBundle\Normalizer\DeliveryNormalizer;
use PHPUnit\Framework\TestCase;
use stdClass;

class DeliveryNormalizerTest extends TestCase
{
    /** @var DeliveryNormalizer */
    private $subject;

    protected function setUp(): void
    {
        $this->subject = new DeliveryNormalizer();
    }

    public function testNormalize(): void
    {
        $deliveryMock = $this->createMock(DeliveryInterface::class);
        $deliveryMock
            ->expects(self::once())
            ->method('getItems')
            ->willReturn([$itemMock = $this->createMock(ItemInterface::class)]);

        self::assertSame(
            ['items' => [$itemMock]],
            $this->subject->normalize($deliveryMock)
        );
    }

    public function testSupportsNormalization(): void
    {
        self::assertTrue($this->subject->supportsNormalization($this->createMock(DeliveryInterface::class)));
        self::assertFalse($this->subject->supportsNormalization(new stdClass()));
        self::assertFalse($this->subject->supportsNormalization('foo'));
    }
}
