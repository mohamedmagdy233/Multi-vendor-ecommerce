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


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <a  href="{{route('categories.create')}}" class="btn btn-info text-bold mr-2">Create Category</a>


                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>store</th>
                            <th>status</th>
                            <th>created_at</th>
                        </tr>
                        </thead>


                        <?php
                        $products=$category->products()->with('store')->paginate(5)

                        ?>
                        <?php
                        $i=0;
                        $i++;
                        ?>


                        @forelse($products as $product)
                            <tbody>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->store->name}}</td>
                                <td>{{ $product->status}}</td>
                                <td>{{$product->created_at}}</td>


                            </tr>

                            </tbody>

                        @empty
                        @endforelse

                    </table>
                    {{$products->links()}}

                </div>

            </div>
        </div>

    </div>


@include('Dashboard.layouts.js')
</body>
</html>
