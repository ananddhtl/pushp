@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Achievement Page</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Achievement Page</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i class="fa fa-plus"></i>Add Content</a>
                <a href="{{ url('/all-achievement') }}" style="display: none;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
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
                            <th scope="col">Student Name</th>
                            <th scope="col">Faculty</th>
                            <th scope="col">Level</th>
                            <th scope="col">CGPA</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($achievements as $key => $achievement)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> {{ $achievement->student_name}} </td>
                            <td> {{ $achievement->faculty}} </td>
                            <td> {{ $achievement->level}} </td>
                            <td> {{ $achievement->CGPA}} </td>
                            <td> <img src="uploads/achievement/{{ $achievement->image }} " width="100px"> </td>
                            <td class="text-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/edit-achievement/{{ $achievement->id}}">
                                            <i class="fa fa-pencil m-r-5">
                                            </i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#deleteAchievement" data-toggle="modal" onclick="deleteItem({{$achievement->id}})" data-target="deleteAchievement"><i class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex" style="float: right">
                    {!! $achievements->links() !!}
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
                    <form action="{{ route('store.achievement') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Select Heading <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="select" name="header">
                                    <option value="">--Select-- </option>
                                    <option value="Dean List">Dean List </option>
                                    <option value="Other Achievements">Other Achievement</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Student Name<span class="text-danger">*</span></label>
                            <input class="form-control" name="student_name" placeholder="Enter  Student Name">
                        </div>
                        <div class="form-group">
                            <label>Exam Roll No<span class="text-danger">*</span></label>
                            <input class="form-control" name="exam_roll_no" placeholder="Enter Exam Roll No">
                        </div>
                        <div class="form-group">
                            <label>Faculty<span class="text-danger">*</span></label>
                            <input class="form-control" name="faculty" placeholder="Enter Faculty">
                        </div>
                        <div class="form-group">
                            <label>Level<span class="text-danger">*</span></label>
                            <input class="form-control" name="level" placeholder="Enter Level">
                        </div>
                        <div class="form-group">
                            <label>Year OF Completion<span class="text-danger">*</span></label>
                            <input class="form-control" name="year_of_completion" placeholder="Enter Year Of Completion">
                        </div>
                        <div class="form-group">
                            <label>CGPA<span class="text-danger">*</span></label>
                            <input class="form-control" name="CGPA" placeholder="Enter CGPA">
                        </div>
                        <div class="form-group">
                            <label>Semester<span class="text-danger">*</span></label>
                            <input class="form-control" name="semester" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label>Year<span class="text-danger">*</span></label>
                            <input class="form-control" name="year" placeholder="Enter Year">
                        </div>
                        <div class="form-group">
                            <label>Achievement<span class="text-danger">*</span></label>
                            <input class="form-control" name="Achievement" placeholder="Enter Achievement">
                        </div>
                        <div class="form-group">
                            <label>Genere<span class="text-danger">*</span></label>
                            <input class="form-control" name="genere" placeholder="Enter Genere">
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
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
</div>
{{-- delete publication start --}}
<div class="modal custom-modal fade" id="delete_resignation" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Achievement</h3>
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



<script>
    function deleteItem(id) {
        document.getElementById("deleteId").href = "delete-achievement/" + id;
        $("#delete_resignation").modal();
    }
</script>



@endsection