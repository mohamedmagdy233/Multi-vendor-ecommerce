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
                @if($errors->any())
                    <div class="alert alert-danger">

                    <h3 class="text-center">Error Occurred</h3>

                        @foreach($errors->all() as $error)
                            <li class="text-center" >{{ $error }}</li>
                        @endforeach
                    </div>

                @endif



                <div class="card card-cyan">
                    <div class="card-header" style="background-color: #343a40;">
                        <h3 class="card-title" >Create Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data"   >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" id="exampleInputEmail1" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">description</label>
                                <textarea class="form-control" name="description" id="exampleInputPassword1" placeholder=" Enter description">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">category parent</label>
                                <select name="parent_id" class="form-control from-select">

                                    <option value="">primary category</option>
                                    @forelse($parents as $parent)


                                        <option value="{{$parent->id}}">{{old('parent_id')??$parent->name}}</option>

                                    @empty
                                        <option> No categories available</option>


                                    @endforelse
                                </select>


                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" value="{{old('image')}}"  name="image" class="custom-file-input" id="exampleInputFile" accept="image/*">
                                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                                    </div>

                                </div>


                                <div class="form-group">

                                    <label >status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="active"   checked>
                                        <label class="form-check-label">
                                            active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"   type="radio" name="status" value="archived"  checked>
                                        <label class="form-check-label" >
                                            archived
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>

@include('Dashboard.layouts.js')
</body>
</html>
