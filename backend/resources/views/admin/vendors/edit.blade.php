@extends('layouts.dashboards', ['menu' => 'vendors'])

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
                    <form action="{{ route('vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="_method" value="put">

                        <div class="box">
                            <div class="box-body">
                                <div class="form-group {{ $errors->has('vendorname') ? 'has-error' : '' }}">
                                    <label>Name</label>
                                    <input required value="{{ $vendor->vendorname }}" type="text" name="vendorname" class="form-control" placeholder="Name" />

                                    @if ($errors->has('vendorname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('vendorname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                    <label>Profile photo</label>
                                    <div class="controls">
                                        <span>
                                            <input type="file" name="photo" id="file" onchange="loadPreview(this, 'preview_img');" class="inputfile">
                                            <?php 
                                                if(@$vendor->photo) {
                                                    $path = asset('uploads/') . "/" . $vendor->photo;
                                                }else{
                                                    $path = "";
                                                }
                                            ?>

                                            <label for="file" @click="onClick" inputId="1" style="background-image: url(<?= $path ?>);" id='preview_img'>
                                                <i class="fa fa-plus-circle"></i>
                                            </label>
                                        </span>
                                    </div>

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label>Email</label>
                                    <input required="" type="email" name="email" class="form-control" placeholder="Email" value="{{ $vendor->email }}" />

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                    <label>Category</label>
                                    <select class="form-control" required name="category_id">
                                        <option value="">Choose</option>
                                        @foreach($categories as $cate)
                                            <option <?php if($cate->id==$vendor->category_id){echo 'selected';} ?> value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label>Phone</label>
                                    <input required="" type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $vendor->phone }}" />

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                    <label>Location</label>
                                    <input required="" type="text" name="location" class="form-control" placeholder="Location" value="{{ $vendor->location }}" />

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Instagram Link</label>
                                    <input type="text" name="instagram_id" class="form-control" placeholder="Instagram" value="{{ $vendor->instagram_id }}" />
                                </div>

                                <div class="form-group">
                                    <label>Facebook Link</label>
                                    <input type="text" name="facebook_id" class="form-control" placeholder="Facebook" value="{{ $vendor->facebook_id }}" />
                                </div>

                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks_vendor" class="form-control" rows="8">{{ $vendor->remarks_vendor }}</textarea>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">Save Vendor</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

<style type="text/css">
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .inputfile + label {
        font-size: 1.25em;
        font-weight: 700;
        color: white;
        /*background-color: #E9ECEF;*/
        padding: 50px;
        display: inline-block;
        cursor: pointer;
        background-size: contain;
        width: 100%;
        background-repeat: no-repeat;
    }

    .inputfile:focus + label,
    .inputfile + label:hover {
        /*background-color: #38C172ed;*/
    }

    .hidden {
        display: none !important;
    }
</style>

@section('script')
    <script>
        function loadPreview(input, id) {
            id = "#" + id;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var path = "background-image: " + "url('" + e.target.result + "')";
                    $(id).attr('style', path);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection