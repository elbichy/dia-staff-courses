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
						<h5 class="mb-0">{{ $payments_today->count() }}</h5>
						<p class="no-margin">Encounters Today</p>
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
						<h5 class="mb-0">{{ $payments_pending->count() }}</h5>
						<p class="no-margin">Pending Enc.</p>
					</div>
				</div>
			</div>
		</div>
		<a href="{{ route('account_successful') }}" class="col s12 m6 l3">
			<div class="gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">done_all</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">{{ $payments_success->count() }}</h5>
						<p class="no-margin">Successful Enc.</p>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('account_cancelled') }}" class="col s12 m6 l3">
			<div class="gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
				<div class="padding-4">
					<div class="col s4 m4">
						<i class="material-icons background-round mt-5">close</i>
					</div>
					<div class="col s8 m8 right-align">
						<h5 class="mb-0">{{ $payments_cancelled->count() }}</h5>
						<p class="no-margin">Cancelled Enc.</p>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>

{{-- TABLE --}}
<div class="sectionTableWrap" style="padding-top:0px;">
	<h6 style="padding:12px; background:#eee; text-align:center; font-weight:bold;">Pending Payments</h6>
	<table class="highlight responsive-table centered">
		<thead>
			<tr>
				<th>OPD No.</th>
				<th>Fullname</th>
				<th>Gender</th>
				<th>Phone</th>
				<th>Payment For</th>
				<th>Amount</th>
				<th>Time</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($payments_pending as $payment)
				@if($payment->status == 1)
				<tr>
					<td>{{ $payment->patient->opd }}</td>
					<td>{{ $payment->patient->surname }} {{ $payment->patient->othername }}</td>
					<td>{{ $payment->patient->gender }}</td>
					<td>{{ $payment->patient->phone }}</td>
					<td>{{ $payment->payment_for }}</td>
					<td>{{ $payment->amount }}</td>
					<td>{{ $payment->updated_at }}</td>
					<td>
						<a href="{{ route('show_reg_payment', $payment->id) }}" class="waves-effect waves-light btn modal-trigger">Process Payment</a>
					</td>
				</tr>
				@endif
			@endforeach
			@empty($payments_pending)
				<tr>
					<td colspan="7" style="text-align:center;">No Data Available</td>
				</tr>
			@endempty
		</tbody>
	</table>
</div>
