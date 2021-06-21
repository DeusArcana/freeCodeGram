@extends('layouts.app')

@section('content')
<div class="container">
	<form action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" method="post">
		@csrf
		@method('PATCH')
		
		<div class="card">
			<div class="card-header">
				<h1>Edit Profile</h1>
			</div>
			<div class="card-body">
				<div class="col-8 offset-1">
					<div class="form-group row">
						<label for="title" class="col-form-label">{{ __('Title') }}</label>
		
						<input	id="title" 
								type="text" 
								class="form-control @error('title') is-invalid @enderror" 
								caption="title"
								name="title"
								value="{{ old('title') ?? $user->profile->title }}" 
								required autocomplete="title" autofocus>
		
						@error('title')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group row">
						<label for="description" class="col-form-label">{{ __('Description') }}</label>
		
						<input	id="description" 
								type="text" 
								class="form-control @error('description') is-invalid @enderror" 
								caption="description"
								name="description"
								value="{{ old('description') ?? $user->profile->description }}" 
								required autocomplete="description" autofocus>
		
						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group row">
						<label for="url" class="col-form-label">{{ __('URL') }}</label>
		
						<input	id="url" 
								type="text" 
								class="form-control @error('url') is-invalid @enderror" 
								caption="url"
								name="url"
								value="{{ old('url') ?? $user->profile->url }}" 
								required autocomplete="url" autofocus>
		
						@error('url')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="row">
						<label for="image" class="col-form-label">{{ __('Profile Image') }}</label>

						<input type="file" class="form-control-file" name="image">
						
						@error('image')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="pt-4">
					<button class="btn btn-primary">Save Profile</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
