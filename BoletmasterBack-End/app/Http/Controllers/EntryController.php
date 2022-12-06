<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;

class EntryController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreEntryRequest $request)
    {
        //
    }

    public function show(Entry $entry)
    {
        //
    }

    public function update(UpdateEntryRequest $request, Entry $entry)
    {
        //
    }

    public function destroy(Entry $entry)
    {
        //
    }
}
