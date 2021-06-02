@extends('layouts.admin_layouts')

@section('title', 'Edit')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Member editing:
                        {{ $member['firstName'] . ' ' . $member['lastName'] }}
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @elseif($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('update', $member['id']) }}" method="POST" enctype="multipart/form-data"
                            novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" value="{{ $member['firstName'] }}" name="firstName"
                                        class="form-control" id="firstName" placeholder="Enter first name">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" value="{{ $member['lastName'] }}" name="lastName"
                                        class="form-control" id="lastName" placeholder="Enter last name">
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Birthdate</label>
                                    <input type="date" value="{{ $member['birthdate'] }}" name="birthdate"
                                        class="form-control" id="birthdate" placeholder="Enter birthdate">
                                </div>
                                <div class="form-group">
                                    <label for="reportSubject">Report Subject</label>
                                    <input type="text" value="{{ $member['reportSubject'] }}" name="reportSubject"
                                        class="form-control" id="reportSubject" placeholder="Enter report subject">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="countryId" class="form-control" id="country">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['id'] }}" @if ($country['id'] == $member['countryId']) selected @endif>{{ $country['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" value="{{ $member['phone'] }}" name="phone" class="form-control"
                                        id="phone" placeholder="Enter phone">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ $member['email'] }}" name="email" class="form-control"
                                        id="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Company</label>
                                    <input type="text" value="{{ $member['company'] }}" name="company"
                                        class="form-control" id="exampleInputEmail1" placeholder="Enter first name">
                                </div>
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text" value="{{ $member['position'] }}" name="position"
                                        class="form-control" id="position" placeholder="Enter last name">
                                </div>
                                <div class="form-group">
                                    <label for="aboutMe">About Me</label>
                                    <textarea id="aboutMe" class="form-control" rows="3" placeholder="Enter ..."
                                        name="aboutMe">{{ $member['aboutMe'] }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" name="photo" class="form-control" id="photo">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-center mt-4">
                                        <a class="btn btn-danger btn-lg btn-block" href="{{ route('deletePhoto', $member['id']) }}" role="button">
                                            <i class="fas fa-dumpster"></i>
                                            Delete photo
                                        </a>
                                    </div>
                                </div>


                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
