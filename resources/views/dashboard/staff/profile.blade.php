@extends('layouts.app', ['title' => 'Staff Profile' ])

@section('content')
    <div class="my-content-wrapper">
        <div class="content-container white">
            <div class="sectionWrap z-depth-0">
                <div class="sectionTableWrap z-depth-0" style="margin-top:18px; padding:0;">
					<h5 style="padding:8px; width:100%; margin:0 0 20px 0; border-bottom: 2px dotted #ccc; text-align:center; font-weight:bold;">{{ $local_courses->fullname }}'s Profile</h5>

					{{-- PROFILE INFO --}}
					<div class="profile">
						<div class="row infoWrap">
							{{-- BASIC INFORMATION --}}
							<div class="row">
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Service name</h6>
										<p>{{ $local_courses->servicename }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Service no.</h6>
										<p>{{ $local_courses->service_number }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Gender</h6>
										<p>{{ $local_courses->gender }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Date of Birth</h6>
										<p>{{ $local_courses->dob }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>State of Origin</h6>
										<p>{{ $local_courses->soo }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Local Government</h6>
										<p>{{ $local_courses->lgoo }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Date of Entry</h6>
										<p>{{ $local_courses->doe }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Grade Level</h6>
										<p>{{ $local_courses->gl }}</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Category</h6>
										<p>{{ $local_courses->category }} Staff</p>
									</div>
								</div>
								<div class="col s12 l3">
									<div class="detailWrap">
										<h6>Directorate</h6>
										<p>{{ $local_courses->directorate }}</p>
									</div>
								</div>
								
							</div>
						</div>
						<div class="sideColumn">
							<div class="profilePic">
								@if ($local_courses->passport == NULL)
									<img src="{{ asset('storage/avaterMale.jpg') }}" alt="Profile Pic" width="100%">
								@else
									<img src="{{ asset('storage/documents/'.$local_courses->service_number.'/passport/'.$local_courses->passport) }}" alt="Profile Pic" width="100%">
								@endif
							</div>
							@if(auth()->user()->isAdmin)
								<a href="{{ route('personnel_edit', $local_courses->id) }}" class="edit waves-effect waves-light btn"><i class="fas fa-user-edit"></i> EDIT RECORD</a>
								<a class="delete waves-effect waves-light btn"><i class="fas fa-user-times"></i> DELETE RECORD</a>
								{{-- DELETE PERSONNEL FORM --}}
								<form action="{{ route('personnel_delete', $local_courses->id) }}" method="post" id="deletePersonnel">
									@method('delete')
									@csrf
								</form>
							@endif
						</div>
					</div>

					@if(auth()->user()->isAdmin || auth()->user()->isCDI)
						{{-- PERSONNEL CAREER PROGRESSION --}}
						<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
							<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">CAREER PROGRESSION</legend>
							<table class="centered striped">
								<thead>
									<tr>
										<th>Grade level</th>
										<th>From</th>
										<th>To</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(!$personnel->progressions->isEmpty())
										@foreach($personnel->progressions as $progressions)
											<tr>
												<td>{{ $progressions->gl }}</td>
												<td>{{ $progressions->gl_start }}</td>
												<td>{{ $progressions->gl_end }}</td>
												<td>
													<a href="{{ route('personnel_remove_progression', ['user'=>$personnel->id, 'progression'=>$progressions->id]) }}">x</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="5" style="text-align:center;">No records available</td>
										</tr>
									@endif
								</tbody>
							</table>
						</fieldset>
						@if(auth()->user()->isAdmin)
							{{-- ADD NEW RECORD --}}
							<form class="assignCourse row card" action="{{ route('personnel_add_progression', $local_courses->id) }}" method="POST">
								@method('PUT')
								@csrf
								<h6 class="center white-text">ADD A NEW PROGRESSION RECORD</h6>
								<div class="input-field col s12 l3 select">
									<select id="gl" name="gl" class="browser-default" required>
										<option disabled selected>Select a Grade Level</option>
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
									</select>
									@if ($errors->has('gl'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('gl') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="gl_start" class="datepicker">
									<label for="gl_start">From (Start-date)</label>
									@if ($errors->has('gl_start'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('gl_start') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="gl_end" class="datepicker">
									<label for="gl_end">To (End-date)</label>
									@if ($errors->has('gl_end'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('gl_end') }}</strong>
										</span>
									@endif
								</div>
								<button class="submit btn waves-effect waves-light" type="submit"><i class="material-icons right">add</i>ADD RECORD</button>
							</form>
						@endif

						{{-- PERSONNEL REDEPLOYMENTS/POSTING --}}
						<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
							<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">REDEPLOYMENT/POSTING</legend>
							<table class="centered striped">
								<thead>
									<tr>
										<th>Directorate</th>
										<th>From</th>
										<th>To</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(!$personnel->postings->isEmpty())
										@foreach($personnel->postings as $postings)
											<tr>
												<td>{{ $postings->directorate }}</td>
												<td>{{ $postings->directorate_start }}</td>
												<td>{{ $postings->directorate_end }}</td>
												<td>
													<a href="{{ route('personnel_remove_posting', ['user'=>$personnel->id, 'posting'=>$postings->id]) }}">x</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="5" style="text-align:center;">No record available</td>
										</tr>
									@endif
								</tbody>
							</table>
						</fieldset>
						@if(auth()->user()->isAdmin)
						{{-- ADD NEW RECORD --}}
							<form class="assignCourse row card" action="{{ route('personnel_add_posting', $local_courses->id) }}" method="POST">
								@method('PUT')
								@csrf
								<h6 class="center white-text">ADD A NEW POSTING RECORD</h6>
								<div class="input-field col s12 l3 select">
									<select id="directorate" name="directorate" class="browser-default" required>
										<option disabled selected>Select a Directorate</option>
										<option value="Administration">Administration</option>
										<option value="Technical">Technical services</option>
										<option value="Operations">Operations</option>
									</select>
									@if ($errors->has('directorate'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('directorate') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="directorate_start" class="datepicker">
									<label for="directorate_start">From (Start-date)</label>
									@if ($errors->has('directorate_start'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('directorate_start') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="directorate_end" class="datepicker">
									<label for="directorate_end">To (End-date)</label>
									@if ($errors->has('directorate_end'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('directorate_end') }}</strong>
										</span>
									@endif
								</div>
								<button class="submit button btn waves-effect waves-light" type="submit"><i class="material-icons right">add</i>ADD RECORD</button>
							</form>
						@endif
					@endif
					
					@if(auth()->user()->isAdmin || auth()->user()->isCDI)
						{{-- PERSONNEL DOCUMENTS --}}
						<fieldset>
							<legend>PERSONNEL DOCUMENTS</legend>
							<div class="docWrapper">
								<div class="segment">
									<legend>Performance Evaluation</legend>
									@if(!$personnel->documents->isEmpty())
										@foreach($personnel->documents as $document)
											@if($document->type == 'performance evaluation')
											<ul>
												<a href="#" class="deleteDocument" id="delete"><i class="tiny material-icons">close</i></a>
												{{-- DELETE DOCUMENT FORM --}}
												<form action="{{ route('deletePersonnelDocument', $document->id) }}" method="post" id="deletePersonnelDocument">
													@method('delete')
													@csrf
												</form>

												<li>
													<a href="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" data-lightbox="documents"  data-title="{{ strtoupper($document->title) }}">
														<img src="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" width="80px">
													</a>
												</li>
												<li>{{ strtoupper($document->title) }}</li>
											</ul>
											@endif
										@endforeach
									@else
										<tr>
											<td colspan="2" style="text-align:center;">No Documents Uploaded</td>
										</tr>
									@endif
								</div>
								<div class="segment">
									<legend>Reports</legend>
									@if(!$personnel->documents->isEmpty())
										@foreach($personnel->documents as $document)
											@if($document->type == 'reports')
											<ul>
												<a href="#" class="deleteDocument" id="delete"><i class="tiny material-icons">close</i></a>
												{{-- DELETE DOCUMENT FORM --}}
												<form action="{{ route('deletePersonnelDocument', $document->id) }}" method="post" id="deletePersonnelDocument">
													@method('delete')
													@csrf
												</form>

												<li>
													<a href="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" data-lightbox="documents"  data-title="{{ strtoupper($document->title) }}">
														<img src="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" width="80px">
													</a>
												</li>
												<li>{{ strtoupper($document->title) }}</li>
											</ul>
											@endif
										@endforeach
									@else
										<tr>
											<td colspan="2" style="text-align:center;">No Documents Uploaded</td>
										</tr>
									@endif
								</div>
								<div class="segment">
									<legend>Miscellaneous</legend>
									@if(!$personnel->documents->isEmpty())
										@foreach($personnel->documents as $document)
											@if($document->type == 'miscellaneous')
											<ul>
												<a href="#" class="deleteDocument" id="delete"><i class="tiny material-icons">close</i></a>
												{{-- DELETE DOCUMENT FORM --}}
												<form action="{{ route('deletePersonnelDocument', $document->id) }}" method="post" id="deletePersonnelDocument">
													@method('delete')
													@csrf
												</form>

												<li>
													<a href="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" data-lightbox="documents"  data-title="{{ strtoupper($document->title) }}">
														<img src="{{ asset('storage/documents/'.$personnel->service_number.'/'.$document->file) }}" width="80px">
													</a>
												</li>
												<li>{{ strtoupper($document->title) }}</li>
											</ul>
											@endif
										@endforeach
									@else
										<tr>
											<td colspan="2" style="text-align:center;">No Documents Uploaded</td>
										</tr>
									@endif
								</div>
							</div>
						</fieldset>
						@if(auth()->user()->isAdmin)
							{{-- UPLOAD NEW DOCUMENT --}}
							<form action="{{ route('personnel_doc_upload', $personnel->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row select" style="display: flex; justify-content: center; align-items: center;">
									<div class="col s12 l4">
										<label for="document_type">Document Type</label>
										<select id="document_type" name="document_type" class="browser-default" required>
											<option disabled selected>Select a document type</option>
											<option value="performance evaluation">Performance Evaluation</option>
											<option value="reports">Reports</option>
											<option value="miscellaneous">Miscellaneous</option>
										</select>
										@if ($errors->has('document_type'))
											<span class="helper-text red-text">
												<strong>{{ $errors->first('document_type') }}</strong>
											</span>
										@endif
										
									</div>
									<div class="file-field col s12 l5 input-field">
										<div class="uploadBtn">
											<span>SELECT SCANNED FILES</span>
											<input type="file" name="file[]" id="file" accept="image/*" multiple>
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate" type="text" placeholder="Upload one or more files">
										</div>
									</div>
									<div class="col s12 l3">
										<button class="submit button btn waves-effect waves-light" type="submit"><i class="material-icons right">add</i>ADD DOCUMENT(s)</button>
									</div>
								</div>
							</form>
						@endif
					@endif

					@if(auth()->user()->isTraining || auth()->user()->isCDI)
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
						@if(auth()->user()->isTraining)
							{{-- ASSIGN NEW COURSE --}}
							<form class="assignCourse row card" action="{{ route('personnel_assign_course', $local_courses->id) }}" method="POST">
								@method('PUT')
								@csrf
								<h6 class="center white-text">ASSIGN A NEW COURSE</h6>
								<div class="col s12 l5 select">
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
								<div class="file-field col s12 l5 input-field">
									<div class="uploadBtn">
										<span class="white-text">Upload course report</span>
										<input type="file" name="file[]" id="file" accept="image/*" multiple>
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="Upload one or more files">
									</div>
								</div>
								<button class="submit button btn waves-effect waves-light" type="submit"><i class="material-icons right">add</i>ADD COURSE</button>
							</form>
						@endif
					@endif

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
		lightbox.option({
		'resizeDuration': 200,
		'wrapAround': true,
		'fitImagesInViewport': true,
		'maxHeight': 800,
		'disableScrolling': false
		});
		$(function() {
			$('.delete').click(function(event){
				event.preventDefault();
				if(confirm("Are you sure you want to delete personnel?")){
					$('#deletePersonnel').submit();
				}
			});
			$('.deleteDocument').click(function(event){
				event.preventDefault();
				
				if(confirm("Are you sure you want to delete document?")){
					event.currentTarget.nextElementSibling.submit();
				}
			});
			$('.datepicker').datepicker();
		});
    </script>
@endpush