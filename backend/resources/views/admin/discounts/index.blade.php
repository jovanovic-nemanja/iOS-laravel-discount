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
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Vendor Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($discounts as $discount)
                                <tr>
                                    <?php 
                                        $vendor_infor = App\Discounts::getVendorInformationByID($discount->vendor_id);
                                        $category = App\Vendors::getCategoryNameByID($vendor_infor->category_id);
                                    ?>
                                    <td>{{ $discount->id }}</td>
                                    <td>{{ $discount->title }}</td>
                                    <td><?= nl2br($discount->description) ?></td>
                                    <td><?= $vendor_infor->vendorname ?></td>
                                    <td><?= $category ?></td>
                                    <td>
                                        <a href="{{ route('discounts.show', $discount->id) }}" class="btn btn-primary btn-sm btn-flat">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="" onclick="event.preventDefault();
                                             document.getElementById('delete-form-{{$discount->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        <form id="delete-form-{{$discount->id}}" action="{{ route('discounts.destroy', $discount->id) }}" method="POST" style="display: none;">
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