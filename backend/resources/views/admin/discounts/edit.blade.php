@extends('layouts.dashboards', ['menu' => 'discounts'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

	<div class="card">
        <div class="card-body" style="padding: 5%;">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="put">

                        <div class="box">
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label>Title</label>
                                    <input required value="{{ $discount->title }}" type="text" name="title" class="form-control" placeholder="Title" />

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label>Description</label>
                                    <textarea required class="form-control" name="description" rows="8">{{ $discount->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <input type="hidden" name="vendor_id" value="{{ $discount->vendor_id }}" class="form-control" />
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">Save Discount</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop