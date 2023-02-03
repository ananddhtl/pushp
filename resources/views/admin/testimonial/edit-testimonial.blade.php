@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Testimonial</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Testimonial</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="{{ route('all.testimonial') }}" style="display: true;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
</div>

<div id="addParentContent" style="display: true;">
    <div class="content container-fluid">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="form-group">
                    <form action="{{ route('testimonial.update',$testimonial->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Full Name:<span class="text-danger">*</span></label>
                            <input class="form-control" name="name" placeholder="Enter Full Name" required value="{{ $testimonial->name }}">
                        </div>
                        <div class="form-group">
                            <label for="parent page">Note:</label>
                            <textarea id="editor" name="description" class="form-control" placeholder="Enter Note">{!! $testimonial->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Designation:<span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" placeholder="Enter Designation"  value="{{ $testimonial->designation }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Choose Photo:</label>
                            <img src="/uploads/testimonial/{{$testimonial->image}}" height="100px">
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