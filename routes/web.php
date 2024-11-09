<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\RecApprovalController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RecUploadController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\OrderingController;
use App\Http\Controllers\OrderingControllerWOS;
use App\Http\Controllers\OrderingControllerWODS;
use App\Http\Controllers\UPOrderingController;
use App\Http\Controllers\UPReceivingController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//RECEIVING UPLOAD
Route::get('/uploadSO',[RecUploadController::class,'index']);
Route::POST('upload-soFile',[RecUploadController::class,'uploadFile']);
Route::get('/upload-list/{id}', [RecUploadController::class, 'show']);
Route::POST('/get-upload-sonumber', [RecUploadController::class, 'showDetails']);


//INVENTORY
Route::get('status-details',[InventoryController::class,'index']);
Route::get('/get-itemcodeInv/{id}', [InventoryController::class, 'show']);

//REFERENCE
Route::get('/category/{id}', [ReferenceController::class, 'category']);
Route::post('/update-category', [ReferenceController::class, 'categoryupdate']);
Route::post('/store-category', [ReferenceController::class, 'categorystore']);

Route::get('/branch/{id}', [ReferenceController::class, 'branch']);
Route::get('/branch', [ReferenceController::class, 'branch']);
Route::post('/update-branch', [ReferenceController::class, 'branchupdate']);
Route::post('/store-branch', [ReferenceController::class, 'branchstore']);


//ORDERING
Route::get('/createSO',[OrderingController::class,'index']);
Route::get('/get-sonumber/{id}', [OrderingController::class, 'show']);
Route::get('/get-days/{id}', [OrderingController::class, 'showDays']);
Route::post('/store-so', [OrderingController::class, 'store']);
Route::post('/store-so-upload', [OrderingController::class, 'storeUpload']);
Route::get('/createSO-list/{SONumber}', [OrderingController::class, 'create'])->name('createSO-list');
Route::get('/get-itemcode/{id}', [OrderingController::class, 'showItem']);
Route::post('/store-details', [OrderingController::class, 'storedetails']);
Route::post('/update-details', [OrderingController::class, 'updatedetails']);
Route::post('/update-header', [OrderingController::class, 'updateHeader']);
Route::get('/duplicateSO-list/{SONumber}', [OrderingController::class, 'createDuplicate']);
Route::delete('/delSOdetail/{id}/{SONumber}', [OrderingController::class, 'destroy']);

//ORDERING W/O SO
Route::get('/createSOWOS',[OrderingControllerWOS::class,'index']);
Route::get('/get-sonumberWOS/{id}/{isType}', [OrderingControllerWOS::class, 'showWOS']);
Route::post('/store-soWOS', [OrderingControllerWOS::class, 'store']);

//ORDERING DROPSHIPPING W/O SO
Route::get('/createSODS',[OrderingControllerWODS::class,'index']);
Route::get('/get-sonumberWODS/{id}/{isType}', [OrderingControllerWODS::class, 'showWOS']);
Route::post('/store-soWODS', [OrderingControllerWODS::class, 'store']);

//ORDERING UPLOAD
Route::get('/uploadingSO',[UPOrderingController::class,'index']);
Route::post('/upload-so', [UPOrderingController::class, 'import']);



//RECEIVING
Route::put('/receiving-edit/{transactionId}/update', [ReceivingEditController::class, 'update']);
Route::get('/get-table-expiry/{id}', [ReceivingController::class, 'getExpiry']);

Route::get('/createREC',[ReceivingController::class,'index']);
Route::get('/updateREC-list/{id}/{SONumber}', [ReceivingController::class, 'createREC']);
Route::post('/updateActualQTY-details',[ReceivingController::class,'updateActualQty']);
Route::post('/store-expiry', [ReceivingController::class, 'storeExpiry']);
Route::post('/fetch-expiration', [ReceivingController::class, 'fetchExpiry']);
Route::post('/update-headerREC', [ReceivingController::class, 'updateHeaderREC']);


//RECEIVING NO SO
Route::get('/createRECNOSO',[ReceivingController::class,'indexNOSO']);

//RECEIVING DROPSHIPPING
Route::get('/createRECDS',[ReceivingController::class,'indexDS']);


//RECEIVING NEW IU
Route::get('/addActualREC',[UPReceivingController::class,'index']);
Route::get('/addActualREC-list/{SONumber}', [UPReceivingController::class, 'show']);
Route::post('/store-actualDetails', [UPReceivingController::class, 'import']);
Route::get('/uploadREC',[UPReceivingController::class,'uploadIndex']);
Route::post('/upload-StoreRec', [UPReceivingController::class, 'storeUploadItem']);
Route::get('/uploadRec-list/{$SONumber}',[UPReceivingController::class,'uploadList']);


//APPROVAL(SO)
Route::get('/SOApproval',[UPOrderingController::class,'SOApproval']);
Route::get('/createSOApp-list/{SONumber}', [OrderingController::class, 'createApproval']);
Route::get('/ForApproveSO/{SONumber}', [OrderingController::class, 'ApprovedSO']);

//APPROVED(SO)
Route::get('/SOApproved',[UPOrderingController::class,'SOApproved']);


//APPROVAL (RECEIVING)
Route::get('approvalSO',[RecApprovalController::class,'index']);
Route::get('/approval-list/{id}/{SONumber}', [RecApprovalController::class, 'approval']);
Route::put('/update-status-rec', [RecApprovalController::class, 'update'])->name('update-status');
Route::post('/approved-SO', [RecApprovalController::class, 'approvedSO']);

//APPROVED (RECEIVING)
Route::get('approvedSO',[RecApprovalController::class,'approved']);
Route::get('/approved-list/{SONumber}', [RecApprovalController::class, 'approved_LIST']);

require __DIR__.'/auth.php';
