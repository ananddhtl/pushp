@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Menu Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menu Page</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_parentpage"><i
                            class="fa fa-plus"></i> Add Page</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable" id="datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parentpages as $key => $parentpage)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $parentpage->title }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                    data-toggle="modal"onclick="slectDataFromTable({{ $parentpage->id }})">
                                                    <i class="fa fa-pencil m-r-5">
                                                        </i> Edit
                                                </a>
                                                <a class="dropdown-item"
                                                    href="#deleteParentpage"
                                                    data-toggle="modal"  onclick="deleteItem({{ $parentpage->id }})" data-target="deleteParentpage"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex" style="float: right" >
                        {!! $parentpages->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add PagePage Modal -->
    <div id="add_parentpage" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Parent Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addparentpage.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Page Title: <span class="text-danger">*</span></label>
                            <input class="form-control" name="title" value="" type="text">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Has Child <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="select" name="ischild">
                                    <option value="0">No child</option>
                                    <option value="1">Has childPage</option>
                                </select>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end add parent page --}}

    {{-- start parentpage modal --}}
    <!-- Modal -->
    <div id="edit_parentpage" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('parentpage.update') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Page Title: <span class="text-danger">*</span></label>
                            <input class="form-control" id="id" name="id" value="" type="hidden">
                            <input class="form-control" id="title" name="title" value="" type="text">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Has Child <span class="text-danger">*</span></label>

                            <select class="form-control" id="hasChild" name="ischild">
                                <option value="0">No child</option>
                                <option value="1">Has childPage</option>
                            </select>

                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function slectDataFromTable(id) {
            let axajUrl = "/edit-parentpage?id=" + id + "";
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    response = dataResult;
                    // console.log(dataResult);
                    let your_json = $.parseJSON(dataResult);
                    const size = Object.keys(your_json).length;
                    document.getElementById("title").value = your_json.title;
                    document.getElementById("hasChild").value = your_json.ischild;
                    document.getElementById("id").value = your_json.id;
                }
            });

            $("#edit_parentpage").modal();
        }

        function deleteItem(id)
        {
            document.getElementById("deleteId").href="delete-parentpage/"+id;
            $("#delete_resignation").modal();
        }
    </script>
    {{-- end edit parentpage modal --}}


    <!-- Delete Resignation Modal -->
    <div class="modal custom-modal fade" id="delete_resignation" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Menu Page</h3>
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

    <!-- /Delete Resignation Modal -->
    @endsection