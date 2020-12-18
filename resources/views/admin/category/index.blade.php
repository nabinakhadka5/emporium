@extends('layouts.admin')
@section('title','Category Manage')
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
                                    <div class="ibox-title">List Category</div>
                            </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn btn-success float-right">
                                    <a href="{{ route('category.create') }}" class="btn btn-success">Add category</a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
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
                                            @if (($data->child_info) -> count()>0)
                                            @foreach($data->child_info as $child_data)
                                            <li>
                                            <small> <a href="{{ route('category.edit',$child_data->id) }}"> {{ $child_data->title }} </a>
                                                <form action="{{ route('category.destroy',$child_data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-link"><i class="fa fa-trash" style='margin-top: -6px;'></i></button>
                                                 </form>

                                                </li>
                                                @endforeach

                                                @endif
                                        </td>
                                        <td><img style="height:100px;width:100px;" src="{{ imageUrl($data->image,'category') }}" alt=""></td>
                                        <td> <span class= "badge badge-{{ $data->status === 'active' ? 'success' : 'danger'}}">{{ $data->status }}</span></td>
                                        <td><a href="{{ route('category.edit',$data->id) }}" class="btn btn-success btn-circle"> <i class="fa fa-edit"></i></a>
                                            {{ Form::open(['url'=> route('category.destroy',$data->id),'class' => 'form float-left']) }}
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

