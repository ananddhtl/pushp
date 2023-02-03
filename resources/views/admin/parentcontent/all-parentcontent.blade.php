@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Menu Content Page</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu Content Page</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i class="fa fa-plus"></i>Add Content</a>
                <a href="{{ url('/all-parentcontent') }}" style="display: none;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row" id="displayParentContent" style="display: block;">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Menu Pages</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parentcontents as $key => $parentcontent)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> {{ $parentcontent->parentpage->title }} </td>
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/edit-parentcontent/{{ $parentcontent->id}}">
                                            <i class="fa fa-pencil m-r-5">
                                            </i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#deleteParencontentpage" data-toggle="modal" onclick="deleteItem({{$parentcontent->id}})" data-target="deleteParencontentpage"><i class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex" style="float: right">
                    {!! $parentcontents->links() !!}
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

                    <form action="{{ route('parentcontent.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <label for="ParentPages">Menu Page</label>

                            <select name="parentpage_id" class="form-control" id="parentpage_id">
                                @foreach ($parentpages as $parentpage)
                                <option value="{{ $parentpage->id }}">{{ $parentpage->title }} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Thumbnail Image:</label>

                            <input type="file" class="form-control" name="thumbnailimg" placeholder="image" onchange="previewFile(this)">
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>

                        </div>
                        <div class="form-group">


                            <label for="parent page">Discription:</label>


                            <textarea id="editor" name="text" class="form-control" placeholder="Write here Description"></textarea>

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


<div class="modal custom-modal fade" id="delete_resignation" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Menu Content</h3>
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

@endsection
<script>
    function deleteItem(id) {
        document.getElementById("deleteId").href = "delete-parenentcontent/" + id;
        $("#delete_resignation").modal();
    }
</script>

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
        document.getElementById("deleteId").href = "delete-parenentcontent/" + id;
        $("#delete_resignation").modal();
    }
</script>