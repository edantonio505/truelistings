@if (count($errors) > 0)
    <div class="alert callout alerts top-space" data-closable>
   		@foreach ($errors->all() as $error)
            <li style="color:#FF6A6A;">{{ $error }}</li>
        @endforeach
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>
	</div>
@endif