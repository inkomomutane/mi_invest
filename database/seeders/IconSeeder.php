<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;
use JsonException;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws JsonException
     */
    public function run(): void
    {
        $this->processIcons();
    }

    /**
     * @throws JsonException
     */
    private function processIcons(): void
    {
        try {
            $icons = json_decode(file_get_contents(__DIR__ . '/icons.json'), true, 512, JSON_THROW_ON_ERROR);

            foreach ($icons as $icon) {
                Icon::updateOrCreate(
                    ['title' => $icon['title']],
                    [
                        'title' => $icon['title'],
                        'tags' => $icon['tags'] ?? [],
                        'categories' => $icon['categories'] ?? [],
                        'lab' => $icon['lab'] ?? false,
                        'created_at' => $icon['created_at'] ?? now(),
                        'updated_at' => $icon['updated_at'] ?? now(),
                    ]
                );
            }
        } catch (JsonException $e) {
            if(app()->isLocal()){
                throw  $e;
            }
        }
    }

}
