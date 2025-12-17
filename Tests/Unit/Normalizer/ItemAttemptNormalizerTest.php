<?php

// SPDX-FileCopyrightText: 2012-2026 Open Assessment Technologies S.A.
// Copyright (C) 2022 (original work) Open Assessment Technologies SA;
//
// SPDX-License-Identifier: AGPL-3.0-only OR LicenseRef-TAO-Commercial-License

declare(strict_types=1);

namespace OAT\Bundle\ScoringEngineBundle\Tests\Unit\Normalizer;

use OAT\Bundle\ScoringEngineBundle\Model\ItemAttemptInterface;
use OAT\Bundle\ScoringEngineBundle\Model\ItemInterface;
use OAT\Bundle\ScoringEngineBundle\Normalizer\ItemAttemptNormalizer;
use PHPUnit\Framework\TestCase;
use stdClass;

class ItemAttemptNormalizerTest extends TestCase
{
    /** @var ItemAttemptNormalizer */
    private $subject;

    protected function setUp(): void
    {
        $this->subject = new ItemAttemptNormalizer();
    }

    public function testNormalize(): void
    {
        $itemAttemptMock = $this->createMock(ItemAttemptInterface::class);
        $itemAttemptMock
            ->expects(self::once())
            ->method('getItem')
            ->willReturn($itemMock = $this->createMock(ItemInterface::class));

        self::assertSame(
            ['item' => $itemMock],
            $this->subject->normalize($itemAttemptMock)
        );
    }

    public function testSupportsNormalization(): void
    {
        self::assertTrue($this->subject->supportsNormalization($this->createMock(ItemAttemptInterface::class)));
        self::assertFalse($this->subject->supportsNormalization(new stdClass()));
        self::assertFalse($this->subject->supportsNormalization('foo'));
    }
}
