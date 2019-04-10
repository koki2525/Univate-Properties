<?php

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
Route::get('resort', function() {
    return view('resort');
});

//Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/','PagesController@serveHome');
Route::get('about','PagesController@serveAbout');
Route::get('faqs','PagesController@serveFAQs');
Route::get('timeshare','PagesController@serveTimeShare');
Route::get('contact-us','PagesController@serveContact');
Route::group(['before' => 'auth'], function(){

Route::get('admin','PagesController@serveAdmin');
Route::get('publishTimeshare/{id}','PagesController@publishTimeshare');
Route::get('publishTimeshareAgent/{id}','PagesController@publishTimeshareAgent');
Route::get('publishCommercial/{id}','PagesController@publishCommercial');
Route::get('deleteTimeshare/{id}','PagesController@deleteTimeshare');
Route::get('deleteAgency/{id}','PagesController@deleteAgency');
Route::get('deleteTimeshareAgent/{id}','PagesController@deleteTimeshareAgent');
Route::post('search-commercial-admin','PagesController@serveCommercialSearch');
Route::post('search-residential-admin','PagesController@serveResidentialSearch');
Route::post('commercial-results','PagesController@handleCommercial');
Route::post('residential','PagesController@handleResidential');
Route::post('edit-timeshare/{id}', ['as' => 'edit-timeshare', 'uses' => 'PagesController@handleEditTimeshare']);
Route::get('edit-timeshare/{id}','PagesController@serveEditTimeshare');
Route::post('edit-timeshare-agent/{id}', ['as' => 'edit-timeshare-agent', 'uses' => 'PagesController@handleEditTimeshareAgent']);
Route::get('edit-timeshare-agent/{id}','PagesController@serveEditTimeshareAgent');
Route::get('edit-agency-timeshare/{id}','PagesController@serveEditAgencyTimeshare');
Route::post('edit-agency-timeshare/{id}', ['as' => 'edit-agency-timeshare', 'uses' => 'PagesController@handleEditAgencyTimeshare']);

});
Route::get('to-sell','PagesController@serveToSell');
Route::post('to-sell','PagesController@handleToSell');
Route::get('to-buy','PagesController@serveToBuy');
Route::get('resort-upload','PagesController@serveResortUpload');
Route::post('resort-upload','PagesController@handleResortUpload');
Route::get('privacy-policy','PagesController@servePrivacyPolicy');
/*
Route::get('login','PagesController@serveLogin');
Route::post('login', 'PagesController@handleLogin');
*/

Route::get('publishResidential/{id}','PagesController@publishResidential');
Route::get('interested/{id}','PagesController@serveInterested');
Route::post('interested/{id}','PagesController@handleInterested');

Route::get('resorts/{province}','PagesController@serveResorts');
Route::get('resort/{resort}','PagesController@serveResort');
Route::get('terms-and-conditions','PagesController@serveTermsConditions');


Route::get('deleteResidential/{id}','PagesController@deleteResidential');
Route::get('deleteCommercial/{id}','PagesController@deleteCommercial');

Route::get('register','PagesController@serveRegister');
Route::get('little-eden','PagesController@LittleEden');
Route::get('kagga-kamma','PagesController@KaggaKamma');
Route::get('mabalingwe','PagesController@Mabalingwe');
Route::get('verlorenkloof','PagesController@Verlorenkloof');
Route::get('sandy-place','PagesController@SandyPlace');
Route::get('kritzel','PagesController@Kridzil');
Route::get('uvongo','PagesController@Uvongo');
Route::get('ngwenya','PagesController@Ngwenya');
Route::get('sudwala','PagesController@Sudwala');
Route::get('jackalberry-ridge','PagesController@jackalberryRidge');
Route::post('register','PagesController@handleRegister');
Route::post('contact-us','PagesController@handleContacts');
//Route::get('logout','PagesController@handleLogout');
Route::get('confirmation/{email}','PagesController@confirmationButton');
Route::post('search','PagesController@serveSearch');

