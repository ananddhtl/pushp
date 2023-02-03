@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Image Gallery</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Image Gallery</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i
                            class="fa fa-plus"></i>Add Image </a>
                    <a href="{{ route('all.gallery') }}" style="display: none;" id="returnBack" class="btn add-btn"><i
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
                                <th scope="col">Image Category</th>
                                <th scope="col">Image Capation</th>
                                <th scope="col">Images</th>
                                <th scope="col">Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleryImage  as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>{{ $gallery->category}}</td>
                                    <td>  {{ $gallery-> name }} </td>
                                    <td> <img src="{{$gallery->image}}" width="100px"> </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/edit-gallery/{{ $gallery->id}}">
                                                    <i class="fa fa-pencil m-r-5">
                                                    </i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#deleteParentpage" data-toggle="modal"
                                                    onclick="deleteItem({{ $gallery->id }})"
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
                        {!! $galleryImage->links() !!}
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
                        <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Select Image Category <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="category">
                                        <option disabled>--Select--</option>
                                        <option value="Sports">Sports</option>
                                        <option value="ECA">ECA</option>
                                        <option value="Farewell or Welcome">Farewell or Welcome</option>
                                        <option value="Graduations">Graduations</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group">
                                <label>Image Heading: <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter Image Title/Heading" required>
                            </div>
                            <div class="form-group">
                                <label for="parent page">Caption::</label>
                               <textarea id="editor"  class="form-control" name="caption" placeholder="Enter Caption"></textarea>
                               </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image:</label>
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
