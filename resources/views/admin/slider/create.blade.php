@extends('layouts.admin')
@section('title','Slider Manage')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">{{ isset($data) ? 'Add'  : 'Update' }} Sliders</div>
            </div>
            <div class="ibox-body">
                @if(isset($data))
                {{ Form::open(['url'=>route('slider.update',$data->id),'class'=>'form','files'=>'false']) }}
                @csrf
                @method('PUT')
                @else
                {{ Form::open(['url'=>route('slider.store'),'class'=>'form','files'=>'false']) }}
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
                    {{ Form::label('link','Link:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                     {{ Form::url('link',@$data->link,['class'=>'form-control form-control-sm','id'=>'link','required'=>'false','placeholder'=>'Enter Link Here']) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('status','Status:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                     {{ Form::select('status',['active'=>'Published','inactive'=>'Un-Published'],@$data->status,['class' =>'form-control form-control-sm','id'=>'status','required'=>'false']) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('image','image:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-4">
                        {{ Form::file('image',['id'=>'image','accept'=>'image/*']) }}
                    </div>
                    <div class="col-sm-4">
                        @if(isset($data))
                            <img style="width:150px;height:15 0px;" src="{{ imageUrl(@$data->image,'slider') }}" alt="">
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

