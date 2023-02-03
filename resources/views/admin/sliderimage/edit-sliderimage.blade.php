@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Image Slider</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Image Slider</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="/Sliderimage" style="display: ture;" id="returnBack" class="btn add-btn"><i
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
                        <form action="{{route('SliderImage.update', $sliderimage->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sliderimage->id }}">	
                            <input type="hidden" name="old_image" value="{{ $sliderimage->image }}">	
                           <div class="form-group">
                                <label>Heading: <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" placeholder="Enter Image Title/Heading" value="{{ $sliderimage->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="parent page">Caption::</label>
                               <textarea id="editor"  class="form-control" name="caption" placeholder="Enter Caption">{{ $sliderimage->caption }}</textarea>
                               </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image:</label>
                                <img src="/uploads/slider/{{$sliderimage->image}}" height="100px">
                               <input style="margin-top: 10px;" type="file" name="image" placeholder="image" onchange="previewFile(this)">
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
        function hideImg() {
            document.getElementById("previewImg")
                .style.display = "none";
        }
    </script>
@endsection
