@extends('admin.admin_master')
@section('admin')
<div class="row" id="displayParentContent" style="display: block;">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Image Caption</th>
                        <th scope="col">Images</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleryImage as $gallery)
                    <tr>
                        <td>{{ $gallery->id }}</td>
                        <td>{{ $gallery->child_content_id}}</td>
                        <td> {{ $gallery-> name }} </td>
                        <td> <img src="{{$gallery->image}}" width="100px"> </td>
                        <td class="text-center">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#deleteParentpage" data-toggle="modal"
                                        onclick="deleteItem({{ $gallery->id }})" data-target="deleteParentpage"><i
                                            class="fa fa-trash-o m-r-5"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex" style="float: right">
                {!! $galleryImage->links() !!}
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
    document.getElementById("deleteId").href = "delete-childcontentgallery/" + id;
    $("#delete_resignation").modal();
}
</script>
@endsection