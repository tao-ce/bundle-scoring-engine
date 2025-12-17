<?php

// SPDX-FileCopyrightText: 2012-2026 Open Assessment Technologies S.A.
// Copyright (C) 2022 (original work) Open Assessment Technologies SA;
//
// SPDX-License-Identifier: AGPL-3.0-only OR LicenseRef-TAO-Commercial-License

declare(strict_types=1);

namespace OAT\Bundle\ScoringEngineBundle\Tests\Unit\Normalizer;

use OAT\Bundle\ScoringEngineBundle\Model\DeliveryInterface;
use OAT\Bundle\ScoringEngineBundle\Model\ItemAttemptInterface;
use OAT\Bundle\ScoringEngineBundle\Model\ItemInterface;
use OAT\Bundle\ScoringEngineBundle\Normalizer\ItemNormalizer;
use PHPUnit\Framework\TestCase;
use stdClass;

class ItemNormalizerTest extends TestCase
{
    /** @var ItemNormalizer */
    private $subject;

    protected function setUp(): void
    {
        $this->subject = new ItemNormalizer();
    }

    public function testNormalize(): void
    {
        $itemMock = $this->createMock(ItemInterface::class);
        $itemMock
            ->expects(self::once())
            ->method('getDelivery')
            ->willReturn($deliveryMock = $this->createMock(DeliveryInterface::class));
        $itemMock
            ->expects(self::once())
            ->method('getItemAttempts')
            ->willReturn([$itemAttemptMock = $this->createMock(ItemAttemptInterface::class)]);

        self::assertSame(
            ['delivery' => $deliveryMock, 'item_attempts' => [$itemAttemptMock]],
            $this->subject->normalize($itemMock)
        );
    }

    public function testSupportsNormalization(): void
    {
        self::assertTrue($this->subject->supportsNormalization($this->createMock(ItemInterface::class)));
        self::assertFalse($this->subject->supportsNormalization(new stdClass()));
        self::assertFalse($this->subject->supportsNormalization('foo'));
    }
}
