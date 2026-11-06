<?php

declare(strict_types=1);

namespace Ichnois;

/**
 * Universal Ichnois Class Aliases.
 * Maps core Sentry classes into the Ichnois namespace so users never have to import Sentry.
 */
class_alias(\Sentry\Breadcrumb::class, 'Ichnois\\Breadcrumb');
class_alias(\Sentry\Event::class, 'Ichnois\\Event');
class_alias(\Sentry\EventHint::class, 'Ichnois\\EventHint');
class_alias(\Sentry\EventId::class, 'Ichnois\\EventId');
class_alias(\Sentry\Severity::class, 'Ichnois\\Severity');
class_alias(\Sentry\Dsn::class, 'Ichnois\\Dsn');
class_alias(\Sentry\Options::class, 'Ichnois\\Options');
class_alias(\Sentry\Client::class, 'Ichnois\\Client');
class_alias(\Sentry\ClientBuilder::class, 'Ichnois\\ClientBuilder');
class_alias(\Sentry\ClientInterface::class, 'Ichnois\\ClientInterface');
class_alias(\Sentry\SentrySdk::class, 'Ichnois\\IchnoisSdk');
class_alias(\Sentry\State\Scope::class, 'Ichnois\\Scope');
class_alias(\Sentry\State\Hub::class, 'Ichnois\\Hub');
class_alias(\Sentry\State\HubInterface::class, 'Ichnois\\HubInterface');
class_alias(\Sentry\Tracing\Span::class, 'Ichnois\\Span');
class_alias(\Sentry\Tracing\SpanContext::class, 'Ichnois\\SpanContext');
class_alias(\Sentry\Tracing\Transaction::class, 'Ichnois\\Transaction');
class_alias(\Sentry\Tracing\TransactionContext::class, 'Ichnois\\TransactionContext');
class_alias(\Sentry\CheckIn::class, 'Ichnois\\CheckIn');
class_alias(\Sentry\CheckInStatus::class, 'Ichnois\\CheckInStatus');
class_alias(\Sentry\MonitorConfig::class, 'Ichnois\\MonitorConfig');
class_alias(\Sentry\MonitorSchedule::class, 'Ichnois\\MonitorSchedule');
class_alias(\Sentry\Transport\Result::class, 'Ichnois\\Result');
class_alias(\Sentry\Transport\ResultStatus::class, 'Ichnois\\ResultStatus');
