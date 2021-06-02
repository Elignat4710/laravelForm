@extends('layouts.admin_layouts')

@section('title', 'List members')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All members</h1>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                FirstName
                            </th>
                            <th>
                                LastName
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Photo
                            </th>
                            <th>
                                Country
                            </th>
                            <th>
                                Hide
                            </th>
                            <th>
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    {{ $profile['firstName'] }}
                                </td>
                                <td>
                                    {{ $profile['lastName'] }}
                                </td>
                                <td>
                                    {{ $profile['phone'] }}
                                </td>
                                <td>
                                    {{ $profile['email'] }}
                                </td>
                                <td>
                                    @if ($profile['photo'] == null)
                                        <img src="https://via.placeholder.com/100" class="avatar" alt="">
                                    @else
                                        <img src={{ asset('/storage/' . $profile['photo']) }} class="avatar">
                                    @endif
                                </td>
                                <td>
                                    {{ $profile['country']['name'] }}
                                </td>
                                <td class="project-actions">
                                    @if ($profile['hide'] == 0)
                                        <form action="{{ route('changeHideField', $profile['id']) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="far fa-window-close"></i>
                                                Hide
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('changeHideField', $profile['id']) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="far fa-eye"></i>
                                                Show
                                            </button>
                                        </form>

                                    @endif
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('edit', $profile['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                </td>
                                <td class="project-actions">
                                    <form action="{{ route('destroy', $profile['id']) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection
