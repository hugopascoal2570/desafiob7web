<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $repository;
    public function __construct(Address $model)
    {
        $this->repository = $model;
    }

    public function index()
    {
        $addresses = $this->repository->get();

        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAddressRequest $request)
    {
        $address = $this->repository->create($request->validated());

        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = $this->repository->where('id', $id)->firstOrFail();

        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = $this->repository->where('id', $id)->firstOrFail();

        $address->update($request->validated());

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = $this->repository->where('id', $id)->firstOrFail();
        $address->delete();
        return response()->json([], 204);
    }
}
