@extends('layouts.dashboards', ['menu' => 'video'])

@section('content')
<div class="card">
    <div class="card-body" style="padding: 5%;">
        <div class="row">
        	<?php if (@$video) { ?>
        		
        	<?php }else{ ?>
        		<a href="{{ route('video.create') }}" class="btn btn-success">Add Video</a> 
    		<?php } ?>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $video->id }}</td>
                                <td>{{ $video->link }}</td>
                                <td>
                                    <a href="{{ route('video.show', $video->id) }}" class="btn btn-primary btn-sm btn-flat">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" onclick="event.preventDefault();
                                         document.getElementById('delete-form-{{$video->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <form id="delete-form-{{$video->id}}" action="{{ route('video.destroy', $video->id) }}" method="POST" style="display: none;">
                                          <input type="hidden" name="_method" value="delete">
                                          @csrf
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
