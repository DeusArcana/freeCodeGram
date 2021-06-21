@extends('layouts.app')

@section('content')
<div class="container">
	<form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="post">
		@csrf
		<div class="card">
			<div class="card-header">
				<h1>Add New Post</h1>
			</div>
			<div class="card-body">
				<div class="col-8 offset-1">
					<div class="form-group row">
						<label for="caption" class="col-form-label">{{ __('Post caption') }}</label>
		
						<input	id="caption" 
								type="text" 
								class="form-control @error('caption') is-invalid @enderror" 
								caption="caption"
								name="caption"
								value="{{ old('caption') }}" 
								required autocomplete="caption" autofocus>
		
						@error('caption')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="row">
						<label for="image" class="col-form-label">{{ __('Post Image') }}</label>

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
					<button class="btn btn-primary">Add New Post</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
	
