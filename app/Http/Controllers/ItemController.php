<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Item::query()->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return Item
     */
    public function store(Request $request): Item
    {
        $newItem = new Item();
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return string
     */
    public function update(Request $request, $id): string
    {
        $exisingItem = Item::query()->find($id);

        if ($exisingItem) {
            $exisingItem->completed = (bool)$request->item["completed"];
            $exisingItem->completed_at = (bool)$request->item["completed"] ? Carbon::now() : null;
            $exisingItem->save();

            return $exisingItem;
        }

        return "Item not found!";
    }

    /**
     * @param $id
     * @return string
     */
    public function destroy($id): string
    {
        $existingItem = Item::query()->find($id);

        if ($existingItem) {
            $existingItem->delete();

            return "Successfully delete item!";
        }

        return "Item not found!:(";
    }
}
