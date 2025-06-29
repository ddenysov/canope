<?php
declare(strict_types=1);

namespace Zinc\Core\Event;

use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Domain\Value\UuidInterface;

class EventId extends Uuid implements UuidInterface
{

}