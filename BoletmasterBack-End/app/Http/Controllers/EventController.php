<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\{IndexEventRequest, StoreEventRequest, UpdateEventRequest};
use App\Http\Resources\{EventResource, EventsResource};
use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(IndexEventRequest $request)
    {
        $event = Event::filter()->paginate();

        return EventsResource::collection($event);
    }

    public function listarAdministracion(IndexEventRequest $request){
        $event = Event::filter()->paginate();

        return EventsResource::collection($event);
    }

    public function inicio(){
        $destacados = Event::destacados()->get();
        $proximos   = Event::proximos()->get();

        return JsonResource::make([
            'destacados' => $destacados,
            'proximos'   => $proximos,
        ]);
    }

    public function store(StoreEventRequest $request)
    {
        $evento = Event::create($request->only(['titulo', 'descripcion', 'lugar', 'fecha_hora']));
        $evento->categorias()->sync($request->input('categorias'));
        $imagen         = $request->file('imagen')->store('public/eventos');
        $imagen = Storage::url($imagen);
        $evento->imagen = asset($imagen);
        $evento->entradas()->createMany($request->input('entradas'));
        $evento->save();
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->only(['titulo', 'descripcion', 'lugar', 'fecha_hora']));
        $event->categorias()->sync($request->input('categorias'));

        if ($request->hasFile('imagen')) {
            Storage::delete($event->imagen);
            $imagen        = $request->file('imagen')->store('public/eventos');
            $event->imagen = $imagen;
        }

        foreach ($request->input('entradas') as $entrada) {
            if (isset($entrada['id'])) {
                $event->entradas()->where('id',$entrada['id'])->update($entrada);
            } else {
                $event->entradas()->create($entrada);
            }
        }

        return response()->json(['message' => 'Evento actualizado correctamente']);
    }

    public function destroy(Event $event)
    {
        $event->archivado = now();
        $event->save();

        return response()->json(['message' => 'Event archivated successfully.'], 200);
    }
    
}
