@extends('layouts.admin')
@section('title','Slider Manage')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Slider {{ isset($data) ? 'Update' : 'Add' }}</div>
            </div>
            <div class="ibox-body">
                {{ Form::open(['url'=>route('slider.update',$data->id),'class'=>'form','files'=>'true']) }}
                @csrf
                @method('PUT')

                <div class="form-group row">
                    {{ Form::label('title','Title',['class' => 'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('title','',['class' => 'form-control form-control-sm', 'id'=>'title', 'required'=> false , 'placeholder'=>'Enter a title',]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('link','Link',['class' => 'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::url('link','',['class' => 'form-control form-control-sm','id' => 'link', 'placeholder' => 'enter a valid url']) }}
                    </div>
                </div>


                <div class="form-group row">
                    {{ Form::label('image','image',['class' => 'col-sm-3']) }}
                    <div class="col-sm-4">
                        {{ Form::file('image',['class' => 'form-control form-control-sm','id' => 'image']) }}
                    </div>
                    <div class="col-sm-4">
                        @if(isset($data))
                            <img style="width:150px;height:15 0px;" src="{{ imageUrl(@$data->image,'slider') }}" alt="">
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    {{ Form::label('status','Status',['class' => 'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::select('status',['active'=>'Published','inactive'=>'Un-Published'],'',['class' => 'form-control form-control-sm','id'=>'status']) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{Form::label('','',['class'=>'col-sm-3'])}}
                    <div class="col-sm-9">
                    {{ Form::button('<i class = "fa fa-paper-plane"></i>Submit',['class' => 'class="btn btn-success','type'=>'submit']) }}
                    {{ Form::button('<i class = "fa fa-trash"></i>Cancel',['class' => 'class="btn btn-danger','type'=>'reset']) }}
                    </div>
                </div>





                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>
@endsection

