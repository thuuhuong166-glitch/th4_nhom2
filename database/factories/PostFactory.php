<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(4);
        // published_at có thể quá khứ/hiện tại/tương lai để test lọc
        $when  = $this->faker->dateTimeBetween('-10 days', '+10 days');
        $status = $this->faker->randomElement(['draft','published']);

        // Nếu status = published mà published_at null -> set now
        $publishedAt = $this->faker->boolean(80) ? Carbon::instance($when) : null;
        if ($status === 'published' && $publishedAt === null) {
            $publishedAt = now();
        }

        return [
            'title'        => $title,
            'slug'         => Str::slug($title),
            'content'      => $this->faker->paragraphs(5, true),
            'status'       => $status,
            'view_count'   => 0,
            'published_at' => $publishedAt,
        ];
    }
}
