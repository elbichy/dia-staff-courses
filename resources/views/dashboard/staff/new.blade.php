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
                        Enter the personnel's information and submit.
                    </p>
					<form action="{{ route('personnel_store_new') }}" method="POST" name="create_form" id="create_form">
						@csrf
						<div class="row">
							<div class="input-field col s12 l3">
								<input id="service_number" name="service_number" type="text">
								@if ($errors->has('tribe'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('service_number') }}</strong>
									</span>
								@endif
								<label for="service_number">Service No.</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="fullname" name="fullname" type="text">
								@if ($errors->has('fullname'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('fullname') }}</strong>
									</span>
								@endif
								<label for="fullname">Fullname</label>
							</div>
							<div class="input-field col s12 l2">
								<input id="dob" name="dob" type="text" class="datepicker" required>
								@if ($errors->has('dob'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('dob') }}</strong>
									</span>
								@endif
								<label for="dob">Date of Birth</label>
							</div>

							<div class="col s12 l2">
								<label for="gender">Gender</label>
								<select id="gender" name="gender" class="browser-default">
									<option disabled selected>Select Gender</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="other">Other</option>
								</select>
								@if ($errors->has('gender'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('gender') }}</strong>
									</span>
								@endif
							</div>
							<div class="input-field col s12 l2">
								<input id="doe" name="doe" type="text" class="datepicker" required>
								@if ($errors->has('doe'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('doe') }}</strong>
									</span>
								@endif
								<label for="doe">Date of Entry</label>
							</div>
							<div class="col s12 l2">
								<label for="gl">Grade Level</label>
								<select id="gl" name="gl" class="browser-default">
									<option disabled selected>Select GL</option>
									<option value="17">17</option>
									<option value="16">16</option>
									<option value="15">15</option>
									<option value="14">14</option>
									<option value="13">13</option>
									<option value="12">12</option>
									<option value="11">11</option>
									<option value="10">10</option>
									<option value="9">9</option>
									<option value="8">8</option>
									<option value="7">7</option>
									<option value="6">6</option>
									<option value="5">5</option>
									<option value="4">4</option>
									<option value="3">3</option>
									<option value="2">2</option>
									<option value="1">1</option>
								</select>
								@if ($errors->has('gl'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('gl') }}</strong>
									</span>
								@endif
							</div>
							<div class="col s12 l3">
								<label for="category">Category</label>
								<select id="category" name="category" class="browser-default">
									<option disabled selected>Select Categoty</option>
									<option value="junior">Junior</option>
									<option value="senior">Senior</option>
									<option value="military">Military</option>
								</select>
								@if ($errors->has('category'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('category') }}</strong>
									</span>
								@endif
							</div>
							<div class="input-field col s12 l3">
								<input id="directorate" name="directorate" type="text">
								@if ($errors->has('directorate'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('directorate') }}</strong>
									</span>
								@endif
								<label for="directorate">Directorate</label>
							</div>
							<div class="input-field col s12 l4 right">
								<button class="submit btn waves-effect waves-light " type="submit"><i class="material-icons right">send</i>REGISTER</button>
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