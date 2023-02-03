@extends('admin.admin_master')
@section('admin')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Sub-Menu Content Page</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Sub-Menu Content Page</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">

                <a href="{{ url('/all-childcontent') }}" style="display: true;" id="returnBack" class="btn add-btn"><i
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

                    <form action="{{ route('childcontent.update',$childcontent->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label for="ParentPages">Menu Page</label>
                            <select name="parentpage_id" class="select">




                                <option disabled="" selected="">--Select Menu-- </option>

                                @foreach ($parentpages as $parentpage)
                                @if($childcontent->parentpage_id==$parentpage->id)
                                <option value="{{ $parentpage->id }}" selected>{{ $parentpage->title }} </option>
                                @else
                                <option value="{{ $parentpage->id }}">{{ $parentpage->title }} </option>
                                @endif

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ParentPages">Sub-Menu Page</label>
                            <select name="childpage_id" class="form-control" id="childpage_id">
                                <option disabled="" selected="">--Select Sub Menu-- </option>
                                @foreach ($childpages as $childpage )
                                @if($childcontent->childpage_id == $childpage->id)
                                <option value="{{ $childpage->id }}" selected>{{ $childpage->child_title }} </option>
                                @else

                                <option value="{{ $childpage->id }}">{{ $childpage->child_title }} </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Thumbnail Image:</label>

                            @if($childcontent->Thumbnailimg)
                            <img src="../uploads/childcontentimg/{{ $childcontent->Thumbnailimg }}" height="100">
                            <button> <a href="/deletechildcontentimage/{{$childcontent->id }}"> Remove </a> </button>

                            @endif
                            <input style="margin-top: 10px;" type="file" onclick="previewFile(this)" name="thumbnailimg"
                                placeholder="image">
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>

                        </div>
                        <div class="form-group">
                            <label for="image">Price of Room:</label>

                            <input type="text" class="form-control" name="price"  value= "{{ $childcontent->price }} " placeholder="Price of a room">

                        </div>
                        <div class="form-group">
                            <label for="image">Person Capacity</label>

                            <input type="text" class="form-control" name="total_no_of_persons"
                            value= "{{ $childcontent->total_no_of_persons }} "  placeholder="Total No. of Persons">
                        </div>
                        <div class="form-group">
                            <label for="image">Bed Size:</label>

                            <input type="text" class="form-control" name="bedsize" value="{{$childcontent->bedsize}}" placeholder="Bed Size">
                        </div>
                        <div class="form-group">


                            <label for="parent page">Description:</label>


                            <textarea id="editor" name="text" class="form-control"
                                placeholder="Write here Description"> {{ $childcontent->text }}</textarea>

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