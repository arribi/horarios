<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'materia' => $this->materia,
            'h_totales' => $this->h_semanales,
            'h_semanales' => $this->h_totales,
            'turno' => $this->turno,
            'aula' => $this->aula,
            'user_id' => $this->user_id,
            'especialidad' => new EspecialidadResource($this->especialidad),
            'estudio_id' => $this->estudio_id,
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
