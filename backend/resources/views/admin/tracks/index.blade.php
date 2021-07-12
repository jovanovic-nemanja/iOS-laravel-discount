@extends('layouts.dashboards', ['menu' => 'tracks'])


@section('content')
    
    @if(session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif
                
    <div class="card">
        <div class="card-body" style="padding: 5%;">
            <div class="row">
                <h3>All: {{ $allCounts }}</h2>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Discount Title</th>
                                    <th>Discount Description</th>
                                    <th>Discount Photo</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email</th>
                                    <th>Vendor Photo</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tracks as $tr)
                                    <tr>
                                        <td>{{ $tr->id }}</td>
                                        <td>{{ $tr->title }}</td>
                                        <td>
                                            <?= nl2br($tr->description) ?>
                                        </td>

                                        <?php 
                                            if(@$tr->discount_photo) {
                                                $path = asset('uploads/') . "/" . $tr->discount_photo;
                                            }else{
                                                $path = "";
                                            }
                                        ?>
                                        <td>
                                            <img src="<?= $path ?>" style="border-radius: unset; height: unset;" />
                                        </td>
                                        <td>{{ $tr->vendorname }}</td>
                                        <td>{{ $tr->vendorEmail }}</td>

                                        <?php 
                                            if(@$tr->vendorPhoto) {
                                                $vpath = asset('uploads/') . "/" . $tr->vendorPhoto;
                                            }else{
                                                $vpath = "";
                                            }
                                        ?>
                                        <td>
                                            <img src="<?= $vpath ?>" style="border-radius: unset; height: unset;" />
                                        </td>

                                        <td>{{ $tr->sign_date }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm btn-flat" onclick="event.stopPropagation(); event.preventDefault(); showSwal('warning-message-and-cancel', 'delete-form-{{$tr->id}}')" title="Delete"><i class="fa fa-trash"></i></button>

                                            <form id="delete-form-{{$tr->id}}" action="{{ route('tracks.destroy', $tr->id) }}" method="POST" style="display: none;">
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