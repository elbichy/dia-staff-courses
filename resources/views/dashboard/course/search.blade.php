@extends('layouts.app', ['title' => 'Search a course'])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container">
            <div class="sectionWrap">
                {{-- SALES HEADING --}}
                <h6 class="center sectionHeading">NEW PERSONNEL REGISTRATION</h6>

                {{-- SALES TABLE --}}
                <div class="sectionFormWrap z-depth-1" style="padding:24px;">
                    <p class="formMsg blue lighten-5 left-align">
                        Enter a term to be marched with courses in the database.
					</p>
					<form action="{{ route('courses_search') }}" method="POST" name="create_form" id="create_form">
						@csrf
						<div class="row">
							<div class="input-field col s12 l10">
								<input id="title" name="title" type="text" placeholder="Enter a term to be searched">
								@if ($errors->has('title'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('title') }}</strong>
									</span>
								@endif
								<label for="title">Term to be searched</label>
							</div>
							<div class="input-field col s12 l2">
								<button class="submit btn waves-effect waves-light right" type="submit"><i class="material-icons right">send</i>SEARCH</button>
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
				$('.submit').prop('disabled', true).html('SEARCHING...');
			});
		});
	</script>
@endpush