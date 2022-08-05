<?php

namespace Modules\Tickets\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'tickets',
            'id' => (string) $this->id,
            'attributes' => [
                'id' => (int) $this->id,
                'subject' => $this->name,
                'code' => $this->code,
                'body' => $this->body,
                'status' => [
                    'id' => $this->status_id,
                    'name' => $this->status->name,
                ],
                'department' => [
                    'id' => $this->department,
                    'name' => $this->dept->deptname,
                ],
                'user_id' => $this->user_id,
                'project_id' => $this->project_id,
                'priority' => [
                    'id' => $this->priority_id,
                    'name' => $this->priority->name,
                ],
                'due_date' => dateIso8601String($this->due_date),
                'closed_at' => !is_null($this->closed_at) ? dateIso8601String($this->closed_at) : $this->closed_at,
                'assignee' => [
                    'id' => $this->assignee,
                    'name' => optional($this->agent)->name,
                ],
                'resolution_time' => $this->resolution_time,
                'archived_at' => !is_null($this->archived_at) ? dateIso8601String($this->archived_at) : $this->archived_at,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ],
        ];
    }
}
