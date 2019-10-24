@extends('layouts.app', ['title' => 'Register New Personnel'])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container">
            <div class="sectionWrap">
                {{-- SALES HEADING --}}
                <h6 class="center sectionHeading">NEW PERSONNEL REGISTRATION</h6>

                {{-- SALES TABLE --}}
                <div class="sectionFormWrap z-depth-1" style="padding:24px;">
                    <p class="formMsg blue lighten-5 left-align">
                        Enter a course information and submit.
					</p>
					<form action="{{ route('courses_store_new') }}" method="POST" name="create_form" id="create_form">
						@csrf
						<div class="row">
							<div class="input-field col s12 l4">
								<input id="title" name="title" type="text">
								@if ($errors->has('title'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('title') }}</strong>
									</span>
								@endif
								<label for="title">Course Title</label>
							</div>
							<div class="input-field col s12 l4">
								<input id="institution" name="institution" type="text">
								@if ($errors->has('institution'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('institution') }}</strong>
									</span>
								@endif
								<label for="institution">Institution</label>
							</div>
							<div class="input-field col s12 l4">
								<input id="location" name="location" type="text">
								@if ($errors->has('location'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('location') }}</strong>
									</span>
								@endif
								<label for="location">Location</label>
							</div>

							<div class="input-field col s12 l2">
								<input id="start_date" name="start_date" type="text" class="datepicker" required>
								@if ($errors->has('start_date'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('start_date') }}</strong>
									</span>
								@endif
								<label for="start_date">Start Date</label>
							</div>
							<div class="input-field col s12 l2">
								<input id="end_date" name="end_date" type="text" class="datepicker" required>
								@if ($errors->has('end_date'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('end_date') }}</strong>
									</span>
								@endif
								<label for="end_date">End Date</label>
							</div>
							
							<div class="input-field col s12 l4">
								<button class="submit btn waves-effect waves-light left" type="submit"><i class="material-icons right">send</i>REGISTER</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
        <div class="footer z-depth-1">
            <p>&copy; Defence Intelligence Agency</p>
        </div>
    </div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd',
				yearRange: [1940, 2019]
			});
			$('#create_form').submit(function (e) { 
				$('.submit').prop('disabled', true).html('ADDING RECORD...');
			});
		});
	</script>
@endpush