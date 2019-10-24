@extends('layouts.app')

@section('content')
	<div class="my-content-wrapper">
		<div class="content-container white">
			<div class="sectionWrap">
				{{-- Shows records restricted info --}}
				@includeWhen(!auth()->user()->isAdmin, 'dashboard.extended.dashboard')

				{{-- Shows account restricted info --}}
				@includeWhen(auth()->user()->isAccount, 'dashboard.extended.account')
			</div>
		</div>
		<div class="footer z-depth-1">
			<p>&copy; Defence Intelligence Agency</p>
		</div>
	</div>
@endsection
