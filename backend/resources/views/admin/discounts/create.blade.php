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
                    <form action="{{ route('discounts.store') }}" method="POST">
                        @csrf

                        <div class="box">
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label>Title</label>
                                    <input required="" type="text" name="title" class="form-control title" placeholder="Title" />

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label>Description</label>
                                    <textarea required class="form-control description" name="description" rows="8"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <input type="hidden" name="vendor_id" value="{{ $id }}" class="form-control" />
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Title 2</label>
                                    <input type="text" name="title2" class="form-control title2" placeholder="Title" />
                                </div>

                                <div class="form-group">
                                    <label>Description 2</label>
                                    <textarea class="form-control description2" name="description2" rows="8"></textarea>
                                </div>
                                <br>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Title 3</label>
                                    <input type="text" name="title3" class="form-control title3" placeholder="Title" />
                                </div>

                                <div class="form-group">
                                    <label>Description 3</label>
                                    <textarea class="form-control description3" name="description3" rows="8"></textarea>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button style="display: none;" type="submit" class="btn btn-success pull-right submit_discount">Save Discount</button>
                            </div>
                        </div>
                    </form>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right submit_discount_h">Save Discount</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop