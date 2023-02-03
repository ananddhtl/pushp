@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Team Member</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Team Member</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" onclick="showHide();" id="addContent" style="display: true;" class="btn add-btn"><i
                            class="fa fa-plus"></i>Add Team Member</a>
                    <a href="/Sliderimage" style="display: none;" id="returnBack" class="btn add-btn"><i
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
                        <form action="{{ route('team.update',$team->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter Image Title/Heading" required value="{{ $team->name }}">
                            </div>
                            <div class="form-group">
                                <label>Desigantion <span class="text-danger">*</span></label>
                                <input class="form-control" name="designation" placeholder="Enter Your Desigantion" required value="{{ $team->designation}}">
                            </div>
                            <div class="form-group">
                                <label for="image">Choose Photo:</label>
                                <img src="/uploads/teamimg/{{$team->image}}" height="100px">
                                <input type="file" class="form-control"name="image" placeholder="image"
                                    onchange="previewFile(this)">
                                <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link <span class="text-danger">*</span></label>
                                <input class="form-control"  name="facebook" placeholder="Enter Facebook Link"  value="{{ $team->facebook }}">
                            </div>
                            <div class="form-group">
                                <label>Twitter Link <span class="text-danger">*</span></label>
                                <input class="form-control" name="twitter" placeholder="Enter Twitter link"  value="{{ $team->twitter}}">
                            </div>
                            <div class="form-group">
                                <label>Gmail Link<span class="text-danger">*</span></label>
                                <input class="form-control" name="gmail" placeholder="Enter Gmail Link"  value="{{ $team->gmail}}">
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