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
								<div class="col s12 l6">
									<div class="detailWrap">
										<h6>Query count</h6>
										<p>0</p>
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
						
						{{-- PERSONNEL EDUCATION RECORD --}}
						<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
							<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">EDUCATION RECORDS</legend>
							<table class="centered striped">
								<thead>
									<tr>
										<th>Type</th>
										<th>School</th>
										<th>Qualification</th>
										<th>Location</th>
										<th>Course</th>
										<th>Grade</th>
										<th>Start Year</th>
										<th>End Year</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(!$personnel->education_records->isEmpty())
										@foreach($personnel->education_records as $education)
											<tr>
												<td>{{ ucwords($education->type) }}</td>
												<td>{{ ucwords($education->school_name) }}</td>
												<td>{{ strtoupper($education->qualification) }}</td>
												<td>{{ ucwords($education->location) }}</td>
												<td>{{ ucwords($education->course) }}</td>
												<td>{{ ucwords($education->grade) }}</td>
												<td>{{ $education->start_year }}</td>
												<td>{{ $education->end_year }}</td>
												<td>
													<a id="deleteRow" onclick="deleteTertiary(event)" href="#" data-row_id="{{ $education->id }}" class="red-text">x</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="9" style="text-align:center;">No records available</td>
										</tr>
									@endif
								</tbody>
							</table>
							
						</fieldset>
						@if(auth()->user()->isAdmin)
							{{-- ADD NEW RECORD --}}
							<form action="{{ route('personnel_add_education', $personnel->id) }}" method="POST" class="row educationForm col s12" id="educationForm">
								@csrf
								<h6 class="customH62">Add a record</h6>
								<div class="input-field col s12 l3">
									<select id="type" name="type" class="browser-default" required>
										<option value="" disabled="" disabled selected>Type</option>
										<option value="primary">Primary</option>
										<option value="secondary">Secondary</option>
										<option value="tertiary">Tertiary</option>
									</select>
								</div>
								<div class="input-field col s12 l4">
									<input id="school_name" name="school_name" type="text" class="" required>
									<label for="school_name">School name</label>
								</div>
								<div class="input-field col s12 l5">
									<input id="location" name="location" type="text" class="" placeholder="e.g. Gwagwalada, Abuja Nigeria" required>
									<label for="location">Location</label>
								</div>
								<div class="input-field col s12 l2">
									<select id="qualification" name="qualification" class="browser-default" required>
										<option value="" disabled="" disabled selected>Qualification</option>
										<option value="fslc">FSLC</option>
										<option value="ssce">SSCE</option>
										<option value="neco">NECO</option>
										<option value="gce">GCE</option>
										<option value="ond">OND</option>
										<option value="nd">ND</option>
										<option value="nce">NCE</option>
										<option value="hnd">HND</option>
										<option value="bsc">B.SC</option>
										<option value="msc">M.SC</option>
										<option value="phd">PhD</option>
									</select>
								</div>

								<div class="input-field col s12 l3">
									<input id="course" name="course" type="text" class="">
									<label for="course">Course</label>
								</div>
								<div class="input-field col s12 l3">
									<select id="grade" name="grade" class="browser-default">
										<option value="" disabled="" disabled selected>Grade</option>
										<option value="1st Class">1st Class/Distinction</option>
										<option value="2nd Class Upper">2nd Class Upper/Upper Credit</option>
										<option value="2nd Class Lower">2nd Class Lower/Lower Credit</option>
										<option value="Pass">Pass</option>
										<option value="na">NA</option>
									</select>
								</div>
								<div class="input-field col s12 l2">
									<select id="start_year" name="start_year" class="browser-default " required>
									<option disabled selected>Start Year</option>
									<option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option></select>
								</div>
								<div class="input-field col s12 l2">
									<select id="end_year" name="end_year" class="browser-default " required>
									<option disabled selected>End Year</option>
									<option value="1970">1970</option><option value="1971">1971</option>
									<option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option>
									<option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option></select>
								</div>
								<div class="input-field col s12 l2">
									<button class="btn waves-effect green darken-1 waves-light center addteriary right" type="submit" name="action"><i class="material-icons right">add</i> ADD</button>
								</div>
							</form>
						@endif

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

						{{-- PERSONNEL APPOINTMENT PROGRESSION --}}
						<fieldset style="border:2px solid #ccc; padding: 15px 10px 10px 10px;">
							<legend style="border:0px solid #ccc; padding:4px 10px; font-weight:bold;">APPOINTMENT PROGRESSION</legend>
							<table class="centered striped">
								<thead>
									<tr>
										<th>Title</th>
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
								<h6 class="center white-text">ADD A NEW APPOINTMENT PROGRESSION RECORD</h6>
								<div class="input-field col s12 l3">
									<input type="text" name="title" class="datepicker">
									<label for="title">Title</label>
									@if ($errors->has('title'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="start" class="datepicker">
									<label for="start">From (Start-date)</label>
									@if ($errors->has('start'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('start') }}</strong>
										</span>
									@endif
								</div>
								<div class="input-field col s12 l3 select">
									<input type="text" name="end" class="datepicker">
									<label for="end">To (End-date)</label>
									@if ($errors->has('end'))
										<span class="helper-text red-text">
											<strong>{{ $errors->first('end') }}</strong>
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
									@if(!$personnel->documents->isEmpty())
										@foreach($personnel->documents as $document)
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
									<div class="file-field col s12 l9 input-field">
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

					{{-- @if(auth()->user()->isTraining || auth()->user()->isCDI)
						LOCAL COURSES
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
						FOREIGN COURSES
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
					@endif --}}

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