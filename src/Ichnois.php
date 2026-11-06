<?php

declare(strict_types=1);

namespace Ichnois;

use Sentry\Breadcrumb;
use Sentry\CheckIn;
use Sentry\CheckInStatus;
use Sentry\ClientBuilder;
use Sentry\ClientInterface;
use Sentry\Event;
use Sentry\EventHint;
use Sentry\EventId;
use Sentry\Integration\IntegrationInterface;
use Sentry\MonitorConfig;
use Sentry\MonitorSchedule;
use Sentry\SentrySdk;
use Sentry\Severity;
use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Sentry\Tracing\Span;
use Sentry\Tracing\SpanContext;
use Sentry\Tracing\Transaction;
use Sentry\Tracing\TransactionContext;
use Sentry\Transport\Result;
use Sentry\Transport\ResultStatus;

/**
 * Primary Ichnois SDK Facade providing native Ichnois entrypoints.
 */
final class Ichnois
{
    /**
     * Initializes the Ichnois SDK client and binds it to the current hub.
     *
     * @param array<string, mixed> $options The client configuration options
     */
    public static function init(array $options = []): void
    {
        \Sentry\init($options);
    }

    /**
     * Captures an exception and delivers it to the Ichnois ingestion backend.
     */
    public static function captureException(\Throwable $exception, ?EventHint $hint = null): ?EventId
    {
        return \Sentry\captureException($exception, $hint);
    }

    /**
     * Captures a log message and delivers it to Ichnois.
     */
    public static function captureMessage(string $message, ?Severity $level = null, ?EventHint $hint = null): ?EventId
    {
        return \Sentry\captureMessage($message, $level, $hint);
    }

    /**
     * Captures a manual event.
     */
    public static function captureEvent(Event $event, ?EventHint $hint = null): ?EventId
    {
        return \Sentry\captureEvent($event, $hint);
    }

    /**
     * Captures a monitor check-in.
     */
    public static function captureCheckIn(
        string $slug,
        CheckInStatus $status,
        ?int $duration = null,
        ?MonitorConfig $monitorConfig = null,
        ?string $checkInId = null
    ): ?string {
        return \Sentry\captureCheckIn($slug, $status, $duration, $monitorConfig, $checkInId);
    }

    /**
     * Adds a breadcrumb to the current scope.
     */
    public static function addBreadcrumb(Breadcrumb $breadcrumb): bool
    {
        return \Sentry\addBreadcrumb($breadcrumb);
    }

    /**
     * Configures the current scope.
     *
     * @param callable(Scope): void $callback
     */
    public static function configureScope(callable $callback): void
    {
        \Sentry\configureScope($callback);
    }

    /**
     * Executes the given callback within a new isolated scope.
     *
     * @template T
     * @param callable(Scope): T $callback
     * @return T
     */
    public static function withScope(callable $callback)
    {
        return \Sentry\withScope($callback);
    }

    /**
     * Starts a new transaction span.
     */
    public static function startTransaction(TransactionContext $context): Transaction
    {
        return \Sentry\startTransaction($context);
    }

    /**
     * Gets the active client from the current hub.
     */
    public static function getClient(): ?ClientInterface
    {
        return SentrySdk::getCurrentHub()->getClient();
    }

    /**
     * Flushes the queued events and envelopes to the network transport.
     */
    public static function flush(?int $timeout = null): Result
    {
        $client = self::getClient();
        if ($client !== null) {
            return $client->flush($timeout);
        }

        return new Result(ResultStatus::skipped());
    }
}

