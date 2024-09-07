<?php
use Illuminate\Support\Facades\Route;
use App\Models\WasteSubtype;

Route::get('/waste-subtypes/{wasteTypeId}', function($wasteTypeId) {
    return WasteSubtype::where('waste_type_id', $wasteTypeId)->get();
});
