
<?php
// app/Http/Resources/AttractionResource.php

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'waitTime' => $this->wait_time,
            'status' => $this->status,
            'thrillLevel' => $this->thrill_level,
            'minHeight' => $this->min_height,
            'description' => $this->description,
            'duration' => $this->duration,
            'capacity' => $this->capacity,
            'rating' => (float) $this->rating,
            'location' => $this->location,
            'image' => $this->image,
            'features' => $this->features,
            'isOpen' => $this->status === 'open',
            'waitTimeCategory' => $this->getWaitTimeCategory(),
            'thrillDescription' => $this->getThrillDescription()
        ];
    }

    private function getWaitTimeCategory(): string
    {
        return match(true) {
            $this->wait_time <= 10 => 'short',
            $this->wait_time <= 30 => 'medium',
            default => 'long'
        };
    }

    private function getThrillDescription(): string
    {
        return match($this->thrill_level) {
            1 => 'Tranquillo',
            2 => 'Leggero',
            3 => 'Moderato',
            4 => 'Intenso',
            5 => 'Estremo'
        };
    }
}