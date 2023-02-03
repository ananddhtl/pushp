<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ChildContentController;
use App\Http\Controllers\Backend\ChildPageController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ParentContentController;
use App\Http\Controllers\Backend\ParentPageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\SliderImageController;
use App\Http\Controllers\Backend\TestimonialController;

use App\Http\Controllers\GalleriesRoomController;
use App\Http\Controllers\ckEditorUpload;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\Mailcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/aboutus', function () {
    return view('frontend.aboutus');
});

Route::get('/contactus', function () {
    return view('frontend.contactus');
});
Route::get('/gallery', function () {
    return view('frontend.gallery');
});
Route::get('/hoteldetails', function () {
    return view('frontend.hoteldetails');
});
Route::get('/checkin', function () {
    return view('frontend.checkin-form');
});


Route::get('/admindashboard', function () {
    return view('admin.admin_master');
});

Route::post('/contactpost', [Mailcontroller::class, 'contactpost'])->name('contactpost');

Route::post('/contactmessage', [Mailcontroller::class, 'contactmessage'])->name('contactmessage');

Route::get('/contentdetails/{id}', [IndexController::class, 'returncontent']);

Route::get('/', [IndexController::class, 'contentreturn']);


Route::get('/aboutus/{id}', [IndexController::class, 'parentpagedetails']);
Route::get('/blogdetails/{id}', [IndexController::class, 'selectBlogdetailFromTable']);


//Start of Route for the slider image//

Route::get('/add-sliderimage', [SliderImageController::class, 'Addslider'])->name('slider');
Route::Post('/add-slideimage-store', [SliderImageController::class, 'slideimageStore'])->name('sliderimage.store');
Route::get('/all-slideimage', [SliderImageController::class, 'sliderImage'])->name('all.sliderimage');
Route::get('/edit-slideimage/{id}', [SliderImageController::class, 'EditSliderImage']);
Route::post('/update-slideimage/{id}', [SliderImageController::class, 'UpdateSliderImage'])->name('SliderImage.update');
Route::get('/delete-slideimage/{id}', [SliderImageController::class, 'Deleleslider']);
//End of Route for slider image //

//Start of the Route for testimonial //

Route::get('/add-testimonial', [TestimonialController::class, 'AddTestimonial'])->name('testimonial');
Route::Post('/add-testimonial', [TestimonialController::class, 'Testimonialstore'])->name('testimonial.store');
Route::get('/all-testimonial', [TestimonialController::class, 'testimonial'])->name('all.testimonial');
Route::get('/edit-testimonial/{id}', [TestimonialController::class, 'EditTestimonial'])->name('edit.testimonial');
Route::post('/update-testimonial/{id}', [TestimonialController::class, 'Updateestimonial'])->name('testimonial.update');
Route::get('/delete-testimonial/{id}', [TestimonialController::class, 'Deletetestimonial']);
//End of the Route for testimonial //

// Start for the Route for parent page//
Route::get('/add-parentpage', [ParentPageController::class, 'addParentPage'])->name('parentpage');
Route::post('/add-parentpage', [ParentPageController::class, 'ParentPageStore'])->name('addparentpage.store');
Route::get('/all-parentpage', [ParentPageController::class, 'Parentpages'])->name('all.parentpages');
Route::get('/edit-parentpage', [ParentPageController::class, 'editparentpage']);
Route::post('/update-parentpage', [ParentPageController::class, 'updateParentpage'])->name('parentpage.update');
Route::get('/delete-parentpage/{id}', [ParentPageController::class, 'deleteParentpage'])->name('deleteParentpage');
// End for the Route for parent page//

// Start of the route for  content parent page controller
Route::get('/add-parentcontent', [ParentContentController::class, 'AddParentContent'])->name('parentcontent');
Route::Post('/add-parentcontent', [ParentContentController::class, 'ParentContentStore'])->name('parentcontent.store');
Route::get('/all-parentcontent', [ParentContentController::class, 'ParentContents'])->name('all.parentcontent');
Route::get('/edit-parentcontent/{id}', [ParentContentController::class, 'EditParentContent']);
Route::post('/update-parentcontent', [ParentContentController::class, 'UpdateParentContent'])->name('parentcontent.update');
Route::get('/delete-parenentcontent/{id}', [ParentContentController::class, 'DeleleParentContent']);
// End of the route for  content parent page controller


// Start of the route for  child content page
Route::get('/add-childcontent', [ChildContentController::class, 'AddChildContent'])->name('childcontent');
Route::Post('/add-childcontent', [ChildContentController::class, 'ChildContentStore'])->name('childcontent.store');
Route::get('/all-childcontent', [ChildContentController::class, 'ChildContents'])->name('all.childcontent');
Route::get('/edit-childcontent/{id}', [ChildContentController::class, 'EditChildContent']);
Route::post('/update-childcontent/{id}', [ChildContentController::class, 'UpdateChildContent'])->name('childcontent.update');
Route::get('/delete-childcontent/{id}', [ChildContentController::class, 'DeleleChildContent']);
Route::get('/deletechildcontentimage/{id}', [ChildContentController::class, 'deletechildcontentimage']);
// End of the route for  child content page

