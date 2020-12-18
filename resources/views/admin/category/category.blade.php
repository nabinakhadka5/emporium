@extends('layouts.admin')
@section('title','Category Manage')

@section('scripts')
    <script>
        $('#is_parent').change(function(){
            let is_checked = $(this).prop('checked');
            if(is_checked){
                $('#parent_div').addClass('d-none');

            } else {
                $('#parent_div').removeClass('d-none');
            }
        });
    </script>


@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">{{ isset($data) ? 'Add'  : 'Update' }} Categories</div>
            </div>
            <div class="ibox-body">
                @if(isset($data))
                {{ Form::open(['url'=>route('category.update',$data->id),'class'=>'form','files'=>'false']) }}
                @csrf
                @method('PUT')
                @else
                {{ Form::open(['url'=>route('category.store'),'class'=>'form','files'=>'false']) }}
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
                     {{ Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm','id'=>'summary','required'=>'false','placeholder'=>'Enter Summary Here']) }}
                    </div>
                    @error('summary')
                    <span class="alert-danger">{{$message}}  </span>
                    @enderror
                </div>


                <div class="form-group row">
                    {{ Form::label('image','image:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-4">
                        {{ Form::file('image',['id'=>'image','accept'=>'image/*']) }}
                    </div>
                    <div class="col-sm-4">
                        @if(isset($data))
                        <img style="width:150px;height:150px;" src="{{ imageUrl(@$data->image,'category') }}" alt="">
                        @endif
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


                        <div class="form-group row d-none" id="parent_div">
                            {{ Form::label('parent_id','Parent Category',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::select('parent_id',$parent_cats,@$data->parent_id,['class'=>'form-control form-control-sm','id'=>'parent_id','required'=>false,'placeholder'=>'--Select Any One--'])}}

                            </div>
                        </div>



                <div class="form-group row">
                    {{ Form::label('status','Status',['class'=>'col-sm-3'])}}
                    <div class="col-sm-9">
                        {{Form::select('status',['active'=> 'Published','inactive'=>'Unpublished'],@$data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true])}}
                        @error('status')
                        <span class="alert-danger">{{$message}}  </span>
                        @enderror
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

