@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-8">
			<img src="/storage/{{ $post->image }}" class="w-100">
		</div>
		<div class="col-4">
			<div>
				<div class="d-flex align-items-center">
					<div>
						<img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
					</div>
					<div class="pl-3">
						<h4 class="font-weight-bold">
							<a href="{{ route('profile.show', $post->user->id) }}" class="pr-1">
								<span class="text-dark">{{ $post->user->username }}</span>
							</a> 
							<span>&centerdot;</span>
							<a href="#" class="pl-1">Follow</a>
						</h4>
					</div>
				</div>
				<hr>
				<p>
					<span class="font-weight-bold">
						<a href="{{ route('profile.show', $post->user->id) }}">
							<span class="text-dark">{{ $post->user->username }}</span>
						</a>
					</span> {{ $post->caption }}
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
	
