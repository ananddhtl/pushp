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
                    <a href="{{ url('/all-achievement') }}" style="display: none;" id="returnBack" class="btn add-btn"><i
                            class="fa fa-arrow-left"></i>Return</a>
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
                        <form action="{{ route('achievement.update',$achievement->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Select Heading <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="select" name="header">
                                        <option value="">--Select-- </option>
                                        <option value="Dean List" {{$achievement->header=='Dean List' ? 'selected':'' }}>Dean List </option>
                                        <option value="Other Achievements" {{$achievement->header=='Other Achievement' ? 'selected':'' }}>Other Achievement</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Student Name<span class="text-danger">*</span></label>
                                <input class="form-control" name="student_name" placeholder="Enter  Student Name"  value="{{$achievement->student_name}}">
                            </div>
                            <div class="form-group">
                                <label>Exam Roll No<span class="text-danger">*</span></label>
                                <input class="form-control" name="exam_roll_no" placeholder="Enter Exam Roll No"  value="{{$achievement->exam_roll_no}}">
                            </div>
                            <div class="form-group">
                                <label>Faculty<span class="text-danger">*</span></label>
                                <input class="form-control" name="faculty" placeholder="Enter Faculty"  value="{{$achievement->faculty}}" >
                            </div>
                            <div class="form-group">
                                <label>Level<span class="text-danger">*</span></label>
                                <input class="form-control" name="level" placeholder="Enter Level"  value="{{$achievement->level}}" >
                            </div>
                            <div class="form-group">
                                <label>Year OF Completion<span class="text-danger">*</span></label>
                                <input class="form-control" name="year_of_completion" placeholder="Enter Year Of Completion"  value="{{$achievement->year_of_completion}}">
                            </div>
                            <div class="form-group">
                                <label>CGPA<span class="text-danger">*</span></label>
                                <input class="form-control" name="CGPA" placeholder="Enter CGPA"  value="{{$achievement->CGPA}}">
                            </div>
                            <div class="form-group">
                                <label>Semester<span class="text-danger">*</span></label>
                                <input class="form-control" name="semester" placeholder="Enter Semester"  value="{{$achievement->semester}}" >
                            </div>
                            <div class="form-group">
                                <label>Year<span class="text-danger">*</span></label>
                                <input type="datetime" class="form-control" name="year" placeholder="Enter Year"  value="{{$achievement->year}}" >
                            </div>
                            <div class="form-group">
                                <label>Achievement<span class="text-danger">*</span></label>
                                <input class="form-control" name="Achievement" placeholder="Enter Achievement"  value="{{$achievement->Achievement}}">
                            </div>
                            <div class="form-group">
                                <label>Genere<span class="text-danger">*</span></label>
                                <input class="form-control" name="genere" placeholder="Enter Genere"  value="{{$achievement->Achievement}}">
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <img src="/uploads/achievement/{{$achievement->image}}" height="100px">
                                <input type="file" class="form-control" name="image" placeholder="image" 
                                    onchange="previewFile(this)">
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
