@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Post Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Post Page</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ url('/posts') }}" style="display: true;" id="returnBack" class="btn add-btn"><i
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

                        <form action="{{ route('blog.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">	
                            <input type="hidden" name="old_image" value="{{ $post->image }}">
                            <div class="form-group">
                                <label>Select Heading <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="select" name="header">
                                        <option value="exam"{{ $post->header=='exam' ? 'selected':'' }}>Exam (Notice)</option>
                                        <option value="general"{{$post->header=='general' ? 'selected':'' }}>General (Notice)</option>
                                        <option value="blog"{{$post->header=='blog' ? 'selected':'' }}>Recent Events & Activities</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tile:<span class="text-danger">*</span></label>
                                <input class="form-control" name="title" placeholder="Enter Post Title" required value="{{ $post->title }}">
                            </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image:</label>
                                <img src="/uploads/Postimg/{{$post->image}}" height="100px">
                                <input type="file" class="form-control" name="image" placeholder="image" 
                                    onchange="previewFile(this)">
                                <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                            </div>
                            <div class="form-group">
                                <label for="parent page">Description:</label>
                                <textarea id="editor" name="description" class="form-control" placeholder="Write here Description">{!! $post->description !!}</textarea>
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

    {{-- delete start modal --}}
    <div class="modal custom-modal fade" id="delete_resignation" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Post Page</h3>
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
    {{-- delete end modal --}}

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
