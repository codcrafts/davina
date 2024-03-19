<?php

namespace App\Http\Resources\API\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->data['title'],
            'body' => $this->data['body'],
            'status'=>$this->data['status'],
            'data_id' => isset($this->data['data_id']) ? $this->data['data_id'] : 0,
            'type' => isset($this->data['type']) ? $this->data['type'] : '',
            'created_at' => $this->data['created_at']
        ];
    }
}
