<?php

namespace spec\JDR\EventRecorderTacticianBridge;

use JDR\EventRecorder\EventDispatcher;
use JDR\EventRecorder\EventRecorder;
use JDR\EventRecorderTacticianBridge\ReleaseRecordedEvents;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReleaseRecordedEventsSpec extends ObjectBehavior
{
    function let(EventDispatcher $dispatcher, EventRecorder $recorder)
    {
        $recorder->releaseEvents()->willReturn(['event', 'somethingHappened']);
        $this->beConstructedWith($dispatcher, $recorder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ReleaseRecordedEvents::class);
    }

    function it_dispatches_all_stored_events(EventDispatcher $dispatcher)
    {
        $this->execute('command', function ($command) {});
        $dispatcher->dispatch('event')->shouldHaveBeenCalled();
        $dispatcher->dispatch('somethingHappened')->shouldHaveBeenCalled();
    }

    function it_dispatches_only_stored_events(EventDispatcher $dispatcher)
    {
        $this->execute('command', function ($command) {});
        $dispatcher->dispatch('unstored event')->shouldNotHaveBeenCalled();
    }

    function it_erases_all_stored_events_when_an_exception_is_thrown(EventDispatcher $dispatcher, EventRecorder $recorder)
    {
        $recorder->eraseEvents()->shouldBeCalled();
        $dispatcher->dispatch('event')->shouldNotBeCalled();
        $dispatcher->dispatch('somethingHappened')->shouldNotBeCalled();
        $this->shouldThrow(new \Exception('something went wrong'))->during('execute', [
            'command',
            function ($command) {
                throw new \Exception('something went wrong');
            }
        ]);
    }
}
