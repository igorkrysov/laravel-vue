<div class="row">
  <div class="message">
    @if(session()->has('message_danger'))
      <div class="alert alert-danger">
        {{ session()->get('message_danger') }}
      </div>
    @endif

    @if(session()->has('message_success'))
      <div class="alert alert-success">
        {{ session()->get('message_success') }}
      </div>
    @endif
  </div>
</div>
