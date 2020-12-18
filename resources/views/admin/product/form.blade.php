@extends('layouts.admin')
@section('title','product Manage')
@section('styles')
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
@endsection
@section('scripts')
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<script>
        $('#description').summernote();

        $('#cat_id').change(function(){
            let cat_id = $(this).val();

            if(cat_id){
                let edit_select_cat = "{{ isset($data,$data->sub_cat_id) ? $data->sub_cat_id : null }}";
                console.log(edit_select_cat);
                $.ajax({
                    url : "{{  route('get-child') }}",
                    type : "post",
                    data : {
                        _token : "{{ csrf_token() }}",
                        cat_id : cat_id
                    },
                    success: function(response){
                        if(typeof(response) != "object"){
                            response = JSON.parse(response);
                        }
                        var html_option = '<option value="" selected> --Select Any One -- </option>';
                        if(response.status){
                            $.each(response.data, function(key , value){
                                html_option += "<option value ='"+key+"' ";
                                if(edit_select_cat == key){
                                    html_option += "selected";
                                }
                                html_option += ">"+value+"</option>";
                            });
                            $('#sub_cat_div').removeClass('d-none');
                        } else {
                            $('#sub_cat_div').addClass('d-none');
                        }
                            $('#sub_cat_id').html(html_option);
                    }
                });
            }
        });

        $('#cat_id').change();
</script>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">{{ isset($data) ? 'Update'  : 'Add' }} Categories</div>
            </div>
            <div class="ibox-body">
                @if(isset($data))
                    {{ Form::open(['url'=>route('product.update',$data->id),'class'=>'form','files'=>'true']) }}
                        @csrf
                        @method('PUT')
                    @else
                    {{ Form::open(['url'=>route('product.store'),'class'=>'form','files'=>'false']) }}
                @endif
                <div class="form-group row">
                    {{ Form::label('title','Title:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('title',@$data->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'required'=>'false', 'placeholder'=>'Enter Your title here']) }}
                    @error('title')
                    <span class="alert-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('summary','Summary:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                     {{ Form::textarea('summary',@$data->summary,['rows'=>'4','class'=>'form-control form-control-sm','id'=>'summary','required'=>'false','placeholder'=>'Enter Summary Here']) }}
                    </div>
                    @error('summary')
                    <span class="alert-danger">{{$message}}  </span>
                    @enderror
                </div>

                <div class="form-group row">
                    {{ Form::label('description','description:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                     {{ Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm','id'=>'description','placeholder'=>'Enter description Here']) }}
                    </div>
                    @error('description')
                    <span class="alert-danger">{{$message}}  </span>
                    @enderror
                </div>

                <div class="form-group row" id="parent_div">
                    {{ Form::label('cat_id','Category',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                           {{Form::select('cat_id',$category,@$data->cat_id,['class'=>'form-control form-control-sm','id'=>'cat_id','required'=>true,'placeholder'=>'--Select Any One--'])}}
                           @error('cat_id')
                           <span class="alert-danger">{{$message}}  </span>
                           @enderror
                        </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('is_parent','Is Parent',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                            {{Form::checkbox('is_parent',1,true,['id'=>'is_parent']) }} Yes
                            @error('parent_id')
                            <span class="alert-danger">{{$message}}  </span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row d-none" id="sub_cat_div">
                    {{ Form::label('sub_cat_id','Sub Category',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::select('sub_cat_id',[],@$data->sub_cat_id,['class'=>'form-control form-control-sm','id'=>'sub_cat_id','placeholder'=>'--Select Any One--'])}}
                            @error('sub_cat_id')
                            <span class="alert-danger">{{$message}}  </span>
                            @enderror
                        </div>
              </div>

              <div class="form-group row">
                {{ Form::label('price','Price (NPR):',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                    {{ Form::number('price',@$data->price,['class'=>'form-control form-control-sm', 'id'=>'price', 'required'=>'false', 'placeholder'=>'Enter Your price here','min'=>100]) }}
                @error('price')
                <span class="alert-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('discount','Discount (%):',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                    {{ Form::number('discount',@$data->discount,['class'=>'form-control form-control-sm', 'id'=>'discount', 'required'=>'false', 'placeholder'=>'Enter Your discount here','min'=>0, 'max' => 90]) }}
                @error('discount')
                <span class="alert-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('brand','Brand:',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                    {{ Form::text('brand',@$data->brand,['class'=>'form-control form-control-sm', 'id'=>'brand', 'required'=>'false', 'placeholder'=>'Enter Your brand here']) }}
                @error('brand')
                <span class="alert-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('is_featured','Is Featured',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                        {{Form::checkbox('is_featured',1,true,['id'=>'is_featured']) }} Yes
                        @error('parent_id')
                        <span class="alert-danger">{{$message}}  </span>
                        @enderror
                </div>
            </div>

            <div class="form-group row" id="parent_div">
                {{ Form::label('seller_id','Seller',['class'=>'col-sm-3'])}}
                    <div class="col-sm-9">
                       {{Form::select('seller_id',$seller_list,@$data->seller_id,['class'=>'form-control form-control-sm','id'=>'seller_id','required'=>true,'placeholder'=>'--Select Any One--'])}}
                       @error('seller_id')
                       <span class="alert-danger">{{$message}}  </span>
                       @enderror
                    </div>
            </div>

            <div class="form-group row">
                {{ Form::label('status','Status',['class'=>'col-sm-3'])}}
                <div class="col-sm-9">
                    {{Form::select('status',['active'=> 'Published','inactive'=>'Unpublished','out_of_stock' => 'Out Of Stock'],@$data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true])}}
                    @error('status')
                    <span class="alert-danger">{{$message}}  </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('image','image:',['class'=>'col-sm-3']) }}
                <div class="col-sm-4">
                    {{ Form::file('image',['id'=>'image','accept'=>'image/*']) }}
                </div>
                <div class="col-sm-4">
                    @if(isset($data))
                    <img style="width:150px;height:150px;" src="{{ imageUrl(@$data->image,'product') }}" alt="">
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('related_images','Other Images:',['class'=>'col-sm-3']) }}
                <div class="col-sm-4">
                    {{ Form::file('related_images[]',['accept'=>'image/*','multiple'=>true]) }}
                    @error('image')
                    <span class="alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    @if(isset($data))
                        @foreach($data->images as $product_image)
                            <div class="col-md-2">
                                <img style="width:150px;height:150px;" src="{{ asset('uploads/product/Thumb-'.$product_image->image_name) }}" alt="" class = "img img-thumbnail img-fluid">
                            {{ Form::checkbox('del_image[]',$product_image->image_name,false) }} Delete
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

                <div class="form-group row">
                    {{ Form::label('','',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::button('<i class="fa fa-trash"></i>Reset',['class'=>'btn btn-danger btn-sm','id'=>'reset','type'=>'reset']) }}
                        {{ Form::button('<i class="fa fa-paper-plane"></i>Submit',['class'=>'btn btn-success btn-sm','id'=>'submit','type'=>'submit']) }}

                    </div>
                </div>


                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>
@endsection

