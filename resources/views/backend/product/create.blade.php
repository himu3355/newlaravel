@extends('layouts.admin.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
        <form method="post" action="{{route('product.store')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-7">

                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                        @error('summary')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="is_featured">Is Featured</label><br>
                        <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                    </div>
                    {{-- {{$categories}} --}}

                    <div class="form-group">
                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach($categories as $key=>$cat_data)
                            <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group d-none" id="child_cat_div">
                        <label for="child_cat_id">Sub Category</label>
                        <select name="child_cat_id" id="child_cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}" class="form-control">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount" value="{{old('discount')}}" class="form-control">
                        @error('discount')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- <div class="form-group">
                <label for="size">Size</label>
                <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                    <option value="">--Select any size--</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">Extra Large (XL)</option>
                </select>
            </div> -->

                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        {{-- {{$brands}} --}}

                        <select name="brand_id" class="form-control">
                            <option value="">--Select Brand--</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select name="condition" class="form-control">
                            <option value="">--Select Condition--</option>
                            <option value="default">Default</option>
                            <option value="new">New</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Quantity <span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity" value="{{old('stock')}}" class="form-control">
                        @error('stock')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <h5>Product Attributes</h5>

                    @foreach($attributesByCategory as $categoryId => $category)
                    <div class=" mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">{{ $category['name'] }}</h6>
                            </div>
                            <div class="card-body">
                                @foreach($category['attributes'] as $attribute)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="attributes[]"
                                        value="{{ $attribute->id }}" id="attr{{ $attribute->id }}"
                                        {{ (is_array(old('attributes')) && in_array($attribute->id, old('attributes'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attr{{ $attribute->id }}">
                                        {{ $attribute->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>


@endsection

@push('scripts')

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    $('#lfm').filemanager('image');
    $('#cat_id').change(function() {
        var cat_id = $(this).val();
        // alert(cat_id);
        if (cat_id != null) {
            // Ajax call
            $.ajax({
                url: "/admin/category/" + cat_id + "/child",
                data: {
                    _token: "{{csrf_token()}}",
                    id: cat_id
                },
                type: "POST",
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = $.parseJSON(response)
                    }
                    // console.log(response);
                    var html_option = "<option value=''>----Select sub category----</option>"
                    if (response.status) {
                        var data = response.data;
                        // alert(data);
                        if (response.data) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title + "</option>"
                            });
                        } else {}
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        } else {}
    })
</script>
@endpush
