@extends('admin.admin_master')
@section('admin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Parent Content Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Parent Content Page</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                   
                    <a href="{{ url('/all-parentcontent') }}" style="display: true;" id="returnBack" class="btn add-btn"><i class="fa fa-arrow-left"></i>Return</a>
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
                        <form action="{{ route('parentcontent.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $parentcontent->id }}" />
                            <div class="form-group">

                                <label for="ParentPages">Parent Page</label>

                                <select name="parentpage_id" class="form-control" id="parentpage_id">
                                    @foreach ($parentpages as $parentpage)
                                    <option value="{{ $parentpage->id }}"
                                        {{ $parentpage->parentpage_id == $parentpage->id ? 'selected' : '' }}>
                                        {{ $parentpage->title }} </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image:</label>

                                @if ($parentcontent->thumbnailimg)
                            <img src="/uploads/thumbnailimg/{{ $parentcontent->thumbnailimg }}" height="100">
                            <button> <a href="/deleteparentcontentimage/{{ $parentcontent->id }}"> Remove </a> </button>
                                @endif
                        <input type="file" style="margin-top: 10px;" name="thumbnailimg" class="form-control"
                            placeholder="Thumbnailimage" onchange="previewFile(this)">

                            </div>
                            <div class="form-group">


                                <label for="parent page">Discription:</label>


                                <textarea id="editor" name="text" class="form-control" placeholder="Write here Description"> {{ $parentcontent->text }}</textarea>

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

    
@endsection