Route::get('commercial-sales','PagesController@serveCommercialSales');
Route::get('commercial-rentals','PagesController@serveCommercialRentals');
Route::get('commercial-rental/{name}','PagesController@serveCommercialRental');
Route::get('residential-rental/{name}','PagesController@serveResidentialRental');
Route::get('commercial-property/{id}','PagesController@serveCommercialProperty');
Route::get('residential-property/{id}','PagesController@serveResidentialProperty');
Route::get('interest-in-commercial-property/{id}','PagesController@serveCommercialPropertyInterested');
Route::post('interest-in-commercial-property/{id}','PagesController@handleCommercialPropertyInterested');

Route::get('interest-in-residential-property/{id}','PagesController@serveResidentialPropertyInterested');
Route::post('interest-in-residential-property/{id}','PagesController@handleResidentialPropertyInterested');

Route::get('residential-sales','PagesController@serveResidentialSales');
Route::get('residential-rentals','PagesController@serveResidentialRentals');

Route::get('commercial','PagesController@serveCommercial');
Route::get('residential','PagesController@serveResidential');
Route::get('timeshare-results','PagesController@serveTimeshareResults');
Route::get('commercial-results','PagesController@serveCommercialResults');

Route::get('margate-beach-club','PagesController@Margate');

Route::get('list-commercial-rental','PagesController@serveListCommercialRental');
Route::post('list-commercial-rental','PagesController@handleListCommercialRental');

Route::get('list-residential-rental','PagesController@serveListResidentialRental');
Route::post('list-residential-rental','PagesController@handleListResidentialRental');

Route::get('list-residential-sale','PagesController@serveListResidentialSale');
Route::post('list-residential-sale','PagesController@handleListResidentialSale');

Route::get('list-commercial-sale','PagesController@serveListCommercialSale');
Route::post('list-commercial-sale','PagesController@handleListCommercialSale');

Route::get('commercial-admin','PagesController@serveCommercialAdmin');
Route::get('residential-admin','PagesController@serveResidentialAdmin');

Route::get('edit-commercial/{id}','PagesController@serveEditCommercial');
Route::post('edit-commercial/{id}', ['as' => 'edit-commercial', 'uses' => 'PagesController@handleEditCommercial']);

Route::get('edit-residential/{id}','PagesController@serveEditResidential');
Route::post('edit-residential/{id}', ['as' => 'edit-residential', 'uses' => 'PagesController@handleEditResidential']);

Route::get('commercial-back/{for}','PagesController@backButtonCommercial');
Route::get('residential-back/{for}','PagesController@backButtonResidential');

Route::get('csi','PagesController@serveCSI');
Route::post('contact-us/{id}','PagesController@handleContactsResortPage');
Route::post('contact-commercial/{id}','PagesController@handleContactCommercial');
Route::get('back','PagesController@back');
Route::get('office-parks','PagesController@officeParks');
Route::get('lombardy','PagesController@Lombardy');
Route::get('lombardy-enquiry/{id}','PagesController@serveLombardyEnquiry');
Route::post('lombardy-enquiry/{id}','PagesController@handleMooikloofEnquiry');
Route::get('mooikloof-enquiry/{id}','PagesController@serveMooikloofEnquiry');
Route::post('mooikloof-enquiry/{id}','PagesController@handleLombardyEnquiry');

Route::get('mooikloof','PagesController@Mooikloof');

Route::post('interested-property/{id}','PagesController@handleInterestProperty');
Route::post('interested-property2/{id}','PagesController@handleInterestProperty2');

Route::get('timeshare-enquiry/{id}','PagesController@serveTimeshareEnquiry');
Route::post('interested-timeshare/{id}','PagesController@handleTimeshareEnquiry');

Route::get('share-transfer-initiation-for-seller','PagesController@serveShareTransferInitiation');
Route::post('share-transfer-initiation-for-seller','PagesController@handleShareTransferIntiation');

Route::get('share-transfer-initiation-for-purchaser/{id}','PagesController@serveShareTransferInitiationForPurchaser');
Route::post('share-transfer-initiation-for-purchaser/{id}','PagesController@handleShareTransferInitiationForPurchaser');

Route::post('upload-timeshares','PagesController@import');

Route::get('successful-payment','PagesController@serveSuccessfulPayment');
Route::get('register-agent','PagesController@serveRegisterAgent');
Route::get('pay-listing-fee/{id}','PagesController@servePayListingFee');

