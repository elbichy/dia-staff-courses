@extends('layouts.app', ['title' => 'Staff Profile' ])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container white">
            <div class="sectionWrap z-depth-0">
                <div class="sectionTableWrap z-depth-0" style="margin-top:18px; padding:0;">
					<h5 style="padding:8px; width:100%; margin:0 0 20px 0; border-bottom: 2px dotted #ccc; text-align:center; font-weight:bold;">{{ $user->fullname }}'s Profile</h5>
					
					{{-- PROFILE INFO --}}
					<div style="display:flex;">
						<div class="row center" style="flex:1; height:160px; display:flex; flex-wrap:wrap; justify-content:center; align-items:center;" >
							<div class="col s12 l3">
								<h6>FULLNAME</h6>
								<p>{{ $user->fullname }}</p>
							</div>
							<div class="col s12 l3">
								<h6>SERVICE NO.</h6>
								<p>{{ $user->service_number }}</p>
							</div>
							<div class="col s12 l3">
								<h6>GENDER</h6>
								<p>{{ $user->gender }}</p>
							</div>
							<div class="col s12 l3">
								<h6>DATE OF BIRTH</h6>
								<p>{{ $user->dob }}</p>
							</div>
							<div class="col s12 l3">
								<h6>DATE OF ENTRY</h6>
								<p>{{ $user->doe }}</p>
							</div>
							<div class="col s12 l3">
								<h6>GRADE LEVEL</h6>
								<p>{{ $user->gl }}</p>
							</div>
							<div class="col s12 l3">
								<h6>CATEGORY</h6>
								<p>{{ $user->category }} Staff</p>
							</div>
							<div class="col s12 l3">
								<h6>DIRECTORATE</h6>
								<p>{{ $user->directorate }}</p>
							</div>
						</div>
						<div class="profil_pic" style="width:150px; height:160px; border:1px solid #ccc;">
							<img src="{{ asset('storage/avaterMale.jpg') }}" alt="Profile Pic" width="100%">
						</div>
					</div>

					{{-- COURSES --}}
					<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
						<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">COURSES ATTENDED</legend>
						<table class="centered striped">
							<thead>
								<tr>
									<th>Title</th>
									<th>Institution</th>
									<th>Location</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($user->courses as $courses)
									<tr>
										<td>{{ $courses->title }}</td>
										<td>{{ $courses->institution }}</td>
										<td>{{ $courses->location }}</td>
										<td>{{ $courses->start_date }}</td>
										<td>{{ $courses->end_date }}</td>
										<td>
											<a href="{{ route('personnel_detach_course', ['user'=>$user->id, 'course'=>$courses->id]) }}">x</a>
										</td>
									</tr>
								@endforeach
								@empty($user->courses)
									<tr>
										<td colspan="5" style="text-align:center;">No Courses Attended</td>
									</tr>
								@endempty
							</tbody>
						</table>
					</fieldset>

					{{-- ASSIGN NEW COURSE --}}
					<h6 class="center">ASSIGN A NEW COURSE</h6>
					<form class="row" action="{{ route('personnel_assign_course', $user->id) }}" method="POST" style="padding:12px; display:flex; align-items:center;">
						@method('PUT')
						@csrf
						<div class="col s12 l10">
							<select id="course" name="course" class="browser-default" required>
								<option disabled selected>Select a new course for this personnel</option>
								@foreach($all_courses as $each_course)
									<option value="{{ $each_course->id }}">{{ $each_course->title }}</option>
								@endforeach
								@empty($all_courses)
									<option disabled>No courses at the moment</option>
								@endempty
							</select>
							@if ($errors->has('course'))
								<span class="helper-text red-text">
									<strong>{{ $errors->first('course') }}</strong>
								</span>
							@endif
						</div>
						<button class="submit btn waves-effect waves-light" type="submit"><i class="material-icons right">add</i>ADD COURSE</button>
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
        $(function() {
        });
    </script>
@endpush