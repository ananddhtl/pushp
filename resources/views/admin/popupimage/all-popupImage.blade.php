@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">PopUp Image</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">PopUp Image</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i
                            class="fa fa-plus"></i>Add PopUp Image</a>
                    <a href="/all-PopUpImage" style="display: none;" id="returnBack" class="btn add-btn"><i
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
                                <th scope="col">Images</th>
                                <th scope="col">Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($popupimages as $key => $image)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> <img src="{{$image->image}}" width="100px"> </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#deletePopUpImage" data-toggle="modal"
                                                    onclick="deleteItem({{ $image->id }})"
                                                    data-target="deletePopUpImage"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex" style="float: right" >
                        {!!  $popupimages->links() !!}
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

                        <form action="{{route('sliderimage.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">PopUp Image:</label>
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

     {{-- delete slider --}} 
         {{--delete --}}
    <div class="modal custom-modal fade" id="delete_resignation" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Popup Image</h3>
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

    {{-- end delete --}}

     {{-- end slider --}}

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
           document.getElementById("deleteId").href = "delete-PopUpImage/" + id;
           $("#delete_resignation").modal();
       }
   </script>


<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
    image.src = url;
    $modal.modal('show');
    };
    var reader;
    var file;
    var url;
    if (files && files.length > 0) {
    file = files[0];
    if (URL) {
    done(URL.createObjectURL(file));
    } else if (FileReader) {
    reader = new FileReader();
    reader.onload = function (e) {
    done(reader.result);
    };
    reader.readAsDataURL(file);
    }
    }
    });
    $modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
    aspectRatio: 1,
    viewMode: 3,
    preview: '.preview'
    });
    }).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
    });
    $("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
    width: 160,
    height: 160,
    });
    canvas.toBlob(function(blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob); 
    reader.onloadend = function() {
    var base64data = reader.result; 
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "crop-image-upload",
    data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
    success: function(data){
    console.log(data);
    $modal.modal('hide');
    alert("Crop image successfully uploaded");
    }
    });
    }
    });
    })
    </script>
@endsection
