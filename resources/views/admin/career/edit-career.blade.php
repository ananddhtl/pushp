@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Career Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Career Page</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ url('/all-career') }}" style="display:true ;" id="returnBack" class="btn add-btn"><i
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
                        <form action="{{ route('career.update', $careers->id)}}"  method="POST" >
                            @csrf()
                            <div class="form-group">
                                <label>Tile:<span class="text-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter Carrer Title" value="{{$careers->name}}">
                            </div>
                            <div class="form-group">
                                <label for="parent page">Discription:</label>
                                <textarea id="editor" name="caption" class="form-control" placeholder="Write here Description">{!! $careers->caption !!}</textarea>
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
