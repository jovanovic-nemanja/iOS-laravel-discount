@extends('layouts.dashboards', ['menu' => 'category'])


@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
				
	<div class="card">
      	<div class="card-body" style="padding: 5%;">
      		<div class="row">
      			<a href="{{ route('category.create') }}" class="btn btn-success">Create Category</a>	
      		</div>
            <br>
            <div class="row">
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Name</th>
									<th>Photo</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->category_name }}</td>
									<?php 
                                        if(@$category->category_photo) {
                                            $path = asset('uploads/') . "/" . $category->category_photo;
                                        }else{
                                            $path = "";
                                        }
                                    ?>
                                    <td><img src="<?= $path ?>" style="border-radius: unset; height: unset;" /></td>
									<td>
										<a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm btn-flat">
											<i class="fa fa-edit"></i>
										</a>
										<a href="" onclick="event.preventDefault();
			                                 document.getElementById('delete-form-{{$category->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
											<i class="fa fa-trash"></i>
										</a>

										<form id="delete-form-{{$category->id}}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
							                  <input type="hidden" name="_method" value="delete">
							                  @csrf
							            </form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop