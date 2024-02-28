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
                        <a  href="{{route('categories.create')}}" class="btn btn-info text-bold">Create Category</a><br><br>
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
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parent_id}}</td>
                                <td>{{$category->description}}</td>

                                <td><img width="50" height="50" src="{{asset('storage/images/'.$category->image)}}" alt=""></td>
                                <td>{{$category->status}}</td>
                                <td >

                                    <form   method="post" action="{{route('categories.restore',[$category->id])}}">
                                        @csrf
                                        @method('POST')


                                        <button type="submit" class="btn btn-danger">restore</button>



                                    </form>

                                    <form   method="post" action="{{route('categories.force-delete',[$category->id])}}">
                                        @csrf
                                        @method('DELETE')


                                        <button type="submit" class="btn btn-danger">Force Delete</button>



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
