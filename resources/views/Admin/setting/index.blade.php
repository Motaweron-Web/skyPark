@extends('Admin/layouts/master')
@section('title') Sky Park | Settings @endsection
@section('page_name') Settings @endsection
@section('content')
    @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                    <li><i class="fa fa-times-circle"></i> {{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.edit.setting')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Sky Park General Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                           placeholder="Enter A Phone Number" value="{{$setting->phone}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sky Park Team</label>
                                    <input type="text" class="form-control" name="Team_phone"
                                           placeholder="Enter A Phone Number" value="{{$setting->Team_phone}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Group Organization Phone</label>
                                    <input type="text" class="form-control" name="group_organization_phone"
                                           placeholder="Enter A Phone Number"
                                           value="{{$setting->group_organization_phone}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Information E-mail</label>
                                    <input type="text" class="form-control" name="info_email"
                                           placeholder="email@email.com" value="{{$setting->info_email}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sales E-mail</label>
                                    <input type="text" class="form-control" name="sales_email"
                                           placeholder="email@email.com" value="{{$setting->sales_email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Park Capacity</label>
                                    <input type="number" min="0" class="form-control" name="capacity"
                                           placeholder="Default Capacity Of The Park" value="{{$setting->capacity}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook"
                                           placeholder="https://www.facebook.com/your_id"
                                           value="{{$setting->facebook}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="instagram"
                                           placeholder="https://www.instagram.com/your_id"
                                           value="{{$setting->instagram}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="twitter"
                                           placeholder="https://www.twitter.com/your_id" value="{{$setting->twitter}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Snap Chat</label>
                                    <input type="text" class="form-control" name="snap"
                                           placeholder="https://www.snapchat.com/snap_id" value="{{$setting->snap}}">
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Address</label>
{{--                                    {{($errors->has('address')) ? 'is-invalid state-invalid' : ''}}--}}
                                    <input type="text" class="form-control" name="address"
                                           placeholder="Address Of The Park" value="{{$setting->address}}">
{{--                                    @if($errors->has('address'))--}}
{{--                                        <div class="invalid-feedback">{{$errors->first('address')}}</div>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Terms</label>
                                    <textarea class="form-control" name="terms" rows="7"
                                              placeholder="text here..">{{$setting->terms}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Main Information About SkyPark</label>
                                    <textarea class="form-control" name="about" rows="7"
                                              placeholder="text here..">{{$setting->about}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary">Updated</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





@endsection
