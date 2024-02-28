<!DOCTYPE html>
<html lang="en">
@include('Dashboard.layouts.head')

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">


<div class="wrapper">

    @include('Dashboard.layouts.loader')



    @include('Dashboard.layouts.navbar')

    @include('Dashboard.layouts.slider')





    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">


                <x-alert />





                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <a  href="{{route('categories.create')}}" class="btn btn-info text-bold mr-2">Create Category</a>
                        <a  href="{{route('categories.trashed')}}" class="btn btn-info text-bold">Trashed Category</a>
                        <br><br>
                        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                            <x-input name="name" placeholder="Name" class="mx-2" type="text" :value="request('name')" /><br>
                            <select name="status" class="form-control mx-2">
                                <option value="">All</option>
                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                            </select>
                            <button class="btn btn-dark mx-2">Filter</button>
                        </form>

                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>slug</th>
                            <th>products_number</th>
                            <th>parent</th>
                            <th>description</th>
                            <th>image</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @forelse($categories as $category)
                        <tbody>
                        <tr>
                            <td>{{$i++}}</td>
                            <td><a href="{{route('categories.show',$category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->products_number}}</td>
                            <td>{{ $category->parent->name}}</td>
                            <td>{{$category->description}}</td>

                            <td><img width="50" height="50" src="{{asset('storage/images/'.$category->image)}}" alt=""></td>
                            <td>{{$category->status}}</td>


                            <td>
                            <a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('categories.destroy',[$category->id]) }}" method="post">
                                    @csrf
                                    <!-- Form Method Spoofing -->
                                    <input type="hidden" name="_method" value="delete">
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>

                        </tr>

                        </tbody>

                        @empty
                        @endforelse

                    </table>
                    {{$categories->links()}}

                </div>

            </div>
        </div>

    </div>


@include('Dashboard.layouts.js')
</body>
</html>
