@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Image Gallery</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Image Gallery</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('all.gallery') }}" style="display: none;" id="returnBack" class="btn add-btn"><i
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
                        <form action="{{route('gallery.update', $Gallery->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $Gallery->id }}">	
                            <input type="hidden" name="old_image" value="{{ $Gallery->image }}">	
                            <div class="form-group">
                                <label>Select Image Category <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="category">
                                        <option disabled>--Select--</option>
                                        <option value="Sports" {{$Gallery->category=='Sports' ? 'selected':'' }}>Sports</option>
                                        <option value="ECA"{{$Gallery->category=='ECA' ? 'selected':'' }}>ECA</option>
                                        <option value="Farewell or Welcome"{{$Gallery->category=='Farewell or Welcome' ? 'selected':'' }}>Farewell/Welcome</option>
                                        <option value="Graduations"{{$Gallery->category=='Graduations' ? 'selected':'' }}>Graduations</option>
                                        <option value="Others"{{$Gallery->category=='Others' ? 'selected':'' }}>Others</option>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group">
                                <label>Image Heading: <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter Image Title/Heading" required value="{{$Gallery->name}}">
                            </div>
                            <div class="form-group">
                                <label for="parent page">Caption::</label>
                               <textarea id="editor"  class="form-control" name="caption" placeholder="Enter Caption">{!! $Gallery->caption !!}</textarea>
                               </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image:</label>
                                <img src="/uploads/gallery/{{$Gallery->image}}" height="100px">
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
                        <h3>Delete Image Gallery</h3>
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
    <script>
        function deleteItem(id) {
               document.getElementById("deleteId").href = "delete-gallery/" + id;
               $("#delete_resignation").modal();
           }
       </script>
@endsection
