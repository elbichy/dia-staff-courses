@extends('layouts.app', ['title' => 'Register New Personnel'])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container">
            <div class="sectionWrap">
                {{-- SALES HEADING --}}
                <h6 class="center sectionHeading">EDIT {{ strtoupper($user->fullname) }}'S INFORMATION</h6>

                {{-- SALES TABLE --}}
                <div class="sectionFormWrap z-depth-1" style="padding:24px;">
                    <p class="formMsg blue lighten-5 left-align">
                        Edit the personnel's information and submit.
                    </p>
					<form action="{{ route('personnel_update', $user->id) }}" method="POST" enctype="multipart/form-data" name="create_form" id="create_form">
						@method('PUT')
						@csrf
						<div class="row">
							<div class="input-field col s12 l3">
								<input id="service_number" name="service_number" type="text" value="{{ $user->service_number }}">
								@if ($errors->has('service_number'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('service_number') }}</strong>
									</span>
								@endif
								<label for="service_number">Service No.</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="fullname" name="fullname" type="text" value="{{ $user->fullname }}">
								@if ($errors->has('fullname'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('fullname') }}</strong>
									</span>
								@endif
								<label for="fullname">Fullname</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="servicename" name="servicename" type="text" value="{{ $user->servicename }}">
								@if ($errors->has('servicename'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('servicename') }}</strong>
									</span>
								@endif
								<label for="servicename">Service Name</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="dob" name="dob" type="text" class="datepicker" required  value="{{ $user->dob }}">
								@if ($errors->has('dob'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('dob') }}</strong>
									</span>
								@endif
								<label for="dob">Date of Birth</label>
							</div>

							<div class="col s12 l3">
								<label for="gender">Gender</label>
								<select id="gender" name="gender" class="browser-default">
									<option disabled selected>Select Gender</option>
									<option value="male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
									<option value="female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
									<option value="other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
								</select>
								@if ($errors->has('gender'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('gender') }}</strong>
									</span>
								@endif
							</div>
							<div class="input-field col s12 l3">
								<input id="doe" name="doe" type="text" class="datepicker" required  value="{{ $user->doe }}">
								@if ($errors->has('doe'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('doe') }}</strong>
									</span>
								@endif
								<label for="doe">Date of Entry</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="soo" name="soo" type="text" value="{{ $user->soo }}">
								@if ($errors->has('soo'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('soo') }}</strong>
									</span>
								@endif
								<label for="soo">State (origin)</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="lgoo" name="lgoo" type="text" value="{{ $user->lgoo }}">
								@if ($errors->has('lgoo'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('lgoo') }}</strong>
									</span>
								@endif
								<label for="lgoo">LG (origin)</label>
							</div>
							<div class="col s12 l4">
								<label for="gl">Grade Level</label>
								<select id="gl" name="gl" class="browser-default">
									<option disabled selected>Select GL</option>
									<option value="17" {{ $user->gl == '17' ? 'selected' : '' }}>17</option>
									<option value="16" {{ $user->gl == '16' ? 'selected' : '' }}>16</option>
									<option value="15" {{ $user->gl == '15' ? 'selected' : '' }}>15</option>
									<option value="14" {{ $user->gl == '14' ? 'selected' : '' }}>14</option>
									<option value="13" {{ $user->gl == '13' ? 'selected' : '' }}>13</option>
									<option value="12" {{ $user->gl == '12' ? 'selected' : '' }}>12</option>
									<option value="11" {{ $user->gl == '11' ? 'selected' : '' }}>11</option>
									<option value="10" {{ $user->gl == '10' ? 'selected' : '' }}>10</option>
									<option value="9" {{ $user->gl == '9' ? 'selected' : '' }}>9</option>
									<option value="8" {{ $user->gl == '8' ? 'selected' : '' }}>8</option>
									<option value="7" {{ $user->gl == '7' ? 'selected' : '' }}>7</option>
									<option value="6" {{ $user->gl == '6' ? 'selected' : '' }}>6</option>
									<option value="5" {{ $user->gl == '5' ? 'selected' : '' }}>5</option>
									<option value="4" {{ $user->gl == '4' ? 'selected' : '' }}>4</option>
									<option value="3" {{ $user->gl == '3' ? 'selected' : '' }}>3</option>
								</select>
								@if ($errors->has('gl'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('gl') }}</strong>
									</span>
								@endif
							</div>
							<div class="col s12 l4">
								<label for="category">Category</label>
								<select id="category" name="category" class="browser-default">
									<option disabled selected>Select Categoty</option>
									<option value="junior" {{ ($user->category == 'Junior' ? 'selected' : '') }}>Junior</option>
									<option value="senior" {{ ($user->category == 'Senior' ? 'selected' : '') }}>Senior</option>
									<option value="military" {{ ($user->category == 'Military' ? 'selected' : '') }}>Military</option>
									<option value="contract" {{ ($user->category == 'Contract' ? 'selected' : '') }}>Contract</option>
									<option value="transfered" {{ ($user->category == 'Transfered' ? 'selected' : '') }}>Transfered</option>
									<option value="retired" {{ ($user->category == 'Retired' ? 'selected' : '') }}>Retired</option>
									<option value="resigned" {{ ($user->category == 'Resigned' ? 'selected' : '') }}>Resigned</option>
									<option value="dismissed" {{ ($user->category == 'Rismissed' ? 'selected' : '') }}>Dismissed</option>
								</select>
								@if ($errors->has('category'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('category') }}</strong>
									</span>
								@endif
							</div>
							<div class="input-field col s12 l4">
								<input id="directorate" name="directorate" type="text" value="{{ $user->directorate }}">
								@if ($errors->has('directorate'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('directorate') }}</strong>
									</span>
								@endif
								<label for="directorate">Directorate</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="queries" name="queries" type="number" value="{{ $user->queries }}">
								@if ($errors->has('queries'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('queries') }}</strong>
									</span>
								@endif
								<label for="queries">No. of Queries</label>
							</div>
							<div class="input-field col s12 l3">
								<input id="commendations" name="commendations" type="number" value="{{ $user->commendations }}">
								@if ($errors->has('commendations'))
									<span class="helper-text red-text">
										<strong>{{ $errors->first('commendations') }}</strong>
									</span>
								@endif
								<label for="commendations">No. of Commendations</label>
							</div>
							<div class="file-field col s12 l4 input-field">
								<div class="uploadBtn">
									<span>SELECT IMAGE</span>
									<input type="file" name="passport" id="passport" accept="image/*">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload personnel passport photograph">
								</div>
							</div>
							<div class="col s12 l2" style="display: flex; justify-content: flex-end; align-items: flex-end; height: 80px;">
								<button class="submit btn waves-effect waves-light right" type="submit"><i class="material-icons right">send</i>UPDATE</button>
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