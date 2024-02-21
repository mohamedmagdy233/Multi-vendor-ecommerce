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


                @if(session()->has('success'))

                    <div  class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

                    @if(session()->has('info'))

                    <div  class="alert alert-info">
                        {{session('info')}}
                    </div>
                    @endif
                    @if(session()->has('danger'))

                    <div  class="alert alert-danger">
                        {{session('danger')}}
                    </div>
                    @endif




                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
{{--                        <button id="goToCreateCategory" class="btn btn-primary">Create Category</button>--}}

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
{{--                                <a href="{{route('categories.edit',[$category->id])}}" class="btn-btn-primary">Edit</a>|--}}
                                <a href="{{route('categories.edit',[$category->id])}}" class="btn btn-primary" style="    padding: 11px 22px 0 22px;">Edit</a><br><br>




                                <form   method="post" action="{{route('categories.destroy',[$category->id])}}">
                                    @csrf
                                    @method('DELETE')


                                    <button type="submit" class="btn btn-danger">Danger</button>



                                </form>

                            </td>

                        </tr>

                        </tbody>

                        @empty
                        @endforelse

                    </table>
                </div>

            </div>
        </div>

    </div>

@include('Dashboard.layouts.js')
</body>
</html>
