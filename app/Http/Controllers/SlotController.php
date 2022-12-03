<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSlotRequest;
use App\Http\Requests\UpdateSlotRequest;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Response;
use Throwable;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $list = Slot::query()->get();

        return view('slot.index', [
            'list' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('slot.create', ['slot' => new Slot()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlotRequest $request): RedirectResponse
    {
        $result = false;

        try {
            $slot = new Slot();

            $slot->from = $request->get('from');
            $slot->to = $request->get('to');
            $slot->save();

            $info = $request->get('info');
            $slot->info()->create([
                'name' => $info['name'],
                'description' => $info['description'],
                'price' => $info['price'],
                'capacity' => $info['capacity'],
            ]);

            $slot->info->save();

            $result = true;
            Flash::success('Создано');
        } catch (Exception $exception) {
            $error = $exception->getMessage();
        }

        return Redirect::route('slot.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot): View
    {
        return view('slot.show', ['slot' => $slot]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot): View
    {
        return view('slot.edit', ['slot' => $slot]);
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdateSlotRequest $request, Slot $slot): RedirectResponse
    {
        $errors = [];
        try {
            DB::beginTransaction();

            $result = $slot->update([
                'from' => $request->input('from'),
                'to' => $request->input('to'),
            ]);

            if (!$result) {
                throw new Exception('Error occurred while updating');
            }

            $result = $slot->info->update([
                'name' => $request->input('info.name'),
                'description' => $request->input('info.description'),
                'price' => $request->input('info.price'),
                'capacity' => $request->input('info.capacity'),
            ]);

            if (!$result) {
                throw new Exception('Error occurred while updating');
            }

            DB::commit();

            Flash::success('Сохранено');
        } catch (Exception $exception) {
            DB::rollBack();
            $errors[] = $exception->getMessage();
        }

        return Redirect::back()
            ->withErrors($errors)
            ->withInput($request->input())
        ;
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(Slot $slot): RedirectResponse
    {
        $errors = [];
        try {
            DB::beginTransaction();

            $result = $slot->delete();

            if (!$result) {
                throw new Exception('Error occurred while deleting');
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $errors[] = $exception->getMessage();
        }

        if (count($errors) > 0) {
            return Redirect::route('slot.edit', ['slot' => $slot])
                ->withErrors($errors)
            ;
        }

        Flash::success("Слот id:$slot->slot_id удален");

        return Redirect::route('slot.index');
    }
}
