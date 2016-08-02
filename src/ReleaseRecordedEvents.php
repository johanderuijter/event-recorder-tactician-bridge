<?php declare(strict_types = 1);

namespace JDR\EventRecorderTacticianBridge;

use JDR\EventRecorder\EventDispatcher;
use JDR\EventRecorder\RecordsEvents;
use League\Tactician\Middleware;

/**
 * Middleware that releases the recorded events
 */
class ReleaseRecordedEvents implements Middleware
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var RecordsEvents
     */
    private $recorder;

    /**
     * Constructor
     *
     * @param EventDispatcher $dispatcher
     * @param RecordsEvents $recorder
     */
    public function __construct(EventDispatcher $dispatcher, RecordsEvents $recorder)
    {
        $this->dispatcher = $dispatcher;
        $this->recorder = $recorder;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        try {
            $returnValue = $next($command);
        } catch (\Exception $exception) {
            $this->recorder->eraseEvents();

            throw $exception;
        }

        $recordedEvents = $this->recorder->releaseEvents();
        while ($event = array_shift($recordedEvents)) {
            $this->dispatcher->dispatch($event);
        }

        return $returnValue;
    }
}