Route::get('my-timeshares','PagesController@serveMyTimeshares');
Route::get('my-residential-properties','PagesController@serveMyResidentialProperties');
Route::get('my-commercial-properties','PagesController@serveMyCommercialProperties');

Route::get('register-timeshare-agent','PagesController@serveRegisterTimeshareAgent');
Route::post('register-timeshare-agent','PagesController@handleRegisterTimeshareAgent');

Route::get('register-commercial-agent','PagesController@serveRegisterCommercialAgent');
Route::post('register-commercial-agent','PagesController@handleRegisterCommercialAgent');

Route::get('register-residential-agent','PagesController@serveRegisterResidentialAgent');
Route::post('register-residential-agent','PagesController@handleRegisterResidentialAgent');

Route::get('timeshare-agents','PagesController@serveTimeshareAgents');
Route::get('commercial-agents','PagesController@serveCommercialAgents');
Route::get('residential-agents','PagesController@serveResidentialAgents');

Route::get('register-agency','PagesController@serveRegisterAgency');
Route::post('register-agency','PagesController@handleRegisterAgency');

Route::get('all-agents','PagesController@serveAllAgents');
Route::get('all-agencies','PagesController@serveAllAgencies');
Route::get('all-commercial-properties','PagesController@serveAllCommercialProperties');
Route::get('all-residential-properties','PagesController@serveAllResidentialProperties');

Route::get('edit-agent/{id}','PagesController@editAgent');
Route::post('edit-agent/{id}','PagesController@handleEditAgent');
Route::get('publishAgent/{id}','PagesController@publishAgent');
Route::get('deleteAgent/{id}','PagesController@deleteAgent');

Route::get('edit-agency/{id}','PagesController@serveEditAgency');
Route::post('edit-agency/{id}','PagesController@handleEditAgency');

Route::get('contract','PagesController@contract');

Route::get('edit-my-timeshare/{id}','PagesController@serveEditMyTimeshare');
Route::post('edit-my-timeshare/{id}','PagesController@handleEditMyTimeshare');

Route::get('edit-my-commercial-property/{id}','PagesController@serveEditMyCommercialProperty');
Route::post('edit-my-commercial-property/{id{','PagesController@handleEditMyCommercialProperty');

Route::get('edit-my-residential-property/{id}','PagesController@serveEditMyResidential');
Route::post('edit-my-residential-property/{id}','PagesController@handleEditMyResidentialProperty');

Route::get('manage-agency-timeshares','PagesController@serveManageAgencyTimeshares');
Route::get('view-all-timeshares','PagesController@serveAllAgencyListings');

Route::get('pre-listed-weeks','PagesController@servePreListedWeeks');
Route::post('pre-listed-weeks','PagesController@handlePreListedWeeks');

Route::get('pre-list-access','PagesController@prelistAcessList');
Route::get('give-prelist-acess/{id}','PagesController@givePrelistAccess');
Route::get('revoke-prelist-acess/{id}','PagesController@revokePrelistAccess');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('verifyTimeshare/{id}','PagesController@verifyTimeshare');

Route::post('filter-weeks/{slug}','PagesController@filterWeeks');

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => true
  ]);

//Route::post('password/reset','Auth\ResetPasswordController@reset');
  
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('update-profile/{id}','PagesController@serveEditProfile');
Route::post('update-profile/{id}','PagesController@handleEditProfile');

Route::get('upload-tender-weeks','PagesController@serveUploadTenderWeeks');
Route::post('upload-tender-weeks','PagesController@handleExcelUpload');
Route::get('review-prelisted-weeks','PagesController@reviewPrelistedWeeks');
Route::get('selected-weeks/{id}','PagesController@selectedWeeks');
Route::post('selected-weeks/{id}','PagesController@handleReviewPrelistedWeeks');

Route::get('publish-remaining-weeks','PagesController@publishTheRest');

Route::get('timeshare-change-logs','PagesController@serveLogs');
Route::get('view-user/{id}','PagesController@serveUser');
Route::get('view-timeshare/{id}','PagesController@serveTimeshareDetails');

Route::post('filter/{id}','PagesController@serveSearchTimeshareFilter');

Route::get('new-resort','PagesController@serveAddNewResort');
Route::post('new-resort','PagesController@handleAddNewResort');