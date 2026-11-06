<?php

declare(strict_types=1);

namespace Ichnois;

use Sentry\Breadcrumb;
use Sentry\CheckIn;
use Sentry\CheckInStatus;
use Sentry\Event;
use Sentry\EventHint;
use Sentry\EventId;
use Sentry\MonitorConfig;
use Sentry\State\Scope;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use Sentry\Transport\Result;

function init(array $options = []): void
{
    Ichnois::init($options);
}

function captureException(\Throwable $exception, ?EventHint $hint = null): ?EventId
{
    return Ichnois::captureException($exception, $hint);
}

function captureMessage(string $message, ?Severity $level = null, ?EventHint $hint = null): ?EventId
{
    return Ichnois::captureMessage($message, $level, $hint);
}

function captureEvent(Event $event, ?EventHint $hint = null): ?EventId
{
    return Ichnois::captureEvent($event, $hint);
}

function addBreadcrumb(Breadcrumb $breadcrumb): bool
{
    return Ichnois::addBreadcrumb($breadcrumb);
}

function configureScope(callable $callback): void
{
    Ichnois::configureScope($callback);
}

function withScope(callable $callback)
{
    return Ichnois::withScope($callback);
}

function startTransaction(TransactionContext $context): Transaction
{
    return Ichnois::startTransaction($context);
}

function flush(?int $timeout = null): Result
{
    return Ichnois::flush($timeout);
}

