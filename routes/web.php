<?php

use \App\Models\Listings;
use App\Http\Controllers\userControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listingControl;
use App\Http\Controllers\applicantControl;
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
//all the listings
Route::get('/', [listingControl::class, 'index']);

//create page
Route::get('/listings/create',[listingControl::class, 'create']);

//store data from create form
Route::post('/listings',[listingControl::class, 'store']);

//Manage Listings
Route::get('/listings/manage', [listingControl::class, 'manage'])->middleware('auth');

//Manage Listings for applicant
Route::get('/applicant', [listingControl::class, 'apply_manage'])->middleware('auth');

//Manage-> profile setup for Applicants
Route::get('/applicant/profileSetup', [listingControl::class, 'applicantSetup'])->middleware('auth');

//Manage->profile setup for applicants post
Route::post('/applicant/profileSetup', [applicantControl::class, 'applicantSetup'])->middleware('auth');

//Manage -> Applications by a user
Route::get('/applicant/applications', [listingControl::class, 'applications'])->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [listingControl::class, 'edit']);

//Update Editted Form
Route::put('/listings/{listing}/',[listingControl::class, 'update']);

//Delete a listing
Route::delete('/listings/{listing}/',[listingControl::class, 'delete']);

//single listing
Route::get('/listings/{listing}',[listingControl::class, 'show']);



//user registration
Route::get('/register', [userControl::class, 'create']);

//create user
Route::post('/users', [userControl::class, 'store']);

//update profile
Route::post('/users/profile/{user}', [userControl::class, 'update']);

//login users
Route::post('/users/authenticate', [userControl::class, 'authenticate']);

//Logout
Route::post('/logout', [userControl::class, 'logout']);

//change Password
Route::get('/change_password/{uuid}/', [userControl::class, 'changePassword'])->middleware('auth');

//update password
Route::put('/change_password/{id}/', [userControl::class, 'updatePassword'])->middleware('auth');

//login form
Route::get('/login', [userControl::class, 'login']);

//company profile setup
Route::get('/company/profileSetup', [userControl::class, 'profile'])->middleware('auth');