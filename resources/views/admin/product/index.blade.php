@extends('layouts.admin')
@section('title','Product Manage')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="col-12">
                            <div class="float-left">
                                <div class="ibox-head">
                                    <div class="ibox-title">List Product</div>
                            </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn btn-success float-right">
                                    <a href="{{ route('product.create') }}" class="btn btn-success">Add product</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Actual Price</th>
                                        <th>Is Featured</th>
                                        <th>Seller</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_list as $data)
                                    <tr>
                                        {{-- <td>
                                            <span class="badge badge-{{ $data->status == 'active' ? 'success' : 'danger'}}">{{ $data->status  == 'active' ? 'Published' : 'Un-Published' }}</span>

                                        <td> --}}


                                        <td>{{ $data->title }}

                                        {{-- <td>{{ $data->summary }}</td> --}}
                                        <td>{{ $data->cat_info->title ?? false }}
                                            <sub>
                                        {{ $data->sub_cat_info->title ?? false }}</sub>
                                      </td>
                                        <td>NPR. {{ number_format($data->actual_price)}}</td>
                                        <td>{{ $data->is_featured == 1  ? 'yes' : 'No'  }}</td>
                                        <td>{{ $data->seller_info->name }} </td>
                                        <td><span class="badge badge-{{ $data->status == 'active' ? 'success' : 'danger' }}">{{ $data->status }}</span></td>
                                        <td><img style="height:100px;width:100px;" src="{{ imageUrl($data->image,'product') }}" alt=""></td>
                                        <td><a href="{{ route('product.edit',$data->id) }}" class="btn btn-success btn-circle"> <i class="fa fa-edit"></i></a>
                                            {{ Form::open(['url'=> route('product.destroy',$data->id),'class' => 'form float-left']) }}
                                            @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>',['class'=>'btn btn-danger btn-circle','onsubmit' => 'return confirm("Are You Sure?")','type'=>'submit']) }}
                                            {{ Form::close() }}
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
    </div>

</div>
@endsection

