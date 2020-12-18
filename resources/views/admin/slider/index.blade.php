@extends('layouts.admin')
@section('title','Slider Manage')
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
                                    <div class="ibox-title">List Sliders</div>
                            </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="btn btn-success float-right">
                                <div class="ibox-head">
                                    <a href="{{ route('slider.create') }}">Add Slider</a>
                            </div>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($data_list as $data)
                                    <tr>
                                        <td>{{ $data->title }}</td>
                                        <td> <a href="{{ $data->link }}" target="_slider">{{ $data->link }}</a></td>
                                        <td>
                                            <span class="badge badge-{{ $data->status == 'active' ? 'success' : 'danger'}}">{{ $data->status  == 'active' ? 'Published' : 'Un-Published' }}</span>
                                            </td>
                                        <td><img style="max-width:150px;" src="{{ imageUrl($data->image,'slider') }}" alt=""></td>
                                        <td><a href="{{ route('slider.edit',$data->id) }}" class="btn btn-success btn-circle"> <i class="fa fa-edit"></i></a></td>
                                        <td>
                                            {{ Form::open(['url'=> route('slider.destroy',$data->id),'class' => 'form float-left']) }}
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

