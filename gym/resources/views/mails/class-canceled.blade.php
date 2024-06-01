<p>Hey, {{ $details['member'] }}!</p>

<p>Sorry, your class {{ $details['className'] }} was canceled on {{ $details['classDateTime']->format('jS F') }} at {{ $details['classDateTime']->format('g:i a') }} by the instructor.</p>

<p>Check the schedule and book another one. Thank you!</p>
