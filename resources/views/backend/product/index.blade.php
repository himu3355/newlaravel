@extends('layouts.admin.app')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Product Lists</h6>
        <a href="{{ route('product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">@if(count($products)>0)
            <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Is Featured</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Size</th>
                        <th>Condition</th>
                        <th>Brand</th>
                        <th>Stock</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Is Featured</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Size</th>
                        <th>Condition</th>
                        <th>Brand</th>
                        <th>Stock</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach($products as $product)
                    @php
                    $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                    // dd($sub_cat_info);
                    $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
                    @endphp
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->cat_info['title']}}
                            <sub>
                                {{$product->sub_cat_info->title ?? ''}}
                            </sub>
                        </td>
                        <td>{{(($product->is_featured==1)? 'Yes': 'No')}}</td>
                        <td>Rs. {{$product->price}} /-</td>
                        <td> {{$product->discount}}% OFF</td>
                        <td>{{$product->size}}</td>
                        <td>{{$product->condition}}</td>
                        <td> {{ucfirst($product->brand->title)}}</td>
                        <td>
                            @if($product->stock>0)
                            <span class="badge badge-primary">{{$product->stock}}</span>
                            @else
                            <span class="badge badge-danger">{{$product->stock}}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->photo)
                            @php
                            $photo=explode(',',$product->photo);
                            // dd($photo);
                            @endphp
                            <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                            @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                            @endif
                        </td>
                        <td>
                            @if($product->status=='active')
                            <span class="badge badge-success">{{$product->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$product->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('product.destroy',[$product->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$products->links()}}</span>
            @else
            <h6 class="text-center">No Products found!!! Please create Product</h6>
            @endif
        </div>
    </div>
</div>
@endsection
