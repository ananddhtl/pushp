@extends('admin.admin_master')
@section('admin')

<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Sub-Menu Content Page</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sub-Menu Content Page</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" onclick="showHide();" id="addContent" style="display: block;" class="btn add-btn"><i
                        class="fa fa-plus"></i>Add Content</a>
                <a href="{{ url('/all-childcontent') }}" style="display: none;" id="returnBack" class="btn add-btn"><i
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
                            <th scope="col">Sub-Menu Pages</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($childcontents as $key => $childcontent)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> {{ @$childcontent->childpage->child_title }} </td>
                            {{-- <td style="width: 700px;">{!! $childcontent->text !!}</td>
                                    <td> <img src="uploads/thumbnailimg/{{ $parentcontent->Thumbnailimg }} "
                            width="100px"> --}}
                            </td>
                            <td class="text-center">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                            href="/add-galleryonchildcontent/{{ $childcontent->id}}/{{$childcontent->childpage->child_title}}">
                                            <i class="fa fa-plus m-r-5">
                                            </i> Add Gallery
                                        </a>
                                        <a class="dropdown-item" href="/edit-childcontent/{{ $childcontent->id}}">
                                            <i class="fa fa-pencil m-r-5">
                                            </i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#deleteParentpage" data-toggle="modal"
                                            onclick="deleteItem({{ $childcontent->id }})"
                                            data-target="deleteParentpage"><i class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex" style="float: right">
                    {!! $childcontents->links() !!}
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

                    <form action="{{ route('childcontent.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- menu --}}

                        <div class="form-group">
                            <label for="ParentPages">Menu Page</label>
                            <select name="parentpage_id" class="select">
                                <option disabled="" selected="">--Select Menu-- </option>
                                @foreach ($parentpages as $parentpage)
                                <option value="{{ $parentpage->id }}">{{ $parentpage->title }} </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- submenu --}}
                        <div class="form-group">
                            <label for="ParentPages">Sub-Menu Page</label>
                            <select name="childpage_id" class="form-control" id="childpage_id">
                                <option disabled="" selected="">--Select Sub Menu-- </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Thumbnail Image:</label>

                            <input type="file" class="form-control" name="thumbnailimg" placeholder="image" multiple>
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                        </div>

                        <div class="form-group">
                            <label for="image">Price of Room:</label>

                            <input type="text" class="form-control" name="price" placeholder="Price of a room">

                        </div>
                        <div class="form-group">
                            <label for="image">Person Capacity</label>

                            <input type="text" class="form-control" name="total_no_of_persons"
                                placeholder="Total No. of Persons">
                        </div>
                        <div class="form-group">
                            <label for="image">Bed Size:</label>

                            <input type="text" class="form-control" name="bedsize" placeholder="Bed Size">
                        </div>
                        <div class="form-group">

                            <label for="parent page">Description:</label>

                            <textarea id="editor" name="text" class="form-control"
                                placeholder="Write here Description"></textarea>

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





<!-- This is for parent/menu -->
<script type="text/javascript">
$(document).ready(function() {
    $('select[name="parentpage_id"]').on('change', function() {
        var parentpage_id = $(this).val();
        if (parentpage_id) {
            $.ajax({
                url: "{{  url('/get/submenu/') }}/" + parentpage_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#childpage_id").empty();
                    $.each(data, function(key, value) {
                        $("#childpage_id").append('<option value="' + value.id +
                            '">' + value.child_title + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>
@endsection