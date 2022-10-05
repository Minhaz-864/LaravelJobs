<?php

use \App\Models\Listings;
use App\Http\Controllers\userControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listingControl;
use App\Http\Controllers\applicantControl;
use App\Http\Controllers\ApplyControl;
use App\Http\Controllers\AdminControl;
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


/**
 * Common resource routes
 * index - show all Listings
 * show - show single listings
 * create - show form to create new listings
 * store - store new listing
 * edit - show form to edit existing listing
 * update - update listing
 * destroy - destroy listing
 */

/************************** 
********Listings***********
****************************/
//all the listings
Route::get('/', [listingControl::class, 'index']);

//create page
Route::get('/listings/create',[listingControl::class, 'create']);

//store data from create form
Route::post('/listings',[listingControl::class, 'store']);

//Manage Listings
Route::get('/listings/manage', [listingControl::class, 'manage'])->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [listingControl::class, 'edit']);

//Update Editted Form
Route::put('/listings/{listing}/',[listingControl::class, 'update']);

//Delete a listing
Route::delete('/listings/{listing}/',[listingControl::class, 'delete']);

//single listing
Route::get('/listings/{listing}',[listingControl::class, 'show']);




/********************************
******Applicant Management*******
*********************************/


//Manage Listings for applicant
Route::get('/applicant', [listingControl::class, 'apply_manage'])->middleware('auth');

//Manage-> profile setup for Applicants
Route::get('/applicant/profileSetup', [listingControl::class, 'applicantSetup'])->middleware('auth');

//Manage->profile setup for applicants post
Route::post('/applicant/profileSetup/{id}', [applicantControl::class, 'applicantSetup'])->middleware('auth');

/************************** 
******Apply Management******
****************************/

//Handle apply
Route::get('/apply/{listing}', [ApplyControl::class, 'index'])->middleware('auth');

//store informations
Route::post('/apply/{applicant}', [ApplyControl::class, 'store'])->middleware('auth');

//delete application
Route::delete('/apply/{application}/', [ApplyControl::class, 'delete'])->middleware('auth');

//Application Accepted
Route::post('/application/Accept/{id}', [ApplyControl::class, 'accept'])->middleware('auth');

//Application Rejected
Route::post('/application/Reject/{id}', [ApplyControl::class, 'reject'])->middleware('auth');
/************************** 
******User Management*******
****************************/


//user registration
Route::get('/register', [userControl::class, 'create']);

//create user
Route::post('/users', [userControl::class, 'store']);

//login form
Route::get('/login', [userControl::class, 'login']);

//login users
Route::post('/users/authenticate', [userControl::class, 'authenticate']);

//update profile
Route::post('/users/profile/{user}', [userControl::class, 'update']);

//change Password
Route::get('/change_password/{uuid}/', [userControl::class, 'changePassword'])->middleware('auth');

//update password
Route::put('/change_password/{id}/', [userControl::class, 'updatePassword'])->middleware('auth');

//Logout
Route::post('/logout', [userControl::class, 'logout']);


/********************************
******Company Management*********
*********************************/

//company profile setup
Route::get('/company/profileSetup', [userControl::class, 'profile'])->middleware('auth');

//manage Applications by users
Route::get('/company/applications', [ApplyControl::class, 'manageApplications']);

//View applicant Profile
Route::post('/applicant/view/{applicant}', [applicantControl::class, 'viewApplicant']);



/*********************************** 
******Admin: User Management********
************************************/
//Rejected Applications
Route::get('/admin/rejected', [AdminControl::class, 'rejected']);

//Accepted Applications
Route::get('/admin/accepted', [AdminControl::class, 'accepted']);

//accepting or rejecting company
Route::get('/admin/{status}/{id}', [AdminControl::class, 'update']);

//user management for admin
Route::get('/admin', [AdminControl::class,'index']);

