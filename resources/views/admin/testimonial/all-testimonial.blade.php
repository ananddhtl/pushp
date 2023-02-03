@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Testimonial</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Testimonial</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i class="fa fa-plus"></i>Add Testimonial</a>
                <a href="{{ route('all.testimonial') }}" style="display: none;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row" id="displayParentContent" style="display: block;">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Images</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $key=>$testimonial)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> {{ $testimonial->name }} </td>
                            <td> {!! substr($testimonial->description,0, 100)!!} </td>
                            <td> <img src="uploads/testimonial/{{$testimonial->image }} " width="100px"> </td>
                            <td class="text-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/edit-testimonial/{{$testimonial->id}}">
                                            <i class="fa fa-pencil m-r-5">
                                            </i> Edit
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex" style="float: right">
                    {!! $testimonials->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addParentContent" style="display: none;">
    <div class="content container-fluid">
        <div class="card" style="width: 100%;">
            <div class="card-body">

                <div class="form-group">

                    <form action="{{ route('testimonial.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Full Name:<span class="text-danger">*</span></label>
                            <input class="form-control" name="name" placeholder="Enter Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="parent page">Note:</label>
                            <textarea id="editor" name="description" class="form-control" placeholder="Enter Note"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Designation:<span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" placeholder="Enter Designation" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Choose Photo:</label>
                            <input type="file" class="form-control" name="image" placeholder="image" onchange="previewFile(this)">
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn add-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </form>
</div>

<script>
    function showHide() {

        //   var x = document.getElementById("displayParentContent");
        if (document.getElementById("displayParentContent").style.display == "block") {

            document.getElementById("displayParentContent").style.display = "none";
            document.getElementById("addParentContent").style.display = "block";
            document.getElementById("addContent").style.display = "none";
            document.getElementById("returnBack").style.display = "block";
        }
    }
</script>



@endsection