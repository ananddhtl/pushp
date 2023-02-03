@extends('admin.admin_master')
@section('admin')
<div id="addParentContent">
    <div class="content container-fluid">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="form-group">
                    <form action="{{url('/add-galleryonchildcontent')}}" method="post" enctype="multipart/form-data">
                        @csrf

                     
                        
                        <div class="form-group">
                            <label for="image">Thumbnail Image:</label>
                            <input type="file" class="form-control" name="image" placeholder="image"
                                onchange="previewFile(this)">
                            <img id="previewImg" src="" alt="image" onerror='this.style.display = "none"'>
                        </div>
   
                        <div class="form-group">
                            <label for="image">Child Pages ID</label>
                            <input type="number" class="form-control" name="child_content_id" value="<?php echo request()->route('id'); ?>" readonly>

                        </div>
                        <div class="form-group">
                            <label for="image">Room</label>
                            <input type="text" class="form-control"  value="<?php echo request()->route('title'); ?>" readonly>

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

@endsection