// Start of the route for gallery for child content page
Route::get('/add-galleryonchildcontent/{id}/{title}', [GalleriesRoomController::class, 'AddGalleryonChildContent'])->name('galleryonchildcontent');
Route::post('/add-galleryonchildcontent', [GalleriesRoomController::class, 'ChildContentGalleryStore'])->name('childcontentgallery.store');
Route::get('/all-childcontentgallery', [GalleriesRoomController::class, 'Viewchildcontentgallery'])->name('childcontentall.gallery');
Route::get('/edit-childcontentgallery/{id}', [GalleriesRoomController::class, 'EditChildContentGallery']);
Route::post('/update-childcontentgallery/{id}', [GalleriesRoomController::class, 'UpdateChildContentGallery'])->name('childcontentgallery.update');
Route::get('/delete-childcontentgallery/{id}', [GalleriesRoomController::class, 'DeleteChildCOntentGallery']);


// Start of the route for  child  page
Route::get('/add-childpage', [ChildPageController::class, 'addChildPage'])->name('childpage');
Route::Post('/add-childpage', [ChildPageController::class, 'ChildPageStore'])->name('childpage.store');
Route::get('/all-childpage', [ChildPageController::class, 'Childpages'])->name('all.childpage');
Route::get('/edit-childpage', [ChildPageController::class, 'editchildpage']);
Route::post('/update-childpage', [ChildPageController::class, 'updatechildpage'])->name('childpage.update');
Route::get('/delete-childpage/{id}', [ChildPageController::class, 'deletechildpage']);

// End of the route for  child  page

// Start of the route for  gallery  page 
Route::get('/add-gallery', [GalleryController::class, 'Addgallery'])->name('gallery');
Route::Post('/add-gallery', [GalleryController::class, 'GalleryStore'])->name('gallery.store');
Route::get('/all-gallery', [GalleryController::class, 'gallery'])->name('all.gallery');
Route::get('/edit-gallery/{id}', [GalleryController::class, 'EditGallery']);
Route::post('/update-gallery/{id}', [GalleryController::class, 'UpdateGallery'])->name('gallery.update');
Route::get('/delete-gallery/{id}', [GalleryController::class, 'DeleteGallery']);
// End of the route for  gallery  page 
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admindashboard')->middleware('auth:admin');

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

});

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route for team
Route::get('/add-team', [AlumniController::class, 'Addteam'])->name('team');
Route::Post('/add-team', [AlumniController::class, 'TeamStore'])->name('team.store');
Route::get('/all-team', [AlumniController::class, 'teams'])->name('all.team');
Route::get('/edit-team/{id}', [AlumniController::class, 'EditTeam']);
Route::post('/update-team/{id}', [AlumniController::class, 'UpdateTeam'])->name('team.update');
Route::get('/delete-team/{id}', [AlumniController::class, 'DeleleTeam']);
//Route for team

Route::get('/add-blog', [PostController::class, 'Addpost'])->name('blog');
Route::Post('/add-blog', [PostController::class, 'BlogStore'])->name('blog.store');
Route::get('/posts', [PostController::class, 'blogs'])->name('all.posts');
Route::get('/edit-blog/{id}', [PostController::class, 'EditBlog']);
Route::post('/update-blog/{id}', [PostController::class, 'UpdateBlog'])->name('blog.update');
Route::get('/delete-blog/{id}', [PostController::class, 'DeleteBlog']);

//publication
// Route::get('/add-publication',[PublicationController::class,'Addpublication'])->name('blog');
Route::Post('/add-publication', [PublicationController::class, 'publicationStore'])->name('publication.store');
Route::get('/all-publication', [PublicationController::class, 'publications'])->name('all.publication');
Route::get('/edit-publication/{id}', [PublicationController::class, 'Editpublication']);
Route::post('/update-publication/{id}', [PublicationController::class, 'Updatepublication'])->name('publication.update');
Route::get('/delete-publication/{id}', [PublicationController::class, 'Deletepublication']);

Route::get('/add-career', [CareerController::class, 'AddCareer'])->name('career');
Route::post('/store-career', [CareerController::class, 'CareerStore'])->name('store.career');
Route::get('/all-career', [CareerController::class, 'Career'])->name('all.career');
Route::get('/edit-career/{id}', [CareerController::class, 'EditCareer']);
Route::post('/update-career/{id}', [CareerController::class, 'UpdateCareer'])->name('career.update');
Route::get('/delete-career/{id}', [CareerController::class, 'DeleteCareer']);

Route::post('upload', [ckEditorUpload::class, 'uploadImage'])->name('upload');

Route::get('/get/submenu/{parentpage_id}', [IndexController::class, 'getsubmenu']);