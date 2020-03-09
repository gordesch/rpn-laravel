<div
  @if ($message['level'] === 'success')
  class="bg-green-100 border border-green-400 text-green-700 max-w-3xl mx-auto mb-12 px-4 py-3 rounded relative"
  @endif
  @if ($message['level'] === 'error')
  class="bg-red-100 border border-red-400 text-red-700 max-w-3xl mx-auto mb-12 px-4 py-3 rounded relative"
  @endif
  @if ($message['level'] === 'warning')
  class="bg-orange-100 border border-orange-400 text-orange-700 max-w-3xl mx-auto mb-12 px-4 py-3 rounded relative"
  @endif
  role="alert"
>
  @if ($message['level'] === 'success')
    Check
  @endif
  @if ($message['level'] === 'error')
    Times
  @endif

  @if ($message['level'] === 'warning')
    Warning
  @endif
  {!! $message['message'] !!}
</div>
