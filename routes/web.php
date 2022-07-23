<?php

use Illuminate\Support\Facades\Route;

// Authentication Area.....//

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
    Route::get('home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('backend.home');
});
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth']], function () {
    Route::get('home', [App\Http\Controllers\User\UserController::class, 'index'])->name('\home');
});


// Frontend Area.....//

Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('/');
Route::get('productdetails/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'product'])->name('productdetails');
Route::get('Brands', [App\Http\Controllers\Frontend\IndexController::class, 'allbrands'])->name('Brands');
Route::get('Item/{id}/{item_name}', [App\Http\Controllers\Frontend\IndexController::class, 'Item'])->name('Item');
Route::get('Category/{id}/{category_name}', [App\Http\Controllers\Frontend\IndexController::class, 'category'])->name('Category');
Route::get('SubCategory/{id}/{subcategory_name}', [App\Http\Controllers\Frontend\IndexController::class, 'subcategory'])->name('SubCategory');
Route::get('SearchProduct', [App\Http\Controllers\Frontend\IndexController::class, 'serachproduct'])->name('SearchProduct');
Route::get('BrandProduct/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'brandproduct'])->name('BrandProduct');
Route::get('About-Us', [App\Http\Controllers\Frontend\IndexController::class, 'aboutus'])->name('About-Us');
Route::get('faq', [App\Http\Controllers\Frontend\IndexController::class, 'faq'])->name('faq');
Route::get('Contact-Us', [App\Http\Controllers\Frontend\IndexController::class, 'contactus'])->name('Contact-Us');
Route::get('Privacy&policy', [App\Http\Controllers\Frontend\IndexController::class, 'privacypolicy'])->name('Privacy&policy');
Route::get('Terms&conditions', [App\Http\Controllers\Frontend\IndexController::class, 'termconditions'])->name('Terms&conditions');
Route::get('Buying-Process', [App\Http\Controllers\Frontend\IndexController::class, 'buyingprocess'])->name('Buying-Process');
Route::post('Message', [App\Http\Controllers\Frontend\UserController::class, 'message'])->name('Message');


// User Dashboard Area ....!!

Route::post('User-Signup', [App\Http\Controllers\Frontend\UserController::class, 'usersignup'])->name('User-Signup');
Route::get('User/Dashboard', [App\Http\Controllers\Frontend\UserController::class, 'dashboard'])->name('User/Dashboard');
Route::post('Update-Profile/{id}', [App\Http\Controllers\Frontend\UserController::class, 'updateprofile'])->name('Update-Profile');
Route::post('Update-Password', [App\Http\Controllers\Frontend\UserController::class, 'updatepassword'])->name('Update-Password');
Route::get('Track-Your-Order', [App\Http\Controllers\Frontend\UserController::class, 'ordertrack'])->name('Track-Your-Order');
Route::get('Tracking-Status', [App\Http\Controllers\Frontend\UserController::class, 'trackingstatus'])->name('Tracking-Status');
Route::get('User/Order-Tracking/{id}', [App\Http\Controllers\Frontend\UserController::class, 'ordertracking'])->name('User/Order-Tracking');
Route::get('wishlist/{id}', [App\Http\Controllers\Frontend\UserController::class, 'wishlist'])->name('wishlist');
Route::get('Wishlists', [App\Http\Controllers\Frontend\UserController::class, 'Wishlists'])->name('Wishlists');
Route::get('Wishlist-Product-Delete/{id}', [App\Http\Controllers\Frontend\UserController::class, 'wishlistprodelete'])->name('Wishlist-Product-Delete');


// AddtoCart Area ....!!

Route::post('AddtoCart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'addtocart'])->name('AddtoCart');
Route::get('checkcart', [App\Http\Controllers\Frontend\CartController::class, 'checkcart'])->name('checkcart');
Route::get('Checkout', [App\Http\Controllers\Frontend\CartController::class, 'checkout'])->name('Checkout');
Route::get('Cart', [App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('Cart');
Route::post('Qty_Update/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'qty_update'])->name('Qty_Update');
Route::get('Product_Remove/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'product_remove'])->name('Product_Remove');
Route::get('Cart_Clear', [App\Http\Controllers\Frontend\CartController::class, 'cart_clear'])->name('Cart_Clear');
Route::post('Shipping_Details/{id}', [App\Http\Controllers\Frontend\CartController::class, 'shipping_details'])->name('Shipping_Details');



// Backend Area.....//

Route::get('/backend', [App\Http\Controllers\Backend\IndexController::class, 'index'])->name('/backend');


// User ....!!
Route::get('Create-Admin', [App\Http\Controllers\Backend\AdminController::class, 'createadmin'])->name('Create-Admin');
Route::post('insertadmin', [App\Http\Controllers\Backend\AdminController::class, 'insertadmin'])->name('insertadmin');
Route::get('Manage-Admin', [App\Http\Controllers\Backend\AdminController::class, 'manageadmin'])->name('Manage-Admin');
Route::get('adminstatus/{id}', [App\Http\Controllers\Backend\AdminController::class, 'adminstatus'])->name('adminstatus');
Route::get('deleteadmin/{id}', [App\Http\Controllers\Backend\AdminController::class, 'deleteadmin'])->name('deleteadmin');
Route::get('editadmin/{id}', [App\Http\Controllers\Backend\AdminController::class, 'adminedit'])->name('editadmin');
Route::POST('updateadmin/{id}', [App\Http\Controllers\Backend\AdminController::class, 'adminupdate'])->name('updateadmin');


// Item ....!!
Route::get('Item', [App\Http\Controllers\Backend\ItemController::class, 'item'])->name('Item');
Route::post('insertitem', [App\Http\Controllers\Backend\ItemController::class, 'iteminsert'])->name('insertitem');
Route::get('Manage-Item', [App\Http\Controllers\Backend\ItemController::class, 'manageitem'])->name('Manage-Item');
Route::get('changeStatus/{id}', [App\Http\Controllers\Backend\ItemController::class, 'changeStatus'])->name('changeStatus');
Route::get('deleteitem/{id}', [App\Http\Controllers\Backend\ItemController::class, 'itemdelete'])->name('deleteitem');
Route::get('edititem/{id}', [App\Http\Controllers\Backend\ItemController::class, 'itemedit'])->name('edititem');
Route::POST('updateitem/{id}', [App\Http\Controllers\Backend\ItemController::class, 'itemupdate'])->name('updateitem');


// Category ....!!
Route::get('Category', [App\Http\Controllers\Backend\CategoryController::class, 'category'])->name('Category');
Route::post('insertcategory', [App\Http\Controllers\Backend\CategoryController::class, 'categoryinsert'])->name('insertcategory');
Route::get('Manage-Category', [App\Http\Controllers\Backend\CategoryController::class, 'managecategory'])->name('Manage-Category');
Route::get('CategoryStatus/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'categorystatus'])->name('CategoryStatus');
Route::get('deletecatecory/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'categorydelete'])->name('deletecatecory');
Route::get('editcategory/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'categoryedit'])->name('editcategory');
Route::POST('updatecategory/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'categoryupdate'])->name('updatecategory');


// Sub Category ....!!
Route::get('Sub-Category', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategory'])->name('Sub-Category');
Route::get('categoryget/{item_id}', [App\Http\Controllers\Backend\SubCategoryController::class, 'categoryget'])->name('categoryget/{item_id}');
Route::post('insertsubcategory', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategoryinsert'])->name('insertsubcategory');
Route::get('Manage-SubCategory', [App\Http\Controllers\Backend\SubCategoryController::class, 'managesubcategory'])->name('Manage-SubCategory');
Route::get('SubCategoryStatus/{id}', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategorystatus'])->name('SubCategoryStatus');
Route::get('deletesubcatecory/{id}', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategorydelete'])->name('deletesubcatecory');
Route::get('editsubcategory/{id}', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategoryedit'])->name('editsubcategory');
Route::POST('updatesubcategory/{id}', [App\Http\Controllers\Backend\SubCategoryController::class, 'subcategoryupdate'])->name('updatesubcategory');


// Brand ....!!
Route::get('Brand', [App\Http\Controllers\Backend\BrandController::class, 'brand'])->name('Brand');
Route::post('insertbrand', [App\Http\Controllers\Backend\BrandController::class, 'brandinsert'])->name('insertbrand');
Route::get('Manage-Brand', [App\Http\Controllers\Backend\BrandController::class, 'managebrand'])->name('Manage-Brand');
Route::get('BrandStatus/{id}', [App\Http\Controllers\Backend\BrandController::class, 'brandstatus'])->name('BrandStatus');
Route::get('deletebrand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'branddelete'])->name('deletebrand');
Route::get('editbrand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'brandedit'])->name('editbrand');
Route::POST('updatebrand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'brandupdate'])->name('updatebrand');


// Product ....!!
Route::get('Product', [App\Http\Controllers\Backend\ProductController::class, 'product'])->name('Product');
Route::get('categoryget/{item_id}', [App\Http\Controllers\Backend\ProductController::class, 'categoryget'])->name('categoryget/{item_id}');
Route::get('subcategoryget/{category_id}', [App\Http\Controllers\Backend\ProductController::class, 'subcategoryget'])->name('subcategoryget/{category_id}');
Route::post('insertproduct', [App\Http\Controllers\Backend\ProductController::class, 'productinsert'])->name('insertproduct');
Route::get('Manage-Product', [App\Http\Controllers\Backend\ProductController::class, 'manageproduct'])->name('Manage-Product');
Route::get('StockStatus/{id}', [App\Http\Controllers\Backend\ProductController::class, 'stockstatus'])->name('StockStatus');
Route::get('ProductStatus/{id}', [App\Http\Controllers\Backend\ProductController::class, 'productstatus'])->name('ProductStatus');
Route::get('deleteproduct/{id}', [App\Http\Controllers\Backend\ProductController::class, 'productdelete'])->name('deleteproduct');
Route::get('editproduct/{id}', [App\Http\Controllers\Backend\ProductController::class, 'productedit'])->name('editproduct');
Route::post('updateproduct/{id}', [App\Http\Controllers\Backend\ProductController::class, 'productupdate'])->name('updateproduct');
Route::get('ViewAllProduct', [App\Http\Controllers\Backend\ProductController::class, 'viewallproduct'])->name('ViewAllProduct');


// Website Settings ....!!
Route::get('Slider', [App\Http\Controllers\Backend\SliderController::class, 'Slider'])->name('Slider');
Route::post('insertslider', [App\Http\Controllers\Backend\SliderController::class, 'sliderinsert'])->name('insertslider');
Route::get('Manage-Slider', [App\Http\Controllers\Backend\SliderController::class, 'manageslider'])->name('Manage-Slider');
Route::get('deleteslider/{id}', [App\Http\Controllers\Backend\SliderController::class, 'sliderdelete'])->name('deleteslider');
Route::get('editslider/{id}', [App\Http\Controllers\Backend\SliderController::class, 'slideredit'])->name('editslider');
Route::post('updateslider/{id}', [App\Http\Controllers\Backend\SliderController::class, 'sliderupdate'])->name('updateslider');

Route::get('About', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'about'])->name('About');
Route::post('updateabout/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'aboutupdate'])->name('updateabout');

Route::get('Settings', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'settings'])->name('Settings');
Route::post('updatesettings/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'settingsupdate'])->name('updatesettings');

Route::get('Contact', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'contact'])->name('Contact');
Route::post('updatecontact/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'contactupdate'])->name('updatecontact');

Route::get('Privacypolicy', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'privacypolicy'])->name('Privacypolicy');
Route::post('updateprivacypolicy/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'privacypolicyupdate'])->name('updateprivacypolicy');

Route::get('Termcondition', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'termcondition'])->name('Termcondition');
Route::post('updatetermcondition/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'termconditionupdate'])->name('updatetermcondition');

Route::get('Howtobuy', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'howtobuy'])->name('Howtobuy');
Route::post('updatehowtobuy/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'howtobuyupdate'])->name('updatehowtobuy');

Route::get('FAQ', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'faq'])->name('FAQ');
Route::post('insertfaq', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'faqinsert'])->name('insertfaq');
Route::get('Manage-FAQ', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'managefaq'])->name('Manage-FAQ');
Route::get('deletefaq/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'faqdelete'])->name('deletefaq');
Route::get('editfaq/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'faqedit'])->name('editfaq');
Route::post('updatefaq/{id}', [App\Http\Controllers\Backend\WebsiteSettingsController::class, 'faqupdate'])->name('updatefaq');


// Order info ....!!
Route::get('All-Order-Info', [App\Http\Controllers\Backend\OrderController::class, 'allorderinfo'])->name('All-Order-Info');
Route::get('Pending-Order', [App\Http\Controllers\Backend\OrderController::class, 'pendingorder'])->name('Pending-Order');
Route::get('Processing-Order', [App\Http\Controllers\Backend\OrderController::class, 'processingorder'])->name('Processing-Order');
Route::get('Shipping-Order', [App\Http\Controllers\Backend\OrderController::class, 'shippingorder'])->name('Shipping-Order');
Route::get('Complete-Order', [App\Http\Controllers\Backend\OrderController::class, 'completeorder'])->name('Complete-Order');
Route::get('Order-Report', [App\Http\Controllers\Backend\OrderController::class, 'orderreport'])->name('Order-Report');
Route::POST('Update-Order-Status/{id}', [App\Http\Controllers\Backend\OrderController::class, 'changeorderstatus'])->name('Update-Order-Status');
Route::POST('Order-Report-Showing', [App\Http\Controllers\Backend\OrderController::class, 'orderreportshowing'])->name('Order-Report-Showing');
Route::get('invoice/{id}', [App\Http\Controllers\Backend\OrderController::class, 'invoice'])->name('invoice');


// Customer Message ....!!
Route::get('Customer-Message', [App\Http\Controllers\Backend\IndexController::class, 'customermessage'])->name('Customer-Message');
