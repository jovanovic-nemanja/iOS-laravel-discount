@extends('layouts.dashboards', ['menu' => 'video'])

@section('content')
<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
				<form method='post' action="{{ route('admin.video.update', $video->id) }}">
					@csrf

					<input type="hidden" name="_method" value="put">

					<div class="box">
					  <!-- /.box-header -->
					  <div class="box-body">
						<div class="form-group">
							<label>Video Link</label>
							<input type="text" name="link" class="form-control" placeholder="Video link" value="{{ $video->link }}" />
						</div>
					  </div>
					  <!-- /.box-body -->
					  <div class="box-footer">
					  	<button type="submit" class="btn btn-success pull-right">Update</button>
					  </div>
					  <!-- box-footer -->
					</div>
					<!-- /.box -->
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
