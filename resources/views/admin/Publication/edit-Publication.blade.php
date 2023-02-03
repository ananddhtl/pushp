@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Publication Page</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Publication Page</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="{{ url('/all-publication') }}" style="display: true;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
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
                    <form action="{{ route('publication.update',$publication->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Select Heading <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="select" name="header">
                                    <option value="brochure" {{$publication->header=='brochure' ? 'selected':'' }}>Brochure </option>
                                    <option value="calender" {{$publication->header=='calender' ? 'selected':'' }}>Calender</option>
                                    <option value="journal" {{$publication->header=='journal' ? 'selected':'' }}>Journal</option>
                                    <option value="thesis" {{$publication->header=='thesis' ? 'selected':'' }}>Thesis</option>
                                    <option value="BE Civil Project" {{$publication->header=='BE Civil Project' ? 'selected':'' }}>BE Civil Project</option>
                                    <option value="BE Computer Project" {{$publication->header=='BE Computer Project' ? 'selected':'' }}>BE Computer Project</option>
                                    <option value="BE Arch Project" {{$publication->header=='BE Arch Project' ? 'selected':'' }}>BE Arch Project</option>
                                    <option value="DE Civil Project" {{$publication->header=='DE Civil Project' ? 'selected':'' }}>DE Civil Project</option>
                                    <option value="DE Computer Project" {{$publication->header=='DE Computer Project' ? 'selected':'' }}>DE Computer Project</option>
                                    <option value="Dean List" {{$publication->header=='Dean List' ? 'selected':'' }}>Dean List</option>
                                    <option value="Other Achievement" {{$publication->header=='Other Achievement' ? 'selected':'' }}>Other Achievement</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tile:<span class="text-danger">*</span></label>
                            <input class="form-control" name="title" placeholder="Enter Post Title" required value="{{$publication->title}}">
                        </div>
                        <div class="form-group">
                            <label for="image">Thumbnail Image:</label>
                            <img src="/uploads/achievement{{$publication->image}}" height="100px">
                            <input type="file" class="form-control" name="image" placeholder="image" onchange="previewFile(this)">
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                        </div>
                        <div class="form-group">
                            <label for="parent page">Discription:</label>
                            <textarea id="editor" name="text" class="form-control" placeholder="Write here Description">{!! $publication->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn add-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- delete publication start --}}
<div class="modal custom-modal fade" id="delete_resignation" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete slider image</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="" id="deleteId" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- delete publication end --}}

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