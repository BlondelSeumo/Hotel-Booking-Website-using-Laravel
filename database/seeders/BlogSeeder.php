<?php

namespace Database\Seeders;

use Botble\ACL\Models\User;
use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Tag;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('news');

        Post::query()->truncate();
        Category::query()->truncate();
        Tag::query()->truncate();

        $categories = [
            [
                'name' => 'General',
                'is_default' => true,
            ],
            [
                'name' => 'Hotel',
            ],
            [
                'name' => 'Booking',
            ],
            [
                'name' => 'Resort',
            ],
            [
                'name' => 'Travel',
            ],
        ];

        foreach ($categories as $index => $item) {
            $this->createCategory(Arr::except($item, 'children'), 0, $index != 0);
        }

        $tags = [
            [
                'name' => 'General',
            ],
            [
                'name' => 'Hotel',
            ],
            [
                'name' => 'Booking',
            ],
            [
                'name' => 'Resort',
            ],
            [
                'name' => 'Travel',
            ],
        ];

        foreach ($tags as $item) {
            $item['author_id'] = 1;
            $item['author_type'] = User::class;
            $tag = Tag::query()->create($item);

            Slug::query()->create([
                'reference_type' => Tag::class,
                'reference_id' => $tag->id,
                'key' => Str::slug($tag->name),
                'prefix' => SlugHelper::getPrefix(Tag::class),
            ]);
        }

        $posts = [
            [
                'name' => 'Each of our 8 double rooms has its own distinct.',
                'description' => 'Discover a world of unique comfort in our collection of 8 double rooms, each boasting its own distinct charm and character. Immerse yourself in a stay that caters to your individual preferences',
            ],
            [
                'name' => 'Essential Qualities of Highly Successful Music',
                'description' => 'Delve into the secrets behind the music that resonates deeply with audiences worldwide. Uncover the essential qualities that elevate music from ordinary to extraordinary, as we explore.',
            ],
            [
                'name' => '9 Things I Love About Shaving My Head',
                'description' => 'Embark on a personal journey of self-discovery and empowerment as we delve into the unique experience of embracing a bald look. From newfound confidence to a simplified routine, explore the 9 things',
            ],
            [
                'name' => 'Why Teamwork Really Makes The Dream Work',
                'description' => 'Unlock the power of collaboration and synergy in achieving your goals. In this exploration of the importance of teamwork, we delve into real-world examples and insights and how combining diverse skills.',
            ],
            [
                'name' => 'The World Caters to Average People',
                'description' => 'Unveil the hidden truths behind success in a world that often values conformity. In a thought-provoking analysis, we examine why societal norms tend to cater to the average and breaking boundaries.',
            ],
            [
                'name' => 'The litigants on the screen are not actors',
                'description' => 'Take a behind-the-scenes look at the reality of courtroom dramas. Contrary to common assumptions, the litigants you see on the screen are not mere actors, but real people with compelling stories.',
            ],
        ];

        foreach ($posts as $index => $item) {
            $item['author_id'] = 1;
            $item['author_type'] = User::class;
            $item['views'] = $this->fake()->numberBetween(100, 2500);
            $item['is_featured'] = true;
            $item['image'] = 'news/' . ($index + 1) . '.jpg';
            $item['content'] = str_replace(
                'news/',
                RvMedia::getImageUrl('news/'),
                File::get(database_path('seeders/contents/post.html'))
            );

            $post = Post::query()->create($item);

            $post->categories()->sync([
                $this->fake()->numberBetween(1, 2),
                $this->fake()->numberBetween(3, 4),
            ]);

            $post->tags()->sync([1, 2, 3, 4, 5]);

            Slug::query()->create([
                'reference_type' => Post::class,
                'reference_id' => $post->id,
                'key' => Str::slug($post->name),
                'prefix' => SlugHelper::getPrefix(Post::class),
            ]);
        }
    }

    protected function createCategory(
        array $item,
        int|string $parentId = 0,
        bool $isFeatured = false
    ) {
        $item['description'] = $this->fake()->text();
        $item['author_id'] = 1;
        $item['parent_id'] = $parentId;
        $item['is_featured'] = $isFeatured;

        $category = Category::query()->create($item);

        Slug::query()->create([
            'reference_type' => Category::class,
            'reference_id' => $category->id,
            'key' => Str::slug($category->name),
            'prefix' => SlugHelper::getPrefix(Category::class),
        ]);

        return $category;
    }
}
