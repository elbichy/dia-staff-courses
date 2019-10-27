@extends('layouts.app', ['title' => 'Staff Profile' ])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container white">
            <div class="sectionWrap z-depth-0">
                <div class="sectionTableWrap z-depth-0" style="margin-top:18px; padding:0;">
					<h5 style="padding:8px; width:100%; margin:0 0 20px 0; border-bottom: 2px dotted #ccc; text-align:center; font-weight:bold;">{{ $local_courses->fullname }}'s Profile</h5>
					
					{{-- PROFILE INFO --}}
					<div class="profile">
						<div class="row center infoWrap">
							<div class="col s12 l3">
								<h6>Service name</h6>
								<p>{{ $local_courses->servicename }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Service no.</h6>
								<p>{{ $local_courses->service_number }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Gender</h6>
								<p>{{ $local_courses->gender }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Date of Birth</h6>
								<p>{{ $local_courses->dob }}</p>
							</div>
							<div class="col s12 l3">
								<h6>State of Origin</h6>
								<p>{{ $local_courses->soo }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Local Government</h6>
								<p>{{ $local_courses->lgoo }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Date of Entry</h6>
								<p>{{ $local_courses->doe }}</p>
							</div>
							<div class="col s12 l3">
								<h6>Grade Level</h6>
								<p>{{ $local_courses->gl }}</p>
							</div>

							<div class="col s12 l3">
								<h6>Category</h6>
								<p>{{ $local_courses->category }} Staff</p>
							</div>
							<div class="col s12 l3">
								<h6>Directorate</h6>
								<p>{{ $local_courses->directorate }}</p>
							</div>

							<div class="col s12 l6 right douButtons">
								<a href="{{ route('personnel_edit', $local_courses->id) }}"><i class="fas fa-edit"></i> Edit profile</a>
								<a href="{{ route('personnel_delete', $local_courses->id) }}"><i class="fas fa-trash-alt"></i> Delete staff</a>
							</div>
						</div>
						<div class="profil_pic" style="width:150px; height:160px; border:1px solid #ccc;">
							<img src="{{ asset('storage/avaterMale.jpg') }}" alt="Profile Pic" width="100%">
						</div>
					</div>

					{{-- LOCAL COURSES --}}
					<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
						<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">FOREIGN COURSES ATTENDED</legend>
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
								@if(! $foreign_courses->courses->isEmpty())
									@foreach($foreign_courses->courses as $f_courses)
										<tr>
											<td>{{ $f_courses->title }}</td>
											<td>{{ $f_courses->institution }}</td>
											<td>{{ $f_courses->location }}</td>
											<td>{{ $f_courses->startdate }}</td>
											<td>{{ $f_courses->enddate }}</td>
											<td>
												<a href="{{ route('personnel_detach_course', ['user'=>$local_courses->id, 'course'=>$f_courses->id]) }}">x</a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5" style="text-align:center;">No Courses Attended</td>
									</tr>
								@endif
							</tbody>
						</table>
					</fieldset>

					{{-- FOREIGN COURSES --}}
					<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
						<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">LOCAL COURSES ATTENDED</legend>
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
								@if(! $local_courses->courses->isEmpty())
									@foreach($local_courses->courses as $l_courses)
										<tr>
											<td>{{ $l_courses->title }}</td>
											<td>{{ $l_courses->institution }}</td>
											<td>{{ $l_courses->location }}</td>
											<td>{{ $l_courses->startdate }}</td>
											<td>{{ $l_courses->enddate }}</td>
											<td>
												<a href="{{ route('personnel_detach_course', ['user'=>$local_courses->id, 'course'=>$l_courses->id]) }}">x</a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="5" style="text-align:center;">No Courses Attended</td>
									</tr>
								@endif
							</tbody>
						</table>
					</fieldset>

					{{-- ASSIGN NEW COURSE --}}
					<form class="assignCourse row card" action="{{ route('personnel_assign_course', $local_courses->id) }}" method="POST">
						@method('PUT')
						@csrf
						<h6 class="center white-text">ASSIGN A NEW COURSE</h6>
						<div class="col s12 l10 select">
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