@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Team Member</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Team Member</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i
                            class="fa fa-plus"></i>Add Team Member</a>
                    <a href="/all-team" style="display: none;" id="returnBack" class="btn add-btn"><i
                            class="fa fa-arrow-left"></i>Return</a>
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
                                <th scope="col">Member Name </th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $teams as $key=>$team )
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $team->name }} </td>
                                    <td> <img src="uploads/teamimg/{{$team->image }} " width="100px"> </td> 
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/edit-team/{{$team->id}}">
                                                    <i class="fa fa-pencil m-r-5">
                                                    </i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#deleteParentpage" data-toggle="modal"
                                                    onclick="deleteItem({{ $team->id }})"
                                                    data-target="deleteParentpage"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex" style="float: right" >
                        {!!  $teams->links() !!}
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

                        <form action="{{ route('team.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name"
                                    placeholder="Enter Image Title/Heading" required>
                            </div>
                            <div class="form-group">
                                <label>Designation<span class="text-danger">*</span></label>
                                <input class="form-control" name="designation"
                                    placeholder="Enter Your Desigantion" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="image">Choose Photo:</label>
                                <input type="file" class="form-control"name="image" placeholder="image"
                                    onchange="previewFile(this)">
                                <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link <span class="text-danger">*</span></label>
                                <input class="form-control"  name="facebook" placeholder="Enter Facebook Link" >
                            </div>
                            <div class="form-group">
                                <label>Twitter Link <span class="text-danger">*</span></label>
                                <input class="form-control" name="twitter" placeholder="Enter Twitter link" >
                            </div>
                            <div class="form-group">
                                <label>Gmail Link<span class="text-danger">*</span></label>
                                <input class="form-control" name="gmail" placeholder="Enter Gmail Link" >
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




    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr("src", reader.result);

                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
