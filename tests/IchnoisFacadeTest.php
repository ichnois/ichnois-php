<?php

declare(strict_types=1);

namespace Ichnois\Tests;

use Ichnois\Ichnois;
use PHPUnit\Framework\TestCase;
use Sentry\Client;
use Sentry\Dsn;
use Sentry\EventHint;
use Sentry\Severity;
use Sentry\Util\Http;

final class IchnoisFacadeTest extends TestCase
{
    public function testDsnDeduplication(): void
    {
        $dsn = Dsn::createFromString('https://test-key@ichnois-h2jw.onrender.com/api/test-project-slug');
        $this->assertSame(
            'https://ichnois-h2jw.onrender.com/api/test-project-slug/envelope/',
            $dsn->getEnvelopeApiEndpointUrl()
        );
        $this->assertSame('test-project-slug', $dsn->getProjectId());
    }

    public function testHttpHeadersContainBothAuthHeaders(): void
    {
        $dsn = Dsn::createFromString('https://public-key@ichnois-h2jw.onrender.com/api/project-1');
        $headers = Http::getRequestHeaders($dsn, Client::SDK_IDENTIFIER, Client::SDK_VERSION);

        $this->assertContains('Content-Type: application/x-sentry-envelope', $headers);
        $this->assertContains(
            'X-Sentry-Auth: Sentry sentry_version=7, sentry_client=ichnois.php/1.0.0, sentry_key=public-key',
            $headers
        );
        $this->assertContains(
            'X-Ichnois-Auth: Ichnois ichnois_version=7, ichnois_client=ichnois.php/1.0.0, ichnois_key=public-key',
            $headers
        );
    }

    public function testIchnoisFacadeInitAndCapture(): void
    {
        $eventId = \Sentry\EventId::generate();

        $hub = $this->createMock(\Sentry\State\HubInterface::class);
        $hub->expects($this->once())
            ->method('captureMessage')
            ->with('Test Ichnois Message', Severity::info(), null)
            ->willReturn($eventId);

        \Sentry\SentrySdk::setCurrentHub($hub);

        $capturedId = Ichnois::captureMessage('Test Ichnois Message', Severity::info());
        $this->assertSame($eventId, $capturedId);
    }
}
