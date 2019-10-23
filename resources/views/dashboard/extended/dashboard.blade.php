{{-- STATISTICS --}}
<div id="card-stats">
	<div class="row mt-1" style="margin-bottom:6px;">
		<div class="col s12 m6 l3">
			<div class="gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">today</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">4543</h5>
						<p class="no-margin">All courses</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m6 l3">
			<div class="gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">loop</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">454</h5>
						<p class="no-margin">No. of Ongoing</p>
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="col s12 m6 l3">
			<div class="gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">done_all</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">654</h5>
						<p class="no-margin">No. of Local</p>
					</div>
				</div>
			</div>
		</a>
		<div class="col s12 m6 l3">
			<div class="gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">close</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">067</h5>
						<p class="no-margin">No. of Foreign</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- TABLE --}}
<div class="sectionTableWrap" style="padding-top:0px;">
	<h6 style="padding:12px; background:#eee; text-align:center; font-weight:bold;">Active/On-going Courses</h6>
	<table class="highlight responsive-table centered">
		<thead>
			<tr>
				<th>Service No</th>
				<th>Fullname</th>
				<th>Gender</th>
				<th>Phone No.</th>
				<th>Course</th>
				<th>Institution</th>
				<th>Started</th>
				<th>Ending</th>
			</tr>
		</thead>
		<tbody>
			{{-- @foreach($treatments_pending as $treatment)
				<tr>
					<td>{{ $treatment->patient->opd }}</td>
					<td>{{ $treatment->patient->surname }} {{ $treatment->patient->othername }}</td>
					<td>{{ $treatment->patient->gender }}</td>
					<td>{{ $treatment->patient->dob }}</td>
					<td>{{ $treatment->patient->phone }}</td>
					<td>{{ $treatment->status }}</td>
					<td>
						<a href="#" class="btn waves-effect green waves-light">See Progress</a>
					</td>
				</tr>
			@endforeach
			@empty($treatments_pending)
				<tr>
					<td colspan="7" style="text-align:center;">No Data Available</td>
				</tr>
			@endempty --}}
		</tbody>
	</table>
</div>